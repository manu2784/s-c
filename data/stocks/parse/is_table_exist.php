<?php 

$root=realpath($_SERVER["DOCUMENT_ROOT"]);

require ( $root.'/config/config.php');
require ( $root.'/config/db_open.php');


function isTableExist($symbol){

global $conn;
$table_name=$symbol;
$result = $conn->query("SHOW TABLES LIKE '".$table_name."'");


    if($result->num_rows == 1) 
    	{
        	return true;

    	} elseif($result->num_rows == 0) 
	    	{
	    		return false;

			}

}

?>