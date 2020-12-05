
<!DOCTYPE HTML>
<head>
	<title>Proof purchase</title>
	<header align="center">Proof purchase</header> 
</head>
<body>
	<?
	$db = pg_connect("host=ec2-3-218-75-21.compute-1.amazonaws.com dbname=d8p0qs8v3fbf9m user=gymsvpkhkckshh password=68db7ff943798b07abc442d46449c9d2f4bfcd38be0f79023a630bf67b3b3a8a");
	
	$order = pg_query($db, "select * from order_t join \"order_book\" on order_t.number = \"order_book\".order_number join book on \"order_book\".book_isbn = book.isbn where placed = false");
	
	if (!empty($_POST)){
		$card_type = $_POST['credit_card'];
		$card_number = $_POST['card_number'];
		$card_expiration = $_POST['card_expiration'];
		
		if ($card_type && $card_number && $card_expiration){
			$query = pg_query($db, "update customer set cctype = '$card_type', ccnum = '$card_number', expdate = '$card_expiration' where logged_in = true;");
		}
	}
	
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

	?>
	
	<table align='center' style='border:2px solid blue;'>
		<form id='buy' action='index.php' method='post'>
		<tr>
			<td colspan = 2>
				<strong>Shipping Address</strong>
				<br>
				<? echo($firstName . " " . $lastName); ?>
				<br>
				<? echo($address); ?>
				<br>
				<? echo($city); ?>
				<br>
				<? echo($state . " " . $zip); ?>
				<br>
			</td>
			<td colspan = 2>
				<strong>UserID</strong>: <? echo($username); ?>
				<br>
				<strong>Date</strong>: <? echo(date("m/d/Y")); ?> 
				<br>
				<strong>Time</strong>: <? echo(date("h:i:sa")); ?> 
				
				<br><br>
				
				<strong>Credit Card Information</strong>: <? echo($cctype . " - " . $ccnum); ?>
			</td>
		</tr>
	<tr>
	<td colspan='3' align='center'>
		<div id='bookdetails' style='overflow:scroll;height:180px;width:520px;border:1px solid black;'>
			<table border='1'>
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
				?>
				
				</table>
			</div>
		</td>
	</tr>
	<tr>
		<td align='left' colspan='2'>
			<div id='bookdetails' style='overflow:scroll;height:180px;width:260px;border:1px solid black;background-color:LightBlue'>
				<b>Shipping Note:</b> The book will be </br>delivered within 5</br>business days.
			</div>
		</td>
		<td align='right'>
			<? 
				$Total = $subtotal + 2;
			?>
		
			<div id='bookdetails' style='overflow:scroll;height:180px;width:260px;border:1px solid black;'>
				SubTotal:$".$subtotal."</br>Shipping_Handling:$2</br>_______</br>Total:$".$Total."</div>
		</td>
	</tr>
	<tr>
		<td align='right'>
			<input type='submit' id='print' name='print' value='Print'>
			</form>
		</td>
		<td align='right'>
			<form id='update' action='checkout2.php' method='post'>
				<?echo "<button type='submit' id='update_customerprofile' name='update_customerprofile' value='".$Total."'>New Search</button>" ?>
			</form>
		</td>
		<td align='left'>
			<form id='exit' action='checkout.php' method='post'>
				<?echo "<button type='submit' id='exit' name='exit' value='".$Total."'>exit</button>" ?>
			</form>
		</td>
	</tr>
	</table>
	
	<?
		pg_close($db);
	?>
</body>
</HTML>
