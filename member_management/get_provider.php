<?php
@mysql_connect('ambush2006.db.11283971.hostedresource.com', 'ambush2006', 'Velociter@1985') or die("Unable to connect to MySql Server");
@mysql_select_db('ambush2006') or die("Unable to select database");
$provider_code = $_POST['provider_code'];

$selectEmail = "Select * from providers where provider_code ='".$provider_code."'";
$resultEmail=mysql_query($selectEmail) or die(mysql_error());

while($row_provider = mysql_fetch_array($resultEmail))
{
	$name = $row_provider['provider_name'];
}
if (mysql_num_rows($resultEmail) == 0)
{
	echo $result= "error";
}
else
{
	echo $result = $name;
}
//return $result;