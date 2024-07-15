<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost"; // your server name
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "test"; // the database you created

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
