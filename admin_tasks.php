
<!DOCTYPE HTML>
<head>
	<title>ADMIN TASKS</title>
</head>
<body>
	<?
		$db = pg_connect("host=ec2-3-218-75-21.compute-1.amazonaws.com dbname=d8p0qs8v3fbf9m user=gymsvpkhkckshh password=68db7ff943798b07abc442d46449c9d2f4bfcd38be0f79023a630bf67b3b3a8a");
		
		$users = pg_query($db, "Select COUNT(*) From customer");
		$user_count = pg_fetch_row($users);
	?>
	
	<table align="center" style="border:2px solid blue;">
		<tr>
			<td>
				<? echo(date("Y-m-d") . " " . date("h:i:sa")); ?>
				<br>
				<br>
				<strong>Customers registered</strong>: <? echo($user_count[0]); ?>
			</td>
		</tr>
		<tr>
			<td>
				<table>
					<tr>
						<td><strong>Genre</strong></td>
						<td><strong>Count</strong></td>
					</tr>
					<?
						$categories = array();
						$categories = pg_query($db, "Select DISTINCT category from book;");
						
						$books = array();
						
						$i = 0;
						
						while($row = pg_fetch_row($categories)){
							?>
								<tr>
									<td><? echo($row[0]); ?></td>
									<td><? 
											$count = pg_fetch_row(pg_query($db, "Select COUNT(*) from book where category ='".$row[0]."';"))[0];
											
											echo($count);
										?>
									</td>
							<?
						}
					?>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table>
					<tr>
						<td><strong>Book</strong></td>
						<td><strong>Reviews</strong></td>
					</tr>
					<?
						$categories = array();
						$categories = pg_query($db, "Select * from book;");
						
						$books = array();
						
						$i = 0;
						
						while($row = pg_fetch_row($categories)){
							?>
								<tr>
									<td><? echo($row[1]); ?></td>
									<td><? 
											$count = pg_fetch_row(pg_query($db, "Select COUNT(*) from review where book ='".$row[0]."';"))[0];
											
											echo($count);
										?>
									</td>
							<?
						}
					?>
				</table>
			</td>
		</tr>
			<form action="index.php" method="post" id="exit">
			<td align="center">
				<input type="submit" name="cancel" id="cancel" value="EXIT 3-B.com[Admin]" style="width:200px;">
			</form>
		</tr>
	</table>
	
	<?
		pg_close($db);
	?>
</body>


</html>