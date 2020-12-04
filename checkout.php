<?
$db = pg_connect("host=ec2-3-218-75-21.compute-1.amazonaws.com dbname=d8p0qs8v3fbf9m user=gymsvpkhkckshh password=68db7ff943798b07abc442d46449c9d2f4bfcd38be0f79023a630bf67b3b3a8a");
$update = "delete from order_book where order_number = 1;";
echo $update;
pg_query($db, $update);
pg_close($db);
header("Location: https://best-book-buy.herokuapp.com/index.php"); 
exit;

?>