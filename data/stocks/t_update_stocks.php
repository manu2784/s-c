<?php ini_set('max_execution_time', 150);

require_once ('../../config/config.php');
require_once ('../../config/db_open.php');
require_once ('get_all_stocks.php');
require_once ('download_errors.php');
require_once ('../symbol/retrieve_symbols.php');

//create a dir for current update date in download folder for stocks
$update_dir=DWNLSTCK."/".date('d_m_y');   
if (!file_exists($update_dir)) {
    mkdir($update_dir, 0777, true);
}

// error variables

$total_symbols=0;							   // total number of symbol in the db	
$number_symbols_used=0;						   // symbols used to download files



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

if(is_null($download_record)) {

	echo "Records not updates";

} else
{
	downloadErros($download_record, $number_symbols_used, $total_symbols);
}

?>





