
<!-- screen 4: Book Reviews by Prithviraj Narahari, php coding: Alexander Martens-->
<!DOCTYPE html>
<html>
<head>
<title>Book Reviews - 3-B.com</title>
<style>
.field_set
{
	border-style: inset;
	border-width:4px;
}
</style>
</head>
<body>
<?
	$query = 'Select * From Review;';
	$db_conn = pg_connect("host=ec2-3-218-75-21.compute-1.amazonaws.com dbname=d8p0qs8v3fbf9m user=gymsvpkhkckshh password=68db7ff943798b07abc442d46449c9d2f4bfcd38be0f79023a630bf67b3b3a8a");
	$result =  pg_query($db_conn, $query);
	if (!$result) {
	echo "<h3>An error occurred.</h3>";
	}
	$arr = pg_fetch_array($result, 0, PGSQL_NUM);
	echo $arr[0] . " <- Row 1 ID\n";
	echo $arr[1] . " <- Row 1 Author\n";
	echo $arr[2] . " <- Row 1 Book\n";
	echo $arr[3] . " <- Row 1 Content\n";
	pg_close($db_conn);
?>
	<table align="center" style="border:1px solid blue;">
		<tr>
			<td align="center">
				<h5> Reviews For:</h5>
			</td>
			<td align="left">
				<h5> </h5>
			</td>
		</tr>
			
		<tr>
			<td colspan="2">
			<div id="bookdetails" style="overflow:scroll;height:200px;width:300px;border:1px solid black;">
				<table>
					<tr>
						<td><? echo"<h3>Username: $arr[1]</h3>" ?></td>
					</tr>
					<tr>
						<td><? echo"<p>$arr[3]</p>" ?></td>
					</tr>		
				</table>
				<br>
			</div>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<form action="screen2.php" method="post">
					<input type="submit" value="Done">
				</form>
			</td>
		</tr>
	</table>


</body>

</html>
