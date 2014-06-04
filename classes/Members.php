<?php
include_once 'Validations.php';
class Members extends Helper {

    private $db;
    public $error_message;

    function __construct() {
        include_once 'include/DB.php';
        $this->db = new DB();
        $this->db->connect();
    }

    function __destruct() {}

    function ActiveDeactive($policy_no, $current_status) {
        $updatedStatus = null;
        if ($current_status == 'Y') {
            $updatedStatus = 'T';
            $msg = 'Active Member data of policy no' . "\t" . $policy_no;
            $this->db->MemberLogData($policy_no, $msg);
        } else {
            $updatedStatus = 'Y';
            $msg1 = 'DeActive Member data of policy no' . "\t" . $policy_no;
            $this->db->MemberLogData($policy_no, $msg1);
        }
        $arrayStatus = Array();
        $arrayStatus['status'] = $this->SanitizeForSQL($updatedStatus);
        if (!$this->db->update('bimapoa_members', $arrayStatus, "policy_no = '" . $policy_no . "' AND relation = 'SELF'")) {
            $this->HandleDBError("Error Updating data to the table\nquery:$insert_query");
        }
        $this->RedirectToURL("pending_transaction_list.php");
    }

    //-------Main Operations ----------------------
    function RegisterMember() {
        if (!isset($_POST['submitted'])) {
            return false;
        }
        $formvars = array();
        if (!$this->ValidateMemberSubmission()) {
            return false;
        }
        $this->CollectMemberDataSubmission($formvars);
        if (!$this->SaveToDatabase($formvars)) {
            return false;
        }
        $this->RedirectToURL("manage_members.php");
    }

