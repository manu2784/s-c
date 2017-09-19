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
$total_files_downloaded=0;
$number_symbols=0;
$number_symbols_used=0;
$error_count=0;
$error_content="";
$err_dir=ERRORLOG."/".date('d_m_y').".csv";


// Get All symbols & create folder for each symbol/security
$get_record = $conn->query("SELECT * FROM symbol");

$number_symbols=mysqli_num_rows($get_record);

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

 	  $symbols_downloaded=getAllStocks($symbol, $path);            // call function to get all html files for a symbol

 	  if(count($symbols_downloaded)>0)                             // check for errors in getting html files
 	  	 {
 	  	 	
 	  	 		foreach ($symbols_downloaded as $sym) 
 	  	 		{
 	  	 			$download_record['$symbol'][]=$sym;
 	  	 			
 	  	 		}

 	  	 }

 	  	 $number_symbols_used++;

 }


// Retrieving individual download records and error if any 
foreach ($download_record as $sym_record) {
		
	foreach ($sym_record as $record) {
					if($record[0])
						{
							$total_files_downloaded++;

						} elseif (!$record[0]) {
							$error_count++;
							$error_content.=$record[3].",".$record[1].",".$record[2]."\n";
						}			

		}	


}

// writing to error log file
$myfile = fopen( $err_dir, "w");
fwrite($myfile, $error_content);
fclose($myfile); 


if($number_symbols==$number_symbols_used) {
	$update_process="Complete!!";
} else {
	$update_process="Incomplete!";
}

echo "Error Count= ".$error_count."<br>"."Total No Symbol=".$number_symbols."<br>"
."Number of Symbol Downloaded=".$number_symbols_used."<br>"
."Total Files Downloaded=".$total_files_downloaded."<br>"."Update Process=".$update_process."<br>";







?>





