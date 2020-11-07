
<!-- Figure 3: Search Result Screen by Prithviraj Narahari, php coding: Alexander Martens -->
<html>
<?
			$db = pg_connect("host=ec2-3-218-75-21.compute-1.amazonaws.com dbname=d8p0qs8v3fbf9m user=gymsvpkhkckshh password=68db7ff943798b07abc442d46449c9d2f4bfcd38be0f79023a630bf67b3b3a8a");
			$query = "Select * From Book Where ".$_POST['searchon']." LIKE '%".$_POST['searchfor']."%';";
			$result =  pg_query($db, $query);
			$row = pg_fetch_row($result);

			pg_close($db);
?>
<head>
	<title> Search Result - 3-B.com </title>
	<script>
	//redirect to reviews page
	function review(isbn, title){
		window.location.href="screen4.php?isbn="+ isbn + "&title=" + title;
	}
	//add to cart
	function cart(isbn, searchfor, searchon, category){
		window.location.href="screen3.php?cartisbn="+ isbn + "&searchfor=" + searchfor + "&searchon=" + searchon + "&category=" + category;
	}
	</script>
</head>
<body>
	<table align="center" style="border:1px solid blue;">
		<tr>
			<td align="left">
				
					<h6> <fieldset>Your Shopping Cart has 0 items</fieldset> </h6>
				
			</td>
			<td>
				&nbsp
			</td>
			<td align="right">
				<form action="shopping_cart.php" method="post">
					<input type="submit" value="Manage Shopping Cart">
				</form>
			</td>
		</tr>
		<tr>
		
		<td style='width: 350px' colspan='3' align='center'>
			<div id="bookdetails" style="overflow:scroll;height:200px;width:800px;border:1px solid black;background-color:LightBlue">
				<table>
		<?
		$db = pg_connect("host=ec2-3-218-75-21.compute-1.amazonaws.com dbname=d8p0qs8v3fbf9m user=gymsvpkhkckshh password=68db7ff943798b07abc442d46449c9d2f4bfcd38be0f79023a630bf67b3b3a8a");
		$query = "Select * From Book Where ".$_POST['searchon']." LIKE '%".$_POST['searchfor']."%';";
		$result =  pg_query($db, $query);
		while ($row = pg_fetch_row($result)) {
			$ISBN = $row[0];
			$Title = $row[1];
			$Author = $row[2];
			$Publisher = $row[3];
			$Price = $row[4];
			$book = "<td rowspan='2' align='left'>".$Title."</br>".$Author."</br><b>Publisher:</b>".$Publisher.",</br><b>ISBN:</b>".$ISBN."</t> <b>Price:</b>".$Price."</td>";
			$review = "<input name='review' id='review' type='submit' value='".$ISBN."' onClick='review(".$ISBN.", ".$Title.")'></input>";
					echo '<tr>';
						echo "<td align='left'>";
							// Place link for cart here	
							echo "<button name='btnCart' id='btnCart' onClick='cart(\"123441\", \"\", \"Array\", \"all\")'>Add to Cart</button>";
						echo'</td>';
					echo $book; 
					echo '</tr>';
				echo '<tr>';
					echo "<td align='left'>";
					echo '<form action="screen4.php" method="post">';
						echo $review;
					echo '</form>';
					echo"</td>";
				echo "</tr>";
			echo "</tr>";
				echo "<tr>";
					echo "<td colspan='2'>";
						echo "<p>_______________________________________________</p>";
					echo "</td>";
			echo "</td>";
		//echo "</tr>";
		}
		pg_close($db);
		?>
	</table>
			</div>
			
			</td>
		</tr>
		<tr>
			<td align= "center">
				<form action="confirm_order.php" method="get">
					<input type="submit" value="Proceed To Checkout" id="checkout" name="checkout">
				</form>
			</td>
			<td align="center">
				<form action="screen2.php" method="post">
					<input type="submit" value="New Search">
				</form>
			</td>
			<td align="center">
				<form action="index.php" method="post">
					<input type="submit" name="exit" value="EXIT 3-B.com">
				</form>
			</td>
		</tr>
	</table>
</body>
</html>
