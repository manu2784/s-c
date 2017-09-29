<?php 

require_once ('config/config.php');
require_once ('config/db_open.php');

function createStockTable($symbol){

$query='CREATE TABLE TATAMOTORS LIKE stock_general';
if($conn->query($query)== true) {
	echo "table created";
} else {
	echo "failed to create table";
}

$table_name=$symbol;
$result = $conn->query("SHOW TABLES LIKE '".$table_name."'");


    if($result->num_rows == 1) {
        echo "Table exists";
    } elseif($result->num_rows == 0) {
     echo "table Doesn't exist";
}


}




?>
