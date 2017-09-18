<?php 

require_once ('../../config/config.php');
require_once ('../../config/db_open.php');
require_once ('get_all_stocks.php');

//create a dir for current update date in download folder for stocks
$update_dir=DWNLSTCK."/".date('d_m_y');   
if (!file_exists($update_dir)) {
    mkdir($update_dir, 0777, true);
}

// error variables
$error_count=0;
$error_log=array();
$error_content="";
$err_dir=ERRORLOG."/".date('d_m_y').".csv";

// Get All symbols & create folder for each symbol/security
$get_record = $conn->query("SELECT * FROM symbol");

while($row=$get_record->fetch_array())
 {
 	$symbol=$row['symbol'];
 	$security_name=$row['security'];
 	if(!mkdir($update_dir."/".$security_name, 0777, true)) // make directory for each symbol for current update
 	  {
 	  	
 		$security_name=$row['security']."-".$row['series'];
 		mkdir($update_dir."/".$security_name, 0777, true);    // if duplicate symbols are found, append series to security name and create folder 
 		 
 	  }	

 	  $path=$update_dir."/".$security_name;
 	  $error_rows=getAllStocks($symbol, $path);            // call function to get all html files for a symbol

 	  if(count($error_rows)>0)                             // check for errors in getting html files
 	  	 {
 	  	 	$error_count++;
 	  	 		foreach ($error_rows as $error) 
 	  	 		{
 	  	 			$error_log['$symbol'][]=$error;
 	  	 			
 	  	 		}

 	  	 }


 }
// Error Reporting and writing each errors to log files


echo "Error Count= ".$error_count;

foreach ($error_log as $err_sym) {
		
	foreach ($err_sym as $error) {
				$error_content.=$error[3].",".$error[1].",".$error[2]."\n";
		}	

}

$myfile = fopen( $err_dir, "w");
fwrite($myfile, $error_content);
fclose($myfile); 

?>