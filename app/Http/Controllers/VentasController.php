<?php

namespace App\Http\Controllers;

use App\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use Codedge\Fpdf\Fpdf\Fpdf;

class VentasController extends Controller
{

    public function ticket(Request $request)
    {
        $venta = Venta::findOrFail($request->get("id"));

        define('EURO',chr(36));
        $pdf = new Fpdf('P','mm',array(80,150));
        $pdf->AddPage();

        $pdf->SetFont('Helvetica','',12);
        $pdf->Cell(60,4,'Lacodigoteca.com',0,1,'C');
        $pdf->SetFont('Helvetica','',8);
        $pdf->Cell(60,4,'C.I.F.: 01234567A',0,1,'C');
        $pdf->Cell(60,4,'C/ Arturo Soria, 1',0,1,'C');
        $pdf->Cell(60,4,'C.P.: 28028 Madrid (Madrid)',0,1,'C');
        $pdf->Cell(60,4,'999 888 777',0,1,'C');
        $pdf->Cell(60,4,'alfredo@lacodigoteca.com',0,1,'C');
        
        // DATOS FACTURA        
        $pdf->Ln(5);
        $pdf->Cell(60,4,'Factura Simpl.: F2019-000001',0,1,'');
        $pdf->Cell(60,4,'Fecha: 28/10/2019',0,1,'');
        $pdf->Cell(60,4,'Metodo de pago: EFECTIVO',0,1,'');
        
        // COLUMNAS
        $pdf->SetFont('Helvetica', 'B', 7);
        $pdf->Cell(30, 10, 'Articulo', 0);
        $pdf->Cell(5, 10, 'Ud',0,0,'R');
        $pdf->Cell(10, 10, 'Precio',0,0,'R');
        $pdf->Cell(15, 10, 'Total',0,0,'R');
        $pdf->Ln(8);
        $pdf->Cell(60,0,'','T');
        $pdf->Ln(0);
        
        // PRODUCTOS
        $pdf->SetFont('Helvetica', '', 7);

        $TOTAL = 0;
        foreach ($venta->productos as $producto) {
            $pdf->MultiCell(30,4,$producto->descripcion,0,'L'); 
            $pdf->Cell(35, -5, $producto->cantidad ,0,0,'R');
            $pdf->Cell(10, -5, EURO.number_format(round($producto->precio), 0, ',', ' '),0,0,'R');
            $pdf->Cell(15, -5, EURO.number_format(round($producto->cantidad * $producto->precio), 2, ',', ' '),0,0,'R');
            $pdf->Ln(3);

            $TOTAL += $producto->cantidad * $producto->precio;
        }
        
        // SUMATORIO DE LOS PRODUCTOS Y EL IVA
        $pdf->Ln(6);
        $pdf->Cell(60,0,'','T');
        $pdf->Ln(2);    
        $pdf->Cell(25, 10, 'TOTAL SIN I.V.A.', 0);    
        $pdf->Cell(20, 10, '', 0);
        $pdf->Cell(15, 10, EURO.number_format(round((round($TOTAL,2)/1.21),2), 2, ',', ' '),0,0,'R');
        $pdf->Ln(3);    
        $pdf->Cell(25, 10, 'I.V.A. 21%', 0);    
        $pdf->Cell(20, 10, '', 0);
        $pdf->Cell(15, 10, EURO.number_format(round((round($TOTAL,2)),2)-round((round(2*3,2)/1.21),2), 2, ',', ' '),0,0,'R');
        $pdf->Ln(3);    
        $pdf->Cell(25, 10, 'TOTAL', 0);    
        $pdf->Cell(20, 10, '', 0);
        $pdf->Cell(15, 10, EURO.number_format(round($TOTAL,2), 2, ',', ' '),0,0,'R');
        
        // PIE DE PAGINA
        $pdf->Ln(10);
        $pdf->Cell(60,0,'EL PERIODO DE DEVOLUCIONES',0,1,'C');
        $pdf->Ln(3);
        $pdf->Cell(60,0,'CADUCA EL DIA  01/11/2019',0,1,'C');
        
        $pdf->Output('F', 'tickets/ticket_venta_'.$request->get("id").'.pdf');
    }

    public function imprimirTicket(Request $request){

        $venta = Venta::findOrFail($request->get("id"));

        $nombreImpresora = env("NOMBRE_IMPRESORA");
        $connector = new WindowsPrintConnector($nombreImpresora);
        $impresora = new Printer($connector);
        $impresora->setJustification(Printer::JUSTIFY_CENTER);
        $impresora->setEmphasis(true);
        $impresora->text("Ticket de venta\n");
        $impresora->text($venta->created_at . "\n");
        $impresora->setEmphasis(false);
        $impresora->text("Cliente: ");
        $impresora->text($venta->cliente->nombre . "\n");
        $impresora->text("\nhttps://parzibyte.me/blog\n");
        $impresora->text("\n===============================\n");
        $total = 0;
        foreach ($venta->productos as $producto) {
            $subtotal = $producto->cantidad * $producto->precio;
            $total += $subtotal;
            $impresora->setJustification(Printer::JUSTIFY_LEFT);
            $impresora->text(sprintf("%.2fx%s\n", $producto->cantidad, $producto->descripcion));
            $impresora->setJustification(Printer::JUSTIFY_RIGHT);
            $impresora->text('$' . number_format($subtotal, 2) . "\n");
        }
        $impresora->setJustification(Printer::JUSTIFY_CENTER);
        $impresora->text("\n===============================\n");
        $impresora->setJustification(Printer::JUSTIFY_RIGHT);
        $impresora->setEmphasis(true);
        $impresora->text("Total: $" . number_format($total, 2) . "\n");
        $impresora->setJustification(Printer::JUSTIFY_CENTER);
        $impresora->setTextSize(1, 1);
        $impresora->text("Gracias por su compra\n");
        $impresora->text("https://parzibyte.me/blog");
        $impresora->feed(5);
        $impresora->close();
        return redirect()->back()->with("mensaje", "Ticket impreso");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventasConTotales = Venta::join("clientes", "clientes.id", "ventas.id_cliente")
            ->select("ventas.*", "clientes.nombre as cliente")
            ->get();
            
        return view("ventas.ventas_index", ["ventas" => $ventasConTotales,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Venta $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        $total = 0;
        foreach ($venta->productos as $producto) {
            $total += $producto->cantidad * $producto->precio;
        }
        return view("ventas.ventas_show", [
            "venta" => $venta,
            "total" => $total,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Venta $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Venta $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Venta $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        $venta->delete();
        return redirect()->route("ventas.index")
            ->with("mensaje", "Venta eliminada");
    }
}
