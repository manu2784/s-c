<?php 
/*$root=realpath($_SERVER["DOCUMENT_ROOT"]);

require ( $root.'/config/config.php');*/
require ('../../../config/db2_open.php');


function createStockTable($symbol){

global $conn2;
$table_name=$symbol;
$query='CREATE TABLE `'.$table_name.'` LIKE stock_general';

					if($conn2->query($query)== true) {
						return true;
					} else {
						return false;
					}

}

?>