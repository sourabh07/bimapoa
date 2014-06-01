<?php
@mysql_connect('ambush2006.db.11283971.hostedresource.com', 'ambush2006', 'Velociter@1985') or die("Unable to connect to MySql Server");
@mysql_select_db('ambush2006') or die("Unable to select database");
$policy_no = $_POST['policy_no'];

$selectPolicy = "Select * from bimapoa_members where policy_no ='".$policy_no."'";
$resultPolicy=mysql_query($selectPolicy) or die(mysql_error());


if (mysql_num_rows($resultPolicy) != 0)
{
	echo $result= "error";
}
else
{
	echo $result = "success";
}
//return $result;