<?php 
$root=realpath($_SERVER["DOCUMENT_ROOT"]);

require ( $root.'/config/config.php');
require ( $root.'/config/db_open.php');


function createStockTable($symbol){

global $conn;
$table_name=$symbol;
$query='CREATE TABLE `'.$table_name.'` LIKE stock_general';

					if($conn->query($query)== true) {
						return true;
					} else {
						return false;
					}

}

?>