    function CollectMemberDataSubmission(&$formvars) {
        
        $formvars['scheme'] = $this->Sanitize("BIMAPOA");
        $formvars['policy_no'] = $this->Sanitize($_POST['policy_no']);
        $formvars['national_id'] = $this->Sanitize($_POST['national_id']);
        $formvars['phone'] = $this->Sanitize($_POST['phone']);
        $formvars['emergency_phone'] = $this->Sanitize($_POST['emergency_phone']);
        $formvars['membership_name'] = $this->Sanitize($_POST['membership_name']);
        $formvars['last_rec_num'] = $this->Sanitize($_POST['last_rec_num']);
        $formvars['dob'] = $this->Sanitize($_POST['dob']);
        list($m, $d, $y) = explode('/', $formvars['dob']);
        $formvars['dob1'] = $y . '-' . $m . '-' . $d;
        $formvars['sex'] = $this->Sanitize($_POST['sex']);
        $formvars['relation'] = $this->Sanitize($_POST['relation']);
        $formvars['area'] = $this->Sanitize($_POST['area']);
        $formvars['region'] = $this->Sanitize($_POST['region']);
        $formvars['location'] = $this->Sanitize($_POST['location']);
        $formvars['selected_provider_code'] = $this->Sanitize($_POST['selected_provider_code']);
        $formvars['chw_code'] = $this->Sanitize($_POST['chw_code']);
        $formvars['transaction_no'] = $this->Sanitize($_POST['transaction_no']);
        
        list($m, $d, $y) = explode('/', $_POST['transaction_date']);
        $formvars['date_signed'] = $y . '-' . $m . '-' . $d;
        
        list($m, $d, $y) = explode('/', $_POST['transaction_date']);
        $formvars['transaction_date'] = $y . '-' . $m . '-' . $d;

        list($m1, $d1, $y1) = explode('/', $_POST['transaction_date']);
        $formvars['date_tra_check'] = $y1 . '-' . $m1 . '-' . $d1;
        
         $qrychecktradate = mysql_query("select * from mpesa where mpesa_account='" .$_POST['national_id'] . "'  or mpesa_account='" .$_POST['policy_no'] . "' ORDER BY id ASC limit 0,1");
         $counttradate = mysql_num_rows($qrychecktradate);
         $fetchresultdate = mysql_fetch_array($qrychecktradate);
         $status = 'N';
        if($counttradate > 0)
        {
            if($formvars['date_tra_check'] == $fetchresultdate['mpesa_transaction_date'])
            {
                $formvars['date_signed'] = $formvars['transaction_date'];
                $neweffectdate = "";
                if ($d1 >= 20) {
                    $mod_date = strtotime($formvars['transaction_date'] . "+ 2 months");
                    $neweffectdate = date("Y-m", $mod_date) . "-1";
                } else if ($d1 <= 20) {
                    $mod_date = strtotime($formvars['transaction_date'] . "+ 1 months");
                    $neweffectdate = date("Y-m", $mod_date) . "-1";
                }
                $mod_date = strtotime($neweffectdate . "+ 364 days");
                $contractexpiredate = date("Y-m-d", $mod_date);

                $formvars['neweffectdate'] = $neweffectdate;
                $formvars['contractexpiredate'] = $contractexpiredate;

                $dateTime = date('Y-m-d');
                $formvars['date_captured'] = $dateTime;
                $status = 'Y';
                $this->MemberLogData("Transaction Date Insertion Is Wrong");
            }
            else
            {
                $formvars['date_signed'] = $fetchresultdate['mpesa_transaction_date'];
                $neweffectdate = "";
                if ($d1 > 20) {
                    $mod_date = strtotime($fetchresultdate['mpesa_transaction_date'] . "+ 2 months");
                    $neweffectdate = date("Y-m", $mod_date) . "-1";
                } else if ($d1 < 20) {
                    $mod_date = strtotime($fetchresultdate['mpesa_transaction_date'] . "+ 1 months");
                    $neweffectdate = date("Y-m", $mod_date) . "-1";
                }

                $mod_date = strtotime($neweffectdate . "+ 364 days");
                $contractexpiredate = date("Y-m-d", $mod_date);

                $formvars['neweffectdate'] = $neweffectdate;
                $formvars['contractexpiredate'] = $contractexpiredate;

                $dateTime = date('Y-m-d');
                $formvars['date_captured'] = $dateTime;
                $status = 'Y';
                $this->MemberLogData("Transaction Date Insertion Is Wright");
            }
        }  else {
            $formvars['date_signed'] = $formvars['transaction_date'];
                $neweffectdate = "";
                if ($d1 >= 20) {
                    $mod_date = strtotime($formvars['transaction_date'] . "+ 2 months");
                    $neweffectdate = date("Y-m", $mod_date) . "-1";
                } else if ($d1 <= 20) {
                    $mod_date = strtotime($formvars['transaction_date'] . "+ 1 months");
                    $neweffectdate = date("Y-m", $mod_date) . "-1";
                }

                $mod_date = strtotime($neweffectdate . "+ 364 days");
                $contractexpiredate = date("Y-m-d", $mod_date);

                $formvars['neweffectdate'] = $neweffectdate;
                $formvars['contractexpiredate'] = $contractexpiredate;

                $dateTime = date('Y-m-d');
                $formvars['date_captured'] = $dateTime;
                $status = 'Y';
                $this->MemberLogData("Transaction Date Insertion Is Wrong");
        }
        
        $dep = $_POST['dep_relation'];
        $formvars['date_captured'] = date('Y-m-d');
        $formvars['status'] = $status;
        $formvars['payment_type'] = $this->Sanitize($_POST['payment_type']);
        for ($h = 0; $h < count($dep); $h++) {
            $formvars['dep_mem_name'] = $this->Sanitize($_POST['dep_mem_name'][$h]);
            $formvars['dep_relation'] = $this->Sanitize($_POST['dep_relation'][$h]);
            $formvars['dep_image'] = $_FILES['dep_image']['name'][$h];
        }
    }

