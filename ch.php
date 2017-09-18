<?php // download data files from the source on the internet

require_once('config/config.php');

function fetchStocks($start_date, $end_date, $symbol,$path, $i) {
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

                   

                    $path=$path."/".$i.".html";
                    $context = stream_context_create($opts);
                    $symCount=file_get_contents( "https://www.nseindia.com/marketinfo/sym_map/symbolCount.jsp?symbol=".$symbol, false, $context );
                    $symCount=(int)$symCount;
                    $url="https://www.nseindia.com/products/dynaContent/common/productsSymbolMapping.jsp?symbol=".$symbol."&segmentLink=3&symbolCount=".$symCount."&series=ALL&dateRange=+&fromDate=".$start_date."&toDate=".$end_date."&dataType=PRICEVOLUMEDELIVERABLE";


                    $content=file_get_contents( $url, false, $context );

                        $internalErrors = libxml_use_internal_errors(true);
                        $doc = new DOMDocument();
                        $doc->loadHTML($content);
                        libxml_use_internal_errors($internalErrors);
                        $node=$doc->getElementById('csvContentDiv');
                        $node=$node->nodeValue;

                    if(!$content)
                        {
                            $error_code=$http_response_header[0];
                            return array($error_code, false, $url, $symbol,$start_date, $end_date);
                        
                        }  if(is_null($node)) 
                            {

                                $error_code="no csv";
                                return array($error_code, false, $url, $symbol,$start_date, $end_date, $symCount);

                            } else if(file_put_contents($path, $content)!==false) 
                                    {
                                        
                                      return true;
                                       
                                    }

}



?>










