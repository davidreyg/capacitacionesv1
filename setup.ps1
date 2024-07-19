# Colores
$RED = "`e[31m"
$GREEN = "`e[32m"
$YELLOW = "`e[33m"
$BLUE = "`e[34m"
$CYAN = "`e[36m"
$RESET = "`e[0m"

# Variables
$ENV_FILE = ".env"
$WINDOWS_ENV_FILE = ".env.windows"

# Comprobación de Dependencias
if (-not (Get-Command php -ErrorAction SilentlyContinue)) {
    Write-Host "${RED}PHP is required but it's not installed. Aborting.${RESET}"
    exit 1
}

if (-not (Get-Command composer -ErrorAction SilentlyContinue)) {
    Write-Host "${RED}Composer is required but it's not installed. Aborting.${RESET}"
    exit 1
}

if (-not (Get-Command npm -ErrorAction SilentlyContinue)) {
    Write-Host "${RED}NPM is required but it's not installed. Aborting.${RESET}"
    exit 1
}

# Logo en ASCII con Colores
$LOGO = @"
${CYAN}
██████╗░░█████╗░██████╗░███████╗░██████╗░██╗░░░██╗░░░██████╗░███████╗██╗░░░██╗
██╔══██╗██╔══██╗██╔══██╗██╔════╝██╔════╝░██║░░░██║░░░██╔══██╗██╔════╝██║░░░██║
██║░░██║███████║██████╔╝█████╗░░██║░░██╗░██║░░░██║░░░██║░░██║█████╗░░╚██╗░██╔╝
██║░░██║██╔══██║██╔══██╗██╔══╝░░██║░░╚██╗██║░░░██║░░░██║░░██║██╔══╝░░░╚████╔╝░
██████╔╝██║░░██║██║░░██║███████╗╚██████╔╝╚██████╔╝██╗██████╔╝███████╗░░╚██╔╝░░
╚═════╝░╚═╝░░╚═╝╚═╝░░╚═╝╚══════╝░╚═════╝░░╚═════╝░╚═╝╚═════╝░╚══════╝░░░╚═╝░░░
${RESET}
${CYAN}Laravel Developer${RESET}
${CYAN}GitHub: https://github.com/davidreyg${RESET}
"@

# Descripción con colores
$DESCRIPTION = "${BLUE}Using PHP, Composer, and NPM for all operations${RESET}"

# Funciones
function Install-ComposerDependencies {
    Write-Host "${GREEN}Installing Composer dependencies...${RESET}"
    composer install --ignore-platform-reqs
}

function Install-NpmDependencies {
    Write-Host "${GREEN}Installing NPM dependencies...${RESET}"
    npm install
}

function Copy-File {
    param (
        [string]$Source,
        [string]$Destination
    )
    if (Test-Path $Source) {
        Copy-Item -Path $Source -Destination $Destination -Force
        if (-not $?) {
            Write-Host "${RED}Failed to copy $Source to $Destination.${RESET}"
            exit 1
        }
    } else {
        Write-Host "${RED}Source file $Source does not exist.${RESET}"
        exit 1
    }
}

function Install-Dependencies {
    if (-not (Test-Path $ENV_FILE)) {
        Write-Host "${RED}.env file does not exist. Please set up the environment first.${RESET}"
        exit 1
    }

    Write-Host "${GREEN}Installing development dependencies...${RESET}"
    Install-ComposerDependencies
    Install-NpmDependencies
    Write-Host "${GREEN}Development dependencies installed.${RESET}"
}

function Setup-Dev {
    Write-Host "${GREEN}Setting up development environment...${RESET}"
    Copy-File -Source $WINDOWS_ENV_FILE -Destination $ENV_FILE
    Write-Host "${GREEN}Development environment setup complete.${RESET}"
}

function Clean {
    Write-Host "${GREEN}Cleaning up...${RESET}"
    Remove-Item -Path $ENV_FILE -Force -ErrorAction SilentlyContinue
    Write-Host "${GREEN}Cleanup complete.${RESET}"
}

function Reset-App {
    Write-Host "${GREEN}Resetting the application...${RESET}"
    php artisan app:reset
}

# Menú
function Show-Menu {
    cls
    Write-Host "$LOGO"
    Write-Host ""
    Write-Host "$DESCRIPTION"
    Write-Host "${YELLOW}Select an option:${RESET}"

    if (-not (Test-Path $ENV_FILE)) {
        Write-Host "1) Setup Development Environment"
        Write-Host "6) Exit"
        $choice = Read-Host "Enter choice [1, 6]"
    } else {
        Write-Host "2) Install Dependencies"
        Write-Host "3) Clean Environment"
        Write-Host "4) Reset Application"
        Write-Host "6) Exit"
        $choice = Read-Host "Enter choice [2-6]"
    }

    switch ($choice) {
        1 {
            if (-not (Test-Path $ENV_FILE)) {
                Setup-Dev
            } else {
                Write-Host "${RED}Invalid choice, please try again.${RESET}"
            }
        }
        2 {
            if (Test-Path $ENV_FILE) {
                Install-Dependencies
            } else {
                Write-Host "${RED}Invalid choice, please try again.${RESET}"
            }
        }
        3 {
            if (Test-Path $ENV_FILE) {
                Clean
            } else {
                Write-Host "${RED}Invalid choice, please try again.${RESET}"
            }
        }
        4 {
            if (Test-Path $ENV_FILE) {
                Reset-App
            } else {
                Write-Host "${RED}Invalid choice, please try again.${RESET}"
            }
        }
        6 {
            exit 0
        }
        default {
            Write-Host "${RED}Invalid choice, please try again.${RESET}"
        }
    }
    Read-Host "Press [Enter] key to continue..."
}

# Loop del Menú
while ($true) {
    Show-Menu
}
