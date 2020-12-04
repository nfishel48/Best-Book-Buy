<html>
<head>
	<title>Welcome to Best Book Buy Online Bookstore!</title>
</head>
<body>
	<?php
		$db = pg_connect("host=ec2-3-218-75-21.compute-1.amazonaws.com dbname=d8p0qs8v3fbf9m user=gymsvpkhkckshh password=68db7ff943798b07abc442d46449c9d2f4bfcd38be0f79023a630bf67b3b3a8a");

		$log_out = pg_query($db, "update customer set logged_in = false;");
		
		pg_close($db);
	?>

	<table align="center" style="border:1px solid blue;">
		<tr>
			<td>
				<h2>Best Book Buy (3-B.com)</h2>
			</td>
		</tr>
		<tr>
			<td>
				<h4>Online Bookstore</h4>
			</td>
		</tr>
		<tr>
			<td>
				<form action="" method="post">
					<input type="radio" name="group1" value="SearchCat.php" onclick="document.location.href='screen2.php'">Search Online<br/>
					<input type="radio" name="group1" value="customer_registration.php" onclick="document.location.href='customer_registration.php'">New Customer<br/>
					<input type="radio" name="group1" value="user_login.php" onclick="document.location.href='user_login.php'">Returning Customer<br/>
					<input type="radio" name="group1" value="admin_login.php" onclick="document.location.href='admin_login.php'">Administrator<br/>
					<input type="submit" name="submit" value="ENTER">
				</form>
			</td>
		</tr>
	</table>
</body>
</html>