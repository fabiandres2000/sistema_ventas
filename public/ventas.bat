@echo off
cd C:\sistema_ventas

REM Inicia el servidor Laravel
start "" php artisan serve --host=192.168.1.23 --port=8000