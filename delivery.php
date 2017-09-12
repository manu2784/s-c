<?php 



    $opts = [
    "http" => [
        "method" => "GET",
        "header" => "Accept-language: en\r\n" .
            "Cookie: pointer=6; sym1=KMSUGAR; sym2=TATAMOTORS; sym3=LAURUSLABS; sym4=SUNPHARMA\r\n" .
            "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:53.0) Gecko/20100101 Firefox/53.0\r\n"  .
            "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\n".
            "Referer: https://www.nseindia.com/products/content/equities/equities/eq_security.htm\r\n".
            "X-Requested-With: XMLHttpRequest"
    ]
];

$context = stream_context_create($opts);
$company=$_GET['symbol'];

$theurl="https://www.nseindia.com/products/dynaContent/common/productsSymbolMapping.jsp?symbol=KMSUGAR&segmentLink=3&symbolCount=1&series=ALL&dateRange=&fromDate=01-01-2010&toDate=30-05-2010&dataType=PRICEVOLUMEDELIVERABLE";

    $page = file_get_contents($theurl,  false, $context);

    echo $page;

   /*$data =  json_decode($page);

       $stock=$data->data[0]->symbol;
       $i=0;

         foreach ($data->data as $stock) {

             
             $row= $stock->symbol. "  "."  ".$stock->chng;
             echo $row ."<br><br>";

         }*/


?>
