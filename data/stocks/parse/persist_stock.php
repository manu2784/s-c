<?php


function persistStock($symbol, $stock_rows) {

global $conn;


// Get the date of last row if there are existing rows in the table
$query="SELECT MAX(date) FROM `syndibank`";
$result= $conn->query($query) or die($conn->error);

$row = mysqli_fetch_array($result);
$last_record_date=$row[0]; 

//First record date in the array
$first_record_date=$stock_rows[0][0];

if($last_record_date<$first_record_date)
  {
  	echo "dates overlap";
  }   else {
  	echo "continue";

  	echo $last_record_date."<br>".$first_record_date;
  }     

/*
$query="INSERT INTO `$symbol` 
	   (date, series, open_price, high_price, low_price, last_price, close_price, avg_price, 
	   total_traded_qty, turnover, no_of_trades, deliverable_qty) 
       VALUES (?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($query) or die('prepare() failed: ' . htmlspecialchars($conn->error));
$stmt->bind_param("isddddddidii", 
	             $date, $series, $open_price, $high_price, $low_price, $last_price, 
	             $close_price, $avg_price, $total_traded_qty, $turnover, $no_of_trades, $deliverable_qty)
				 or die('bind_param() failed: ' . htmlspecialchars($stmt->error));


			foreach ($stock_rows as $row) 
			{

					if($row[0])
				
								$date= $row[0];
								$series= $row[1];
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

								$stmt->execute() or die('bind_param() failed: ' . htmlspecialchars($stmt->error));
			}

$stmt->close();

*/
}


?>