
<!DOCTYPE HTML>
<head>
	<title>CONFIRM ORDER</title>
	<header align='center'>Confirm Order</header> 
</head>
<body>
<?
	$db = pg_connect("host=ec2-3-218-75-21.compute-1.amazonaws.com dbname=d8p0qs8v3fbf9m user=gymsvpkhkckshh password=68db7ff943798b07abc442d46449c9d2f4bfcd38be0f79023a630bf67b3b3a8a");
	
	$order = pg_query($db, "select * from \"order\" join \"order_book\" on \"order\".number = \"order_book\".order_number join book on \"order_book\".book_isbn = book.isbn where placed = false");

	if (!empty($_GET)) {
		$isbn = $_GET['delIsbn'];

		if ($isbn){
			$remove_book = pg_query($db, "delete from order_book where order_number = (select number from \"order\" where placed = false) and book_isbn = '$isbn'");
		}
	} else if (!empty($_POST)){
		foreach ($_POST as $key => $value) {
			if ($key[0] == 't' and $key[1] == 'x' and $key[2] == 't'){ //really bad code i know
				$isbn = substr($key, 3);
				
				$query = pg_query($db, "update order_book set quantity = $value where book_isbn = '$isbn'");
			}
		}
	}
	echo pg_fetch_row($order);
	
	echo "<table align='center' style='border:2px solid blue;'>";
	echo "<form id='buy' action='proof_purchase.php' method='post'>";
	echo "<tr>";
	echo "<td>";
	echo "Shipping Address:";
	echo "</td>";
	echo "</tr>";
	echo "<td colspan='2'>";
		echo "test test	</td>";
	echo "<td rowspan='3' colspan='2'>";
		echo "<input type='radio' name='cardgroup' value='profile_card' checked>Use Credit card on file<br />MASTER - 1234567812345678 - 12/2015<br />";
		echo "<input type='radio' name='cardgroup' value='new_card'>New Credit Card<br />";
				echo "<select id='credit_card' name='credit_card'>";
					echo "<option selected disabled>select a card type</option>";
					echo "<option>VISA</option>";
					echo "<option>MASTER</option>";
					echo "<option>DISCOVER</option>";
				echo "</select>";
				echo "<input type='text' id='card_number' name='card_number' placeholder='Credit card number'>";
				echo "<br />Exp date<input type='text' id='card_expiration' name='card_expiration' placeholder='mm/yyyy'>";
	echo "</td>";
	echo "<tr>";
	echo "<td colspan='2'>";
		echo "test	</td>";	
	echo "</tr>";
	echo "<tr>";
	echo "<td colspan='2'>";
		echo "test	</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td colspan='2'>";
		echo "Tennessee, 12345	</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td colspan='3' align='center'>";
	echo "<div id='bookdetails' style='overflow:scroll;height:180px;width:520px;border:1px solid black;'>";
	echo "<table border='1'>";
		echo "<th>Book Description</th><th>Qty</th><th>Price</th>";
		echo "<tr><td>iuhdf</br><b>By</b> Avi Silberschatz</br><b>Publisher:</b> McGraw-Hill</td><td>1</td><td>$12.99</td></tr>	</table>";
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
	echo "<div id='bookdetails' style='overflow:scroll;height:180px;width:260px;border:1px solid black;'>";
		echo "SubTotal:$12.99</br>Shipping_Handling:$2</br>_______</br>Total:$14.99	</div>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td align='right'>";
			echo "<input type='submit' id='buyit' name='btnbuyit' value='BUY IT!'>";
		echo "</td>";
		echo "</form>";
		echo "<td align='right'>";
			echo "<form id='update' action='update_customerprofile.php' method='post'>";
			echo "<input type='submit' id='update_customerprofile' name='update_customerprofile' value='Update Customer Profile'>";
			echo "</form>";
		echo "</td>";
		echo "<td align='left'>";
			echo "<form id='cancel' action='index.php' method='post'>";
			echo "<input type='submit' id='cancel' name='cancel' value='Cancel'>";
			echo "</form>";
		echo "</td>";
	echo "</tr>";
	echo "</table>";
	pg_close($db);
?>
</body>
</HTML>
