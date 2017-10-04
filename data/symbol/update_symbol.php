<?php
$root=realpath($_SERVER["DOCUMENT_ROOT"]);

require ( $root.'/config/config.php');
require ( $root.'/config/db_open.php');
require ('fetch_symbol.php');
require ('is_modified.php');

// --------------------------------------FETCH NEW SYMBOL DATA
$url=$config['urls']['symbol'];
$fetch_symbol= fetchSymbol($url);

$date=$fetch_symbol['date'];
$success=($fetch_symbol['success']) ? "true": "false" ;
$error_code= $fetch_symbol['error_code'];
$path=$fetch_symbol['path'];

if(!$fetch_symbol['success'])
   {
     /* $insert_row = $conn->query("INSERT INTO sym_update (update_date, success, error_code) 
                           VALUES ('$date','$success', '$error_code')");*/
     exit("</br>Failed to Download New Symbols"." - ".$fetch_symbol['error_code']);
   }  


            

// -------------------------------------- Insert New Symbol Data
$symbol="";
$series="";
$security="";
$band="";

$no_records=0;
$sym_count=0;
$no_errors=0;


if (($handle = fopen($path, "r")) !== FALSE && count(file($path))>100) {

      // delete old data
      $delete_old_rows = $conn->query("TRUNCATE TABLE symbol");

  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $no_records++;
    if(count($data)==5)
         {

            //values to be inserted in database table

            $symbol='"'.$conn->real_escape_string($data[0]).'"';
            $series='"'.$conn->real_escape_string($data[1]).'"';
            $security='"'.$conn->real_escape_string($data[2]).'"';
            $band='"'.$conn->real_escape_string($data[3]).'"';


            //MySqli Insert Query
            $insert_row = $conn->query("INSERT INTO symbol (symbol, series, security, band) VALUES ($symbol,$series,$security,$band)");

            if($insert_row){
                $sym_count++;
            }else{
                die('Error : ('. $conn->errno .') '. $conn->error);
                $no_errors++;
            }
                       


         }
    
   
  }
  fclose($handle);
}

if($no_records==($sym_count+1)) echo "success!" ;


$modified=isModified($conn, $sym_count); 
$insert_row = $conn->query("INSERT INTO sym_update (update_date, success, sym_count, error_code) 
                           VALUES ('$date','$success','$sym_count', '$error_code')") or die($conn->error);



?>




