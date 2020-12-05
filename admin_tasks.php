
<!DOCTYPE HTML>
<head>
	<title>ADMIN TASKS</title>
</head>
<body>
<?
$db = pg_connect("host=ec2-3-218-75-21.compute-1.amazonaws.com dbname=d8p0qs8v3fbf9m user=gymsvpkhkckshh password=68db7ff943798b07abc442d46449c9d2f4bfcd38be0f79023a630bf67b3b3a8a");
	echo '<table align="center" style="border:2px solid blue;">';
		echo '<tr>';
			echo '<td>';
			$users = pg_query($db, "Select COUNT(*) From customer");
			$row = pg_fetch_row($users);
				echo "<p>";
				echo 'Customers registered: '.$row[0].' '.date("h:i:sa").'  '.date("Y-m-d").' ';
				echo "</p>";
			echo '</td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td>';
			$categories = pg_query($db, "Select DISTINCT category from book");
			$books = array();
			$i = 0;
			foreach($categories as &$category){
				$books[$category] = pg_query($db, "Select COUNT(*) from book where category =".$category);
			}
			rsort($books);
			foreach($books as $x => $x_value) {
				echo "<p>".$x." ".$x_value;
			}
			echo '<td>';
		echo '</tr>';
			echo '<form action="index.php" method="post" id="exit">';
			echo '<td align="center">';
				echo '<input type="submit" name="cancel" id="cancel" value="EXIT 3-B.com[Admin]" style="width:200px;">';
			echo '</form>';
		echo '</tr>';
	echo '</table>';
	pg_close($db);
?>
</body>


</html>