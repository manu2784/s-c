<?php

$path="reports.csv";


if (($handle = fopen($path, "r")) !== FALSE) 
      {

        $alldata= array();
        $c=false;


          while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
                    {

                          if(!$c) { $c=true; continue;}
                          if(count($data)==4)
                               {
                                  $alldata[]=$data;                                     
                               }  
                    }

          fclose($handle);

        }


        $countries=[];
        $live_BE=[];
        $notLive_BE=[];
        foreach ($alldata as $data) 
        {
          $countries[]=$data[3];

              if(stripos($data[0],'Live')!==false)
              {
                   $live_BE[]=$data;
              } else 
                  {
                      $notLive_BE[]=$data;
                  }
        }










?>




