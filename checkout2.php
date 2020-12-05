<?
$db = pg_connect("host=ec2-3-218-75-21.compute-1.amazonaws.com dbname=d8p0qs8v3fbf9m user=gymsvpkhkckshh password=68db7ff943798b07abc442d46449c9d2f4bfcd38be0f79023a630bf67b3b3a8a");
$update = "delete from order_book where order_number = 1;";

pg_query($db, $update);
$month = date("m");
switch($month){
    case 1:
        $month = "January";
        break;
    case 2:
        $month = "Febuary";
        break;
    case 3:
        $month = "March";
        break;
    case 4:
        $month = "April";
        break;
    case 5:
        $month = "May";
        break;
    case 6:
        $month = "June";
        break;
    case 7:
        $month = "July";
        break;
    case 8: 
        $month = "August";
        break;
    case 9:
        $month = "September";
        break;
    case 10:
        $month = "October";
        break;
    case 11:
        $month = "November";
    case 12:
        $month = "December";
}
$sale = "Select Ammount from Sales where Month ='".$month."';";
$total = pg_query($db, $sale);
$total = $total +$_POST['submit'];
echo $total;
$sale2 = "Update Sales Set Ammount =".$total.";";
pg_query($db, $sale2); 
pg_close($db);
//header("Location: https://best-book-buy.herokuapp.com/screen2.php"); 

//exit;

?>