@echo off
cd C:\sistema_ventas

REM Inicia el servidor Laravel
start "" php artisan serve

REM Espera unos segundos para asegurarse de que el servidor esté en funcionamiento
timeout /nobreak /t 10 >nul

REM Abre Google Chrome en la URL del servidor Laravel
start chrome http://127.0.0.1:8000