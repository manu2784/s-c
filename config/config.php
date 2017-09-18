<?php

$config= array("database"  => array(
									"db_name"          => "statsandcharts",
								   	"hostname"         => "localhost",
								   	"username"         => "root",
								   	"password"         => "root"
								   	),

			   "urls"      => array(
			   						"symbol"         => "https://www.nseindia.com/content/equities/sec_list.csv",
			   						"deliverables"    =>"",
			   						"dailybhav"       =>""
			   					   ),


				);

				

define("DWNLSYM", realpath($_SERVER["DOCUMENT_ROOT"])."/downloads/symbol/"); // path where downloaded symbol data is saved
define("DWNLSTCK", realpath($_SERVER["DOCUMENT_ROOT"])."/downloads/stocks/"); // path where downloaded stock data is saved
define("ERRORLOG", realpath($_SERVER["DOCUMENT_ROOT"])."/downloads/log/");
define("BASEDATE", "1 Jan 2017");                                             // Base date from when the stock data is to be downloaded
define("DATA_INTERVAL", 90);                                                  // specifies parts durations when data downloaded in parts
?>