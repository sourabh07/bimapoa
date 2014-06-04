<?php
include '../common_include_in.php';
$memberobj = new Members();
$datet = date('Y-m-d');
$id = $_GET['membership_no'];
$updatedStatus = 'D';
$arrayStatus = Array();
$arrayStatus['deactivated_date'] = $datet;
$arrayStatus['status'] = $updatedStatus;
$memberobj->update('bimapoa_members', $arrayStatus,  "membership_no = '".$id."'");
$msg = 'DeActive Member data of membership no' . "\t" . $id;
$memberobj->MemberLogData($policy_no, $msg);
$memberobj->RedirectToURL('manage_members.php');
