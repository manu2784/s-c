<?php

function isModified($conn, $sym_count) {
	
	//Get records from last update
            $get_record = $conn->query("SELECT * FROM symbol");
            if($get_record->num_rows>0)
            	 {
             		 if($get_record->num_rows==$sym_count){return true;} else { return flase ;}
             	 } 	 else { return flase ;}
   
   }

?>
