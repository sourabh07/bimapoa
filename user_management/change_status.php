<?php
include '../common_include_in.php';
$userobj = new Users();
$db = new DB();
$current_status= $_GET['current_status'];
$user_id = $_GET['user_id'];

$userobj->ActiveDeactive($user_id,$current_status);