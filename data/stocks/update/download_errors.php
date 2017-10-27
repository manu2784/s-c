<?php

function downloadErros($download_record, $duplicate_sym, $total_symbols) {



						// error variables
						$total_files_downloaded=0;                     // actual number of html files downloaded
						$no_data_symbols=0;							   // symbols used but no data available for any time intervals	
						$sym_some_error=0;							   // Symbol with some data but atleast one error
						$error_count=0;
						$error_symbols="";
						$error_content="";

						if(!file_exists(ERRORLOG."stock/".date('d_m_y'))) // make directory for download error for current update
						 	  {					 	  	
						 		mkdir(ERRORLOG."stock/".date('d_m_y'), 0777, true);    					 		 
						 	  }	

						$err_dir=ERRORLOG."stock/".date('d_m_y')."/errors.csv";
						$err_sym_dir=ERRORLOG."stock/".date('d_m_y')."/symbols.csv";


						// Retrieving symbols for which no data exist for any time intervals in the given date range

						foreach ($download_record as $sym => $sym_record) 
						{

							$j=0;
							$l=count($sym_record);
							foreach ($sym_record as $record)
							{	

								if(!$record[0]) {$j++;}


							}
									if($j==$l) {
												$no_data_symbols++;
												$error_symbols.="CE".",".$sym."\n";
											
								           	    } else if(($j>0) && ($j<$l))
								           	       {
								           	       		$sym_some_error++;
								           	       		$error_symbols.="PE".",".$sym."\n";
								           	       }

						}


						// Retrieving duplicate symbols 
						foreach($duplicate_sym as $symbol)
						{
							$error_symbols.="DS".",".$symbol."\n";
						}

						// writing symbols with error to log file
						$symfile = fopen( $err_sym_dir, "w");
						fwrite($symfile, $error_symbols);
						fclose($symfile); 
					

						// Retrieving individual download  errors if any 

						foreach ($download_record as $sym_record) 
						{							
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


						// writing to individual error log file
						$myfile = fopen( $err_dir, "w");
						fwrite($myfile, $error_content);
						fclose($myfile);



						echo "Total Files Downloaded= ".$total_files_downloaded.
						     "<br>"."Number of Errors= ".$error_count.
						     "<br>"."Total No Symbol=".$total_symbols.
						     "<br>"."Duplicate Symbols=".count($duplicate_sym).
						     "<br>"."Number of Symbols with no data= ".$no_data_symbols.
						     "<br>"."Number of Symbols with at least one error= ".$sym_some_error;

						     

}

?>