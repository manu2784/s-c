<?php


function retrieveSymbols($symbol="all")

{
	global $conn;
	$retrieve_symbol=[];

	if($symbol=="all")
		 {
		 	$symbol_records = $conn->query("SELECT * FROM symbol");
		 } elseif (is_array($symbol)) {
		 	$symbol_set = join("','",$symbol);   
			$query = "SELECT * FROM symbol WHERE symbol IN ('$symbol_set')";
			$symbol_records = $conn->query($query);
		 }

		 while($row=$symbol_records->fetch_array()) 
		 {
		 	$retrieve_symbol[]=array($row['sym_id'], $row['symbol'],$row['series'], $row['security'], $row['band']);
		 }


		 return $retrieve_symbol;
	
} 



?>