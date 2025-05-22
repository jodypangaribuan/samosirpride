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
   cd proyekAkhir1
   ```

2. Start the application:

   ```
   docker-compose up -d
   ```

3. Access the website:

   ```
   http://localhost
   ```

4. Access the admin panel:
   ```
   http://localhost/php/login.php
   ```
   Default credentials:
   - Username: admin
   - Password: admin123

### Configuration

The Docker setup uses the following configuration:

- PHP 8.0 with Apache
- MySQL 8.0 on port 3307
- Website running on port 80

### Environment Variables

You can customize the database connection by modifying the environment variables in the `docker-compose.yml` file:

- DB_HOST: Database hostname (default: db)
- DB_PORT: Database port (default: 3306)
- DB_USER: Database username (default: root)
- DB_PASSWORD: Database password (default: root_password)
- DB_NAME: Database name (default: db_admin)

### Volumes

The Docker setup uses the following volumes:

- `.:/var/www/html`: Mount the current directory to the web server's document root
- `mysql_data:/var/lib/mysql`: Persist MySQL data
- `./database:/docker-entrypoint-initdb.d`: Database initialization scripts

### Deployment

To deploy on a VPS or any Docker-compatible environment:

1. Install Docker and Docker Compose on your server:

   ```
   curl -fsSL https://get.docker.com | sh
   sudo curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
   sudo chmod +x /usr/local/bin/docker-compose
   ```

2. Copy your project files to the server:

   ```
   scp -r proyekAkhir1 user@your-server:/path/to/destination
   ```

3. Start the containers:

   ```
   cd /path/to/destination/proyekAkhir1
   docker-compose up -d
   ```

4. Access your website at `http://your-server-ip`

### Data Persistence

The MySQL data is stored in a Docker volume named `mysql_data`, which persists across container restarts. To back up your data:

```
docker exec proyekakhir1-db-1 sh -c 'exec mysqldump -uroot -p"$MYSQL_ROOT_PASSWORD" db_admin' > backup.sql
```

To restore data:

```
cat backup.sql | docker exec -i proyekakhir1-db-1 sh -c 'exec mysql -uroot -p"$MYSQL_ROOT_PASSWORD" db_admin'
```

### Troubleshooting

- If you encounter permission issues with file uploads, run:

  ```
  docker exec proyekakhir1-webserver-1 chown -R www-data:www-data /var/www/html
  ```

- If the database connection fails, check if MySQL is running:

  ```
  docker-compose ps
  ```

  And check the logs:

  ```
  docker-compose logs db
  ```
