<?
echo 'This button worked';
$add = "insert into order_book (order_number, book_isbn, quantity) values(1, ".$_POST['cart'].", 1);";
echo $add;
pg_query($db, $add);
?>