#!/bin/bash
set -e

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

# Make sure permissions are set correctly
chown -R www-data:www-data /var/www/html

# Execute the command passed to the container
exec "$@" 