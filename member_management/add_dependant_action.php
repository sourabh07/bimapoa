<?php
include '../common_include_in.php';
$obj = new Members();
$appandchar = array(2 => 'C', 3 => 'D', 4 => 'E', 5 => 'F', 6 => 'G', 7 => 'H', 8 => 'I');

$appandcharspouse = array(3 => 'C', 4 => 'D', 5 => 'E', 6 => 'F', 7 => 'G', 8 => 'H', 9 => 'I');

$count = mysql_num_rows(mysql_query("select * from bimapoa_members where policy_no='" . $_POST['policy_no'] . "'"));

if (isset($_POST['dep_mem_name'])) {
    foreach ($_POST['dep_mem_name'] as $key => $value) {
        if ($_POST['dep_relation'][$key] == 'Spouse' && !empty($_POST['dep_mem_name'][$key])) {
            
            $result = mysql_query("select * from bimapoa_members where policy_no='" . $_POST['policy_no'] . "' AND relation = 'SELF'");
            $row = mysql_fetch_array($result);
            
            $resultspouse = mysql_query("select * from bimapoa_members where policy_no='" . $_POST['policy_no'] . "' AND relation = 'Spouse'");
            $countspouse = mysql_num_rows($resultspouse);
            
            $alpha = "B";
            
            if($countspouse == 0)
            {
                $alpha = "B";
            }
            else if($countspouse == 1)
            {
                $alpha = "Z";
            }
            else if($countspouse == 2)
            {
                $alpha = "Y";
            }
            
            $insertid = $row['membership_no'];
            $number1 = $insertid;
            $number = preg_replace("/[^0-9]/", '', $number1);
            $membership_prefix = "BP";
            
            $membership_no = $membership_prefix . $number . $alpha;
            $path = '../uploads/';
            $path2 = '../uploads/thumb_image/';
            $image_name1 = time() . $_FILES['dep_image']['name'];
//            move_uploaded_file($_FILES["dep_image"]["tmp_name"], $path . $image_name1);

            $image_name2 = time() . $_FILES['dep_image']['name'];
            $obj->createThumbs($path, $path2, 100, $image_name2, $_FILES["dep_image"]["tmp_name"]);
           
            $dep_array = array();
            $dep_array['scheme'] = $row['scheme'];
            $dep_array['policy_no'] = $row['policy_no'];
            $dep_array['phone'] = $row['phone'];
            $dep_array['emergency_phone'] = $row['emergency_phone'];
            $dep_array['contract_effective_date'] = $row['contract_effective_date'];
            $dep_array['contract_expiry_date'] = $row['contract_expiry_date'];
            $dep_array['membership_no'] = $membership_no;
            $dep_array['membership_name'] = $_POST['dep_mem_name'][$key];
            list($m, $d, $y) = explode('/', $_POST['dep_dob'][$key]);
            $dob1 = $y . '-' . $m . '-' . $d;
            $dep_array['dob'] = $dob1;
            //$dep_array['sex'] = $row['sex'];
            $dep_array['relation'] = $_POST['dep_relation'][$key];
            $dep_array['national_id'] = $row['national_id'];
            $dep_array['area'] = $row['area'];
            $dep_array['region'] = $row['region'];
            $dep_array['location'] = $row['location'];
            $dep_array['selected_provider_code'] = $row['selected_provider_code'];
            $dep_array['chw_code'] = $row['chw_code'];
            $dep_array['date_signed'] = $row['date_signed'];
            $dep_array['date_captured'] = $row['date_captured'];
            $dep_array['card_issued'] = $row['card_issued'];
            $dep_array['upload_file'] = $image_name1;
            $dep_array['terminated_date'] = $row['terminated_date'];
            $dep_array['payment_type'] = $row['payment_type'];
            
            $obj->insert('bimapoa_members', $dep_array);
            $dep_array_child = array();
            $dep_array_child['membership_no'] = $row['membership_no'];
            $dep_array_child['policy_no'] = $row['policy_no'];
            $dep_array_child['upload_file'] = $image_name1;
            $obj->insert('dep_images', $dep_array_child);

            $msg = 'Dependant added of policy no' . "\t" . "\t" . $dep_array_child['policy_no'] . "\t";
            $this->db->MemberLogData($dep_array, $msg);
        } else if (!empty($_POST['dep_mem_name'][$key])) {

            $result = mysql_query("select * from bimapoa_members where policy_no='" . $_POST['policy_no'] . "' AND relation = 'SELF'");
            $row = mysql_fetch_array($result);

            $resultspouse = mysql_query("select * from bimapoa_members where policy_no='" . $_POST['policy_no'] . "' AND relation = 'Spouse'");
            $rowspouse = mysql_fetch_array($result);
            $countspouse = mysql_num_rows($resultspouse);
            
            $insertid = mysql_query("SELECT * FROM bimapoa_members where policy_no='" . $_POST['policy_no'] . "'");
            $countall = mysql_num_rows($insertid);

            $row_member = mysql_fetch_array($insertid);
            $number1 = $row_member['membership_no'];
            $number = preg_replace("/[^0-9]/", '', $number1);
            
            $charcount = $countall + 1;
            
            if($countspouse>0)
            {
                $membership_no = 'BP' . $number . $appandcharspouse[$charcount];
            }
            else
            {
                $membership_no = 'BP' . $number . $appandchar[$charcount];
            }
            
            $image_name1 = time() . $_FILES['dep_image'][$key]['name'];
            $path = '../uploads/';
            $path2 = '../uploads/thumb_image/';
            $image_name2 = time() . $_FILES['dep_image']['name'];
            $obj->createThumbs($path, $path2, 100, $image_name1, $_FILES["dep_image"][$key]["tmp_name"]);
            
            $dep_array = array();
            $dep_array['scheme'] = $row['scheme'];
            $dep_array['policy_no'] = $row['policy_no'];
            $dep_array['phone'] = $row['phone'];
            $dep_array['emergency_phone'] = $row['emergency_phone'];
            $dep_array['contract_effective_date'] = $row['contract_effective_date'];
            $dep_array['contract_expiry_date'] = $row['contract_expiry_date'];
            $dep_array['membership_no'] = $membership_no;
            $dep_array['membership_name'] = $_POST['dep_mem_name'][$key];
            list($m, $d, $y) = explode('/', $_POST['dep_dob'][$key]);
            $dob1 = $y . '-' . $m . '-' . $d;
            $dep_array['dob'] = $dob1;
            //$dep_array['sex'] = $row['sex'];
            $dep_array['relation'] = $_POST['dep_relation'][$key];
            $dep_array['national_id'] = $row['national_id'];
            $dep_array['area'] = $row['area'];
            $dep_array['region'] = $row['region'];
            $dep_array['location'] = $row['location'];
            $dep_array['selected_provider_code'] = $row['selected_provider_code'];
            $dep_array['chw_code'] = $row['chw_code'];
            $dep_array['date_signed'] = $row['date_signed'];
            $dep_array['date_captured'] = $row['date_captured'];
            $dep_array['card_issued'] = $row['card_issued'];
            $dep_array['upload_file'] = $image_name1;
            $dep_array['terminated_date'] = $row['terminated_date'];
            
            $dep_array['payment_type'] = $row['payment_type'];
            
            $obj->insert('bimapoa_members', $dep_array);
            $msg = 'Depedent Added data of policy no' . "\t" . $dep_array['policy_no'] . "\t";
            $this->db->MemberLogData($dep_array, $msg);

            $dep_array_child = array();
            $dep_array_child['membership_no'] = $membership_no;
            $dep_array_child['policy_no'] = $row['policy_no'];
            $dep_array_child['upload_file'] = $image_name;
            $obj->insert('dep_images', $dep_array_child);

            $msg = 'Depedent Added data of policy no' . "\t" . $dep_array_child['policy_no'] . "\t";
            $this->db->MemberLogData($dep_array, $msg);
        }
    }
}
header("Location:manage_members.php");
?>
