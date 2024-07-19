#!/bin/bash

# Colores
RED=$(tput setaf 1)
GREEN=$(tput setaf 2)
YELLOW=$(tput setaf 3)
BLUE=$(tput setaf 4)
CYAN=$(tput setaf 6)
RESET=$(tput sgr0)

# Variables
ENV_FILE=".env"
DOCKER_COMPOSE_FILE="docker-compose.yml"
USE_SAIL=false
SAIL_CHOICE=""

# Comprobación de Dependencias
command -v composer >/dev/null 2>&1 || { echo >&2 "${RED}Composer is required but it's not installed. Aborting.${RESET}"; exit 1; }
command -v npm >/dev/null 2>&1 || { echo >&2 "${RED}npm is required but it's not installed. Aborting.${RESET}"; exit 1; }
command -v docker >/dev/null 2>&1 || { echo >&2 "${RED}Docker is required but it's not installed. Aborting.${RESET}"; exit 1; }

# Prompt para configuración inicial
echo "${YELLOW}Do you want to use Laravel Sail? (y/n)${RESET}"
read -p "Enter choice: " use_sail_choice
case $use_sail_choice in
    y|Y|yes|Yes|YES)
        USE_SAIL=true
        SAIL_CHOICE="${BLUE}Using Laravel Sail${RESET}"
        ;;
    n|N|no|No|NO)
        USE_SAIL=false
        SAIL_CHOICE="${RED}Not using Laravel Sail${RESET}"
        ;;
    *)
        echo "${RED}Invalid choice. Defaulting to not using Sail.${RESET}"
        USE_SAIL=false
        SAIL_CHOICE="${RED}Not using Laravel Sail (default)${RESET}"
        ;;
esac

# Logo en ASCII con Colores
LOGO="
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
"
# Descripción con colores
DESCRIPTION="${BLUE}$SAIL_CHOICE${RESET}
"

# Funciones
copy_file() {
    local source=$1
    local destination=$2
    if [[ -f $source ]]; then
        cp $source $destination || { echo "${RED}Failed to copy $source to $destination.${RESET}"; exit 1; }
    else
        echo "${RED}Source file $source does not exist.${RESET}"
        exit 1
    fi
}

install_dependencies() {
    if [[ ! -f $ENV_FILE ]]; then
        echo "${RED}.env file does not exist. Please set up the environment first.${RESET}"
        exit 1
    fi

    local env=$(grep "^APP_ENV=" $ENV_FILE | cut -d '=' -f 2)

    if [[ $USE_SAIL == true ]]; then
        if [[ $env == "local" ]]; then
            echo "${GREEN}Installing development dependencies using Sail...${RESET}"
            ./vendor/bin/sail composer install
            ./vendor/bin/sail npm install
            echo "${GREEN}Development dependencies installed.${RESET}"
        elif [[ $env == "production" ]]; then
            echo "${GREEN}Installing production dependencies using Sail...${RESET}"
            ./vendor/bin/sail composer install --no-dev --optimize-autoloader
            ./vendor/bin/sail npm install --production
            echo "${GREEN}Production dependencies installed.${RESET}"
        else
            echo "${RED}Invalid environment in .env file. APP_ENV should be 'local' or 'production'.${RESET}"
            exit 1
        fi
    else
        if [[ $env == "local" ]]; then
            echo "${GREEN}Installing development dependencies...${RESET}"
            composer install
            npm install
            echo "${GREEN}Development dependencies installed.${RESET}"
        elif [[ $env == "production" ]]; then
            echo "${GREEN}Installing production dependencies...${RESET}"
            composer install --no-dev --optimize-autoloader
            npm install --production
            echo "${GREEN}Production dependencies installed.${RESET}"
        else
            echo "${RED}Invalid environment in .env file. APP_ENV should be 'local' or 'production'.${RESET}"
            exit 1
        fi
    fi
}

setup_dev() {
    echo "${GREEN}Setting up development environment...${RESET}"
    copy_file ".env.dev" $ENV_FILE
    copy_file "docker-compose.dev.yml" $DOCKER_COMPOSE_FILE
    echo "${GREEN}Development environment setup complete.${RESET}"
}

setup_prod() {
    echo "${GREEN}Setting up production environment...${RESET}"
    copy_file ".env.prod" $ENV_FILE
    copy_file "docker-compose.prod.yml" $DOCKER_COMPOSE_FILE
    echo "${GREEN}Production environment setup complete.${RESET}"
}

clean() {
    echo "${GREEN}Cleaning up...${RESET}"
    rm -f $ENV_FILE
    rm -f $DOCKER_COMPOSE_FILE
    echo "${GREEN}Cleanup complete.${RESET}"
}

serve() {
    if [[ $USE_SAIL == true ]]; then
        ./vendor/bin/sail up
    else
        php artisan serve
    fi
}

reset_app() {
    if [[ $USE_SAIL == true ]]; then
        ./vendor/bin/sail artisan app:reset
    else
        php artisan app:reset
    fi
}

# Menú
show_menu() {
    clear
    echo "$LOGO"
    echo ""
    echo "$DESCRIPTION"
    echo "${YELLOW}Select an option:${RESET}"
    echo "1) Setup Development Environment"
    echo "2) Setup Production Environment"
    echo "3) Install Dependencies"
    echo "4) Clean Environment"
    echo "5) Serve Application"
    echo "6) Reset Application"
    echo "7) Exit"
    read -p "Enter choice [1-7]: " choice
    case $choice in
        1)
            setup_dev
            ;;
        2)
            setup_prod
            ;;
        3)
            install_dependencies
            ;;
        4)
            clean
            ;;
        5)
            serve
            ;;
        6)
            reset_app
            ;;
        7)
            exit 0
            ;;
        *)
            echo "${RED}Invalid choice, please try again.${RESET}"
            ;;
    esac
    read -p "Press [Enter] key to continue..."
}

# Loop del Menú
while true; do
    show_menu
done
