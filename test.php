<?php ini_set('max_execution_time', 10);
require_once ('config/config.php');
require_once ('config/db_open.php');
require_once ('data/stocks/fetch_stock.php');


$query="SELECT MAX(date) FROM `syndibank`";
$result= $conn->query($query) or die($conn->error);

$row = mysqli_fetch_array($result);
echo $row[0];




?>