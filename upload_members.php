<?php

ob_start();
include_once './common_include_out.php';
$providerobj = new Providers();
$providerobj->connect();
/* $db = mysql_connect("localhost", "root", "") or die("Could not connect.");
  if(!$db)
  die("no db");
  if(!mysql_select_db("bimapoa",$db))
  die("No database selected.");
 */if (isset($_POST['submit'])) {
    if (is_uploaded_file($_FILES['data']['tmp_name'])) {
        readfile($_FILES['data']['tmp_name']);
    }
    $handle = fopen($_FILES['data']['tmp_name'], "r");
    /* 	scheme,policy_no,contract_effective_date,contract_expiry_date,membership_no,membership_name,dob,sex,relation,national_id
      ,area,region,location,selected_provider_code,chw_code,date_signed,date_captured,card_issued,status,terminated_date,payment_type
     */

    while (($data = fgetcsv($handle, 10000, ","))) {
        $selectQueryMembers = "SELECT * FROM `bimapoa_members` WHERE `policy_no`='" . $data[2] . "' AND `membership_no`='" . $data[5] . "'";
        $resultMembers = mysql_query($selectQueryMembers) or die(mysql_error());
        if (mysql_num_rows($resultMembers) == 0) {
            $code_prefix = "BP";
            if ($data[5] == '' && $data[5] == null) {
                if ($data[9] == "SELF") {
                  //  $count = $providerobj->row_count('bimapoa_members', "relation = 'SELF'");
                    $count = mysql_query("SELECT * FROM bimapoa_members ORDER BY member_id DESC LIMIT 1");
                    $row_member = mysql_fetch_array($count);
                    $number1 = $row_member['membership_no'];
                    $number = preg_replace("/[^0-9]/", '', $number1);
                }
                $membership_str = str_pad(($number + 1), 6, '0', STR_PAD_LEFT);
                $temp_code = $code_prefix . $membership_str;
                if ($data[9] == "SELF") {
                    $ch = chr(67);
                    $membership_code = $temp_code . "A";
                } elseif ($data[9] == "Spouse") {
                    $membership_code = $temp_code . "B";
                } else {
                    $membership_code = $temp_code . $ch;
                    $ch++;
                }
                $name = mysql_escape_string($data[6]);
                $import = "INSERT into bimapoa_members(member_id,scheme,policy_no,contract_effective_date,
				contract_expiry_date,membership_no,membership_name,dob,sex,relation,national_id
				,area,region,location,selected_provider_code,chw_code,date_signed,
				date_captured,card_issued,status,terminated_date,payment_type,phone,emergency_phone,upload_file
				) values('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$membership_code','$name','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$data[13]','$data[14]','$data[15]','$data[16]','$data[17]','$data[18]','$data[19]','$data[20]','$data[21]','$data[22]','$data[23]','$data[24]')";

//                                $import="INSERT into bimapoa_members(member_id,scheme
//				) values('$data[0]','$data[1]')";


                mysql_query($import) or die(mysql_error());
            } else {
                $name = mysql_escape_string($data[6]);
                $import = "INSERT into bimapoa_members(member_id,scheme,policy_no,contract_effective_date,
				contract_expiry_date,membership_no,membership_name,dob,sex,relation,national_id
				,area,region,location,selected_provider_code,chw_code,date_signed,
				date_captured,card_issued,status,terminated_date,payment_type,phone,emergency_phone,upload_file
				) values('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$name','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$data[13]','$data[14]','$data[15]','$data[16]','$data[17]','$data[18]','$data[19]','$data[20]','$data[21],'$data[22]','$data[23]','$data[24]')";

//                              $import="INSERT into bimapoa_members(member_id,scheme
//				) values('$data[0]','$data[1]')";
                mysql_query($import) or die(mysql_error());
            }
        }
    }

    ob_end_flush();
    fclose($handle);
    header("location: dashboard.php");
} else {
    header("location: dashboard.php");
}
?>

