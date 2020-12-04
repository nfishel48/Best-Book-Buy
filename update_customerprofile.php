<script>alert('Please enter all values')</script><!DOCTYPE HTML>
<head>
<title>UPDATE CUSTOMER PROFILE</title>

</head>
<body>
	<?
		$db = pg_connect("host=ec2-3-218-75-21.compute-1.amazonaws.com dbname=d8p0qs8v3fbf9m user=gymsvpkhkckshh password=68db7ff943798b07abc442d46449c9d2f4bfcd38be0f79023a630bf67b3b3a8a");
		
		$user = pg_fetch_row(pg_query($db, "select * from customer where logged_in = true;"));
	
		if (!empty($_POST)) {
			$username = $_POST['username'];
			$pin = $_POST['pin'];
			$retype_pin = $_POST['retype_pin'];
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$address = $_POST['address'];
			$city = $_POST['city'];
			$state = $_POST['state'];
			$zip = $_POST['zip'];
			$credit_card = $_POST['credit_card'];
			$card_number = $_POST['card_number'];
			$expiration = $_POST['expiration'];

			$username_test = pg_query($db, "select * from customer where username = '$username'");
			
			if ($username_test && pg_num_rows($username_test) > 0) {
				echo("<h3>Username $username is taken, please try another</h3>");
			} else if ($pin != $retype_pin) {
				echo("<h3>Pins do not match</h3>");
			} else {
				$insert = pg_query($db, "insert into customer (username, first_name, last_name, pin, address, city, state, zip, cctype, ccnum, expdate) values('$username', '$firstname', '$lastname', $pin, '$address', '$city', '$state', '$zip', '$credit_card', '$card_number', '$expiration')");

				if ($insert) {
					echo("Account created");
				} else {
					echo("There was an error");
				}
			}

			pg_close($db);
		}
	?>

	<form id="update_profile" action="" method="post">
	<table align="center" style="border:2px solid blue;">
		<tr>
			<td align="right">
				Username: <? echo($user[1]); ?>
			</td>
			<td colspan="3" align="center">
							</td>
		</tr>
		<tr>
			<td align="right">
				New PIN<span style="color:red">*</span>:
			</td>
			<td>
				<input type="text" id="new_pin" name="new_pin" value = "<? echo($user[4]); ?>">
			</td>
			<td align="right">
				Re-type New PIN<span style="color:red">*</span>:
			</td>
			<td>
				<input type="text" id="retypenew_pin" name="retypenew_pin" value = "<? echo($user[4]); ?>">
			</td>
		</tr>
		<tr>
			<td align="right">
				First Name<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<input type="text" id="firstname" name="firstname" value = "<? echo($user[2]); ?>">
			</td>
		</tr>
		<tr>
			<td align="right"> 
				Last Name<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<input type="text" id="lastname" name="lastname" value = "<? echo($user[3]); ?>">
			</td>
		</tr>
		<tr>
			<td align="right">
				Address<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<input type="text" id="address" name="address" value = "<? echo($user[5]); ?>">
			</td>
		</tr>
		<tr>
			<td align="right">
				City<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<input type="text" id="city" name="city" value = "<? echo($user[6]); ?>">
			</td>
		</tr>
		<tr>
			<td align="right">
				State<span style="color:red">*</span>:
			</td>
			<td>
				<select id="state" name="state">
				<option selected disabled>select a state</option>
				<option <? if ($user[7] == "Michigan"){ echo("selected"); } ?>>Michigan</option>
				<option <? if ($user[7] == "California"){ echo("selected"); } ?>>California</option>
				<option <? if ($user[7] == "Tennessee"){ echo("selected"); } ?>>Tennessee</option>
				</select>
			</td>
			<td align="right">
				Zip<span style="color:red">*</span>:
			</td>
			<td>
				<input type="text" id="zip" name="zip" value = "<? echo($user[8]); ?>">
			</td>
		</tr>
		<tr>
			<td align="right">
				Credit Card<span style="color:red">*</span>:
			</td>
			<td>
				<select id="credit_card" name="credit_card">
				<option selected disabled>select a card type</option>
				<option <? if ($user[9] == "VISA"){ echo("selected"); } ?>>VISA</option>
				<option <? if ($user[9] == "MASTER"){ echo("selected"); } ?>>MASTER</option>
				<option <? if ($user[9] == "DISCOVER"){ echo("selected"); } ?>>DISCOVER</option>
				</select>
			</td>
			<td align="left" colspan="2">
				<input type="text" id="card_number" name="card_number" placeholder="Credit card number" value = "<? echo($user[10]); ?>">
			</td>
		</tr>
		<tr>
			<td align="right" colspan="2">
				Expiration Date<span style="color:red">*</span>:
			</td>
			<td colspan="2" align="left">
				<input type="text" id="expiration_date" name="expiration_date" placeholder="MM/YY" value = "<? echo($user[11]); ?>">
			</td>
		</tr>
		<tr>
			<td align="right" colspan="2">
				<input type="submit" id="update_submit" name="update_submit" value="Update">
			</td>
			</form>
		<form id="cancel" action="index.php" method="post">	
			<td align="left" colspan="2">
				<input type="submit" id="cancel_submit" name="cancel_submit" value="Cancel">
			</td>
		</tr>
	</table>
	</form>
</body>
</html>