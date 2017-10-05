<?php

require_once ('../../../config/config.php');
require_once ('../../../config/db_open.php');
require_once ('../../symbol/retrieve_symbols.php');

function parseSymbol($symbol) 
 {
 		$dir_path=DWNLSTCK."/19_09_17/".$symbol[3];


					$filecount = 0;
					$files = glob($dir_path . "csv");
					if (count($files)>0)
						{
						 	
							foreach ($files as $file) {
								$file_path=$dir_path.$file;
								parseFile($file_path); 
							}

						} else 
							{
								//echo "data doesn't exist";
								return false;
							}

					

}				

?>




