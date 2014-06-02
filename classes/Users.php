<?php
include_once 'Validations.php';

class Users extends Helper {

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

	function RegisterForm() {

		if (!isset($_POST['submitted'])) {
			return false;
		}

		$formvars = array();

		if (!$this->ValidateSubmission()) {
			return false;
		}


		$this->CollectDataSubmission($formvars);

		if (!$this->SaveToDatabase($formvars)) {
			return false;
		}

		$this->RedirectToURL("manage_users.php");
	}

	function CollectDataSubmission(&$formvars) {

		$formvars['full_name'] = $this->Sanitize($_POST['full_name']);
		$formvars['user_email'] = $this->Sanitize($_POST['user_email']);
		$formvars['username'] = $this->Sanitize($_POST['username']);
		$formvars['password'] = $this->Sanitize($_POST['password']);
		$formvars['user_type'] = $this->Sanitize($_POST['user_type']);
		$formvars['provider_code'] = $this->Sanitize($_POST['provider_code']);
	}

	function ValidateSubmission() {
		//This is a hidden input field. Humans won't fill this field.
		if (!empty($_POST[$this->GetSpamTrapInputName()])) {
			//The proper error is not given intentionally
			$this->HandleError("Automated submission prevention: case 2 failed");
			return false;
		}

		$validator = new FormValidator();
		$validator->addValidation("full_name", "req", "Please fill in name");
		$validator->addValidation("user_email", "req", "Please fill in email");
		$validator->addValidation("user_email", "email", "Please fill in email with proper format");
		$validator->addValidation("password", "req", "Please fill in password");
		$validator->addValidation("user_type", "req", "Please fill in user_type");
		$validator->addValidation("username", "req", "Please fill in username");
		$validator->addValidation("provider_code", "req", "Please fill in designation");

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
		$mysqlvars['full_name'] = $this->SanitizeForSQL($formvars['full_name']);
		$mysqlvars['user_email'] = $this->SanitizeForSQL($formvars['user_email']);
		$mysqlvars['password'] = $this->SanitizeForSQL($formvars['password']);
		$mysqlvars['user_type'] = $this->SanitizeForSQL($formvars['user_type']);
		$mysqlvars['username'] = $this->SanitizeForSQL($formvars['username']);
		$mysqlvars['provider_code'] = $this->SanitizeForSQL($formvars['provider_code']);

		if (!$this->db->insert('users', $mysqlvars)) {
			$this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
			return false;
		}
                
                $msg='Insert User Data'."\t".$mysqlvars['user_type']. "\t";
                $this->db->UserLogData($mysqlvars, $msg);
                
		return true;
	}
	//--------------------update--------------------------------

	function UpdateUser() {
		if (!isset($_POST['updated'])) {
			return false;
		}

		$formvars = array();

		if (!$this->ValidateUpdation()) {
			return false;
		}


		$this->CollectDataUpdation($formvars);

		if (!$this->UpdateToDatabase($formvars)) {
			return false;
		}
		$this->RedirectToURL("manage_users.php");
	}

	function CollectDataUpdation(&$formvars) {

		$formvars['user_id'] = $this->Sanitize($_POST['user_id']);
		$formvars['full_name'] = $this->Sanitize($_POST['full_name']);
		$formvars['user_email'] = $this->Sanitize($_POST['user_email']);
		//$formvars['password'] = $this->Sanitize($_POST['password']);
		$formvars['user_type'] = $this->Sanitize($_POST['user_type']);
		$formvars['role'] = $this->Sanitize($_POST['role']);
		$formvars['mobile'] = $this->Sanitize($_POST['mobile']);
		$formvars['designation'] = $this->Sanitize($_POST['designation']);
		$formvars['gender'] = $this->Sanitize($_POST['gender']);

	}

	function ValidateUpdation() {
		//This is a hidden input field. Humans won't fill this field.
		if (!empty($_POST[$this->GetSpamTrapInputName()])) {
			//The proper error is not given intentionally
			$this->HandleError("Automated submission prevention: case 2 failed");
			return false;
		}
		$validator = new FormValidator();
		$validator->addValidation("full_name", "req", "Please fill in name");
		$validator->addValidation("user_email", "req", "Please fill in email");
		$validator->addValidation("user_email", "email", "Please fill in email with proper format");
		$validator->addValidation("user_type", "req", "Please fill in user_type");
		//$validator->addValidation("role", "req", "Please fill in role");
		//$validator->addValidation("mobile", "req", "Please fill in mobile");
		//$validator->addValidation("designation", "req", "Please fill in designation");
		//$validator->addValidation("gender", "req", "Please fill in gender");

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
		$mysqlvars['full_name'] = $this->SanitizeForSQL($formvars['full_name']);
		$mysqlvars['user_email'] = $this->SanitizeForSQL($formvars['user_email']);
		//$mysqlvars['password'] = $this->SanitizeForSQL($formvars['password']);
		$mysqlvars['user_type'] = $this->SanitizeForSQL($formvars['user_type']);
		//$mysqlvars['role'] = $this->SanitizeForSQL($formvars['role']);
		//$mysqlvars['mobile'] = $this->SanitizeForSQL($formvars['mobile']);
		//$mysqlvars['designation'] = $this->SanitizeForSQL($formvars['designation']);
		//$mysqlvars['gender'] = $this->SanitizeForSQL($formvars['gender']);

		if (!$this->db->update("users", $mysqlvars , "user_id = '".$formvars['user_id']."'"))
		{
			$this->HandleDBError("Error Updating data to the table\nquery:$insert_query");
			return false;
		}
                
                
                $msg='Update User Data'."\t".$mysqlvars['user_type']. "\t";
                $this->db->UserLogData($mysqlvars, $msg);
                
		return true;
	}



	function ActiveDeactive($user_id,$current_status)
	{
            
            $qrystring = "select * from users where user_id= '".$user_id."'";
            $result_user = mysql_query($qrystring);
            $row_user = mysql_fetch_array($result_user);
		$updatedStatus = null;
		if($current_status == '1')
		{
			$updatedStatus = '0';
                        $msg='Active User Data of '."\t".$row_user['full_name']."\t";
                        $this->db->UserLogData($mysqlvars, $msg);
		}
		else
		{
			$updatedStatus = '1';
                         $msg1='DeActive User Data of'."\t" .$row_user['full_name']."\t";
                        $this->db->UserLogData($mysqlvars, $msg1);
		}
		$arrayStatus = Array();
		$arrayStatus['status'] = $this->SanitizeForSQL($updatedStatus);
		if(!$this->db->update('users', $arrayStatus, "user_id = '".$user_id."'"))
		{
			$this->HandleDBError("Error Updating data to the table\nquery:$insert_query");
		}
		$this->RedirectToURL("manage_users.php");
	}

}



?>