<?php
class Helper extends DB {
	
	public $error_message;
	
	function __construct() {
		$today = new DateTime();
	}
	
	function __destruct()
	{
	}
		
	/*
	 * Validation Related Funcations Start
	*
	*/
	
	function RegisterForm(){
		
	}
	
	function UpdateForm(){
	
	}
	
	function ActivationForm(){
	
	}
	
	function SafeDisplay($value_name) {

		if (empty($_POST[$value_name])) {

			return'';
		}
		return htmlentities($_POST[$value_name]);
	}


	function SanitizeForSQL($str) {
		if (function_exists("mysql_real_escape_string")) {
			$ret_str = mysql_real_escape_string($str);
		} else {
			$ret_str = addslashes($str);
		}
		return $ret_str;
	}


	function Sanitize($str, $remove_nl = true) {
		$str = $this->StripSlashes($str);

		if ($remove_nl) {
			$injections = array('/(\n+)/i',
					'/(\r+)/i',
					'/(\t+)/i',
					'/(%0A+)/i',
					'/(%0D+)/i',
					'/(%08+)/i',
					'/(%09+)/i'
			);
			$str = preg_replace($injections, '', $str);
		}
		return $str;
	}
	
	function StripSlashes($str) {
		if (get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return $str;
	}

	//-------Public Helper functions -------------

	function HandleError($err) {
		$this->error_message.= $err."\r\n";
	}

	function GetSpamTrapInputName() {
		return 'sp' . md5('KHGdnbvsgst'. $this->rand_key);
	}

	function GetErrorMessage() {
		if (empty($this->error_message)) {
			return '';
		}
		$errormsg = nl2br(htmlentities($this->error_message));
		return $errormsg;
	}

	/*
	 * Validation Related Funcations End
	*
	*/

	/*
	 * PHP Redirect Self And Location Related Funcations End
	*
	*/

	function GetSelfScript() {
		return htmlentities($_SERVER['PHP_SELF']);
	}

	function RedirectToURL($url) {
		header("Location: $url");
		exit;
	}

	/*
	 * Commmon Funcations Start Related Date and Time,Format,Masking,
	*
	*/

	function getDate(){
		$timezone = "Asia/Calcutta";
		if (function_exists('date_default_timezone_set'))
			date_default_timezone_set($timezone);
		$date = date('Y-m-d');
		return $date;
	}

	function getDateTime(){
		$timezone = "Asia/Calcutta";
		if (function_exists('date_default_timezone_set'))
			date_default_timezone_set($timezone);
		$datetime = date('Y-m-d H:i:s');
		return $datetime;
	}

	function getDateMysqlFormate($date){
		list($mm,$dd,$yy) = explode($date);
		$datemysqlformate = $yy."-".$mm."-".$dd;
		return $datemysqlformate;
	}

	
	function CalculateAge($BirthDate) 
	{ 
		list($Year, $Month, $Day) = explode("-", $BirthDate); 
		
		$YearDiff = date("Y") - $Year; 
		
		if(date("m") < $Month || (date("m") == $Month && date("d") < $DayDiff)) 
		{ 
		$YearDiff--; 
		} 
		return $YearDiff; 
	} 

	
	function getDateToDisplayFormate($date){
		list($yy,$mm,$dd) = explode($date);
		$datemysqlformate = $dd."/".$mm."/".$yy;
		return $datemysqlformate;
	}


	function getDateToDisplayFormateMMDDYY($date){
		list($yy,$mm,$dd) = explode($date);
		$datemysqlformate = $mm."/".$dd."/".$yy;
		return $datemysqlformate;
	}
	
	
	function _maskUrlParam($param)
	{
		return str_replace('=', '', base64_encode($param));

	}

	function _unmaskUrlParam($param)
	{
		return base64_decode($param);
	}

	/*
	 * Commmon Funcations Related To Database Fetch Name,ID,etc......
	*
	*/


	// Return List For Selections

	function getLeadTypeList($leadtype='') {
		$getgroup = '';
		$selected = array($leadtype => 'selected');
		$getgroup .= "<option value='Group' ".$selected['Group'].">Group</option>";
		$getgroup .= "<option value='Individual' ".$selected['Individual'].">Individual</option>";


		return $getgroup;
	}

	function getPaymentModeList($paymentmode='') {
		$getgroup = '';
		$selected = array($leadtype => 'selected');
		$getgroup .= "<option value='Cash' ".$selected['Cash'].">Cash</option>";
		$getgroup .= "<option value='M-Pesa' ".$selected['M-Pesa'].">M-Pesa</option>";
		$getgroup .= "<option value='Cheque' ".$selected['Cheque'].">Cheque</option>";
		return $getgroup;
	}
	// Group List
	function getGroupList($gid='') {
		$getgroup = '';
		$selected = array($gid => 'selected');
		$res = $this->query('select * from groups where group_id <> 0 ');

		while($row = $this->fetch_object($res)){
			$getgroup = $getgroup."<option value='".$row->group_id."' ".$selected[$row->group_id].">".$row->group_name."</option>";
		}
		return $getgroup;
	}
	
	//get provider code
	
	function getProviders($gid='') {
		$getgroup = '';
		$selected = array($gid => 'selected');
		$res = $this->query('select * from providers where provider_id <> 0 ');
	
		while($row = $this->fetch_object($res)){
			$getgroup = $getgroup."<option value='".$row->provider_code."' ".$selected[$row->provider_code].">".$row->provider_code."</option>";
		}
		return $getgroup;
	}
	
	//get agent code
	
	function getAgents($gid='') {
		$getgroup = '';
		$selected = array($gid => 'selected');
		$res = $this->query('select * from agent where agent_id <> 0 ');
	
		while($row = $this->fetch_object($res)){
			$getgroup = $getgroup."<option value='".$row->agent_code."' ".$selected[$row->agent_code].">".$row->agent_code."</option>";
		}
		return $getgroup;
	}
	
	
	// Group Code List
	function getGroupCODE() {
		$getgroup = '';
		$res = $this->query('select * from groups where group_id <> 0 ');
	
		while($row = $this->fetch_object($res)){
			$getgroup = $getgroup."<option value='".$row->group_code."'>".$row->group_code."</option>";
		}
		return $getgroup;
	}
	
	// Lead List
	function getLeadList($lid='') {
		$getlead = '';
		$selected = array($lid => 'selected');
		$res = $this->query('select * from insurance_lead where lead_id <> 0 ');
	
		while($row = $this->fetch_object($res)){
			$getlead = $getlead."<option value='".$row->lead_id."' ".$selected[$row->lead_id].">".$row->member_name."</option>";
		}
		return $getlead;
	}
	
	// Provider List
	function getProviderList($pid='') {
		$getprovider = '';
		$selected = array($pid => 'selected');
		$res = $this->query('select * from providers where provider_code <> 0 ');
	
		while($row = $this->fetch_object($res)){
			$getprovider = $getprovider."<option value='".$row->provider_code."' ".$selected[$row->provider_code].">".$row->provider_name."</option>";
		}
		return $getprovider;
	}
	
	// Area List
	function getAreaList($cid='') {
		$getarea = '';
		$selected = array($cid => 'selected');
		$res = $this->query('select * from area where area_id <> 0 ');

		while($row = $this->fetch_object($res)){
			$getarea = $getarea."<option value='".$row->area_id."' ".$selected[$row->name].">".$row->name."</option>";
		}
		return $getarea;
	}
        
        //Selected Area List
	function getSelectedAreaList($cid='') {
		$getarea = '';
		$selected = array($cid => 'selected');
		$res = $this->query('select * from area where area_id <> 0 ');

		while($row = $this->fetch_object($res)){
			$getarea = $getarea."<option value='".$row->area_id."' ".$selected[$row->name].">".$row->name."</option>";
		}
		return $getarea;
	}
        
        	function getSelectedRegionList($cid='') {
		$getarea = '';
		$selected = array($cid => 'selected');
		$res = $this->query('select * from region where region_id <> 0 ');

		while($row = $this->fetch_object($res)){
			$getarea = $getarea."<option value='".$row->region_id."' ".$selected[$row->region_name].">".$row->region_name."</option>";
		}
		return $getarea;
	}
        
        function getSelectedLocationList($cid='') {
		$getarea = '';
		$selected = array($cid => 'selected');
		$res = $this->query('select * from location where location_id <> 0 ');

		while($row = $this->fetch_object($res)){
			$getarea = $getarea."<option value='".$row->location_id."' ".$selected[$row->location_name].">".$row->location_name."</option>";
		}
		return $getarea;
	}

	// Sales Agent List
	function getSalesAgentList($said='') {
		$getsalesagent = '';
		$selected = array($said => 'selected');
		$res = $this->query('select * from agent where agent_id <> 0 ');

		while($row = $this->fetch_object($res)){
			$getsalesagent = $getsalesagent."<option value='".$row->agent_id."' ".$selected[$row->agent_id].">".$row->first_name." " .$row->last_name."</option>";
		}
		return $getsalesagent;
	}
	
	// Sales Agent List
	function getSalesAgentCODE() {
		$getsalesagent = '';
		
		$res = $this->query('select * from agent where agent_id <> 0 ');
	
		while($row = $this->fetch_object($res)){
			$getsalesagent = $getsalesagent."<option>".$row->agent_code."</option>";
		}
		return $getsalesagent;
	}
	// Sales Agent Code List
	function getSalesAgentCodeList($said='') {
		$getsalesagentcode = '';
		$selected = array($said => 'selected');
		$res = $this->query('select * from agent where agent_id <> 0 ');
	
		while($row = $this->fetch_object($res)){
			$getsalesagentcode = $getsalesagentcode."<option value='".$row->agent_id."' ".$selected[$row->agent_id].">".$row->agent_code."</option>";
		}
		return $getsalesagentcode;
	}

	// Users List
	function getUsersList($said='') {
		$getusers = '';
		$selected = array($said => 'selected');
		$res = $this->query('select * from  users where user_id <> 0 ');
	
		while($row = $this->fetch_object($res)){
			$getusers = $getusers."<option value='".$row->user_id."' ".$selected[$row->user_id].">".$row->full_name." " .$row->last_name."</option>";
		}
		return $getusers;
	}
	
	// Customer List
	function getCustomerList($cid='') {
		$getcustomer = '';
		$selected = array($cid => 'selected');
		$res = $this->query('select * from customer where customer_id <> 0 ');

		while($row = $this->fetch_object($res)){
			$getcustomer = $getcustomer."<option value='".$row->customer_id."' ".$selected[$row->customer_id].">".$row->first_name." " .$row->last_name."</option>";
		}
		return $getcustomer;
	}
	// Fetch Name By IDs
	// City Name
	function getCityNameByID($id)
	{

		$qry = "Select city_name from city where city_id='$id'";
		$result = $this->query($qry);
		$row = $this->fetch_object($result);
		return $row->city_name;
	}
	// Group Name
	function getGroupNameByID($id) {

		$qry = "Select group_name from groups where group_id='$id'";
		$result = $this->query($qry);
		$row = $this->fetch_object($result);
		return $row->group_name;
	}
	// Agent Name
	function getAgentNameByID($id) {

		$qry = "Select first_name,last_name from agent where agent_id='$id'";

		$result = $this->query($qry);
		$row = $this->fetch_object($result);
		return $row->first_name." ".$row->last_name;
	}
}
?>