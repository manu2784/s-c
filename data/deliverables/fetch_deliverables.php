<?php


    $opts = [
    "http" => [
        "method" => "GET",
        "header" => "Accept-language: en\r\n" .
            "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:53.0) Gecko/20100101 Firefox/53.0"  .
            "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8"
    ]
];

$i=15;
$j=0;

while ($i>0) {
    $j++;
$context = stream_context_create($opts);

$limit=date('Y-m-d', strtotime('-'.$i. 'days'));


$limit=explode("-", $limit); 

$path="../../../downloads/dailybhavs/".$limit[2].$limit[1].$limit[0].".txt";
$url="https://www.nseindia.com/archives/equities/mto/MTO_".$limit[2].$limit[1].$limit[0].".DAT";




if(!file_get_contents( $url, false, $context )){
    echo "error:".$http_response_header[0]."\n</br>";
}else{
    echo $j."</br>";
    $content=file_get_contents( $url, false, $context );
    file_put_contents(
    $path,$content);
}



 --$i;

}
?>




