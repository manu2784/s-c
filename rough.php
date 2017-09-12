<?php 

include_once('get_file.php');
include_once('config/config.php');

$base_date=BASEDATE;;
$start_date= date('d-m-Y', strtotime($base_date));
$days_fromstart=(strtotime('today')-strtotime($base_date))/(60*60*24);
$days_fromstart= (int)$days_fromstart;
$intervel=DATA_INTERVAL;
$i=(int)0;




while (($days_fromstart- $intervel) > 0){


echo $days_fromstart." ".$intervel."</br>";
$end_date= date('d-m-Y',strtotime($base_date.'+'. $intervel. 'days'));

echo $start_date. " -------".$end_date."<br><br>";

 $get_file=getFile($start_date, $end_date, $i);

 if($get_file) {
    echo "success";
 } else
   {
     echo $get_file;
   }

$start_date=date("d-m-Y", strtotime($base_date.'+'.($intervel+1).'days'));




if (($days_fromstart- $intervel)>90) 
        {

        $intervel= $intervel + 90;

        } else if ((($days_fromstart- $intervel)<90)) 
            {
                	$intervel=$intervel+($days_fromstart- $intervel);
                	$end_date= date('d-m-Y',strtotime($base_date.'+'. $intervel. 'days'));
                    echo $days_fromstart." ".$intervel."</br>";
                    echo $start_date. " -------".$end_date."<br><br>";
                    $i++;

                     $get_file=getFile($start_date, $end_date,$i);

                     if($get_file) {
                        echo "success";
                     } else
                       {
                         echo $get_file;
                       }

             }  

 $i++;
} 






?>