<?php
include_once 'Validations.php';

class Agents extends Helper {

	private $db;
	public $error_message;

	function __construct() {
		include_once 'DB.php';
		$this->db = new DB();
		$this->db->connect();
	}

	function __destruct()
	{

	}

	//-------Main Operations ----------------------
	function RegisterAgent() {
		if (!isset($_POST['submitted'])) {
			return false;
		}

		$formvars = array();

		if (!$this->ValidateAgentSubmission()) {
			return false;
		}


		$this->CollectAgentDataSubmission($formvars);

		if (!$this->SaveToDatabase($formvars)) {
			return false;
		}
		$this->RedirectToURL("manage_agents.php");
	}


	function UpdateAgent() {
		if (!isset($_POST['updated'])) {
			return false;
		}

		$formvars = array();

		if (!$this->ValidateAgentUpdation()) {
			return false;
		}


		$this->CollectAgentDataUpdation($formvars);

		if (!$this->UpdateToDatabase($formvars)) {
			return false;
		}
		$this->RedirectToURL("manage_agents.php");
	}

	function CollectAgentDataUpdation(&$formvars) {

		$formvars['agent_id'] = $this->Sanitize($_POST['agent_id']);
		$formvars['name'] = $this->Sanitize($_POST['name']);
		$formvars['date_created'] = $this->Sanitize($_POST['date_created']);
		list($m,$d,$y) = explode('/', $formvars['date_created']);
		$formvars['date_created1'] = $y.'-'.$m.'-'.$d;
	//	$formvars['agent_code'] = $this->Sanitize($_POST['agent_code']);
		$formvars['phone'] = $this->Sanitize($_POST['phone']);
	}

