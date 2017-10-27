<?php

function downloadErros($download_record, $duplicate_sym, $total_symbols) {



						// error variables
						$total_files_downloaded=0;                     // actual number of html files downloaded
						$no_data_symbols=0;							   // symbol used but no data available	
						$error_count=0;
						$error_content="";
						$err_dir=ERRORLOG."/EOD/".date('d_m_y').".csv";




						// Retrieving individual download records and error if any 

						foreach ($download_record as $sym => $record) 

							{
						
											if($record[0])
												{
													$total_files_downloaded++;

												} elseif (!$record[0]) {
													$error_count++;
													$error_content.=$record[3].",".$record[1].",".$record[2].",".$record[6]."\n";
													
												}			

							}

						// writing to error log file
						$myfile = fopen( $err_dir, "w");
						fwrite($myfile, $error_content);
						fclose($myfile); 


						echo    "Total No Symbol=".$total_symbols."<br>". 
								"Total Files Downloaded= ".$total_files_downloaded."<br>".
								"Number of Errors= ".$error_count."<br>".
								"Number of Duplicate Symbols=".count($duplicate_sym)."<br>";

}

?>