<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection
include "koneksi.php";

echo "<h1>Database Connection Test</h1>";

// Display connection info
echo "<h2>Connection Settings</h2>";
echo "<pre>";
echo "Host: " . $host . "\n";
echo "Port: " . $port . "\n";
echo "User: " . $user . "\n";
echo "Password: " . (empty($pass) ? "(empty)" : "(set)") . "\n";
echo "Database: " . $db . "\n";
echo "</pre>";

// Check if connection works
echo "<h2>Connection Status</h2>";
if ($conn) {
    echo "<p style='color:green'>✓ Database connection successful!</p>";
} else {
    echo "<p style='color:red'>✗ Database connection failed: " . mysqli_connect_error() . "</p>";
    die();
}

// Check if users table exists
echo "<h2>Users Table Check</h2>";
$table_check = mysqli_query($conn, "SHOW TABLES LIKE 'users'");
if (mysqli_num_rows($table_check) > 0) {
    echo "<p style='color:green'>✓ Users table exists!</p>";
} else {
    echo "<p style='color:red'>✗ Users table does not exist!</p>";
    die();
}

// Check if admin user exists
echo "<h2>Admin User Check</h2>";
$query = "SELECT * FROM users WHERE username = 'admin'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    echo "<p style='color:green'>✓ Admin user found (ID: " . $user['id'] . ")</p>";

    // Test password verification
    echo "<h2>Password Verification Test</h2>";
    if (password_verify('admin123', $user['password'])) {
        echo "<p style='color:green'>✓ Password 'admin123' is valid!</p>";
    } else {
        echo "<p style='color:red'>✗ Password 'admin123' is NOT valid!</p>";
        echo "<p>Stored hash: " . $user['password'] . "</p>";
        echo "<p>Generated hash for admin123: " . password_hash('admin123', PASSWORD_DEFAULT) . "</p>";
    }
} else {
    echo "<p style='color:red'>✗ Admin user not found!</p>";

    // Print all users
    echo "<h3>All users in database:</h3>";
    $all_users = mysqli_query($conn, "SELECT * FROM users");
    if (mysqli_num_rows($all_users) > 0) {
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($all_users)) {
            echo "<li>ID: " . $row['id'] . ", Username: " . $row['username'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No users found in database.</p>";
    }
}

// Show all database tables
echo "<h2>All Database Tables</h2>";
$tables = mysqli_query($conn, "SHOW TABLES");
if (mysqli_num_rows($tables) > 0) {
    echo "<ul>";
    while ($row = mysqli_fetch_row($tables)) {
        echo "<li>" . $row[0] . "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No tables found in database.</p>";
}
