<?php


function parseFile($symbol, $file_path) {


global $conn;
$i=0;
$stock_rows= array();


// open CSV file, loop through the lines, and get the lines in an array
if (($handle = fopen($file_path, "r")) !== FALSE && count(file($file_path))>0) 
					 {

							while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) 
								{

									if($i==0) 
									  {
										$i++;
										continue;	// if statement skips the first row which is header text
									   }
										
												    if(count($data)==15)
												         {

												            //values to be inserted in database table

												            $date=strtotime($conn->real_escape_string($data[2]));
												            $series=$conn->real_escape_string($data[1]);
												            $open_price=floatval($conn->real_escape_string($data[4]));
												            $high_price=floatval($conn->real_escape_string($data[5]));

												            $low_price=floatval($conn->real_escape_string($data[6]));
												            $last_price=floatval($conn->real_escape_string($data[7]));
												            $close_price=floatval($conn->real_escape_string($data[8]));
												            $avg_price=floatval($conn->real_escape_string($data[9]));

												            $total_traded_qty=(int)$conn->real_escape_string($data[10]);
												            $turnover=floatval($conn->real_escape_string($data[11]));
												            $no_of_trades=(int)$conn->real_escape_string($data[12]);
												            $deliverable_qty=(int)$conn->real_escape_string($data[13]);


												            $stock_rows[]=[$date,$series, $open_price, $high_price, $low_price,
												            			   $last_price, $close_price, $avg_price, $total_traded_qty,
												            			   $turnover,$no_of_trades, $deliverable_qty];
												                       

												         } 
								    
								   
								  }
								  
					  		fclose($handle);
					}

if(!(count($stock_rows)>0)) 
	{
		return false;  // Error: empty file
	}	

return $stock_rows;


				
}

?>





