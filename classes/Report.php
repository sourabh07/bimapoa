<?php
include_once 'Validations.php';
class Report extends Helper {
	
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
	function RegisterReport() {
		if (!isset($_POST['submitted'])) {
			return false;
		}
		$formvars = array();
		if (!$this->ValidateReportSubmission()) {
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
		$this->RedirectToURL("manage_report.php");
	}
	function CollectDataSubmission(&$formvars)
	{
//            print_r($_POST);
//                        exit();
                $formvars['school_id'] = $this->Sanitize($_POST['school_id']);
		$formvars['class_id'] = $this->Sanitize($_POST['class_id']);
                $formvars['student_id'] = $this->Sanitize($_POST['student_id']);
                $formvars['section'] = $this->Sanitize($_POST['section']);
                $formvars['session_id'] = $this->Sanitize($_POST['session_id']);
                $formvars['date_testing'] = $this->Sanitize($_POST['date_testing']);
                list($m,$d,$y) = explode('/', $formvars['date_testing']);
                $formvars['dateoftest'] = $y.'-'.$m.'-'.$d;
                
                $formvars['dob'] = $this->Sanitize($_POST['dob']);
                list($m,$d,$y) = explode('/', $formvars['dob']);
                $formvars['dateofbirth'] = $y.'-'.$m.'-'.$d;
                
                $formvars['age'] = $this->Sanitize($_POST['age']);
                $formvars['gender'] = $this->Sanitize($_POST['gender']);
                $formvars['height'] = $this->Sanitize($_POST['height']);
                $formvars['weight'] = $this->Sanitize($_POST['weight']);
                $formvars['height_weight_ratio'] = $this->Sanitize($_POST['height_weight_ratio']);
                $formvars['bmi'] = $this->Sanitize($_POST['bmi']);
                $formvars['pulse_rate'] = $this->Sanitize($_POST['pulse_rate']);
                $formvars['speed'] = $this->Sanitize($_POST['speed']);
                $formvars['exp_strength'] = $this->Sanitize($_POST['exp_strength']);
                $formvars['strength'] = $this->Sanitize($_POST['strength']);
                $formvars['upper_body_str'] = $this->Sanitize($_POST['upper_body_str']);
                $formvars['agility'] = $this->Sanitize($_POST['agility']);
                $formvars['flexibility'] = $this->Sanitize($_POST['flexibility']);
                $formvars['speed2'] = $this->Sanitize($_POST['speed2']);
                $formvars['exp_strength2'] = $this->Sanitize($_POST['exp_strength2']);
                $formvars['strength2'] = $this->Sanitize($_POST['strength2']);
                $formvars['upper_body_str2'] = $this->Sanitize($_POST['upper_body_str2']);
                $formvars['agility2'] = $this->Sanitize($_POST['agility2']);
                $formvars['flexibility2'] = $this->Sanitize($_POST['flexibility2']);
		
	}
	function ValidateReportSubmission() {
		//This is a hidden input field. Humans won't fill this field.
		if (!empty($_POST[$this->GetSpamTrapInputName()])) {
			//The proper error is not given intentionally
			$this->HandleError("Automated submission prevention: case 2 failed");
			return false;
		}
		$validator = new FormValidator();
		
		
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
                $mysqlvars['school_id'] = $this->SanitizeForSQL($formvars['school_id']);
                $mysqlvars['class_id'] = $this->SanitizeForSQL($formvars['class_id']);
                $mysqlvars['student_id'] = $this->SanitizeForSQL($formvars['student_id']);
                $mysqlvars['section'] = $this->SanitizeForSQL($formvars['section']);
                $mysqlvars['session_id'] = $this->SanitizeForSQL($formvars['session_id']);
                $mysqlvars['date_testing'] = $this->SanitizeForSQL($formvars['dateoftest']);
                $mysqlvars['dob'] = $this->SanitizeForSQL($formvars['dateofbirth']);
                $mysqlvars['age'] = $this->SanitizeForSQL($formvars['age']);
                $mysqlvars['gender'] = $this->SanitizeForSQL($formvars['gender']);
		$mysqlvars['height'] = $this->SanitizeForSQL($formvars['height']);
                $mysqlvars['weight'] = $this->SanitizeForSQL($formvars['weight']);
                $mysqlvars['height_weight_ratio'] = $this->SanitizeForSQL($formvars['height_weight_ratio']);
                $mysqlvars['bmi'] = $this->SanitizeForSQL($formvars['bmi']);
                $mysqlvars['pulse_rate'] = $this->SanitizeForSQL($formvars['pulse_rate']);
                $mysqlvars['speed'] = $this->SanitizeForSQL($formvars['speed']);
                $mysqlvars['exp_strength'] = $this->SanitizeForSQL($formvars['exp_strength']);
                $mysqlvars['strength'] = $this->SanitizeForSQL($formvars['strength']);
                $mysqlvars['upper_body_str'] = $this->SanitizeForSQL($formvars['upper_body_str']);
                $mysqlvars['agility'] = $this->SanitizeForSQL($formvars['agility']);
                $mysqlvars['flexibility'] = $this->SanitizeForSQL($formvars['flexibility']);
                $mysqlvars['speed2'] = $this->SanitizeForSQL($formvars['speed2']);
                $mysqlvars['exp_strength2'] = $this->SanitizeForSQL($formvars['exp_strength2']);
                $mysqlvars['strength2'] = $this->SanitizeForSQL($formvars['strength2']);
                $mysqlvars['upper_body_str2'] = $this->SanitizeForSQL($formvars['upper_body_str2']);
                $mysqlvars['agility2'] = $this->SanitizeForSQL($formvars['agility2']);
                $mysqlvars['flexibility2'] = $this->SanitizeForSQL($formvars['flexibility2']);
                
//                print_r($mysqlvars);exit();
		
                $result = mysql_query("select * from student_report where student_id='".$mysqlvars['student_id']."' and session_id='".$mysqlvars['session_id']."'");
                $num = mysql_num_rows($result);
                if($num>0)
                {
                   $this->HandleError("$error"); 
                   $error="Test completed already";
                   return false;
                }
                else
                {
                    if (!$this->db->insert('student_report',$mysqlvars)) {
			$this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
			return false;
                    }
                    
                }
               
//                        exit();
		

                $this->HandleError("Student report added successfully!");
		return true;
	}

	//--------------------update student report--------------------------------
	function UpdateReport() {
		if (!isset($_POST['updated'])) {
			return false;
		}

		$formvars = array();

		if (!$this->ValidateReportUpdation()) {
			return false;
		}


		$this->CollectReportDataUpdation($formvars);

		if (!$this->UpdateToReportDatabase($formvars)) {
			return false;
		}
		$this->RedirectToURL("manage_report.php");
	}

	function CollectReportDataUpdation(&$formvars) {
//            print_r($_POST);
//            exit();
                $formvars['student_report_id'] = $this->Sanitize($_POST['student_report_id']);
		$formvars['school_id'] = $this->Sanitize($_POST['school_id']);
		$formvars['class_id'] = $this->Sanitize($_POST['class_id']);
                $formvars['student_id'] = $this->Sanitize($_POST['student_id']);
                $formvars['section'] = $this->Sanitize($_POST['section']);
                $formvars['session_id'] = $this->Sanitize($_POST['session_id']);
                
                $formvars['dob'] = $this->Sanitize($_POST['dob']);
                list($m,$d,$y) = explode('/', $formvars['dob']);
                $formvars['dateofbirth'] = $y.'-'.$m.'-'.$d;
                
                $formvars['age'] = $this->Sanitize($_POST['age']);
                $formvars['gender'] = $this->Sanitize($_POST['gender']);
                $formvars['height'] = $this->Sanitize($_POST['height']);
                $formvars['weight'] = $this->Sanitize($_POST['weight']);
                $formvars['height_weight_ratio'] = $this->Sanitize($_POST['height_weight_ratio']);
                $formvars['bmi'] = $this->Sanitize($_POST['bmi']);
                $formvars['pulse_rate'] = $this->Sanitize($_POST['pulse_rate']);
                
                $formvars['date_testing'] = $this->Sanitize($_POST['date_testing']);
                list($m,$d,$y) = explode('/', $formvars['date_testing']);
                $formvars['dateoftest'] = $y.'-'.$m.'-'.$d;
                
                $formvars['speed'] = $this->Sanitize($_POST['speed']);
                $formvars['exp_strength'] = $this->Sanitize($_POST['exp_strength']);
                $formvars['strength'] = $this->Sanitize($_POST['strength']);
                $formvars['upper_body_str'] = $this->Sanitize($_POST['upper_body_str']);
                $formvars['agility'] = $this->Sanitize($_POST['agility']);
                $formvars['flexibility'] = $this->Sanitize($_POST['flexibility']);
                
                $formvars['date_testing2'] = $this->Sanitize($_POST['date_testing2']);
                list($m,$d,$y) = explode('/', $formvars['date_testing2']);
                $formvars['dateoftest2'] = $y.'-'.$m.'-'.$d;
                
                $formvars['speed2'] = $this->Sanitize($_POST['speed2']);
                $formvars['exp_strength2'] = $this->Sanitize($_POST['exp_strength2']);
                $formvars['strength2'] = $this->Sanitize($_POST['strength2']);
                $formvars['upper_body_str2'] = $this->Sanitize($_POST['upper_body_str2']);
                $formvars['agility2'] = $this->Sanitize($_POST['agility2']);
                $formvars['flexibility2'] = $this->Sanitize($_POST['flexibility2']);
	}
	function ValidateReportUpdation() {
		//This is a hidden input field. Humans won't fill this field.
		if (!empty($_POST[$this->GetSpamTrapInputName()])) {
			//The proper error is not given intentionally
			$this->HandleError("Automated submission prevention: case 2 failed");
			return false;
		}
		$validator = new FormValidator();
                
                

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

	function UpdateToReportDatabase(&$formvars) {
		if (!$this->UpdateIntoReportDB($formvars)) {
			$this->HandleError("Inserting to Database failed!");
			return false;
		}
		return true;
	}

	function UpdateIntoReportDB(&$formvars)
	{
		$mysqlvars = array();
		$mysqlvars['school_id'] = $this->SanitizeForSQL($formvars['school_id']);
                $mysqlvars['class_id'] = $this->SanitizeForSQL($formvars['class_id']);
                $mysqlvars['student_id'] = $this->SanitizeForSQL($formvars['student_id']);
                $mysqlvars['section'] = $this->SanitizeForSQL($formvars['section']);
                $mysqlvars['session_id'] = $this->SanitizeForSQL($formvars['session_id']);
                $mysqlvars['dob'] = $this->SanitizeForSQL($formvars['dateofbirth']);
                $mysqlvars['age'] = $this->SanitizeForSQL($formvars['age']);
                $mysqlvars['gender'] = $this->SanitizeForSQL($formvars['gender']);
		$mysqlvars['height'] = $this->SanitizeForSQL($formvars['height']);
                $mysqlvars['weight'] = $this->SanitizeForSQL($formvars['weight']);
                $mysqlvars['height_weight_ratio'] = $this->SanitizeForSQL($formvars['height_weight_ratio']);
                $mysqlvars['bmi'] = $this->SanitizeForSQL($formvars['bmi']);
                $mysqlvars['pulse_rate'] = $this->SanitizeForSQL($formvars['pulse_rate']);
                $mysqlvars['date_testing'] = $this->SanitizeForSQL($formvars['dateoftest']);
                $mysqlvars['speed'] = $this->SanitizeForSQL($formvars['speed']);
                $mysqlvars['exp_strength'] = $this->SanitizeForSQL($formvars['exp_strength']);
                $mysqlvars['strength'] = $this->SanitizeForSQL($formvars['strength']);
                $mysqlvars['upper_body_str'] = $this->SanitizeForSQL($formvars['upper_body_str']);
                $mysqlvars['agility'] = $this->SanitizeForSQL($formvars['agility']);
                $mysqlvars['flexibility'] = $this->SanitizeForSQL($formvars['flexibility']);
                $mysqlvars['date_testing2'] = $this->SanitizeForSQL($formvars['dateoftest2']);
                $mysqlvars['speed2'] = $this->SanitizeForSQL($formvars['speed2']);
                $mysqlvars['exp_strength2'] = $this->SanitizeForSQL($formvars['exp_strength2']);
                $mysqlvars['strength2'] = $this->SanitizeForSQL($formvars['strength2']);
                $mysqlvars['upper_body_str2'] = $this->SanitizeForSQL($formvars['upper_body_str2']);
                $mysqlvars['agility2'] = $this->SanitizeForSQL($formvars['agility2']);
                $mysqlvars['flexibility2'] = $this->SanitizeForSQL($formvars['flexibility2']);
		
//                 print_r($mysqlvars);
//                        exit();
                if (!$this->db->update("student_report",$mysqlvars,"student_report_id = '".$formvars['student_report_id']."'"))
		{
			$this->HandleDBError("Error Updating data to the table\nquery:$insert_query");
			return false;
		}
                $this->HandleError("Student report updated successfully!");
		return true;
	}
        

}



?>