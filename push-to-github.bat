@echo off
setlocal EnableDelayedExpansion
title Push Mohammad Ghaith CV to GitHub
cd /d "%~dp0"

where git >nul 2>nul
if errorlevel 1 (
    echo Git is not installed. Download it from https://git-scm.com/download/win , install, then run this file again.
    start "" https://git-scm.com/download/win
    pause & exit /b 1
)

echo.
echo  Create an EMPTY repository first at https://github.com/new
echo  (do NOT tick "Add a README"), then copy its URL, e.g.
echo     https://github.com/your-username/mohammad-cv.git
echo.
set /p REPO=Paste the repository URL here and press Enter:
if "%REPO%"=="" (echo No URL entered. & pause & exit /b 1)

REM --- identity (only set if missing) ---
git config --global user.name >nul 2>nul || git config --global user.name "Mohammad Ghaith"
git config --global user.email >nul 2>nul || git config --global user.email "mohamad.ziad97@gmail.com"

REM --- this folder is under inetpub; tell git it's safe ---
git config --global --add safe.directory "%CD:\=/%" >nul 2>nul

if not exist ".git" git init -b main >nul
git add -A

REM --- SAFETY: refuse to continue if the SMTP password file is staged ---
git diff --cached --name-only | findstr /i /x "config/smtp.php" >nul
if not errorlevel 1 (
    echo.
    echo  STOP: config/smtp.php ^(your Gmail App Password^) was about to be uploaded.
    echo  Check that the .gitignore file is in this folder, then try again.
    git reset >nul
    pause & exit /b 1
)

echo.
echo Files that will be uploaded:
git diff --cached --name-only
echo.

git commit -m "CV website" >nul 2>nul
git branch -M main
git remote remove origin >nul 2>nul
git remote add origin "%REPO%"

echo Uploading... (a browser window may ask you to sign in to GitHub)
git push -u origin main
if errorlevel 1 (
    echo.
    echo Upload failed - see the message above.
    pause & exit /b 1
)

echo.
echo ===============================================
echo   Done! Your project is on GitHub:
echo   %REPO:.git=%
echo ===============================================
start "" "%REPO:.git=%"
pause
