<?php 

require_once ('../../config/config.php');
require_once ('../../config/db_open.php');
require_once ('get_all_stocks.php');


$update_dir=DWNLSTCK."/".date('d_m_y');
if (!file_exists($update_dir)) {
    mkdir($update_dir, 0777, true);
}

// -----------------------------------------------------Get All symbols & create folder for each symbol/security
$get_record = $conn->query("SELECT * FROM symbol");

while($row=$get_record->fetch_array())
 {
 	$symbol=$row['symbol'];
 	$security_name=$row['security'];
 	if(!mkdir($update_dir."/".$security_name, 0777, true))
 	  {
 	  	
 		$security_name=$row['security']."-".$row['series'];
 		mkdir($update_dir."/".$security_name, 0777, true);
 		 
 	  }	

 	  $path=$update_dir."/".$security_name;
 	  getAllStocks($symbol, $path);

 }



?>