<?php

// Database configuration constants
define('DB_HOST', 'localhost');
define('DB_NAME', 'food_db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

try {
	// Create DSN (Data Source Name)
	$dsn = sprintf("mysql:host=%s;dbname=%s;charset=%s",
		DB_HOST,
		DB_NAME,
		DB_CHARSET
	);

	// Configure PDO options
	$options = [
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES   => false,
	];

	// Create PDO instance
	$conn = new PDO($dsn, DB_USER, DB_PASS, $options);

} catch (PDOException $e) {
	// Log the error (in production, log to file instead of displaying)
	die('Connection failed: ' . $e->getMessage());
}
?>