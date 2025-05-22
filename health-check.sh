#!/bin/bash

# HKBP Tiberias Church Website Health Check
# This script checks the health of Docker containers

# Color codes for better readability
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

echo -e "${YELLOW}=== HKBP Tiberias Docker Container Health Check ===${NC}"

# Check if Docker is running
if ! docker ps &> /dev/null; then
    echo -e "${RED}ERROR: Docker is not running.${NC}"
    exit 1
fi

# Check web application container
if docker ps | grep -q "hkbp_app"; then
    echo -e "${GREEN}✓ Web Application (hkbp_app): RUNNING${NC}"
    
    # Additional checks for the web container
    app_status=$(docker inspect --format='{{.State.Status}}' hkbp_app)
    app_health=$(docker inspect --format='{{.State.Health.Status}}' hkbp_app 2>/dev/null || echo "N/A")
    app_uptime=$(docker inspect --format='{{.State.StartedAt}}' hkbp_app)
    
    echo -e "  - Status: ${YELLOW}$app_status${NC}"
    echo -e "  - Health: ${YELLOW}$app_health${NC}"
    echo -e "  - Running since: ${YELLOW}$app_uptime${NC}"
else
    echo -e "${RED}✗ Web Application (hkbp_app): NOT RUNNING${NC}"
fi

# Check database container
if docker ps | grep -q "hkbp_db"; then
    echo -e "${GREEN}✓ Database (hkbp_db): RUNNING${NC}"
    
    # Additional checks for the database container
    db_status=$(docker inspect --format='{{.State.Status}}' hkbp_db)
    db_health=$(docker inspect --format='{{.State.Health.Status}}' hkbp_db 2>/dev/null || echo "N/A")
    db_uptime=$(docker inspect --format='{{.State.StartedAt}}' hkbp_db)
    
    echo -e "  - Status: ${YELLOW}$db_status${NC}"
    echo -e "  - Health: ${YELLOW}$db_health${NC}"
    echo -e "  - Running since: ${YELLOW}$db_uptime${NC}"
    
    # Check if MySQL is accepting connections
    echo -e "${YELLOW}Testing database connection...${NC}"
    if docker exec hkbp_db mysqladmin ping -h localhost -u root --silent; then
        echo -e "${GREEN}✓ Database connection: SUCCESSFUL${NC}"
    else
        echo -e "${RED}✗ Database connection: FAILED${NC}"
    fi
else
    echo -e "${RED}✗ Database (hkbp_db): NOT RUNNING${NC}"
fi

# Check phpMyAdmin container
if docker ps | grep -q "hkbp_phpmyadmin"; then
    echo -e "${GREEN}✓ phpMyAdmin (hkbp_phpmyadmin): RUNNING${NC}"
    
    # Additional checks for phpMyAdmin container
    pma_status=$(docker inspect --format='{{.State.Status}}' hkbp_phpmyadmin)
    pma_uptime=$(docker inspect --format='{{.State.StartedAt}}' hkbp_phpmyadmin)
    
    echo -e "  - Status: ${YELLOW}$pma_status${NC}"
    echo -e "  - Running since: ${YELLOW}$pma_uptime${NC}"
else
    echo -e "${RED}✗ phpMyAdmin (hkbp_phpmyadmin): NOT RUNNING${NC}"
fi

# Check disk space for Docker volumes
echo -e "\n${YELLOW}=== Storage Health Check ===${NC}"
echo -e "${YELLOW}Docker Volumes:${NC}"
docker system df -v | grep "hkbp_network\|dbdata"

# Check overall system health
echo -e "\n${YELLOW}=== System Health Summary ===${NC}"
echo -e "${YELLOW}Memory and CPU Usage:${NC}"
docker stats --no-stream hkbp_app hkbp_db hkbp_phpmyadmin

echo -e "\n${GREEN}Health check completed!${NC}" 