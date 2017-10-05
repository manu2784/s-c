<?php
require_once ('../../../config/config.php');
require_once ('../../../config/db_open.php');


function parseFile($file_path) {


global $conn;
					 		if (($handle = fopen($file_path, "r")) !== FALSE && count(file($file_path))>0) 
					 		{

					      			// delete old data
					      			//$delete_old_rows = $conn->query("TRUNCATE TABLE symbol");

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


												            //MySqli Insert Query
												          /*  $insert_row = $conn->query("INSERT INTO symbol (symbol, series, security, band) VALUES ($symbol,$series,$security,$band)");

												            if($insert_row){
												                $sym_count++;
												            }else{
												                die('Error : ('. $conn->errno .') '. $conn->error);
												                $no_errors++;
												            }*/
												                       
												            $io_String="<br>".$date." - ".$open_price." - ".$high_price." - ".$close_price."<br>";
												            echo $io_String;

												         }
								    
								   
								  }
								  
					  		fclose($handle);
						}

				
}

$file_path=DWNLSTCK.'14_09_17/Syndicate Bank/1.csv';

parseFile($file_path); 



?>