    function ValidateMemberSubmission(){
        
        if (!empty($_POST[$this->GetSpamTrapInputName()])) {
            $this->HandleError("Automated submission prevention: case 2 failed");
            return false;
        }
        $validator = new FormValidator();
        $validator->addValidation("policy_no", "req", "  Please Enter policy_no");
        $validator->addValidation("phone", "req", "  Please Enter Contact Details");
        $validator->addValidation("membership_name", "req", "  Please Enter Membership_name");
        $validator->addValidation("dob", "req", " Please Enter Dob");
        $validator->addValidation("sex", "req", " Please Enter Sex");
        $validator->addValidation("relation", "req", " Please Enter Relation");
        $validator->addValidation("national_id", "req", " Please Enter National_Id");
        $validator->addValidation("area", "req", "  Please Enter Area");
        $validator->addValidation("region", "req", "  Please Enter Region");
        $validator->addValidation("location", "req", "  Please Enter Location");
        $validator->addValidation("selected_provider_code", "req", " Please Enter Selected_provider_code");
        $validator->addValidation("chw_code", "req", "  Please Enter Chw_code");
        $validator->addValidation("payment_type", "req", "  Please Select Payment Type");

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

        $path = '../uploads/';

        $pathToThumbs = '../uploads/thumbs/';
        if ($_FILES['upload_file1']['size'] == 0) {
            $file_name1 = "";
        } else {
            $file_name1 = time() . $_FILES['upload_file1']['name'];
            move_uploaded_file($_FILES["upload_file1"]["tmp_name"], $path . $file_name1);
        }

        if ($_FILES['upload_file2']['size'] == 0) {
            $file_name2 = "";
        } else {
            $file_name2 = time() . $_FILES['upload_file2']['name'];
            move_uploaded_file($_FILES["upload_file2"]["tmp_name"], $path . $file_name2);
        }
        if ($_FILES['upload_file3']['size'] == 0) {
            $file_name3 = "";
        } else {
            $file_name3 = time() . $_FILES['upload_file3']['name'];
            move_uploaded_file($_FILES["upload_file3"]["tmp_name"], $path . $file_name3);
        }

        if ($_FILES['upload_image']['size'] == 0) {
            $upload_image = "";
        } else {
        $upload_image = time() . $_FILES['upload_image']['name'];
        $upload_tmp = $_FILES["upload_image"]["tmp_name"];
        $this->createThumbs($path, $pathToThumbs, 100, $upload_image, $upload_tmp);
        }
        
        $mysqlvars = array();
        $mysqlvars['scheme'] = $this->SanitizeForSQL($formvars['scheme']);
        $mysqlvars['policy_no'] = $this->SanitizeForSQL($formvars['policy_no']);
        $mysqlvars['phone'] = $this->SanitizeForSQL($formvars['phone']);
        $mysqlvars['emergency_phone'] = $this->SanitizeForSQL($formvars['emergency_phone']);
        $mysqlvars['contract_effective_date'] = $this->SanitizeForSQL($formvars['neweffectdate']);
        $mysqlvars['contract_expiry_date'] = $this->SanitizeForSQL($formvars['contractexpiredate']);
        $mysqlvars['membership_name'] = $this->SanitizeForSQL($formvars['membership_name']);
        $mysqlvars['dob'] = $this->SanitizeForSQL($formvars['dob1']);
        $mysqlvars['sex'] = $this->SanitizeForSQL($formvars['sex']);
        $mysqlvars['relation'] = $this->SanitizeForSQL($formvars['relation']);
        $mysqlvars['national_id'] = $this->SanitizeForSQL($formvars['national_id']);
        $mysqlvars['area'] = $this->SanitizeForSQL($formvars['area']);
        $mysqlvars['region'] = $this->SanitizeForSQL($formvars['region']);
        $mysqlvars['location'] = $this->SanitizeForSQL($formvars['location']);
        $mysqlvars['selected_provider_code'] = $this->SanitizeForSQL($formvars['selected_provider_code']);
        $mysqlvars['chw_code'] = $this->SanitizeForSQL($formvars['chw_code']);
        $mysqlvars['date_signed'] = $this->SanitizeForSQL($formvars['date_signed']);
        $mysqlvars['date_captured'] = $this->SanitizeForSQL($formvars['date_captured']);
        $mysqlvars['card_issued'] = 'N';
        $mysqlvars['terminated_date'] = '';
        $mysqlvarstra['transaction_date'] = $this->SanitizeForSQL($formvars['transaction_date']);
        $mysqlvarstra['transaction_no'] = $this->SanitizeForSQL($formvars['transaction_no']);
        $mysqlvars['payment_type'] = $this->SanitizeForSQL($formvars['payment_type']);
        $mysqlvars['upload_file'] = $this->SanitizeForSQL($upload_image);
        $mysqlvars['status'] = $this->SanitizeForSQL($formvars['status']);
        

        $payment = 0;
        if ($mysqlvars['payment_type'] == 'Monthly') {
            $payment = 800;
        } else if ($mysqlvars['payment_type'] == 'Two') {
            $payment = 4000;
        } else if ($mysqlvars['payment_type'] == 'Full') {
            $payment = 8000;
        }

        if (!$this->db->insert('bimapoa_members', $mysqlvars)) {
            $this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
            return false;
        }
        
         $msg = 'Insert data of policy no' . "\t" . $mysqlvars['policy_no'] . "\t";
         $this->db->MemberLogData($mysqlvars, $msg);

        $insertedId = $this->db->insert_id();
        $membership_prefix = "BP";
        $abc = $formvars['last_rec_num'];
        $membership_str = str_pad(($abc + 1), 6, '0', STR_PAD_LEFT);
        $membership_no = $membership_prefix . $membership_str . "A";
        $arrayMno = array();
        $arrayMno['membership_no'] = $membership_no;

        if (!$this->db->update("bimapoa_members", $arrayMno, "member_id = '" . $insertedId . "'")) {
            $this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
            return false;
        }

        $selectMpesa = "SELECT * FROM `mpesa` WHERE mpesa_code='" . $mysqlvarstra['transaction_no'] . "' AND `mpesa_transaction_date`='" . $mysqlvarstra['transaction_date'] . "'";
        $resultMpesa = $this->db->query($selectMpesa);
        $mpesacount = $this->db->num_rows($resultMpesa);

        if ($mpesacount == 0) {
            if ($mysqlvars['payment_type'] == 'Monthly') {
                $queryMonthlyInstallments = "INSERT into monthly_payment(policy_no,member_name,mpesa_transaction_code,mpesa_transaction_date,mpesa_transaction_amount) values('" . $mysqlvars['policy_no'] . "','A','" . $mysqlvarstra['transaction_no'] . "','" . $mysqlvarstra['transaction_date'] . "','" . $payment . "')";
                $resultMonthly = $this->db->query($queryMonthlyInstallments);
            } else if ($mysqlvars['payment_type'] == 'Two') {
                $queryTwoInstallments = "INSERT into two_time_payment(policy_no,member_name,mpesa_transaction_code,mpesa_transaction_date,mpesa_transaction_amount) values('" . $mysqlvars['policy_no'] . "','A','" . $mysqlvarstra['transaction_no'] . "','" . $mysqlvarstra['transaction_date'] . "','" . $payment . "')";
                $resultM = $this->db->query($queryTwoInstallments);
            } else if ($mysqlvars['payment_type'] == 'Full') {
                $queryTwelveInstallments = "INSERT into one_time_payment(policy_no,member_name,mpesa_transaction_code,mpesa_transaction_date,mpesa_transaction_amount) values('" . $mysqlvars['policy_no'] . "','A','" . $mysqlvarstra['transaction_no'] . "','" . $mysqlvarstra['transaction_date'] . "','" . $payment . "')";
                $resultMt = $this->db->query($queryTwelveInstallments);
            }
        }

        $docarray = array();
        $docarray['policy_no'] = $this->SanitizeForSQL($formvars['policy_no']);
        $docarray['membership_no'] = $this->SanitizeForSQL($membership_no);
        $docarray['document1'] = $this->SanitizeForSQL($file_name1);
        $docarray['document2'] = $this->SanitizeForSQL($file_name2);
        $docarray['document3'] = $this->SanitizeForSQL($file_name3);
        if (!$this->db->insert('documents', $docarray)) {
            $this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
            return false;
        }
        
        if (count($_POST['dep_mem_name']) > 0) {
            $i = 0;
            $ch = chr(67);
            $mysqlvarschild = array();
            foreach ($_POST['dep_mem_name'] as $key => $values):
                
                $mysqlvarschild['membership_name'] = $_POST['dep_mem_name'][$i];
                $mysqlvarschild['relation'] = $_POST['dep_relation'][$i];
                $mysqlvarschild['dob'] = $_POST['year'][$i] . "-" . $_POST['month'][$i] . "-" . $_POST['day'][$i];

                if ($_POST['dep_relation'][$i] == "Spouse") {
                    $ch = "B";
                }
                
                $mysqlvarschild['membership_no'] = strtoupper($membership_prefix . $membership_str . $ch);
                $mysqlvarschild['scheme'] = $this->SanitizeForSQL($formvars['scheme']);
                $mysqlvarschild['policy_no'] = $this->SanitizeForSQL($formvars['policy_no']);
                $mysqlvarschild['contract_effective_date'] = $mysqlvars['contract_effective_date'];
                $mysqlvarschild['contract_expiry_date'] = $mysqlvars['contract_expiry_date'];
                $mysqlvarschild['sex'] = '';
                $mysqlvarschild['date_signed'] = $mysqlvars['date_signed'];
                $mysqlvarschild['date_captured'] = $mysqlvars['date_captured'];
                $mysqlvarschild['status'] = $this->SanitizeForSQL($formvars['status']);
                $this->db->insert('bimapoa_members', $mysqlvarschild);
                
                $path = '../uploads/';
                $pathToThumbs = '../uploads/thumbs/';
                $dep_image_name = time() . $_FILES['dep_image']['name'][$i];

                $dep_image_name_tmp = $_FILES["dep_image"]["tmp_name"][$i];
                $this->createThumbs($path, $pathToThumbs, 100, $dep_image_name, $dep_image_name_tmp);

                move_uploaded_file($_FILES["dep_image"]["tmp_name"][$i], $path . $dep_image_name);
                $deparray = array();
                $deparray['policy_no'] = $this->SanitizeForSQL($mysqlvarschild['policy_no']);
                $deparray['membership_no'] = $this->SanitizeForSQL($mysqlvarschild['membership_no']);
                $deparray['image'] = $dep_image_name;
                $this->db->insert('dep_images', $deparray);

                $i++;
                $ch++;
            endforeach;
        }
        return true;
    }

