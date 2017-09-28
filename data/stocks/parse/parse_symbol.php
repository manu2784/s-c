<?php

require_once ('../../../config/config.php');
require_once ('../../../config/db_open.php');
require_once ('../../symbol/retrieve_symbols.php');

function parseSymbol($dir_path) 
 {



					$filecount = 0;
					$files = glob($dir_path . "*");
					if ($files)
					{
					 	$filecount = count($files);
					} else 
					{
						echo "data doesn't exist";
					}

					parseFile($files); 

}				

?>




