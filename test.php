<?php
require_once ('config/config.php');
require_once ('config/db_open.php');


// -------------------------------------- Get all symbol
/* $get_record = $conn->query("SELECT * FROM symbol");

while($row=$get_record->fetch_array())
 {
    $symbol=$row['symbol'];
    $security_name=$row['security'];
    if(!mkdir($update_dir."/".$security_name, 0777, true))
      {
        
        $security_name=$row['security']."-".$row['series'];
        mkdir($update_dir."/".$security_name, 0777, true);
         
      } 

      $path=$update_dir."/".$security_name;
      getAllStocks($symbol, $path);

 }  */

            

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
   // $no_records++;
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




