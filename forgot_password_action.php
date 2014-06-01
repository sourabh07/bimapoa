<?php
@mysql_connect('ambush2006.db.11283971.hostedresource.com', 'ambush2006', 'Velociter@1985') or die("Unable to connect to MySql Server");
@mysql_select_db('ambush2006') or die("Unable to select database");
$email = $_POST['user_email'];
$select = "SELECT * FROM `users` WHERE `user_email`='".$email."'";
$result=mysql_query($select) or die(mysql_error());
if(mysql_num_rows($result)>0)
{
	$result_part=  mysql_query("select * from users where user_email='".$email."'");
	$row_part=  mysql_fetch_array($result_part);
	$to_part=$row_part['email'];
	$subject_partner = "Password Recovery";
	$message_partner = "Dear ".$row_part['full_name']." ,<br><br><br>Your Password = ".$row_part['password']."";
	$admi_email="manoj@velociters.com";
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'To: ' .$to_part."\r\n";
	$headers .= 'From: '.$admi_email. "\r\n<br>";
	mail($to_part, $subject_partner, $message_partner, $headers);
	//setcookie("success","Password has been sent to your E-mail ID",time()+60);
	header("Location: index.php");
}
else
{
	//setcookie("error","E-mail ID is not authorized",time()+60);
	header("Location: forgot_password.php");
}







