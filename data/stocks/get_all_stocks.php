<?php 
require_once ('../../config/config.php');
require_once ('fetch_stock.php');


function getAllStocks($symbol, $path) {


                    $base_date=BASEDATE;
                    $start_date= date('d-m-Y', strtotime($base_date));
                    $days_fromstart=(strtotime('today')-strtotime($base_date))/(60*60*24);
                    $days_fromstart= (int)$days_fromstart;
                    $intervel=DATA_INTERVAL;
                    $i=1;





                    while (($days_fromstart- $intervel) > 0){


                                    
                                     $end_date= date('d-m-Y',strtotime($base_date.'+'. $intervel. 'days')); // create/increment end date

                                     $get_file=fetchStocks($start_date, $end_date, $symbol, $path,$i);    //get file

                                             if($get_file) {
                                                echo "success";
                                             } else
                                               {
                                                 echo $get_file;
                                               }

                                    $start_date=date("d-m-Y", strtotime($base_date.'+'.($intervel+1).'days')); //increment start date




                                    if (($days_fromstart- $intervel)>90) 
                                            {

                                            $intervel= $intervel + 90;

                                            } else if ((($days_fromstart- $intervel)<90))   // last iteration or last date range fetch
                                                {
                                                    	$intervel=$intervel+($days_fromstart- $intervel);
                                                    	$end_date= date('d-m-Y',strtotime($base_date.'+'. $intervel. 'days'));
                                                        $i++;
                                                        $get_file=fetchStocks($start_date, $end_date, $symbol, $path,$i);  //get file

                                                         if($get_file) {
                                                            echo "success";
                                                         } else
                                                           {
                                                             echo $get_file;
                                                           }

                                                 }  

                                     $i++;
                    } 



}


?>