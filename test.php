<?php

require_once ('config/config.php');
require_once ('config/db_open.php');
require_once ('test1.php');


// -------------------------------------- Get all symbol
$update_dir=DWNLSTCK."14_09_17";


 $get_record = $conn->query("SELECT * FROM symbol");

while($row=$get_record->fetch_array())
 {
    $symbol=$row['symbol'];
    $security_name=$row['security'];


      $path=$update_dir."/".$security_name;
      parseHTML($path);
    

 }  

                



?>




