
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
	echo $_POST['review'];
	$query = 'Select '.$_POST['review'].'From Review;';
	$db_conn = pg_connect("host=ec2-3-218-75-21.compute-1.amazonaws.com dbname=d8p0qs8v3fbf9m user=gymsvpkhkckshh password=68db7ff943798b07abc442d46449c9d2f4bfcd38be0f79023a630bf67b3b3a8a");
	$result =  pg_query($db_conn, $query);
	while ($row = pg_fetch_row($result)) {
		echo $row[0];
		echo $row[1];
		echo $row[2];
		echo $row[3];

		$a = "<tr><td><h3>Username: ".$row[1]."</h3></td></tr><tr><td><p>".$row[3]."</p></td></tr><hr>"; 	
	echo '<table align="center" style="border:1px solid blue;">';
		echo '<tr>';
			echo '<td align="center">';
				echo '<h5> Reviews For:</h5>';
			echo '</td>';
			echo '<td align="left">';
				echo '<h5> </h5>';
			echo '</td>';
		echo '</tr>';
			
		echo '<tr>';
			echo '<td colspan="2">';
			echo '<div id="bookdetails" style="overflow:scroll;height:200px;width:300px;border:1px solid black;">';
				echo '<table>';
					echo $a;
				echo '</table>';
				
			echo '</div>';
			echo '</td>';
		echo '</tr>';
	}
?>
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
