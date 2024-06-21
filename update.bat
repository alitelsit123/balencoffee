@echo off
REM Change directory to the repository's directory
cd /d "C:\xampp\htdocs\balencoffee"

REM Execute the git pull command
git pull

REM Check if the git pull was successful
if %errorlevel% equ 0 (
    echo Pull successful.
    exit
) else (
    echo Pull failed.
    pause
)
