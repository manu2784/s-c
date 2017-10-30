<?php 
require_once 'config.php';
$servername = $config ['database2']['hostname'];
$username = $config ['database2']['username'];
$password = $config ['database2']['password'];
$db_name=$config ['database2']['db_name'];
// Create connection
$conn2 = new mysqli($servername, $username, $password, $db_name);
// Check connection
if ($conn2->connect_error) {
    die("Connection failed: " . $conn2->connect_error);
} 
?>