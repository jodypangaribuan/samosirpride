#!/bin/bash

# HKBP Tiberias Church Website Deployment Script
# This script helps you deploy the HKBP Tiberias website on your VPS

# Color codes for better readability
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

echo -e "${GREEN}=== HKBP Tiberias Website Deployment ===${NC}"
echo -e "${YELLOW}This script will help you deploy the HKBP Tiberias website using Docker${NC}"
echo ""

# Check if Docker is installed
if ! command -v docker &> /dev/null; then
    echo -e "${RED}Docker is not installed. Installing Docker...${NC}"
    curl -fsSL https://get.docker.com -o get-docker.sh
    sudo sh get-docker.sh
    sudo usermod -aG docker $USER
    rm get-docker.sh
    echo -e "${GREEN}Docker installed successfully!${NC}"
    echo -e "${YELLOW}You may need to log out and back in for Docker to work without sudo.${NC}"
    echo ""
else
    echo -e "${GREEN}Docker is already installed.${NC}"
fi

# Check if Docker Compose is installed
if ! command -v docker-compose &> /dev/null; then
    echo -e "${RED}Docker Compose is not installed. Installing Docker Compose...${NC}"
    sudo curl -L "https://github.com/docker/compose/releases/download/v2.23.0/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
    sudo chmod +x /usr/local/bin/docker-compose
    echo -e "${GREEN}Docker Compose installed successfully!${NC}"
    echo ""
else
    echo -e "${GREEN}Docker Compose is already installed.${NC}"
fi

echo -e "${YELLOW}Starting deployment...${NC}"

# Create uploads directories if they don't exist
echo -e "${GREEN}Creating upload directories...${NC}"
mkdir -p php/uploads/acara_koor
mkdir -p php/uploads/ayat_harian
mkdir -p php/uploads/event
mkdir -p php/uploads/galeri
mkdir -p php/uploads/gambar_ayat
mkdir -p php/uploads/jemaat
mkdir -p php/uploads/koor
mkdir -p php/uploads/pelayanan
mkdir -p php/uploads/remaja
mkdir -p php/uploads/struktur
mkdir -p php/uploads/warta_jemaat

# Set proper permissions
echo -e "${GREEN}Setting proper permissions...${NC}"
chmod -R 755 .
find . -type f -exec chmod 644 {} \;
chmod +x deploy.sh

# Build and start the Docker containers
echo -e "${GREEN}Building and starting Docker containers...${NC}"
docker-compose up -d --build

# Check if the containers are running
if [ $? -eq 0 ]; then
    echo -e "${GREEN}Deployment successful!${NC}"
    echo ""
    echo -e "${YELLOW}Your website is now available at:${NC}"
    
    # Get the server's public IP
    PUBLIC_IP=$(curl -s ifconfig.me)
    echo -e "${GREEN}http://$PUBLIC_IP${NC}"
    echo ""
    echo -e "${YELLOW}Admin panel:${NC}"
    echo -e "${GREEN}http://$PUBLIC_IP/php/login.php${NC}"
    echo -e "${YELLOW}Username: admin${NC}"
    echo -e "${YELLOW}Password: password${NC}"
    echo ""
    echo -e "${YELLOW}PHPMyAdmin:${NC}"
    echo -e "${GREEN}http://$PUBLIC_IP:8080${NC}"
    echo -e "${YELLOW}Username: root${NC}"
    echo -e "${YELLOW}Password: (no password)${NC}"
    echo ""
    echo -e "${GREEN}Deployment completed successfully!${NC}"
else
    echo -e "${RED}Deployment failed. Please check the error messages above.${NC}"
fi 