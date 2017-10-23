<?php
require ('../../../config/db2_open.php');

function persistStock($symbol, $stock_rows) {

global $conn2;


// Get the date of last row if there are existing rows in the table
$query="SELECT MAX(date) FROM `$symbol`";
$result= $conn2->query($query);

$row = mysqli_fetch_array($result);
$last_record_date=0;
if($row!=0) {
$last_record_date=$row[0]; 
}

//First record date in the array
$first_record_date=$stock_rows[0][0];


if(!($last_record_date<$first_record_date))
  {	
  	return false;   // Error: new data overlaps with existing data
  }      


$query="INSERT INTO `$symbol` 
	   (date, series, open_price, high_price, low_price, last_price, close_price, avg_price, 
	   total_traded_qty, turnover, no_of_trades, deliverable_qty) 
       VALUES (?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn2->prepare($query);
$stmt->bind_param("isddddddidii", 
	             $date, $series, $open_price, $high_price, $low_price, $last_price, 
	             $close_price, $avg_price, $total_traded_qty, $turnover, $no_of_trades, $deliverable_qty);
	
			$j=0;                       // counts insert errors if any
			$k=count($stock_rows);

			foreach ($stock_rows as $row) 
			{

									
								$date= $row[0];
								$series= $row[1];
								  if($series!=="EQ") { continue;}  // allows only row with sereies equals EQ
								$open_price=$row[2];
								$high_price=$row[3];
								$low_price=$row[4];
								$last_price=$row[5];
								$close_price=$row[6];
								$avg_price=$row[7];

								$total_traded_qty=$row[8];
								$turnover=$row[9];
								$no_of_trades=$row[10];
								$deliverable_qty=$row[11];

								if($stmt->execute()) { $j++;}
			}

$stmt->close();


return [true, $k,$j];


}


?>