<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection parameters
$host = 'localhost';        // Host (typically localhost)
$dbname = 'Panol';  // Database name
$username = 'root';         // Username (default for XAMPP)
$password = '';             // Password (default for XAMPP is empty)

// Create PDO instance
try {
    // Establish the connection using the defined variables
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set error mode to exception for better debugging
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Connection successful message (optional)
    // echo "Connected to the database!";
} catch (PDOException $e) {
    // Display error message if connection fails
    die("Connection failed: " . $e->getMessage());
}
?>
