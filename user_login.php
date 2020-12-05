
<!DOCTYPE HTML>
<head>
	<title>User Login</title>
</head>
<body>
	<?php
		if (!empty($_POST)) {
			$username = $_POST['username'];
			$pin = $_POST['pin'];
			
			$db = pg_connect("host=ec2-3-218-75-21.compute-1.amazonaws.com dbname=d8p0qs8v3fbf9m user=gymsvpkhkckshh password=68db7ff943798b07abc442d46449c9d2f4bfcd38be0f79023a630bf67b3b3a8a");

			$user_test = pg_query($db, "select * from customer where username = '$username' and pin = '$pin'");
			
			if (pg_num_rows($user_test) > 0){
				pg_query($db, "update customer set logged_in = true where username = '$username'");
				
				echo("<script type = \"text/javascript\">window.location = \"screen2.php\";</script>");
			}
		}
	?>

	<table align = "center" style = "border:2px solid blue;">
		<form action = "user_login.php" method = "post" id = "login_screen">
		<tr>
			<td align = "right">
				Username<span style = "color:red">*</span>:
			</td>
			<td align = "left">
				<input type = "text" name = "username" id = "username">
			</td>
			<td align = "right">
				<input type = "submit" name = "login" id = "login" value = "Login">
			</td>
		</tr>
		<tr>
			<td align = "right">
				PIN<span style = "color:red">*</span>:
			</td>
			<td align = "left">
				<input type = "password" name = "pin" id = "pin">
			</td>
			</form>
			<form action = "shopping_cart.php" method = "post" id = "login_screen">
			<td align = "right">
				<input type = "submit" name = "cancel" id = "cancel" value = "Cancel">
			</td>
			</form>
		</tr>
	</table>
</body>

</html>
