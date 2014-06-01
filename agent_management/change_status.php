<?php
include '../common_include_in.php';
$agentobj = new Agents();
$db = new DB();
$current_status= $_GET['current_status'];
$agent_code = $_GET['agent_code'];

$agentobj->ActiveDeactive($agent_code,$current_status);