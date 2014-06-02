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
		$formvars['phone'] = $this->Sanitize($_POST['phone']);
	}
	function ValidateAgentUpdation() {
		if (!empty($_POST[$this->GetSpamTrapInputName()])) {
			$this->HandleError("Automated submission prevention: case 2 failed");
			return false;
		}
		$validator = new FormValidator();
		$validator->addValidation("name", "req", "Please fill in Agent Name");
		$validator->addValidation("phone", "req", "Please fill in phone");
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
		if (!empty($_POST[$this->GetSpamTrapInputName()])) {
			$this->HandleError("Automated submission prevention: case 2 failed");
			return false;
		}
		$validator = new FormValidator();
		$validator->addValidation("name", "req", "Please fill in Agent Name");
		$validator->addValidation("date_created", "req", "Please fill in Date created");
		$validator->addValidation("phone", "req", "Please fill in phone");
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
		$mysqlvars['phone'] = $this->SanitizeForSQL($formvars['phone']);
		if (!$this->db->update("agent", $mysqlvars , "agent_id = '".$formvars['agent_id']."'"))
		{
			$this->HandleDBError("Error Updating data to the table\nquery:$insert_query");
			return false;
		}
                
                  $msg = 'Update Agent data of name'."\t".$mysqlvars['name']. "\t";
                  $this->db->AgentLogData($mysqlvars,$msg);
                 return true;
                
               
                
	}

	function InsertIntoDB(&$formvars)
	{

		$mysqlvars = array();
		$mysqlvars['name'] = $this->SanitizeForSQL($formvars['name']);
		$mysqlvars['date_created'] = $this->SanitizeForSQL($formvars['date_created1']);
		$mysqlvars['agent_code'] = $this->SanitizeForSQL($formvars['agent_code']);
		$mysqlvars['phone'] = $this->SanitizeForSQL($formvars['phone']);
		
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
                
                 $msg = 'Insert Agent data of agent_code'."\t".$mysqlvars['agent_code']. "\t";
                 $this->db->AgentLogData($mysqlvars,$msg);
                
                 return true;
		 
               
	}
        
        


	function ActiveDeactive($agent_code,$current_status)
	{
               
		$updatedStatus = null;
		if($current_status == '1')
		{
			$updatedStatus = '0';
                        $msg = 'Active Agent data of agent_code'."\t"."\t".$agent_code;
                        $this->db->AgentLogData($agent_code,$msg);
		}
		 else
		{
			$updatedStatus = '1';
                         $msg1 = 'DeActive Agent data of agent_code'."\t".$agent_code;
                         $this->db->AgentLogData($agent_code,$msg1);
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