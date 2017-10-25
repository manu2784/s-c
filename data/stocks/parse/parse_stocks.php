<?php
ini_set('max_execution_time', 90);
require_once ('../../../config/config.php');
require_once ('../../../config/db_open.php');
require_once ('../../symbol/retrieve_symbols.php');
require_once ('parse_symbol.php');

function parseStock($dir) 
 {

$symbol_records=retrieveSymbols();  // get symbol table into an array
$dir=$dir."/";
$j=0;
$k=0;
$sym_parse_err="";
$err_dir=ERRORLOG."/parse/".date('d_m_y').".csv";

		foreach ($symbol_records as $record) 
		{
			
					$symbol=$record[1];
					$s=parseSymbol($symbol, $dir);  // function call to parse csv files belonging to a symbol

					if($s[0]) {
						if($s[3]!==$s[4])
							 {
													
								$sym_parse_err.=$s[0].",".$symbol.",".$s[1].",".$s[2].",".$s[3].",". $s[4]."\n";
								$j++;
							 }	
					} else {
						$sym_parse_err.=$s[0].",".$symbol.",".$s[1].",".$s[2]."\n";
						$k++;
					}

			
		}

		// writing to error log file
		$myfile = fopen( $err_dir, "w");
		fwrite($myfile, $sym_parse_err);
		fclose($myfile);

		echo "No. of Parse Errors = ".$k."<br>"."No. of Symbol Parsed With Error = ".$j."<br>";		


 	}

parseStock("25_10_17");
?>