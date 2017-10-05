<?php 
$root=realpath($_SERVER["DOCUMENT_ROOT"]);

require ( $root.'/config/config.php');
require ( $root.'/config/db_open.php');


function isTableExist($symbol){

global $conn;
$table_name=$conn->real_escape_string($symbol);
$result = $conn->query("SHOW TABLES LIKE '".$table_name."'");


    if($result->num_rows == 1) 
    	{
        	return true;

    	} elseif($result->num_rows == 0) 
	    	{
	    		return false;

			}

}

function createStockTable($symbol){

global $conn;
$table_name=$conn->real_escape_string($symbol);

$query='CREATE TABLE `'.$table_name.'` LIKE stock_general';

					if($conn->query($query)== true) {
						return true;
					} else {
						return false;
					}

}


?>
