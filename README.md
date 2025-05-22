# HKBP Tiberias Church Website

A church website application built with PHP and MySQL, containerized with Docker for easy deployment.

## Prerequisites

- Docker and Docker Compose installed on your server
- Git (optional, for cloning the repository)

## Deployment Instructions

### Quick Deployment (Linux VPS)

We've provided a convenient deployment script for Linux-based VPS:

```bash
# Make the script executable (if not already)
chmod +x deploy.sh

# Run the deployment script
./deploy.sh
```

The script will:

1. Check if Docker and Docker Compose are installed, and install them if needed
2. Create necessary upload directories
3. Set appropriate permissions
4. Build and start the Docker containers
5. Display access information for your website

### Manual Deployment

#### 1. Clone or download the repository

```bash
git clone <repository-url>
# or download and extract the ZIP file
cd proyekAkhir1
```

#### 2. Build and start the Docker containers

```bash
docker-compose up -d
```

This command will:

- Build the PHP application container
- Start MySQL database on port 3307
- Start PHPMyAdmin on port 8080
- Initialize the database with the necessary tables

#### 3. Access the application

- Website: http://your-server-ip/
- Admin Panel: http://your-server-ip/php/login.php

  - Default username: admin
  - Default password: password

- PHPMyAdmin: http://your-server-ip:8080
  - Username: root
  - Password: (no password)

## Directory Structure

- `/` - Main application files
- `/php` - Admin panel and backend files
- `/assets` - CSS, JavaScript, and images
- `/templates` - HTML templates
- `/database` - SQL initialization files

## Environment Variables

Environment variables are set in docker-compose.yml:

```yaml
environment:
  - DB_HOST=db
  - DB_USER=root
  - DB_PASSWORD=
  - DB_NAME=db_admin
  - DB_PORT=3306
  - APP_ENV=production
  - APP_DEBUG=false
```

## Managing Docker Containers

- Stop containers: `docker-compose down`
- View logs: `docker-compose logs -f`
- Restart containers: `docker-compose restart`

### Monitoring Container Health

We've included a health check script to monitor the status of your Docker containers:

```bash
# Make the script executable (if not already)
chmod +x health-check.sh

# Run the health check
./health-check.sh
```

This script will:

1. Check if all required containers are running
2. Display detailed status information for each container
3. Test the database connection
4. Show disk usage for Docker volumes
5. Display memory and CPU usage

Run this script regularly to ensure your application is healthy.

## Backup and Restore

We've provided a backup script to easily create backups of your database and uploads:

```bash
# Make the script executable (if not already)
chmod +x backup.sh

# Run the backup script
./backup.sh
```

The script will:

1. Create a backup of the database
2. Create a backup of uploaded files
3. Optionally create a full backup of the entire project
4. Store all backups in a `backups` directory

### Manual Backup and Restore

#### Backup the database

```bash
docker exec hkbp_db sh -c 'exec mysqldump -uroot db_admin' > backup.sql
```

#### Restore the database

```bash
cat backup.sql | docker exec -i hkbp_db sh -c 'exec mysql -uroot db_admin'
```

## Using HTTPS with Nginx (Optional)

For added security, you might want to use HTTPS. We've provided a sample Nginx configuration file (`nginx-config-example.conf`) that you can use as a reference.

To set up HTTPS with Nginx:

1. Install Nginx on your server
2. Obtain SSL certificates (e.g., using Let's Encrypt)
3. Modify the example config file with your domain and certificate paths
4. Place the modified config in `/etc/nginx/sites-available/`
5. Create a symbolic link to `/etc/nginx/sites-enabled/`
6. Test and reload Nginx

## Customization

To modify any of the site content, you can:

1. Log in to the admin panel
2. Or modify the files directly in the container

## Troubleshooting

- If you encounter database connection issues, ensure the MySQL container is running properly
- Check logs with `docker-compose logs -f db`
- For permission issues, run `docker exec -it hkbp_app chown -R www-data:www-data /var/www/html`
