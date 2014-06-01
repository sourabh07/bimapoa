<?php
include '../common_include_in.php';
include '../include/header_in.php';
$memberobj = new Members();
$id = $_GET['member_id'];
$memberobj->_delete("bimapoa_members", "member_id = '".$id."'");
header("location:manage_members.php");
