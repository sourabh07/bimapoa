<?php 
include '../common_include_in.php';

$id = $_REQUEST['id'];
$orig =  $_REQUEST['orig'];
$dest =  $_REQUEST['dest'];
$tstamp =  $_REQUEST['tstamp'];
$text =  $_REQUEST['text'];
$customer_id =  $_REQUEST['customer_id'];
$user =  $_REQUEST['user'];
$pass =  $_REQUEST['pass'];
$routemethod_id =  $_REQUEST['routemethod_id'];
$routemethod_name =  $_REQUEST['routemethod_name'];
$mpesa_code =  $_REQUEST['mpesa_code'];
$mpesa_acc =  $_REQUEST['mpesa_acc'];
$mpesa_msisdn =  $_REQUEST['mpesa_msisdn'];
$mpesa_trx_date =  $_REQUEST['mpesa_trx_date'];
$mpesa_trx_time =  $_REQUEST['mpesa_trx_time'];
$mpesa_amt =  $_REQUEST['mpesa_amt'];
$mpesa_sender =  $_REQUEST['mpesa_sender'];
$business_number =  $_REQUEST['business_number'];

if(isset($_REQUEST['mpesa_msisdn']) && isset($_REQUEST['mpesa_sender']) && isset($_REQUEST['mpesa_amt']))
{

$IPN_Id = $_REQUEST['id'];
$moneyfromnumber = $_REQUEST['mpesa_msisdn'];
$moneyfromname = $_REQUEST['mpesa_sender'];
$amount = $_REQUEST['mpesa_amt'];

$check = mysql_query("INSERT INTO mpesa (IPN_Id, mpesa_msisdn,mpesa_sender, mpesa_amount)
VALUES ('$IPN_Id', '$moneyfromnumber', '$moneyfromname',$amount)");


if($check)
{
	echo "OK|Thank you for your payment";
}
else
{
	echo "FAIL|Payment Not Done";
}
mysql_close($con);
}
else
{
	echo "FAIL|Request Not Valid";
}



?>