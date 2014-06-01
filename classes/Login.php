<?php
include_once 'Validations.php';
class Login extends Helper {

	private $db;
	public $error_message;

	function __construct() {
		include_once 'include/DB.php';
		$this->db = new DB();
		$this->db->connect();
	}
	function Login() {

		if (empty($_POST['user_email'])) {
			$this->HandleError("UserName is empty!");
			return false;
		}
		if (empty($_POST['password'])) {
			$this->HandleError("Password is empty!");
			return false;
		}

		$username = trim($_POST['user_email']);
		$password = trim($_POST['password']);

		if (!isset($_SESSION)) {
			session_start();
		}
		if (!$this->CheckLoginInDB($username, $password)) {
			return false;
		}

		$this->RedirectToURL("dashboard.php");
	}

	function CheckLoginInDB($username, $password) {
		$username = $this->SanitizeForSQL($username);
		$pwdmd5 = $this->SanitizeForSQL($password);
		$qry = "Select * from users where user_email='$username' and password='$pwdmd5' and status = '1'";
		$result = $this->db->query($qry);
		if (!$result || $this->db->num_rows($result) <= 0) {
			$this->HandleError("Error logging in. The username or password does not match");
			return false;
		}
		$row = mysql_fetch_assoc($result);
		$_SESSION['user_type'] = $row['user_type'];
		$_SESSION['user_id'] = $row['user_id'];
		return true;
	}

}