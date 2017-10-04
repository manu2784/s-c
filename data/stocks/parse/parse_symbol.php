<?php

require_once ('../../../config/config.php');
require_once ('../../../config/db_open.php');
require_once ('../../symbol/retrieve_symbols.php');

function parseSymbol($symbol) 
 {
 		$dir_path=DWNLSTCK."/19_09_17/".$symbol[3];


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




