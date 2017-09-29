<?php ini_set('max_execution_time', 10);
require_once ('config/config.php');
require_once ('data/stocks/fetch_stock.php');


function getAllStocks($symbol, $path) {


                    $base_date=BASEDATE;
                    $start_date= date('d-m-Y', strtotime($base_date));
                    $days_fromstart=(strtotime('today')-strtotime($base_date))/(60*60*24);
                    $days_fromstart= (int)$days_fromstart;
                    $intervel=DATA_INTERVAL;
                    $i=1;
                    $error_rows=array();



                    while (($days_fromstart- $intervel) > 0){


                                    
                                     $end_date= date('d-m-Y',strtotime($base_date.'+'. $intervel. 'days')); // create/increment end date

                                     echo $start_date.'--------'.$end_date.'<br>';
                                    

                                    /* $get_file=fetchStocks($start_date, $end_date, $symbol, $path,$i);    //get file function                                     
                                     $error_rows[$i]=$get_file;    */                                       // array containing any errors while downloading or parsing an html file


                                    $start_date=date("d-m-Y", strtotime($base_date.'+'.($intervel+1).'days')); //increment start date


                                    	echo $days_fromstart.'--------'.$intervel.'<br>';

                                    if (($days_fromstart- $intervel)>=90)  //headache!!!!!!
                                            {

                                            $intervel= $intervel + 90;

                                            } else if ((($days_fromstart- $intervel)<90))                   // last iteration or last date range fetch if days remaining are less than interval days
                                                {
                                                    	$intervel=$intervel+($days_fromstart- $intervel);
                                                    	$end_date= date('d-m-Y',strtotime($base_date.'+'. $intervel. 'days'));
                                                        $i++;
                                                        echo 'Hello<br>';
                                                       /* $get_file=fetchStocks($start_date, $end_date, $symbol, $path,$i);  //get file
                                                        $error_rows[$i]=$get_file;*/
                                                       

                                                 }  

                                     $i++;
                    } 

          return $error_rows;

}
$path=DWNLSTCK.'29_09_17/'.'ZEEL';
$test=getAllStocks('ZEEL', $path);

?>