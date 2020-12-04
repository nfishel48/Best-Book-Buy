
<!DOCTYPE HTML>
<head>
	<title>Proof purchase</title>
	<header align="center">Proof purchase</header> 
</head>
<body>
	<?
	$db = pg_connect("host=ec2-3-218-75-21.compute-1.amazonaws.com dbname=d8p0qs8v3fbf9m user=gymsvpkhkckshh password=68db7ff943798b07abc442d46449c9d2f4bfcd38be0f79023a630bf67b3b3a8a");
	$order = pg_query($db, 'select * from Order_t where placed = false;');
	$row = pg_fetch_row($order);
	$orderNumber = $row[0];
	$customerId = $row[1];
	$placed = $row[2];
	$user = pg_query($db, "select * from customer where ID =".$customerId.";");
	$row = pg_fetch_row($user);
	$username = $row[1];
	$firstName = $row[2];
	$lastName = $row[3];
	$pin = $row[4];
	$address = $row[5];
	$city = $row[6];
	$state = $row[7];
	$zip = $row[8];
	$cctype = $row[9];
	$ccnum = $row[10];
	$expdate = $row[11];
	$bookOrder = pg_query($db, 'select * from order_book where order_number ='.$orderNumber.';');
	$isbns = array();
	$i = 0;
	while($row = pg_fetch_row($bookOrder)){
		$isbns[$i] = $row[1];
		$i++;
	}

	echo "<table align='center' style='border:2px solid blue;'>";
	echo "<form id='buy' action='proof_purchase.php' method='post'>";
	echo "<tr>";
	echo "<td>";
	echo "Shipping Address:";
	echo "</td>";
	echo "</tr>";
	echo "<td colspan='2'>";
		echo $firstName." ".$lastName."	</td>";
		echo '<td rowspan="3" colspan="2">';
		echo '<b>UserID:</b>'.$username.'<br />';
		echo '<b>Date:</b>'.date("Y-m-d").'<br />';
		echo '<b>Time:</b>'.date("h:i:sa").'<br />';
		echo '<b>Card Info:</b>'.$cctype.'<br />'.$expdate.' - '.$ccnum.'	</td>';
	echo "<tr>";
	echo "<td colspan='2'>";
		echo $address."</td>";	
	echo "</tr>";
	echo "<tr>";
	echo "<td colspan='2'>";
		echo $city."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td colspan='2'>";
		echo $state.", ".$zip."	</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td colspan='3' align='center'>";
	echo "<div id='bookdetails' style='overflow:scroll;height:180px;width:520px;border:1px solid black;'>";
	echo "<table border='1'>";
		// echo "<th>Book Description</th><th>Qty</th><th>Price</th>";
		// echo "<tr><td>iuhdf</br><b>By</b> Avi Silberschatz</br><b>Publisher:</b> McGraw-Hill</td><td>1</td><td>$12.99</td></tr>	</table>";
		$k = sizeof($isbns)-1 ;
		$prices = array();
		while ($k > -1) {
			$book = pg_query($db, 'Select * from book where isbn = CAST('.$isbns[$k].' as VARCHAR(15));');
			$row = pg_fetch_row($book);
			$ISBN = $row[0];
			$Title = $row[1];
			$Author = $row[2];
			$Publisher = $row[3];
			$Price = $row[4];
			$prices[$k] = $Price;
			$book = "<td rowspan='2' align='left'>".$Title."</br>".$Author."</br><b>Publisher:</b>".$Publisher.",</br><b>ISBN:</b>".$ISBN."</t> <b>Price:</b>".$Price."</td>";
					echo '<tr>';
					echo $book; 
					echo '</tr>';
				echo '<tr>';
					echo"</td>";
				echo "</tr>";
			echo "</tr>";
				echo "<tr>";
					echo "<td colspan='2'>";
						echo "<p>_______________________________________________</p>";
					echo "</td>";
			echo "</td>";
			$k--;
		}
		echo "</table>";
	echo "</div>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td align='left' colspan='2'>";
	echo "<div id='bookdetails' style='overflow:scroll;height:180px;width:260px;border:1px solid black;background-color:LightBlue'>";
	echo "<b>Shipping Note:</b> The book will be </br>delivered within 5</br>business days.";
	echo "</div>";
	echo "</td>";
	echo "<td align='right'>";
	$j = sizeof($prices) -1;
	$subTotal = 0;
	while($j > -1){
		$subTotal = $subTotal + (double)$prices[$j];
		$j--;
	}
	$Total = $subTotal + 2;
	echo "<div id='bookdetails' style='overflow:scroll;height:180px;width:260px;border:1px solid black;'>";
		echo "SubTotal:$".$subTotal."</br>Shipping_Handling:$2</br>_______</br>Total:$".$Total."</div>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td align='right'>";
		echo '<input type="submit" id="buyit" name="btnbuyit" value="Print" disabled>';
	echo "</td>";
	echo "</form>";
	echo '<td align="right">';
		echo '<form id="update" action="screen2.php" method="post">';
		echo '<input type="submit" id="update_customerprofile" name="update_customerprofile" value="New Search">';
		echo '</form>';
	echo '</td>';
	echo '<td align="left">';
		echo '<form id="cancel" action="index.php" method="post">';
		echo '<input type="submit" id="exit" name="exit" value="EXIT 3-B.com">';
		echo '</form>';
	echo '</td>';
echo '</tr>';
	echo "</table>";
	pg_close($db);
?>
</body>
</HTML>
