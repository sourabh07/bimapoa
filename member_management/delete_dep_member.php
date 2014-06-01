<?php
include '../common_include_in.php';
$memberobj = new Members();
$id = $_GET['membership_no'];
$memberobj->_delete("bimapoa_members", "membership_no = '".$id."'");
$memberobj->RedirectToURL('manage_members.php');
