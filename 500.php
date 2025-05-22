<?php
// Enable error display for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Get the error information
$error = error_get_last();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Error - HKBP Tiberias</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .error-container {
            background-color: #fff;
            border-radius: 5px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-top: 5px solid #e74c3c;
        }

        h1 {
            color: #e74c3c;
            margin-bottom: 20px;
        }

        .error-details {
            background-color: #f9f9f9;
            border-left: 4px solid #e74c3c;
            padding: 15px;
            margin: 20px 0;
        }

        .btn {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .tech-info {
            margin-top: 30px;
            padding: 10px;
            border: 1px dashed #ccc;
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #777;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="error-container">
        <h1>500 - Server Error</h1>
        <p>We're sorry, but something went wrong on our end. Our technical team has been notified and is working on resolving the issue.</p>

        <div class="error-details">
            <p><strong>What happened?</strong> The server encountered an internal error that prevented it from fulfilling your request.</p>
            <p><strong>What can you do?</strong> Please try again in a few moments. If the problem persists, please contact the site administrator.</p>
        </div>

        <a href="index.php" class="btn">Go to Homepage</a>

        <?php if (isset($error) && $error): ?>
            <div class="tech-info">
                <h3>Technical Information (for developers):</h3>
                <p><strong>Error Type:</strong> <?php echo htmlspecialchars($error['type'] ?? 'Unknown'); ?></p>
                <p><strong>Message:</strong> <?php echo htmlspecialchars($error['message'] ?? 'No message available'); ?></p>
                <p><strong>File:</strong> <?php echo htmlspecialchars($error['file'] ?? 'Unknown file'); ?></p>
                <p><strong>Line:</strong> <?php echo htmlspecialchars($error['line'] ?? 'Unknown line'); ?></p>
            </div>
        <?php endif; ?>
    </div>

    <div class="footer">
        <p>&copy; <?php echo date('Y'); ?> HKBP Tiberias Lumban Bul-Bul. All rights reserved.</p>
    </div>
</body>

</html>