    //--------------------update--------------------------------
    function UpdateMember() {
        if (!isset($_POST['updated'])) {
            return false;
        }

        $formvars = array();

        if (!$this->ValidateMemberUpdation()) {
            return false;
        }

        $this->CollectMemberDataUpdation($formvars);

        if (!$this->UpdateToDatabase($formvars)) {
            return false;
        }
        $this->RedirectToURL("manage_members.php");
    }

    function CollectMemberDataUpdation(&$formvars) {

        $formvars['member_id'] = $this->Sanitize($_POST['member_id']);
        $formvars['policy_no'] = $this->Sanitize($_POST['policy_no']);
        $formvars['phone'] = $this->Sanitize($_POST['phone']);
        $formvars['emergency_phone'] = $this->Sanitize($_POST['emergency_phone']);
        $formvars['membership_name'] = $this->Sanitize($_POST['membership_name']);
        $formvars['membership_no'] = $this->Sanitize($_POST['membership_no']);
        $formvars['dob'] = $this->Sanitize($_POST['dob']);
        list($m, $d, $y) = explode('/', $formvars['dob']);
        $formvars['dob1'] = $y . '-' . $m . '-' . $d;
        $formvars['sex'] = $this->Sanitize($_POST['sex']);
        $formvars['relation'] = $this->Sanitize($_POST['relation']);
        $formvars['national_id'] = $this->Sanitize($_POST['national_id']);
        $formvars['area'] = $this->Sanitize($_POST['area']);
        $formvars['region'] = $this->Sanitize($_POST['region']);
        $formvars['location'] = $this->Sanitize($_POST['location']);
        $formvars['selected_provider_code'] = $this->Sanitize($_POST['selected_provider_code']);
        $formvars['chw_code'] = $this->Sanitize($_POST['chw_code']);
        $formvars['date_signed'] = $this->Sanitize($_POST['transaction_date']);
        list($m, $d, $y) = explode('/', $_POST['transaction_date']);
        $formvars['date_signed'] = $y . '-' . $m . '-' . $d;
        $dateTime = date('Y-m-d');
        $formvars['date_captured'] = $dateTime;
        $dep = $_POST['dep_relation'];
        $formvars['payment_type'] = $this->Sanitize($_POST['payment_type']);
        for ($h = 0; $h < count($dep); $h++) {
            $formvars['dep_mem_name'] = $this->Sanitize($_POST['dep_mem_name'][$h]);
            $formvars['dep_relation'] = $this->Sanitize($_POST['dep_relation'][$h]);
            $formvars['dep_image'] = $_FILES['dep_image']['name'][$h];
            $formvars['dep_mem_no'] = $this->Sanitize($_POST['dep_relation'][$h]);
            $formvars['old_image'] = $this->Sanitize($_POST['old_image'][$h]);
        }
    }

