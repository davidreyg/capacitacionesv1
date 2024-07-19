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

# Comprobación de Dependencias
command -v docker >/dev/null 2>&1 || { echo >&2 "${RED}Docker is required but it's not installed. Aborting.${RESET}"; exit 1; }

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
DESCRIPTION="${BLUE}Using Laravel sail for all operations${RESET}
"

# Funciones
install_composer_dependencies() {
    if [[ -f "./vendor/bin/sail" ]]; then
        echo "${GREEN}Installing Composer dependencies using Sail...${RESET}"
        ./vendor/bin/sail composer install --ignore-platform-reqs
    else
        echo "${GREEN}Sail not found. Installing Composer dependencies using Docker...${RESET}"
        docker run --rm \
            -u "$(id -u):$(id -g)" \
            -v "$(pwd):/var/www/html" \
            -w /var/www/html \
            laravelsail/php82-composer:latest \
            composer install --ignore-platform-reqs
    fi
}

install_npm_dependencies() {
    echo "${GREEN}Installing NPM dependencies using Sail...${RESET}"
    ./vendor/bin/sail npm install
}

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

    if [[ $env == "local" ]]; then
        echo "${GREEN}Installing development dependencies...${RESET}"
        install_composer_dependencies
        install_npm_dependencies
        echo "${GREEN}Development dependencies installed.${RESET}"
    elif [[ $env == "production" ]]; then
        echo "${GREEN}Installing production dependencies...${RESET}"
        install_composer_dependencies --no-dev --optimize-autoloader
        ./vendor/bin/sail npm install --production
        echo "${GREEN}Production dependencies installed.${RESET}"
    else
        echo "${RED}Invalid environment in .env file. APP_ENV should be 'local' or 'production'.${RESET}"
        exit 1
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

reset_app() {
    echo "${GREEN}Resetting the application using Docker...${RESET}"
    ./vendor/bin/sail artisan app:reset
}

# Menú
show_menu() {
    clear
    echo "$LOGO"
    echo ""
    echo "$DESCRIPTION"
    echo "${YELLOW}Select an option:${RESET}"

    if [[ ! -f $ENV_FILE ]]; then
        echo "1) Setup Development Environment"
        echo "2) Setup Production Environment"
    fi

    echo "3) Install Dependencies"
    echo "4) Clean Environment"
    echo "5) Reset Application"
    echo "6) Exit"

    if [[ ! -f $ENV_FILE ]]; then
        read -p "Enter choice [1-6]: " choice
    else
        read -p "Enter choice [3-6]: " choice
    fi

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
            reset_app
            ;;
        6)
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
