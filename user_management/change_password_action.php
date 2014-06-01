<?php
include_once '../common_include_in.php';
if(isset($_POST['submit']))
$userobj = new Members();
{
	$user_id=$_POST['user_id'];
	$oldpassword=$_POST['oldpassword'];
	$newpassword=$_POST['newpassword'];
	$confirmpassword=$_POST['confirmpassword'];


	$result=  mysql_query("select * from users where user_id='$user_id' && password='$oldpassword'");
	$resultset= mysql_num_rows($result);

	if($resultset == 0)
	{
		$userobj->RedirectToURL('change_password.php');
	//	echo  $message ="Incorrect Password!";
	}

	else if($newpassword == $confirmpassword)
	{
		$sql = mysql_query("UPDATE users SET password = '$newpassword' where user_id='$user_id'");
		$userobj->RedirectToURL('manage_users.php');
	//	echo  $message ="Password Change Successfully...";
	}
	else if($newpassword!=$confirmpassword)
	{
		//echo  $message ="New password and confirm password must be the same!";
		$userobj->RedirectToURL('change_password.php');
	}


}





?>
