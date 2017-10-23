<?php

require ('is_table_exist.php');
require ('create_stock_table.php');
require ('parse_file.php');
require ('persist_stock.php');


function parseSymbol($symbol, $dir) 
 {

 	$parse_errors=array(true,0,0);
 	$records= array();


 					// get the path to stock directory and check if directory exists
 					$dir_path=DWNLSTCK.$dir.$symbol; // get the path to stock directory

 					if(!(is_dir($dir_path) || file_exists($dir_path))) 
			 			 {	
			 			 	$parse_errors[0]=false;   // FALSE : if stock direcotry doesn't exist 
			 			 	$parse_errors[1]=1;       // Parse error code 1
			 			 	echo $dir_path;
			 			 	return $parse_errors;  
			 			 }


			 			 

					// check if there are any csv files in the stock directory 			
					$filecount = 0;
					$files = glob($dir_path.'/*.csv');

					if (count($files)<1) 
						{ 
				
							$parse_errors[0]=false;  // FALSE:  if there are no csv file in the stock directory
							$parse_errors[1]=2;       // Parse error code 2
							return $parse_errors;
						} 



					// Loop through each csv file in the stock directory and return all row in an array				
					$j=1;	 	
					foreach ($files as $file) 
					  {
							$file_path=$file;
							$t=parseFile($symbol, $file_path);  // extract data from each csv file in the stock directory
							if(!$t){
									$parse_errors[0]=false;    // FALSE:  if there is no data in file or file couldn't parsed for valid csv data
									$parse_errors[1]=3;       //Parse error code 3
									$parse_errors[2]=$j;      // files number of the file with the error
									return $parse_errors;
							} 
							$records = array_merge($records, $t); 
							$j++;
					  }


					
					// check if the database table for th symbol already exist
					$table_exist= isTableExist($symbol);  

					if($table_exist) 
						{

						} else if(!$table_exist) 
							{
								$create_table= createStockTable($symbol);	// Create Table for the symbol if doesn't exist already 
									if(!$create_table) 
									    {
											$parse_errors[0]=false; // False: if table can't be created
											$parse_errors[1]=4;		// Parse error code 4							    		
											return $parse_errors; 
										}
							} else 
								{
								   $parse_errors[0]=false; // False: if table can't be checked
								   $parse_errors[1]=5;		// Parse error code 5										
								   return $parse_errors;   
								}					



						 
					//  insert into table all rows in the array returned by  parseFile()
					$x=persistStock($symbol, $records);  
					if(!$x[0]) {
							$parse_errors[0]=false;  // FALSE:  if data time range overlaps 
							$parse_errors[1]=6;       // Parse error code 6
							return $parse_errors;
					} else 
					 {
					 		$parse_errors[3]=$x[1];   // total number of rows in csv files
					 		$parse_errors[4]=$x[2] ;  //total number of rows not inserted in table  
					 }			

	return $parse_errors;				 
}	
	

?>




