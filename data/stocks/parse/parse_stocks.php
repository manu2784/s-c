<?php
require_once ('../../../config/config.php');
require_once ('../../../config/db_open.php');
require_once ('../../symbol/retrieve_symbols.php');
require_once ('parse_symbol.php');

function parseStock() 
 {

$symbol_record=retrieveSymbols();

		foreach ($symbol_record  $symbol) 
		{
					$dir_path=DWNLSTCK."/18_09_17/".$symbol[3];

					parseSymbol($dir_path); 

			
		}

 	}

?>