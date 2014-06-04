<?php
@mysql_connect('localhost', 'root', '') or die("Unable to connect to MySql Server");
@mysql_select_db('ambush2006') or die("Unable to select database");
$agent_code = $_POST['agent_code'];

$selectEmail = "Select * from agent where agent_code ='".$agent_code."'";
$resultEmail=mysql_query($selectEmail) or die(mysql_error());

while($row_agent = mysql_fetch_array($resultEmail))
{
	$name = $row_agent ['name'];
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