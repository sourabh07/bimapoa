<?php
include '../common_include_in.php';
include '../include/header_in.php';
$userobj = new Users();
$id = $_GET['user_id'];
$userobj->_delete("users", "user_id = '".$id."'");
header("location:manage_users.php");
