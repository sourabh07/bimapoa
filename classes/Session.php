<?php
include_once 'Validations.php';
class Session extends Helper {
	
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
	function AddSession() {
		if (!isset($_POST['submitted'])) {
			return false;
		}
		$formvars = array();
		if (!$this->ValidateSessionSubmission()) {
			return false;
		}
		$this->CollectDataSubmission($formvars);
		if (!$this->SaveToDatabase($formvars)) {
			return false;
		}
		/* if (!$this->SendUserConfirmationEmail($formvars)) {
			return false;
		}
		$this->SendAdminIntimationEmail($formvars); */
		$this->RedirectToURL("manage_session.php");
	}
	function CollectDataSubmission(&$formvars)
	{
//            print_r($_POST);
//                        exit();
                $formvars['start_date'] = $this->Sanitize($_POST['start_date']);
		$formvars['start_month'] = $this->Sanitize($_POST['start_month']);
                $formvars['start_year'] = $this->Sanitize($_POST['start_year']);
                $formvars['end_date'] = $this->Sanitize($_POST['end_date']);
		$formvars['end_month'] = $this->Sanitize($_POST['end_month']);
                $formvars['end_year'] = $this->Sanitize($_POST['end_year']);
                
		
	}
	function ValidateSessionSubmission() {
		//This is a hidden input field. Humans won't fill this field.
		if (!empty($_POST[$this->GetSpamTrapInputName()])) {
			//The proper error is not given intentionally
			$this->HandleError("Automated submission prevention: case 2 failed");
			return false;
		}
		$validator = new FormValidator();
		$validator->addValidation("start_date", "req", "  Please select start date");
                $validator->addValidation("start_month", "req", "  Please select start month");
                $validator->addValidation("start_year", "req", " Please select start year");
                $validator->addValidation("end_date", "req", "  Please select end date");
                $validator->addValidation("end_month", "req", "  Please select end month");
                $validator->addValidation("end_year", "req", "  Please select end year");
               
		
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
	
	
	
	function InsertIntoDB(&$formvars) {
		
		$mysqlvars = array();
                $mysqlvars['start_date'] = $this->SanitizeForSQL($formvars['start_date']);
                $mysqlvars['start_month'] = $this->SanitizeForSQL($formvars['start_month']);
                $mysqlvars['start_year'] = $this->SanitizeForSQL($formvars['start_year']);
                $mysqlvars['end_date'] = $this->SanitizeForSQL($formvars['end_date']);
                $mysqlvars['end_month'] = $this->SanitizeForSQL($formvars['end_month']);
                $mysqlvars['end_year'] = $this->SanitizeForSQL($formvars['end_year']);
		
//                print_r($mysqlvars);
//                        exit();
                $result = mysql_query("select * from session where start_date='".$mysqlvars['start_date']."' and start_month='".$mysqlvars['start_month']."' and end_date='".$mysqlvars['end_date']."' and end_month='".$mysqlvars['end_month']."'");
                $num = mysql_num_rows($result);
                if($num>0)
                {
                   $this->HandleError("Session already exists!"); 
                   return false;
                }
                else
                {
		if (!$this->db->insert('session',$mysqlvars)) {
			$this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
			return false;
		}
                }
                $this->HandleError("Session added successfully!");
		return true;
	}

	//--------------------update--------------------------------
	function UpdateSession() {
		if (!isset($_POST['updated'])) {
			return false;
		}

		$formvars = array();

		if (!$this->ValidateSessionUpdation()) {
			return false;
		}


		$this->CollectSessionDataUpdation($formvars);

		if (!$this->UpdateToSessionDatabase($formvars)) {
			return false;
		}
		$this->RedirectToURL("manage_session.php");
	}

	function CollectSessionDataUpdation(&$formvars) {
//            print_r($_POST);exit();
		
		$formvars['session_id'] = $this->Sanitize($_POST['session_id']);
		$formvars['start_date'] = $this->Sanitize($_POST['start_date']);
                $formvars['start_month'] = $this->Sanitize($_POST['start_month']);
		$formvars['start_year'] = $this->Sanitize($_POST['start_year']);
		$formvars['end_date'] = $this->Sanitize($_POST['end_date']);
		$formvars['end_month'] = $this->Sanitize($_POST['end_month']);
		$formvars['end_year'] = $this->Sanitize($_POST['end_year']);
		
	}
	function ValidateSessionUpdation() {
		//This is a hidden input field. Humans won't fill this field.
		if (!empty($_POST[$this->GetSpamTrapInputName()])) {
			//The proper error is not given intentionally
			$this->HandleError("Automated submission prevention: case 2 failed");
			return false;
		}
		$validator = new FormValidator();
                $validator->addValidation("start_date", "req", "  Please select start date");
                $validator->addValidation("start_month", "req", "  Please select start month");
                $validator->addValidation("start_year", "req", " Please select start year");
                $validator->addValidation("end_date", "req", "  Please select end date");
                $validator->addValidation("end_month", "req", "  Please select end month");
                $validator->addValidation("end_year", "req", "  Please select end year");

		
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

	function UpdateToSessionDatabase(&$formvars) {
		if (!$this->UpdateIntoSessionDB($formvars)) {
			$this->HandleError("Inserting to Database failed!");
			return false;
		}
		return true;
	}

	function UpdateIntoSessionDB(&$formvars)
	{
		$mysqlvars = array();
		$mysqlvars['start_date'] = $this->SanitizeForSQL($formvars['start_date']);
                $mysqlvars['start_month'] = $this->SanitizeForSQL($formvars['start_month']);
		$mysqlvars['start_year'] = $this->SanitizeForSQL($formvars['start_year']);
		$mysqlvars['end_date'] = $this->SanitizeForSQL($formvars['end_date']);
		$mysqlvars['end_month'] = $this->SanitizeForSQL($formvars['end_month']);
		$mysqlvars['end_year'] = $this->SanitizeForSQL($formvars['end_year']);
                
//                print_r($mysqlvars);exit();
		
                if (!$this->db->update("session",$mysqlvars, "session_id='".$formvars['session_id']."'"))
		{
			$this->HandleDBError("Error Updating data to the table\nquery:$insert_query");
			return false;
		}
                $this->HandleError("Session updated successfully!");
		return true;
	}
        

}

?>