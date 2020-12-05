
<!DOCTYPE HTML>
<head>
	<title>ADMIN TASKS</title>
</head>
<body>
	<?
		$db = pg_connect("host=ec2-3-218-75-21.compute-1.amazonaws.com dbname=d8p0qs8v3fbf9m user=gymsvpkhkckshh password=68db7ff943798b07abc442d46449c9d2f4bfcd38be0f79023a630bf67b3b3a8a");
		
		$users = pg_query($db, "Select COUNT(*) From customer");
		$row = pg_fetch_row($users);
	?>
	
	<table align="center" style="border:2px solid blue;">
		<tr>
			<td>
				<p>Current day/time: <? echo(date("Y-m-d") . " " . date("h:i:sa")); ?></p>
				<br>
				<p>Customers registered: <? echo(row[0]); ?></p>
			</td>
		</tr>
		<tr>
			<td>
				<table>
					<tr>
						<td>Genre</td>
						<td>Count</td>
					</tr>
					<?
						$categories = array();
						$categories = pg_query($db, "Select DISTINCT category from book;"
						
						$books = array();
						
						while($row = pg_fetch_row($categories)){
							?>
								<tr>
									<td><? echo(row[1]); ?></td>
							<?
							
							$books[$genre] = pg_query($db, "Select COUNT(*) from book where category ='".$row[0]."';");
							
							$i++;
						}
						
						rsort($books);
						
						foreach($books as $x => $x_value) {
							$row = pg_fetch_row($x_value);
								
							?>
									<td><? echo(row[1]); ?></td>
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
	pg_close($db);
?>
</body>


</html>