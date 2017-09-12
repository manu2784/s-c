<?php 
require_once 'config.php';

$servername = $config ['database']['hostname'];
$username = $config ['database']['username'];
$password = $config ['database']['password'];
$db_name=$config ['database']['db_name'];

// Create connection
$conn = new mysqli($servername, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>