	function CollectAgentDataSubmission(&$formvars) {

		$formvars['name'] = $this->Sanitize($_POST['name']);
		$formvars['date_created'] = $this->Sanitize($_POST['date_created']);
		list($m,$d,$y) = explode('/', $formvars['date_created']);
		$formvars['date_created1'] = $y.'-'.$m.'-'.$d;
		//$formvars['agent_code'] = $this->Sanitize($_POST['agent_code']);
		$formvars['phone'] = $this->Sanitize($_POST['phone']);
		//$formvars['bank_name'] = $this->Sanitize($_POST['bank_name']);
		//$formvars['account_name'] = $this->Sanitize($_POST['account_name']);
		//$formvars['account_no'] = $this->Sanitize($_POST['account_no']);
		//$formvars['iifc_code'] = $this->Sanitize($_POST['iifc_code']);
	}
	function ValidateAgentUpdation() {
		//This is a hidden input field. Humans won't fill this field.
		if (!empty($_POST[$this->GetSpamTrapInputName()])) {
			//The proper error is not given intentionally
			$this->HandleError("Automated submission prevention: case 2 failed");
			return false;
		}
		$validator = new FormValidator();
		$validator->addValidation("name", "req", "Please fill in Agent Name");
	//	$validator->addValidation("date_created", "req", "Please fill in Date created");
		//$validator->addValidation("agent_code", "req", "Please fill in agent_code");
		$validator->addValidation("phone", "req", "Please fill in phone");
		//$validator->addValidation("account_name", "req", "Please fill in City");
		//$validator->addValidation("account_no", "req", "Please provide Education");
		//$validator->addValidation("iifc_code", "req", "Please provide Occupation");
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


	function ValidateAgentSubmission() {
		//This is a hidden input field. Humans won't fill this field.
		if (!empty($_POST[$this->GetSpamTrapInputName()])) {
			//The proper error is not given intentionally
			$this->HandleError("Automated submission prevention: case 2 failed");
			return false;
		}
		$validator = new FormValidator();
		$validator->addValidation("name", "req", "Please fill in Agent Name");
		$validator->addValidation("date_created", "req", "Please fill in Date created");
		//$validator->addValidation("agent_code", "req", "Please fill in agent_code");
		$validator->addValidation("phone", "req", "Please fill in phone");
		//$validator->addValidation("bank_name", "req", "Please fill in Address");
		//$validator->addValidation("account_name", "req", "Please fill in City");
		//$validator->addValidation("account_no", "req", "Please provide Education");
		//$validator->addValidation("iifc_code", "req", "Please provide Occupation");
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
		if (!$this->InsertIntoDB($formvars)) {
			$this->HandleError("Inserting to Database failed!");
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



	function IsFieldUnique($formvars, $fieldname) {
		$field_val = $this->SanitizeForSQL($formvars[$fieldname]);
		$qry = "select username from $this->tablename where $fieldname='" . $field_val . "'";
		$result = mysql_query($qry, $this->connection);
		if ($result && mysql_num_rows($result) > 0) {
			return false;
		}
		return true;
	}
	function UpdateIntoDB(&$formvars)
	{
		$mysqlvars = array();
		$mysqlvars['name'] = $this->SanitizeForSQL($formvars['name']);
		//$mysqlvars['date_created'] = $this->SanitizeForSQL($formvars['date_created1']);
		//$mysqlvars['agent_code'] = $this->SanitizeForSQL($formvars['agent_code']);
		$mysqlvars['phone'] = $this->SanitizeForSQL($formvars['phone']);
		//$mysqlvars['bank_name'] = $this->SanitizeForSQL($formvars['bank_name']);
		//$mysqlvars['account_name'] = $this->SanitizeForSQL($formvars['account_name']);
		//$mysqlvars['account_no'] = $this->SanitizeForSQL($formvars['account_no']);
		//$mysqlvars['iifc_code'] = $this->SanitizeForSQL($formvars['iifc_code']);
		if (!$this->db->update("agent", $mysqlvars , "agent_id = '".$formvars['agent_id']."'"))
		{
			$this->HandleDBError("Error Updating data to the table\nquery:$insert_query");
			return false;
		}
		return true;
	}

	function InsertIntoDB(&$formvars)
	{


		/* srand((double)microtime()*1000000);

		$data = "AbcDE123IJKLMN67QRSTUVWXYZ";
		$data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
		$data .= "0FGH45OP89";

		for($i = 0; $i < 10; $i++)
		{
		$agent_code .= substr($data, (rand()%(strlen($data))), 1);
		} */
		$mysqlvars = array();
		$mysqlvars['name'] = $this->SanitizeForSQL($formvars['name']);
		$mysqlvars['date_created'] = $this->SanitizeForSQL($formvars['date_created1']);
		$mysqlvars['agent_code'] = $this->SanitizeForSQL($formvars['agent_code']);
		$mysqlvars['phone'] = $this->SanitizeForSQL($formvars['phone']);
		//$mysqlvars['bank_name'] = $this->SanitizeForSQL($formvars['bank_name']);
		//$mysqlvars['account_name'] = $this->SanitizeForSQL($formvars['account_name']);
		//$mysqlvars['account_no'] = $this->SanitizeForSQL($formvars['account_no']);
		//$mysqlvars['iifc_code'] = $this->SanitizeForSQL($formvars['iifc_code']);
		//$mysqlvars['agent_code'] = $this->SanitizeForSQL(strtoupper($agent_code.$formvars['national_id']));

		if (!$this->db->insert('agent', $mysqlvars)) {
			$this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
			return false;
		}
		$insertid = $this->db->insert_id();
		$agent_prefix= "CH";
		$agent_str =str_pad($insertid, 7, '0', STR_PAD_LEFT);
		$agent_code = $agent_prefix.$agent_str;
		$arrayMno =  array();
		$arrayMno['agent_code'] = $agent_code;

		if (!$this->db->update("agent",$arrayMno,"agent_id = '".$insertid."'")){
			$this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
			return false;
		}
		return true;
	}


	function ActiveDeactive($agent_code,$current_status)
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
		if(!$this->db->update('agent', $arrayStatus, "agent_code = '".$agent_code."'"))
		{
			$this->HandleDBError("Error Updating data to the table\nquery:$insert_query");
		}
		$this->RedirectToURL("manage_agents.php");
	}
}
?>