<?php
require ('../../../config/config.php');
require ('../../../config/db_open.php');
require ('is_table_exist.php');
require ('create_stock_table.php');


function parseFile($symbol, $file_path) {


global $conn;



			$table_exist= is_table_exist($symbol);  // check if the table for th symbol already exist

			if($table_exist) 
				{

			    } else if(!$table_exist) 
			        {
			        			$create_table= create_stock_table($symbol)	// Create Table for the symbol if doesn't exist already 
					        	if(!$create_table) 
					        		{
					        			return false;
					        	    }
			    	} else {
			    				return false;
			    	       }


					 		

					 		if (($handle = fopen($file_path, "r")) !== FALSE && count(file($file_path))>0) 
					 		{

									while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) 
									{
											
												    if(count($data)==15)
												         {

												            //values to be inserted in database table

												            $date='"'.$conn->real_escape_string($data[2]).'"';
												            $series='"'.$conn->real_escape_string($data[1]).'"';
												            $open_price='"'.$conn->real_escape_string($data[4]).'"';
												            $high_price='"'.$conn->real_escape_string($data[5]).'"';

												            $low_price='"'.$conn->real_escape_string($data[6]).'"';
												            $last_price='"'.$conn->real_escape_string($data[7]).'"';
												            $close_price='"'.$conn->real_escape_string($data[8]).'"';
												            $avg_price='"'.$conn->real_escape_string($data[9]).'"';

												            $total_traded_qty='"'.$conn->real_escape_string($data[10]).'"';
												            $turnover='"'.$conn->real_escape_string($data[11]).'"';
												            $no_of_trades='"'.$conn->real_escape_string($data[12]).'"';
												            $deliverable_qty='"'.$conn->real_escape_string($data[13]).'"';

												                       
												         /*   $io_String="<br>".$date." - ".$open_price." - ".$high_price." - ".$close_price."<br>";
												            echo $io_String;*/

												         }
								    
								   
								  }
								  
					  		fclose($handle);
						}

				
}

$file_path=DWNLSTCK.'14_09_17/Syndicate Bank/1.csv';

//parseFile($file_path); 



?>





