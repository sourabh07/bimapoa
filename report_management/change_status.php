<?php
include '../common_include_in.php';
$memberobj = new Members();
$current_status= $_GET['current_status'];
$policy_no = $_GET['policy_no'];

if(isset($_GET['termination_date']))
{
	$statusArray = array();

	list($m, $d, $y) = explode('/', $_GET['termination_date']);
	$statusArray['terminated_date'] = $y . '-' . $m . '-' . $d;
	$memberobj->update('bimapoa_members', $statusArray, 'policy_no = "'.$policy_no.'"');
	$memberobj->ActiveDeactive($policy_no,$current_status);
}
else {
	
	$statusArray = array();
	$statusArray['terminated_date'] = "";
	$memberobj->update('bimapoa_members', $statusArray, 'policy_no = "'.$policy_no.'"');
	$memberobj->ActiveDeactive($policy_no,$current_status);

}
