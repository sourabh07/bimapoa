<?php
@mysql_connect('ambush2006.db.11283971.hostedresource.com', 'ambush2006', 'Velociter@1985') or die("Unable to connect to MySql Server");
@mysql_select_db('ambush2006') or die("Unable to select database");
$national_id = $_POST['national_id'];

$selectPolicy = "Select * from bimapoa_members where national_id ='".$national_id."'";
$resultPolicy=mysql_query($selectPolicy) or die(mysql_error());

if($national_id != '')
{
$selectPolicy = "Select * from bimapoa_members where national_id ='".$national_id."'";
$resultPolicy=mysql_query($selectPolicy) or die(mysql_error());


if (mysql_num_rows($resultPolicy) != 0)
{
	echo $result= "error";
}
else
{
	echo $result = "success";
}
}
else
{
    echo $result = "success";
}
//return $result;