@echo off
:: Check for administrator privileges
openfiles >nul 2>&1
if '%errorlevel%' NEQ '0' (
    echo Requesting administrative privileges...
    powershell -Command "Start-Process '%0' -Verb runAs"
    exit /b
)

echo "Starting xampp..."
cd /d "C:\xampp"
start xampp_start.exe
timeout /t 10

echo "Starting project..."
cd /d "C:\xampp\htdocs\balencoffee"
start cmd /k "php artisan serve --host=balencoffee.test --port=80"

echo "Opening Browser..."
timeout /t 1
start http://balencoffee.test