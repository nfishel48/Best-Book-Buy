<?
$db_conn = pg_connect("host=ec2-3-218-75-21.compute-1.amazonaws.com dbname=d8p0qs8v3fbf9m user=gymsvpkhkckshh password=68db7ff943798b07abc442d46449c9d2f4bfcd38be0f79023a630bf67b3b3a8a");
$add = "insert into order_book (order_number, book_isbn, quantity) values(1, ".$_POST['cart'].", 1);";
echo $add;
echo pg_query($db, $add);
pg_close($db);
?>