#!/bin/bash
# Script to rebuild the Docker containers for HKBP Tiberias project

echo "=== HKBP Tiberias Rebuild Script ==="
echo "This script will stop, rebuild, and restart the Docker containers."
echo

# Check if Docker is running
if ! docker info > /dev/null 2>&1; then
    echo "Error: Docker is not running. Please start Docker and try again."
    exit 1
fi

echo "1. Stopping existing containers..."
docker-compose down

echo "2. Removing old volumes (if any)..."
docker volume rm $(docker volume ls -q | grep proyekakhir1) 2>/dev/null || true

echo "3. Building the images..."
docker-compose build --no-cache

echo "4. Starting the containers..."
docker-compose up -d

echo "5. Checking container status..."
sleep 5
docker-compose ps

echo
echo "=== Rebuild Complete ==="
echo "Web server should now be available at: http://localhost:80"
echo "You can access the database at localhost:3306"
echo
echo "To view logs: docker-compose logs -f"
echo "To stop containers: docker-compose down" 