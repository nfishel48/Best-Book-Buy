
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
	
		$order = pg_query($db, "select * from order_t join \"order_book\" on order_t.number = \"order_book\".order_number join book on \"order_book\".book_isbn = book.isbn where placed = false");
	
		$subtotal = 0;
	
		if (!empty($_GET)) {
			$isbn = $_GET['delIsbn'];

			if ($isbn){
				$remove_book = pg_query($db, "delete from order_book where order_number = (select number from order_t where placed = false) and book_isbn = '$isbn'");
				
				echo("<script type = \"text/javascript\">window.location = \"shopping_cart.php\";</script>");
			}
		} else if (!empty($_POST)){
			foreach ($_POST as $key => $value) {
				if ($key[0] == 't' and $key[1] == 'x' and $key[2] == 't'){ //really bad code i know
					$isbn = substr($key, 3);
					
					$query = pg_query($db, "update order_book set quantity = $value where book_isbn = '$isbn'");
					
					echo("<script type = \"text/javascript\">window.location = \"shopping_cart.php\";</script>");
				}
			}
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
									$subtotal += $book[10] * $book[5];
								
									?>
									
									<tr>
										<td>
											<button name='delete' id='delete' onClick='del("<? echo($book[4]); ?>");return false;'>Delete Item</button>
										</td>
										<td>
											<? echo($book[7]); ?></br><b>By</b> <? echo($book[8]); ?></br><b>Publisher:</b> <? echo($book[9]); ?>
										</td>
										<td>
											<input id='txt<? echo($book[4]); ?>' name='txt<? echo($book[4]); ?>' value='<? echo($book[5]); ?>' size='1' />
										</td>
										<td><? echo($book[10]); ?></td>
									</tr>
								<? } ?>
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
				Subtotal: $<? echo($subtotal); ?>
			</td>
		</tr>
	</table>
</body>
