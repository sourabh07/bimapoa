<?php
include_once 'Validations.php';
class Providers extends Helper {

	private $db;
	public $error_message;

	function __construct() {
		include_once 'include/DB.php';
		$this->db = new DB();
		$this->db->connect();
	}

	function __destruct()
	{
	}

	//-------Main Operations ----------------------
	function RegisterProvider() {
		if (!isset($_POST['submitted'])) {
			return false;
		}
		$formvars = array();
		if (!$this->ValidateProviderSubmission()) {
			return false;
		}
		$this->CollectProviderDataSubmission($formvars);
		if (!$this->SaveToDatabase($formvars)) {
			return false;
		}
		/* if (!$this->SendUserConfirmationEmail($formvars)) {
			return false;
		}
		$this->SendAdminIntimationEmail($formvars); */
		$this->RedirectToURL("manage_providers.php");
	}
	function CollectProviderDataSubmission(&$formvars)
	{
		//provider_name,address,provider_code,phone,bank_name,account_name,account_no,iifc_code
		$formvars['provider_name'] = $this->Sanitize($_POST['provider_name']);
		$formvars['address'] = $this->Sanitize($_POST['address']);
		$formvars['provider_code'] = $this->Sanitize($_POST['provider_code']);
		$formvars['phone'] = $this->Sanitize($_POST['phone']);
//		$formvars['bank_name'] = $this->Sanitize($_POST['bank_name']);
//		$formvars['account_name'] = $this->Sanitize($_POST['account_name']);
//		$formvars['account_no'] = $this->Sanitize($_POST['account_no']);
//		$formvars['iifc_code'] = $this->Sanitize($_POST['iifc_code']);
	}
	function ValidateProviderSubmission() {
		//This is a hidden input field. Humans won't fill this field.
		if (!empty($_POST[$this->GetSpamTrapInputName()])) {
			//The proper error is not given intentionally
			$this->HandleError("Automated submission prevention: case 2 failed");
			return false;
		}
		$validator = new FormValidator();
		$validator->addValidation("provider_name", "req", "  Please Enter provider Name");
		$validator->addValidation("address", "req", "  Please Enter address");
		//$validator->addValidation("provider_code", "req", "  Enter provider code");
		$validator->addValidation("phone", "req", "  Please Enter phone");
//		$validator->addValidation("bank_name", "req", "  Please Enter bank_name");
//		$validator->addValidation("account_name", "req", "Please Enter account_name");
//		$validator->addValidation("account_no", "req", "Please Enter account_no");
//		$validator->addValidation("iifc_code", "req", "Please Enter iifc_code");

		if (!$validator->ValidateForm()) {
			$error = '';
			$error_hash = $validator->GetErrors();
			foreach ($error_hash as $inpname => $inp_err) {
				$error .= $inpname . ':' . $inp_err . "\n";
			}
			$this->HandleError($error);
			return false;
		}
		return true;
	}

	function SaveToDatabase(&$formvars) {
		/* if (!$this->IsFieldUnique($formvars, 'email')) {
			$this->HandleError("This email is already registered");
		return false;
		}

		if (!$this->IsFieldUnique($formvars, 'username')) {
		$this->HandleError("This UserName is already used. Please try another username");
		return false;
		} */
		if (!$this->InsertIntoDB($formvars)) {
			$this->HandleError("Inserting to Database failed!");
			return false;
		}
		return true;
	}

	function IsFieldUnique($formvars, $fieldname) {
		$field_val = $this->SanitizeForSQL($formvars[$fieldname]);
		$qry = "select username from $this->tablename where $fieldname='" . $field_val . "'";
		$result = mysql_query($qry, $this->connection);
		if ($result && mysql_num_rows($result) > 0) {
			return false;
		}
		return true;
	}

	function InsertIntoDB(&$formvars) {

		$mysqlvars = array();
		$mysqlvars['provider_name'] = $this->SanitizeForSQL($formvars['provider_name']);
		$mysqlvars['address'] = $this->SanitizeForSQL($formvars['address']);
		$mysqlvars['provider_code'] = $this->SanitizeForSQL($formvars['provider_code']);
		$mysqlvars['phone'] = $this->SanitizeForSQL($formvars['phone']);
//		$mysqlvars['bank_name'] = $this->SanitizeForSQL($formvars['bank_name']);
//		$mysqlvars['account_name'] = $this->SanitizeForSQL($formvars['account_name']);
//		$mysqlvars['account_no'] = $this->SanitizeForSQL($formvars['account_no']);
//		$mysqlvars['iifc_code'] = $this->SanitizeForSQL($formvars['iifc_code']);
		if (!$this->db->insert('providers', $mysqlvars)) {
			$this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
			return false;
		}
                
                
                $insertid = $this->db->insert_id();
		$provider_prefix= "HP";
		$provider_str =str_pad($insertid, 4, '0', STR_PAD_LEFT);
		$provider_code = $provider_prefix.$provider_str;
                $arrayMno =  array();
		$arrayMno['provider_code'] = $provider_code;

		if (!$this->db->update("providers",$arrayMno,"provider_id = '".$insertid."'")){
			$this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
			return false;
		
	}
           return true;
        }

