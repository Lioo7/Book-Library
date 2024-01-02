<?php
include 'config.php';

$conn = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['database']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Read and execute the SQL file
$sql = file_get_contents('schema.sql');
$conn->multi_query($sql);

// Handle errors, logging, etc. as needed
if ($conn->error) {
    die("SQL execution failed: " . $conn->error);
}

$conn->close();
?>
