<?php   // download data files from the source on the internet

function fetchSymbol($url){

$success="";
$error_code="N/A";

$date=date('Y-m-d');
$date_str=explode("-", $date); 
$path= DWNLSYM.$date_str[2].$date_str[1].$date_str[0].".csv";

    $opts = [
                "http" => [
                    "method" => "GET",
                    "header" => "Accept-language: en\r\n" .
                        "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:53.0) Gecko/20100101 Firefox/53.0"  .
                        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8"
                ]
            ];


$context = stream_context_create($opts);
$content=file_get_contents( $url, false, $context );

if(!$content)
    {
        $error_code=$http_response_header[0];
        return array("date"=>$date, "success"=>false, "error_code"=> $error_code, "path"=> "N/A");
    }else if(file_put_contents($path, $content)!==false) 
        {
        $success=true;
        return array("date"=>$date, "success"=>$success, "error_code"=> $error_code, "path"=> $path);
        }

}
?>




