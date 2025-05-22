#!/bin/bash
set -e

# Enable debugging for the script
set -x

# Wait for database to be ready
if [ ! -z "$DB_HOST" ]; then
    echo "Waiting for database connection..."
    max_attempts=30
    attempt=0
    
    while [ $attempt -lt $max_attempts ]; do
        if mysqladmin ping -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USER" -p"$DB_PASSWORD" --silent; then
            echo "MySQL is up - continuing"
            break
        fi
        
        echo "MySQL is unavailable - sleeping (attempt $((attempt+1))/$max_attempts)"
        sleep 2
        attempt=$((attempt+1))
    done
    
    if [ $attempt -eq $max_attempts ]; then
        echo "MySQL did not become available in time - proceeding anyway"
    fi
fi

# Update database connection settings
if [ -f /var/www/html/php/koneksi.php ]; then
    echo "Updating database connection settings..."
    sed -i "s/\$host = \"localhost\";/\$host = \"${DB_HOST}\";/" /var/www/html/php/koneksi.php
    sed -i "s/\$user = \"root\";/\$user = \"${DB_USER}\";/" /var/www/html/php/koneksi.php
    sed -i "s/\$pass = \"\";/\$pass = \"${DB_PASSWORD}\";/" /var/www/html/php/koneksi.php
    sed -i "s/\$db   = \"db_admin\";/\$db   = \"${DB_NAME}\";/" /var/www/html/php/koneksi.php
    sed -i "s/\$port = 3306;/\$port = ${DB_PORT};/" /var/www/html/php/koneksi.php
    echo "Database connection updated."
else
    echo "Warning: Database configuration file not found."
fi

# Create required upload directories
echo "Creating upload directories..."
mkdir -p /var/www/html/php/uploads/ayat \
         /var/www/html/php/uploads/galeri \
         /var/www/html/php/uploads/jemaat \
         /var/www/html/php/uploads/struktur \
         /var/www/html/php/uploads/warta_jemaat \
         /var/www/html/php/uploads/remaja

# Create error pages directory if it doesn't exist
mkdir -p /var/www/html/errors

# Make sure permissions are set correctly
echo "Setting correct permissions..."
chown -R www-data:www-data /var/www/html
find /var/www/html -type d -exec chmod 755 {} \;
find /var/www/html -type f -exec chmod 644 {} \;
chmod -R 775 /var/www/html/php/uploads

# Apply Apache configuration (sometimes needed for config changes to take effect)
if [ -d /etc/apache2/sites-available ] && [ -f /etc/apache2/sites-available/000-default.conf ]; then
    echo "Reloading Apache configuration..."
    apachectl -t && apachectl graceful
fi

# Echo completion
echo "Initialization complete, starting web server..."

# Execute the command passed to the container
exec "$@" 