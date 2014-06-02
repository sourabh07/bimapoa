<?php
Function Transfer ()	
{
	
	global $role, $full_name, $user_email, $password, $user_type,$mobile,$designation,$gender;
	mysql_connect("localhost","root","");
	echo $full_name;
	$database="practise";
	@mysql_select_db($database) or die( "Unable to select database");
	//echo "insert into users(full_name) values('$full_name','$user_email','$password','$user_type','$role','$mobile','$designation','$gender','1')";
	//$query="insert into users values('$full_name','$user_email','$password','$user_type','$role','$mobile','$designation','$gender','1')";
	$query = "insert into users(full_name,user_email,password,user_type,role,mobile,designation,gender,status) values('$full_name','$user_email','$password','$user_type','$role','$mobile','$designation','$gender','1')";
	$result=mysql_query($query);

}

mysql_connect("localhost","root","");
$database="bimapoa";
@mysql_select_db("$database") or die( "Unable to select database");
$table="users";
$query="select * from $table";
$result=mysql_query($query);
$num=mysql_numrows($result);
$i=0;
while ($i < $num):
$full_name=mysql_result($result,$i,"full_name");
$user_email=mysql_result($result,$i,"user_email");
$password=mysql_result($result,$i,"password");
$user_type=mysql_result($result,$i,"user_type");
$role=mysql_result($result,$i,"role");
$mobile=mysql_result($result,$i,"mobile");
$designation=mysql_result($result,$i,"designation");
$gender=mysql_result($result,$i,"gender");
Transfer ();
$i++;
endwhile;

?>