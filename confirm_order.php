
<!DOCTYPE HTML>
<head>
	<title>CONFIRM ORDER</title>
	<header align='center'>Confirm Order</header> 
</head>
<body>
<?
	$db = pg_connect("host=ec2-3-218-75-21.compute-1.amazonaws.com dbname=d8p0qs8v3fbf9m user=gymsvpkhkckshh password=68db7ff943798b07abc442d46449c9d2f4bfcd38be0f79023a630bf67b3b3a8a");
	
	$order = pg_query($db, "select * from order_t join \"order_book\" on order_t.number = \"order_book\".order_number join book on \"order_book\".book_isbn = book.isbn where placed = false");
	
	$user = pg_query($db, "select * from customer where logged_in = true;");
	
	if (pg_num_rows($user) == 0){
		echo("<script type = \"text/javascript\">window.location = \"customer_registration.php\";</script>");
	}
	
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

	$subtotal = 0;

	echo "<table align='center' style='border:2px solid blue;'>";
	echo "<tr>";
	echo "<td>";
	echo "Shipping Address:";
	echo "</td>";
	echo "</tr>";
	echo "<td colspan='2'>";
		echo $firstName." ".$lastName."	</td>";
	echo "<td rowspan='3' colspan='2'>";
		echo "<input type='radio' name='cardgroup' value='profile_card' checked>Use Credit card on file<br/>".$cctype." - ".$ccnum." - ".$expdate."<br/>";
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
		
	?>
		<tr>
			<th>Book Description</th>
			<th>Qty</th>
			<th>Price</th>
		</tr>
	<?
		
		while ($book = pg_fetch_row($order)){
			$Title = $book[7];
			$Author = $book[8];
			$Publisher = $book[9];
			$Price = $book[10];
			$Quantity = $book[5];
			
			$subtotal += $Price * $Quantity;
			
			?>
			
			<tr>
				<td>
					<? echo($Title); ?>
					<br>
					<strong>By</strong> <? echo($Author); ?>
					<br>
					<strong>Price</strong>: <? echo($Price); ?>
				</td>
				<td>
					<? echo($Quantity); ?>
				</td>
				<td>
					<? echo($Price * $Quantity); ?>
				</td>
			</tr>
			<?
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

	$Total = $subtotal + 2;
	
	echo "<div id='bookdetails' style='overflow:scroll;height:180px;width:260px;border:1px solid black;'>";
		echo "SubTotal:$".$subtotal."</br>Shipping_Handling:$2</br>_______</br>Total:$".$Total."</div>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td align='right'>";
		echo "<form id='buy' action='proof_purchase.php' method='post'>";
		echo "<input type='submit' id='buyit' name='buyit' value='Buy'>";
		echo "</form>";
		echo "</td>";
		echo "</form>";
		echo "<td align='right'>";
			echo "<form id='update' action='update_customerprofile.php' method='get'>";
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
