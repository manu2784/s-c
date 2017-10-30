<?php
$config= array("database"  => array(
									"db_name"          => "statsandcharts",
								   	"hostname"         => "localhost",
								   	"username"         => "root",
								   	"password"         => "root"
								   	),
				"database2"  => array(
									"db_name"          => "stocks",
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
				
define("ROOT", realpath($_SERVER["DOCUMENT_ROOT"]));
define("DWNLSYM", realpath($_SERVER["DOCUMENT_ROOT"])."/downloads/symbol/"); // path where downloaded symbol data is saved
define("DWNLSTCK", realpath($_SERVER["DOCUMENT_ROOT"])."/downloads/stocks/"); // path where downloaded stock data is saved
define("DWNLEOD", realpath($_SERVER["DOCUMENT_ROOT"])."/downloads/EOD/"); // path where downloaded EOD data is saved
define("ERRORLOG", realpath($_SERVER["DOCUMENT_ROOT"])."/tmp/logs/");
define("BASEDATE", "1 January 2017");                                             // Base date from when the stock data is to be downloaded
define("DATA_INTERVAL", 90);                                                  // specifies parts durations when data downloaded in parts



?>