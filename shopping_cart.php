
<!DOCTYPE HTML>
<head>
	<title>Shopping Cart</title>
	<script>
	//remove from cart
	function del(isbn){
		window.location.href="shopping_cart.php?delIsbn="+ isbn;
	}
	</script>
</head>
<body>
	<?
		$db = pg_connect("host=ec2-3-218-75-21.compute-1.amazonaws.com dbname=d8p0qs8v3fbf9m user=gymsvpkhkckshh password=68db7ff943798b07abc442d46449c9d2f4bfcd38be0f79023a630bf67b3b3a8a");
	
		$order = pg_query($db, "select * from \"order\" join \"order_book\" on \"order\".number = \"order_book\".order_number join book on \"order_book\".book_isbn = book.isbn where placed = false");
	
		if (!empty($_POST)) {
			$isbn = $_POST['delIsbn'];

			$remove_book = pg_query($db, "delete from order_book where placed = false and book_isbn = '$isbn'");
		}
		
		pg_close($db);
	?>

	<table align="center" style="border:2px solid blue;">
		<tr>
			<td align="center">
				<form id="checkout" action="confirm_order.php" method="get">
					<input type="submit" name="checkout_submit" id="checkout_submit" value="Proceed to Checkout">
				</form>
			</td>
			<td align="center">
				<form id="new_search" action="screen2.php" method="post">
					<input type="submit" name="search" id="search" value="New Search">
				</form>								
			</td>
			<td align="center">
				<form id="exit" action="index.php" method="post">
					<input type="submit" name="exit" id="exit" value="EXIT 3-B.com">
				</form>					
			</td>
		</tr>
		<tr>
			<form id="recalculate" name="recalculate" action="" method="post">
				<td  colspan="3">
					<div id="bookdetails" style="overflow:scroll;height:180px;width:400px;border:1px solid black;">
						<table align="center" BORDER="2" CELLPADDING="2" CELLSPACING="2" WIDTH="100%">
							<th width='10%'>Remove</th>
							<th width='60%'>Book Description</th>
							<th width='10%'>Qty</th>
							<th width='10%'>Price</th>
							<?
								while ($book = pg_fetch_row($order)) {
									?>
									
									<tr>
										<td>
											<button name='delete' id='delete' onClick='del("<? echo($book[4]); ?>");return false;'>Delete Item</button>
										</td>
										<td>
											<? echo($book[7]); ?></br><b>By</b> <? echo($book[8]); ?></br><b>Publisher:</b> <? echo($book[9]); ?>
										</td>
										<td>
											<input id='txt<? echo($book[4]); ?>' name='txt<? echo($book[4]); ?>' value='1' size='1' />
										</td>
										<td><? echo($book[10]); ?></td>
									</tr>
									
									<?
								}
							?>
						</table>
					</div>
				</td>
		</tr>
		<tr>
			<td align="center">				
				<input type="submit" name="recalculate_payment" id="recalculate_payment" value="Recalculate Payment">
			</form>
			</td>
			<td align="center">
				&nbsp;
			</td>
			<td align="center">			
				Subtotal:  $12.99
			</td>
		</tr>
	</table>
</body>
