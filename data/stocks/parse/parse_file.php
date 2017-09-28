<?php


require_once ('../../../config/config.php');
require_once ('../../../config/db_open.php');
require_once ('../../symbol/retrieve_symbols.php');

function parseFile($files) {

					foreach($files as $file)
						{
								$file_path=$dir_path.'/'.$file;

					 		if (($handle = fopen($file_path, "r")) !== FALSE && count(file($file_path))2) 
					 		{

					      			// delete old data
					      			$delete_old_rows = $conn->query("TRUNCATE TABLE symbol");

									while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
									{
												    $no_records++;
												    if(count($data)==5)
												         {

												            //values to be inserted in database table

												            $symbol='"'.$conn->real_escape_string($data[0]).'"';
												            $series='"'.$conn->real_escape_string($data[1]).'"';
												            $security='"'.$conn->real_escape_string($data[2]).'"';
												            $band='"'.$conn->real_escape_string($data[3]).'"';


												            //MySqli Insert Query
												            $insert_row = $conn->query("INSERT INTO symbol (symbol, series, security, band) VALUES ($symbol,$series,$security,$band)");

												            if($insert_row){
												                $sym_count++;
												            }else{
												                die('Error : ('. $conn->errno .') '. $conn->error);
												                $no_errors++;
												            }
												                       


												         }
								    
								   
								  }
								  
					  		fclose($handle);
						}

				}
}

?>