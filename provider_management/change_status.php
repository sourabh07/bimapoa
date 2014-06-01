<?php
include '../common_include_in.php';
$providerobj = new Providers();
$db = new DB();
$current_status= $_GET['current_status'];
$provider_code = $_GET['provider_code'];

$providerobj->ActiveDeactive($provider_code,$current_status);