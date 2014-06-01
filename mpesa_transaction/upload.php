<?php
ob_start();

$db = mysql_connect("ambush2006.db.11283971.hostedresource.com", "ambush2006", "Velociter@1985") or die("Could not connect.");
if(!$db)
	die("no db");
if(!mysql_select_db("ambush2006",$db))
	die("No database selected.");

/* $db = mysql_connect("localhost", "root", "") or die("Could not connect.");
 if(!$db)
	die("no db");
if(!mysql_select_db("bimapoa",$db))
	die("No database selected.");
*/if (isset($_POST['submit']))
{
	if (is_uploaded_file($_FILES['data']['tmp_name'])) {
		readfile($_FILES['data']['tmp_name']);
	}

	$handle = fopen($_FILES['data']['tmp_name'], "r");

	/* 	scheme,policy_no,contract_effective_date,contract_expiry_date,membership_no,membership_name,dob,sex,relation,national_id
	 ,area,region,location,selected_provider_code,chw_code,date_signed,date_captured,card_issued,status,terminated_date,payment_type
	*/

	while (($data = fgetcsv($handle, 10000, ",")))
	{
		$selectQueryMembers = "SELECT * FROM `bimapoa_members` WHERE `policy_no`='".$data[1]."' AND `national_id`='".$data[9]."'";
		$resultMembers=mysql_query($selectQueryMembers) or die(mysql_error());
		if (mysql_num_rows($resultMembers) == 0)
		{
			$import="INSERT into bimapoa_members(scheme,policy_no,contract_effective_date,contract_expiry_date,membership_no,membership_name,dob,sex,relation,national_id
			,area,region,location,selected_provider_code,chw_code,date_signed,date_captured,card_issued,status,terminated_date,payment_type
			) values('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$data[13]','$data[14]','$data[15]','$data[16]','$data[17]','$data[18]','$data[19]','$data[3]')";
			mysql_query($import) or die(mysql_error());
		}
		else
		{
		}
	}




	/* $selectMpesa = "SELECT * FROM `mpesa`";
	 $resultMpesa=mysql_query($selectMpesa) or die(mysql_error());
	while($row= mysql_fetch_array($resultMpesa))
	{
	$mpesa_account = mysql_real_escape_string($row['mpesa_account']);
	$mpesa_sender = mysql_real_escape_string($row['mpesa_sender']);
	$mpesa_amount=$row['mpesa_amount'];

	if( $mpesa_amount== '4000')
	{
	if (strpos($mpesa_account,'APN') !== false)
	{
	$queryTwoInstallments = "INSERT into two_time_payment(policy_no,member_name) values('$mpesa_account','$mpesa_sender')";
	$resultM=mysql_query($queryTwoInstallments) or die(mysql_error());
	}
	else
	{
	$queryTwoInstallments = "INSERT into two_time_payment(national_id,member_name) values('$mpesa_account','$mpesa_sender')";
	$resultM=mysql_query($queryTwoInstallments) or die(mysql_error());
	}
	}

	elseif ($mpesa_amount == '8000')
	{

	if (strpos($mpesa_account,'APN') !== false)
	{
	$queryTwelveInstallments = "INSERT into one_time_payment(policy_no,member_name) values('$mpesa_account','$mpesa_sender')";
	$resultMt=mysql_query($queryTwelveInstallments) or die(mysql_error());
	}
	else
	{
	$queryTwelveInstallments = "INSERT into one_time_payment(national_id,member_name) values('$mpesa_account','$mpesa_sender')";
	$resultMt=mysql_query($queryTwelveInstallments) or die(mysql_error());
	}
	}
	elseif($mpesa_amount== '800')
	{
	if (strpos($mpesa_account,'APN') !== false)
	{
	$queryMonthlyInstallments = "INSERT into monthly_payment(policy_no,member_name) values('$mpesa_account','$mpesa_sender')";
	$resultMonthly=mysql_query($queryMonthlyInstallments) or die(mysql_error());
	}
	else
	{
	$queryMonthlyInstallments = "INSERT into monthly_payment(national_id,member_name) values('$mpesa_account','$mpesa_sender')";
	$resultMonthly=mysql_query($queryMonthlyInstallments) or die(mysql_error());

	}

	}
	} */
	ob_end_flush();
	fclose($handle);
	header("location: manage_members.php");

}else {
	header("location: manage_members.php");
}
?>

