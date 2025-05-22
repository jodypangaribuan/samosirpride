#!/bin/bash
set -e

# Wait for database to be ready
if [ ! -z "$DB_HOST" ]; then
    echo "Waiting for database connection..."
    while ! mysqladmin ping -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USER" -p"$DB_PASSWORD" --silent; do
        echo "MySQL is unavailable - sleeping"
        sleep 1
    done
    echo "MySQL is up - continuing"
fi

# Update database connection settings
if [ -f /var/www/html/php/koneksi.php ]; then
    sed -i "s/\$host = \"localhost\";/\$host = \"${DB_HOST}\";/" /var/www/html/php/koneksi.php
    sed -i "s/\$user = \"root\";/\$user = \"${DB_USER}\";/" /var/www/html/php/koneksi.php
    sed -i "s/\$pass = \"\";/\$pass = \"${DB_PASSWORD}\";/" /var/www/html/php/koneksi.php
    sed -i "s/\$db   = \"db_admin\";/\$db   = \"${DB_NAME}\";/" /var/www/html/php/koneksi.php
    sed -i "s/\$port = 3307;/\$port = ${DB_PORT};/" /var/www/html/php/koneksi.php
    echo "Database connection updated."
else
    echo "Warning: Database configuration file not found."
fi

# Create upload directories if they don't exist
mkdir -p /var/www/html/php/uploads/ayat \
         /var/www/html/php/uploads/galeri \
         /var/www/html/php/uploads/jemaat \
         /var/www/html/php/uploads/struktur \
         /var/www/html/php/uploads/warta_jemaat \
         /var/www/html/php/uploads/remaja

# Make sure permissions are set correctly
chown -R www-data:www-data /var/www/html
find /var/www/html -type d -exec chmod 755 {} \;
find /var/www/html -type f -exec chmod 644 {} \;
chmod -R 775 /var/www/html/php/uploads

# Execute the command passed to the container
exec "$@" 