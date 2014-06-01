<?php
include 'common_include_out.php';
$obj = new Members();
$obj ->connect();
$agent_code = $_POST['agent_code'];

$selectEmail = "Select * from agent where agent_code ='".$agent_code."'";
$resultEmail=mysql_query($selectEmail) or die(mysql_error());

while($row_agent    = mysql_fetch_array($result_agent))
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