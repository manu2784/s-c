<?php

function downloadErros($download_record, $number_symbols_used) {



						// error variables
						$total_files_downloaded=0;                     // actual number of html files downloaded
						$no_data_symbols=0;							   // symbol used but no data available	
						$error_count=0;
						$error_content="";
						$err_dir=ERRORLOG."/".date('d_m_y').".csv";


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

}

?>