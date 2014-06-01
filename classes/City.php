<?php
include_once 'Validations.php';

class City extends Helper {

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
	function RegisterCity() {
		if (!isset($_POST['submitted'])) {
			return false;
		}

		$formvars = array();

		if (!$this->ValidateCitySubmission()) {
			return false;
		}


		$this->CollectCityDataSubmission($formvars);

		if (!$this->SaveToDatabase($formvars)) {
			return false;
		}


		/* if (!$this->SendUserConfirmationEmail($formvars)) {
			return false;
		}

		$this->SendAdminIntimationEmail($formvars); */

		$this->RedirectToURL("manage_city.php");
	}

	function CollectCityDataSubmission(&$formvars)
	{
		$formvars['city'] = $this->Sanitize($_POST['city']);
	}

	function ValidateCitySubmission() {
		//This is a hidden input field. Humans won't fill this field.
		if (!empty($_POST[$this->GetSpamTrapInputName()])) {
			//The proper error is not given intentionally
			$this->HandleError("Automated submission prevention: case 2 failed");
			return false;
		}
		$validator = new FormValidator();
		$validator->addValidation("city", "req", "  Please Enter City");

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
		$mysqlvars['city_name'] = $this->SanitizeForSQL($formvars['city']);


		if (!$this->db->insert('city', $mysqlvars)) {
			$this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
			return false;
		}
		return true;
	}



}



?>