    function ValidateMemberUpdation() {
        
        if (!empty($_POST[$this->GetSpamTrapInputName()])) {
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

    function UpdateToDatabase(&$formvars) {
        if (!$this->UpdateIntoDB($formvars)) {
            $this->HandleError("Inserting to Database failed!");
            return false;
        }
        return true;
    }

    function UpdateIntoDB(&$formvars) {

        $path = '../uploads/';

        $pathToThumbs = '../uploads/thumbs/';

        if ($_FILES['upload_file1']['size'] == 0) {
            $file_name1 = $_POST['old_file1'];
        } else {
            $file_name1 = time() . $_FILES['upload_file1']['name'];
            move_uploaded_file($_FILES["upload_file1"]["tmp_name"], $path . $file_name1);
        }
        if ($_FILES['upload_file2']['size'] == 0) {
            $file_name2 = $_POST['old_file2'];
        } else {
            $file_name2 = time() . $_FILES['upload_file2']['name'];
            move_uploaded_file($_FILES["upload_file2"]["tmp_name"], $path . $file_name2);
        }
        if ($_FILES['upload_file3']['size'] == 0) {
            $file_name3 = $_POST['old_file3'];
        } else {
            $file_name3 = time() . $_FILES['upload_file3']['name'];
            move_uploaded_file($_FILES["upload_file3"]["tmp_name"], $path . $file_name3);
        }
        if ($_FILES['upload_image']['size'] == 0) {
            $img_name = $_POST['old_image_self'];
        } else {
            $img_name = time() . $_FILES['upload_image']['name'];
            $img_name_tmp = $_FILES['upload_image']['tmp_name'];
            $this->createThumbs($path, $pathToThumbs, 100, $img_name, $img_name_tmp);
           
        }

        $qrycheckdoc = mysql_query("select * from documents where policy_no='" . $formvars['policy_no'] . "'");
        $countdoc = mysql_num_rows($qrycheckdoc);
        if ($countdoc < 1) {
            $docarray = array();
            $docarray['policy_no'] = $this->SanitizeForSQL($formvars['policy_no']);
            $docarray['membership_no'] = $this->SanitizeForSQL($membership_no);
            $docarray['document1'] = $this->SanitizeForSQL($file_name1);
            $docarray['document2'] = $this->SanitizeForSQL($file_name2);
            $docarray['document3'] = $this->SanitizeForSQL($file_name3);
            if (!$this->db->insert('documents', $docarray)) {
                $this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
                return false;
            }
        } else {
            $docarray = array();
            $docarray['document1'] = $this->SanitizeForSQL($file_name1);
            $docarray['document2'] = $this->SanitizeForSQL($file_name2);
            $docarray['document3'] = $this->SanitizeForSQL($file_name3);

            $this->db->update('documents', $docarray, 'membership_no = "' . $_POST['membership_no'] . '"');

            if (!$this->db->update('documents', $docarray, 'membership_no = "' . $_POST['membership_no'] . '"')) {
                $this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
                return false;
            }
        }
        
        $mysqlvars = array();
        $mysqlvars['policy_no'] = $this->SanitizeForSQL($formvars['policy_no']);
        $mysqlvars['national_id'] = $this->SanitizeForSQL($formvars['national_id']);
        $mysqlvars['phone'] = $this->SanitizeForSQL($formvars['phone']);
        $mysqlvars['emergency_phone'] = $this->SanitizeForSQL($formvars['emergency_phone']);
        $mysqlvars['membership_name'] = $this->SanitizeForSQL($formvars['membership_name']);
        $mysqlvars['membership_no'] = $this->SanitizeForSQL($formvars['membership_no']);
        $mysqlvars['dob'] = $this->SanitizeForSQL($formvars['dob1']);
        $mysqlvars['sex'] = $this->SanitizeForSQL($formvars['sex']);
        $mysqlvars['relation'] = $this->SanitizeForSQL($formvars['relation']);
        $mysqlvars['area'] = $this->SanitizeForSQL($formvars['area']);
        $mysqlvars['region'] = $this->SanitizeForSQL($formvars['region']);
        $mysqlvars['location'] = $this->SanitizeForSQL($formvars['location']);
        $mysqlvars['selected_provider_code'] = $this->SanitizeForSQL($formvars['selected_provider_code']);
        $mysqlvars['chw_code'] = $this->SanitizeForSQL($formvars['chw_code']);
        $mysqlvars['date_signed'] = $this->SanitizeForSQL($formvars['date_signed']);
        $mysqlvars['upload_file'] = $this->SanitizeForSQL($img_name);
        $mysqlvars['terminated_date'] = "";
        $mysqlvars['payment_type'] = $this->SanitizeForSQL($formvars['payment_type']);

        if (!$this->db->update("bimapoa_members", $mysqlvars, "member_id = '" . $formvars['member_id'] . "'")) {
            $this->HandleDBError("Error Updating data to the table\nquery:$insert_query");
            return false;
        }
        
        $msg = 'Update data of policy no' . "\t" . $mysqlvars['policy_no'] . "\t";
        $this->db->MemberLogData($mysqlvars, $msg);

        if (count($_POST['dep_mem_name']) > 0) {
            $i = 0;
            $ch = chr(67);
            $mysqlvarschild = array();
            foreach ($_POST['dep_mem_name'] as $key => $values):

                $mysqlvarschild['membership_name'] = $_POST['dep_mem_name'][$key];
                $mysqlvarschild['relation'] = $_POST['dep_relation'][$key];
                $mysqlvarschild['membership_no'] = $_POST['dep_mem_no'][$key];
                $mysqlvarschild['dob'] = $_POST['year'][$key] . "-" . $_POST['month'][$key] . "-" . $_POST['day'][$key];

                $this->db->update("bimapoa_members", $mysqlvarschild, "membership_no = '" . $mysqlvarschild['membership_no'] . "'");

                $path = '../uploads/';
                $pathToThumbs = '../uploads/thumbs/';
                $dep_image_name="";
                if ($_FILES['dep_image']['size'][$key] == 0) {
                    $dep_image_name = $_POST['old_image'][$key];
                } else {
                    $dep_image_name = time() . $_FILES['dep_image']['name'][$key];
                    $dep_image_name_tmp = $_FILES["dep_image"]["tmp_name"][$key];
                    $this->createThumbs($path, $pathToThumbs, 100, $dep_image_name, $dep_image_name_tmp);
                }

                if($mysqlvarschild['membership_no'] != ''){
                $qrycheckdep = mysql_query("select * from dep_images where membership_no='" . $mysqlvarschild['membership_no'] . "'");
                $countdep = mysql_num_rows($qrycheckdep);
                
                if ($countdep < 1) {
                    $deparray = array();
                    $deparray['policy_no'] = $this->SanitizeForSQL($mysqlvars['policy_no']);
                    $deparray['membership_no'] = $this->SanitizeForSQL($mysqlvarschild['membership_no']);
                    $deparray['image'] = $dep_image_name;
                    if (!$this->db->insert('dep_images', $deparray)) {
                        $this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
                        return false;
                    }
                } else {
                    $deparray = array();
                    $deparray['image'] = $dep_image_name;
                    $this->db->update('dep_images', $deparray, 'membership_no ="' . $mysqlvarschild['membership_no'] . '" ');
                }
                
                $i++;
                $ch++;
                }
            endforeach;
        }
       
        return true;
    }

    function getToday() {
        $dateTime = date('Y-m-d');
        return $dateTime;
    }

    function createThumbs($pathToImages, $pathToThumbs, $thumbWidth, $filename, $filetemp) {

        if (move_uploaded_file($filetemp, $pathToImages . $filename)) {
            if (file_exists($pathToImages . $filename)) {

                $info = pathinfo($pathToImages . $filename);

                if (strtolower($info['extension']) == 'jpg') {
                    
                    $img = imagecreatefromjpeg("{$pathToImages}{$filename}");
                    $width = imagesx($img);
                    $height = imagesy($img);
                    $new_width = $thumbWidth;
                    $new_height = floor($height * ( $thumbWidth / $width ));
                    $tmp_img = imagecreatetruecolor($new_width, $new_height);
                    imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                    imagejpeg($tmp_img, "{$pathToThumbs}{$filename}");
                    
                } else if (strtolower($info['extension']) == 'png') {
                    
                    $img = imagecreatefrompng("{$pathToImages}{$filename}");
                    $width = imagesx($img);
                    $height = imagesy($img);
                    $new_width = $thumbWidth;
                    $new_height = floor($height * ( $thumbWidth / $width ));
                    $tmp_img = imagecreatetruecolor($new_width, $new_height);
                    imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                    imagepng($tmp_img, "{$pathToThumbs}{$filename}");
                    
                } else if (strtolower($info['extension']) == 'gif') {
                    
                    $img = imagecreatefromgif("{$pathToImages}{$filename}");
                    $width = imagesx($img);
                    $height = imagesy($img);
                    $new_width = $thumbWidth;
                    $new_height = floor($height * ( $thumbWidth / $width ));
                    $tmp_img = imagecreatetruecolor($new_width, $new_height);
                    imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                    imagegif($tmp_img, "{$pathToThumbs}{$filename}");
                }
            }
            closedir($dir);
        }
    }

}

?>