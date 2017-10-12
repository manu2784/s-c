<?php 
require ('fetch_stock.php');


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

                                     $get_file=fetchStocks($start_date, $end_date, $symbol, $path,$i);    //get file function                                     
                                     $error_rows[$i]=$get_file;                                           // array containing any errors while downloading or parsing an html file


                                    $start_date=date("d-m-Y", strtotime($base_date.'+'.($intervel+1).'days')); //increment start date




                                    if (($days_fromstart- $intervel)>90)  //HEADACHE!!!!! CODE FOR ALL POSSIBILITIES 
                                            {

                                            $intervel= $intervel + 90;

                                            } else if ((($days_fromstart- $intervel)<=90))                   // last iteration or last date range fetch if days remaining are less than interval days
                                                {
                                                    	$intervel=$intervel+($days_fromstart- $intervel);
                                                    	$end_date= date('d-m-Y',strtotime($base_date.'+'. $intervel. 'days'));
                                                        $i++;
                                                        $get_file=fetchStocks($start_date, $end_date, $symbol, $path,$i);  //get file
                                                        $error_rows[$i]=$get_file;
                                                       

                                                 }  

                                     $i++;
                    } 

          return $error_rows;

}


?>