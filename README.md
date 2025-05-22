# HKBP Tiberias Church Website

## Dockerized Application

This project has been dockerized to make deployment easy on any platform supporting Docker.

### Prerequisites

- Docker
- Docker Compose

### Quick Start

1. Clone the repository:

   ```
   git clone <repository-url>
   cd <project-directory>
   ```

2. Create .env file from the example:

   ```
   cp env.example .env
   ```

   You can modify the .env file to customize database credentials, ports, etc.

3. Start the application:

   ```
   docker-compose up -d
   ```

4. Access the website:

   ```
   http://localhost
   ```

5. Access the admin panel:
   ```
   http://localhost/php/login.php
   ```
   Default credentials:
   - Username: admin
   - Password: admin123

### Configuration

The Docker setup uses the following configuration:

- PHP 8.0 with Apache
- MySQL 8.0
- Website running on port 80 (configurable)

### Environment Variables

You can customize the deployment by modifying the environment variables in the `.env` file:

- `DB_HOST`: Database hostname (default: db)
- `DB_PORT`: Database port (default: 3306)
- `DB_USER`: Database username (default: root)
- `DB_PASSWORD`: Database password (default: root_password)
- `DB_NAME`: Database name (default: db_admin)
- `WEB_PORT`: Website port (default: 80)
- `MYSQL_PORT`: MySQL external port (default: 3307)

### Volumes

The Docker setup uses the following volumes:

- `./:/var/www/html`: Mount the current directory to the web server's document root
- `mysql_data:/var/lib/mysql`: Persist MySQL data
- `./database:/docker-entrypoint-initdb.d`: Database initialization scripts

### Deployment

#### Deploying on a VPS

1. Install Docker and Docker Compose on your server:

   ```
   curl -fsSL https://get.docker.com | sh
   sudo curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
   sudo chmod +x /usr/local/bin/docker-compose
   ```

2. Copy your project files to the server:

   ```
   # Using git
   git clone <repository-url> /path/to/destination

   # OR using scp
   scp -r <project-directory> user@your-server:/path/to/destination
   ```

3. Configure environment variables:

   ```
   cd /path/to/destination
   cp env.example .env
   nano .env  # Edit settings as needed
   ```

4. Start the containers:

   ```
   docker-compose up -d
   ```

5. Access your website at `http://your-server-ip`

#### Deploying on WSL (Windows Subsystem for Linux)

1. Make sure WSL2 and Docker Desktop are installed and configured.

2. Navigate to your project in WSL:

   ```
   cd /path/to/your/project
   ```

3. Create and configure the .env file:

   ```
   cp env.example .env
   nano .env  # Edit settings as needed
   ```

4. Start the containers:

   ```
   docker-compose up -d
   ```

5. Access your website at `http://localhost`

### Troubleshooting

#### Fixing Container Configuration Errors

If you encounter an error related to `ContainerConfig`, try these steps:

1. Stop all containers and remove them:

   ```
   docker-compose down
   ```

2. Remove the volume to start fresh:

   ```
   docker volume rm <project_name>_mysql_data
   ```

3. Restart the containers:
   ```
   docker-compose up -d
   ```

#### Permission Issues

If you encounter permission issues with file uploads, run:

```
docker exec hkbp_webserver chown -R www-data:www-data /var/www/html
docker exec hkbp_webserver chmod -R 775 /var/www/html/php/uploads
```

#### Database Connection Issues

If the database connection fails, check if MySQL is running:

```
docker-compose ps
```

And check the logs:

```
docker-compose logs db
```

#### For WSL Users

If you encounter networking issues in WSL, try:

1. Restart Docker Desktop
2. In PowerShell (as Administrator), run:
   ```
   netsh winsock reset
   ```
3. Restart your computer