	//--------------------update--------------------------------
	function UpdateProvider() {
		if (!isset($_POST['updated'])) {
			return false;
		}

		$formvars = array();

		if (!$this->ValidateProviderUpdation()) {
			return false;
		}


		$this->CollectProviderDataUpdation($formvars);

		if (!$this->UpdateToDatabase($formvars)) {
			return false;
		}
		$this->RedirectToURL("manage_providers.php");
	}

	function CollectProviderDataUpdation(&$formvars) {

		$formvars['provider_id'] = $this->Sanitize($_POST['provider_id']);
		$formvars['provider_name'] = $this->Sanitize($_POST['provider_name']);
		$formvars['address'] = $this->Sanitize($_POST['address']);
		$formvars['provider_code'] = $this->Sanitize($_POST['provider_code']);
		$formvars['phone'] = $this->Sanitize($_POST['phone']);
//		$formvars['bank_name'] = $this->Sanitize($_POST['bank_name']);
//		$formvars['account_name'] = $this->Sanitize($_POST['account_name']);
//		$formvars['account_no'] = $this->Sanitize($_POST['account_no']);
//		$formvars['iifc_code'] = $this->Sanitize($_POST['iifc_code']);
		//$formvars['payment_type'] = $this->Sanitize($_POST['payment_type']);
	}
	function ValidateProviderUpdation() {
		//This is a hidden input field. Humans won't fill this field.
		if (!empty($_POST[$this->GetSpamTrapInputName()])) {
			//The proper error is not given intentionally
			$this->HandleError("Automated submission prevention: case 2 failed");
			return false;
		}
		$validator = new FormValidator();
		$validator->addValidation("provider_name", "req", "  Please Enter provider  Name");
		$validator->addValidation("address", "req", "  Please Enter address");
		//$validator->addValidation("provider_code", "req", "  Enter provider_code");
		$validator->addValidation("phone", "req", "  Please Enter phone");
//		$validator->addValidation("bank_name", "req", "  Please Enter bank_name");
//		$validator->addValidation("account_name", "req", "Please Enter account_name");
//		$validator->addValidation("account_no", "req", "Please Enter account_no");
//		$validator->addValidation("iifc_code", "req", "Please Enter iifc_code");
		//	$validator->addValidation("payment_type", "req", "  Please Enter Signed Contact");
		if (!$validator->ValidateForm()) {
			$error = '';
			$error_hash = $validator->GetErrors();
			foreach ($error_hash as $inpname => $inp_err) {
				$error .= $inpname . ':' . $inp_err . "\n";
			}
			$this->HandleError($error);
			return false;
		}
		return true;
	}

	function UpdateToDatabase(&$formvars) {
		if (!$this->UpdateIntoDB($formvars)) {
			$this->HandleError("Inserting to Database failed!");
			return false;
		}
		return true;
	}
	function UpdateIntoDB(&$formvars)
	{
		$mysqlvars = array();
		$mysqlvars['provider_name'] = $this->SanitizeForSQL($formvars['provider_name']);
		$mysqlvars['address'] = $this->SanitizeForSQL($formvars['address']);
		$mysqlvars['provider_code'] = $this->SanitizeForSQL($formvars['provider_code']);
		$mysqlvars['phone'] = $this->SanitizeForSQL($formvars['phone']);
//		$mysqlvars['bank_name'] = $this->SanitizeForSQL($formvars['bank_name']);
//		$mysqlvars['account_name'] = $this->SanitizeForSQL($formvars['account_name']);
//		$mysqlvars['account_no'] = $this->SanitizeForSQL($formvars['account_no']);
//		$mysqlvars['iifc_code'] = $this->SanitizeForSQL($formvars['iifc_code']);
		//	$mysqlvars['payment_type'] = $this->SanitizeForSQL($formvars['payment_type']);
		if (!$this->db->update("providers", $mysqlvars , "provider_id = '".$formvars['provider_id']."'"))
		{
			$this->HandleDBError("Error Updating data to the table\nquery:$insert_query");
			return false;
		}
		return true;
	}
	
	function ActiveDeactive($provider_code,$current_status)
	{
		$updatedStatus = null;
		if($current_status == '1')
		{
			$updatedStatus = '0';
		}
		else
		{
			$updatedStatus = '1';
		}
		$arrayStatus = Array();
		$arrayStatus['status'] = $this->SanitizeForSQL($updatedStatus);
		if(!$this->db->update('providers', $arrayStatus, "provider_code = '".$provider_code."'"))
		{
			$this->HandleDBError("Error Updating data to the table\nquery:$insert_query");
		}
		$this->RedirectToURL("manage_providers.php");
	}
}



?>