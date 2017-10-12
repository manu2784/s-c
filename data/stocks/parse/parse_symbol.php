<?php

require ('../../../config/config.php');
require ('../../../config/db_open.php');
require ('../../symbol/retrieve_symbols.php');
require ('parse_file.php');


function parseSymbol($symbol) 
 {

 	$parse_errors= array();

 		$dir_path=DWNLSTCK."/19_09_17/".$symbol; // get the path to stock directory


					$filecount = 0;
					$files = glob($dir_path . "csv");

					if (count($files)<1) { return false;}  // check if there are csv files in the stock directory
						
						 	
					foreach ($files as $file) 
					  {
							$file_path=$dir_path.$file;
							$data=parseFile($symbol, $file_path);   // extract data from each csv file in the stock directory

					  }

						 

					

}				

?>




