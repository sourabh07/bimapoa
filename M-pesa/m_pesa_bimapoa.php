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
	$account = $_REQUEST['mpesa_acc'];

	$check = mysql_query("INSERT INTO mpesa (IPN_Id, mpesa_msisdn,mpesa_sender, mpesa_amount)
			VALUES ('$IPN_Id', '$moneyfromnumber', '$moneyfromname',$amount)");


	if($check)
	{
	 $selectMpesa = "SELECT * FROM `mpesa`";
	 $resultMpesa=mysql_query($selectMpesa) or die(mysql_error());
		while($row= mysql_fetch_array($resultMpesa))
		{
			/* $account = mysql_real_escape_string($row['mpesa_account']); //$account
			 $moneyfromname = mysql_real_escape_string($row['mpesa_sender']); //$moneyfromname
			$amount=$row['mpesa_amount'];//$amount */

			if( $amount== '4000')
			{
				if (strpos($account,'APN') !== false)
				{
					$queryTwoInstallments = "INSERT into two_time_payment(policy_no,member_name) values('$account','$moneyfromname')";
					$resultM=mysql_query($queryTwoInstallments) or die(mysql_error());
				}
				else
				{
					$queryTwoInstallments = "INSERT into two_time_payment(national_id,member_name) values('$account','$moneyfromname')";
					$resultM=mysql_query($queryTwoInstallments) or die(mysql_error());
				}
			}

			elseif ($amount == '8000')
			{

				if (strpos($account,'APN') !== false)
				{
					$queryTwelveInstallments = "INSERT into one_time_payment(policy_no,member_name) values('$account','$moneyfromname')";
					$resultMt=mysql_query($queryTwelveInstallments) or die(mysql_error());
				}
				else
				{
					$queryTwelveInstallments = "INSERT into one_time_payment(national_id,member_name) values('$account','$moneyfromname')";
					$resultMt=mysql_query($queryTwelveInstallments) or die(mysql_error());
				}
			}
			elseif($amount== '800')
			{
				if (strpos($account,'APN') !== false)
				{
					$queryMonthlyInstallments = "INSERT into monthly_payment(policy_no,member_name) values('$account','$moneyfromname')";
					$resultMonthly=mysql_query($queryMonthlyInstallments) or die(mysql_error());
				}
				else
				{
					$queryMonthlyInstallments = "INSERT into monthly_payment(national_id,member_name) values('$account','$moneyfromname')";
					$resultMonthly=mysql_query($queryMonthlyInstallments) or die(mysql_error());

				}

			}
		}
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