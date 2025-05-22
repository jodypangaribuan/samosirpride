#!/bin/bash

# HKBP Tiberias Church Website Backup Script
# This script creates a backup of the database and uploads directories

# Color codes for better readability
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

echo -e "${GREEN}=== HKBP Tiberias Website Backup ===${NC}"
echo -e "${YELLOW}This script will create a backup of your database and uploaded files${NC}"
echo ""

# Create backup directory if it doesn't exist
BACKUP_DIR="backups"
mkdir -p "$BACKUP_DIR"

# Get current date and time for the backup filename
TIMESTAMP=$(date +"%Y%m%d-%H%M%S")
DB_BACKUP_FILE="$BACKUP_DIR/db_backup_$TIMESTAMP.sql"
UPLOADS_BACKUP_FILE="$BACKUP_DIR/uploads_backup_$TIMESTAMP.tar.gz"
FULL_BACKUP_FILE="$BACKUP_DIR/full_backup_$TIMESTAMP.tar.gz"

# Check if Docker is running
if ! docker ps &> /dev/null; then
    echo -e "${RED}Docker is not running. Please start Docker first.${NC}"
    exit 1
fi

# Check if the database container is running
if ! docker ps | grep -q "hkbp_db"; then
    echo -e "${RED}Database container is not running. Please start your containers first.${NC}"
    exit 1
fi

# Backup the database
echo -e "${YELLOW}Creating database backup...${NC}"
docker exec hkbp_db sh -c 'exec mysqldump -uroot db_admin' > "$DB_BACKUP_FILE"

if [ $? -eq 0 ]; then
    echo -e "${GREEN}Database backup created successfully: $DB_BACKUP_FILE${NC}"
else
    echo -e "${RED}Failed to create database backup.${NC}"
    exit 1
fi

# Backup the uploads directories
echo -e "${YELLOW}Creating uploads backup...${NC}"
tar -czf "$UPLOADS_BACKUP_FILE" php/uploads

if [ $? -eq 0 ]; then
    echo -e "${GREEN}Uploads backup created successfully: $UPLOADS_BACKUP_FILE${NC}"
else
    echo -e "${RED}Failed to create uploads backup.${NC}"
    exit 1
fi

# Create a full backup (optional)
echo -e "${YELLOW}Would you like to create a full backup of the entire project? (y/n)${NC}"
read -r create_full_backup

if [[ "$create_full_backup" =~ ^[Yy]$ ]]; then
    echo -e "${YELLOW}Creating full project backup...${NC}"
    tar --exclude="$BACKUP_DIR" --exclude=".git" -czf "$FULL_BACKUP_FILE" .
    
    if [ $? -eq 0 ]; then
        echo -e "${GREEN}Full backup created successfully: $FULL_BACKUP_FILE${NC}"
    else
        echo -e "${RED}Failed to create full backup.${NC}"
    fi
fi

echo ""
echo -e "${GREEN}Backup process completed!${NC}"
echo -e "${YELLOW}Backup files are stored in the '$BACKUP_DIR' directory.${NC}"
echo ""
echo -e "${YELLOW}To restore the database:${NC}"
echo -e "${GREEN}cat $DB_BACKUP_FILE | docker exec -i hkbp_db sh -c 'exec mysql -uroot db_admin'${NC}"
echo ""
echo -e "${YELLOW}To restore the uploads:${NC}"
echo -e "${GREEN}tar -xzf $UPLOADS_BACKUP_FILE -C ./${NC}" 