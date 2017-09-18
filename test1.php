<?php

function parseHTML($path) {
    echo $path."<br>";

$i=1;

while($page = @file_get_contents($path."/".$i.".html"))

{



    $internalErrors = libxml_use_internal_errors(true);
    $doc = new DOMDocument();
    $doc->preserveWhiteSpace = false;
    $doc->loadHTML($page);
    libxml_use_internal_errors($internalErrors);
    $node=$doc->getElementById('csvContentDiv');
    $node=$node->nodeValue;
 

    $node=str_replace(":", "\n", $node); 

    $wpath=$path."/".$i.".csv";

    $myfile = fopen( $wpath, "w") or die("Unable to open file!");

fwrite($myfile, $node);
fclose($myfile);  
$i++;
}

}

?>