@echo off
setlocal enabledelayedexpansion

:: 1. Ir a la ruta específica de tus imágenes
cd /d "E:\Avatar_#D\imagenes\imagenes\img"

:: 2. Crear las carpetas de destino si no existen
if not exist pares mkdir pares
if not exist impares mkdir impares

echo Organizando imagenes para fotogrametria...

:: 3. Recorrer todas las imagenes jpg
for %%F in (foto_*.jpg) do (
    set "nombre=%%~nF"
    
    :: Extraer solo el último dígito del nombre del archivo
    set "ultimo_digito=!nombre:~-1!"
    
    :: Verificar si el último dígito es divisible entre 2
    set /a "es_par=ultimo_digito %% 2"
    
    :: Mover el archivo a la carpeta correspondiente
    if !es_par! == 0 (
        move "%%F" "pares\" >nul
    ) else (
        move "%%F" "impares\" >nul
    )
)

echo.
echo ¡Proceso completado con exito!
pause