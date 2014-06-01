<?php
include '../common_include_in.php';
include '../include/header_in.php';
$providerobj = new Providers();
$id = $_GET['provider_id'];
$providerobj->_delete("providers", "provider_id = '".$id."'");
header("location:manage_providers.php");
