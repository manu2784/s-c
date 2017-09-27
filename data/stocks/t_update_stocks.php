<?php ini_set('max_execution_time', 150);

require_once ('../../config/config.php');
require_once ('../../config/db_open.php');
require_once ('get_all_stocks.php');
require_once ('../symbol/retrieve_symbols.php');

//create a dir for current update date in download folder for stocks
$update_dir=DWNLSTCK."/".date('d_m_y');   
if (!file_exists($update_dir)) {
    mkdir($update_dir, 0777, true);
}

// error variables
$total_files_downloaded=0;                     // actual number of html files downloaded
$total_symbols=0;							   // total number of symbol in the db	
$number_symbols_used=0;						   // symbols used to download files
$no_data_symbols=0;							   // symbol used but no data available	
$error_count=0;
$error_content="";
$err_dir=ERRORLOG."/".date('d_m_y').".csv";


// Get All symbols from db & create folder for each symbol/security
$retrieved_symbols= retrieveSymbols();
$total_symbols=count($retrieved_symbols);

foreach($retrieved_symbols as $record)
 {
 	$symbol=$record[1];
 	$security_name=$record[3];
 	if(!file_exists($update_dir."/".$symbol)) // make directory for each symbol for current update
 	  {
 	  	
 		mkdir($update_dir."/".$symbol, 0777, true);    // if duplicate symbols are found, append series to security name and create folder 
 		 
 	  }	 else { continue; }

 	  $path=$update_dir."/".$symbol;

 	  $symbols_downloaded=getAllStocks($symbol, $path);            // call function to get all html files for a symbol

 	  if(count($symbols_downloaded)>0)                             // check for errors in getting html files
 	  	 {
 	  	 	
 	  	 		foreach ($symbols_downloaded as $sym) 
 	  	 		{
 	  	 			$download_record[$symbol][]=$sym;
 	  	 			
 	  	 		}

 	  	 }

 	  	 $number_symbols_used++;

 }


// Retrieving symbols for which no data exist for any time intervals in the given date range

foreach ($download_record as $sym => $sym_record) 
{

	$j=true;
	foreach ($sym_record as $record)
	{	

		$x=$record[0];
		$j=($j && $x);

	}
			if(!$j) {
						$no_data_symbols++;
		           }

}

// Retrieving individual download records and error if any 

foreach ($download_record as $sym_record) {

		
	foreach ($sym_record as $record) {
					if($record[0])
						{
							$total_files_downloaded++;

						} elseif (!$record[0]) {
							$error_count++;
							$error_content.=$record[3].",".$record[1].",".$record[2].",".$record[6]."\n";
							
						}			

		}	


}

// writing to error log file
$myfile = fopen( $err_dir, "w");
fwrite($myfile, $error_content);
fclose($myfile); 

// Update Process status
if($total_symbols==$number_symbols_used && $error_count>0) {
	$update_process="Complete with Errors";
} elseif ($total_symbols==$number_symbols_used && $error_count==0) 
		{
			$update_process="Complete With No Errors";

		} elseif ($total_symbols!=$number_symbols_used && $error_count>0)
		  {
		  		$update_process="Incomplete With Errors";
		  } elseif ($total_symbols!=$number_symbols_used && $error_count>0)
		     {
		     	$update_process="Incomplete With No Errors";
		     }

echo "Total Files Downloaded= ".$total_files_downloaded."<br>"."Number of Errors= ".$error_count."<br>"."Total No Symbol=".$total_symbols."<br>"
."Number of Symbol Downloaded=".$number_symbols_used."<br>"."Number of Symbol with no data= ".$no_data_symbols."<br>"."Update Process=".$update_process."<br>";





?>





