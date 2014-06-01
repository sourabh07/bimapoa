<?php
include '../common_include_in.php';
include '../include/header_in.php';
$agentobj = new Agents();
$id = $_GET['agent_id'];
$agentobj->_delete("agent", "agent_id = '".$id."'");
header("location:manage_agents.php");
