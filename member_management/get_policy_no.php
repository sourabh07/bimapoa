<?php
@mysql_connect('localhost', 'root', '') or die("Unable to connect to MySql Server");
@mysql_select_db('ambush2006') or die("Unable to select database");
$policy_no = $_POST['policy_no'];

$selectPolicy = "Select * from bimapoa_members where policy_no ='".$policy_no."'";
$resultPolicy=mysql_query($selectPolicy) or die(mysql_error());

$count = mysql_num_rows($resultPolicy);

if ( $count > 0)
{
	echo $result= "error";
}
else
{
	echo $result = "success";
}
//return $result;