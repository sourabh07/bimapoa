<?php

ob_start();
$db = mysql_connect("ambush2006.db.11283971.hostedresource.com", "ambush2006", "Velociter@1985") or die("Could not connect.");
if (!$db)
    die("no db");
if (!mysql_select_db("ambush2006", $db))
    die("No database selected.");

//print_r($_FILES);
/* if (isset($_POST['submit']))
  { */
$fileName = $_FILES['data']['tmp_name'];
if (is_uploaded_file($_FILES['data']['tmp_name'])) {
    readfile($_FILES['data']['tmp_name']);
}
$handle = fopen($_FILES['data']['tmp_name'], "r");

/* IPN_Id-0,mpesa_originator-1,mpesa_destination-2,mpesa_timestamp-3,mpesa_text-4,mpesa_user-5,-mpesa_password,mpesa_code,mpesa_account,mpesa_msisdn,mpesa_transaction_date,mpesa_transaction_time,mpesa_amount,mpesa_sender,date_record_created,processed,status */

while (($data = fgetcsv($handle, 50000, ","))) {
    //$id = $data[0];
    /* policy_no,member_name,mpesa_transaction_code_1,mpesa_transaction_date_1,mpesa_transaction_amount_1,mpesa_transaction_code_2,mpesa_transaction_date_2,mpesa_transaction_amount_2) values('$accnt','$user','$code','$xdate','$amnt' */
    $des = mysql_escape_string($data['5']);
    //$queryBimaPoaMembers = "Select * from bimapoa_members where policy_no ='".$data[9]."'OR national_id ='".$data[9]."' ";
    //$resultMembers = mysql_query($queryBimaPoaMembers) or die(mysql_error());
    //if (mysql_num_rows($resultMembers) != 0)
    //{
    echo $selectMpesa = "SELECT * FROM `mpesa` WHERE `mpesa_account`='" . $data[9] . "' AND `mpesa_code`='" . $data[8] . "' AND `mpesa_transaction_date`='" . $transacton_date . "'";
    $resultMpesa = mysql_query($selectMpesa) or die(mysql_error());
    if (mysql_num_rows($resultMpesa) == 0) {
    	
        $needle = "/";
        if (strpos($data[4],$needle) == TRUE) {
            list($m, $d, $y) = explode('/', $data[4]);
            $transacton_date = $y . '-' . $m . '-' . $d;
        } else {
            $transacton_date = $data[4];
        }
    

        $import = "INSERT into mpesa(id,IPN_Id,mpesa_originator,mpesa_destination,mpesa_timestamp,mpesa_text,mpesa_user,mpesa_password,mpesa_code,mpesa_account,mpesa_msisdn,mpesa_transaction_date,mpesa_transaction_time,mpesa_amount,mpesa_sender,date_record_created,processed,status)
		values('$data[0]','$data[1]','$data[2]','$data[3]','$transacton_date','$des','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$transacton_date','$data[12]','$data[13]','$data[14]','$data[15]','$data[16]','$data[17]')";
        mysql_query($import) or die(mysql_error());

        $acnt = strtoupper($data[9]);
        if ($data[13] == '4000' && $transacton_date == '') {
            if (strpos($acnt, 'APN') !== false) {
                $selectMpesa = "SELECT * FROM `two_time_payment` WHERE `policy_no`='" . $data[2] . "' AND `mpesa_transaction_date`='" . $transacton_date . "'";
                $resultMpesa = mysql_query($selectMpesa) or die(mysql_error());
                if (mysql_num_rows($resultMpesa) == 0) {
                    $queryTwoInstallments = "INSERT into two_time_payment(policy_no,member_name,mpesa_transaction_code,mpesa_transaction_date,mpesa_transaction_amount) values('$data[9]','$data[6]','$data[8]','$transacton_date','$data[13]')";
                    $resultM = mysql_query($queryTwoInstallments) or die(mysql_error());
                } else {
                    
                }
            } else {
                $queryTwoInstallments = "INSERT into two_time_payment(national_id,member_name,mpesa_transaction_code,mpesa_transaction_date,mpesa_transaction_amount) values('$data[9]','$data[6]','$data[8]','$transacton_date','$data[13]')";
                $resultM = mysql_query($queryTwoInstallments) or die(mysql_error());
            }
        } elseif ($data[13] == '8000' && $transacton_date == '') {
            if (strpos($acnt, 'APN') !== false) {
                $selectMpesa = "SELECT * FROM `one_time_payment` WHERE `policy_no`='" . $data[2] . "' AND `mpesa_transaction_date`='" . $transacton_date . "'";
                $resultMpesa = mysql_query($selectMpesa) or die(mysql_error());
                if (mysql_num_rows($resultMpesa) == 0) {
                    $queryTwelveInstallments = "INSERT into one_time_payment(policy_no,member_name,mpesa_transaction_code,mpesa_transaction_date,mpesa_transaction_amount) values('$data[9]','$data[6]','$data[8]','$transacton_date','$data[13]')";
                    $resultMt = mysql_query($queryTwelveInstallments) or die(mysql_error());
                } else {
                    
                }
            } else {
                $queryTwelveInstallments = "INSERT into one_time_payment(national_id,member_name,mpesa_transaction_code,mpesa_transaction_date,mpesa_transaction_amount) values('$data[9]','$data[6]','$data[8]','$transacton_date','$data[13]')";
                $resultMt = mysql_query($queryTwelveInstallments) or die(mysql_error());
            }
        } elseif ($data[13] == '800' && $transacton_date == '') {
            if (strpos($acnt, 'APN') !== false) {
                $selectMpesa = "SELECT * FROM `monthly_payment` WHERE `policy_no`='" . $data[2] . "' AND `mpesa_transaction_date`='" .$transacton_date. "'";
                $resultMpesa = mysql_query($selectMpesa) or die(mysql_error());
                if (mysql_num_rows($resultMpesa) == 0) {
                    $queryMonthlyInstallments = "INSERT into monthly_payment(policy_no,member_name,mpesa_transaction_code,mpesa_transaction_date,mpesa_transaction_amount) values('$data[9]','$data[6]','$data[8]','$transacton_date','$data[13]')";
                    $resultMonthly = mysql_query($queryMonthlyInstallments) or die(mysql_error());
                } else {
                    
                }
            } else {
                $queryMonthlyInstallments = "INSERT into monthly_payment(national_id,member_name,mpesa_transaction_code,mpesa_transaction_date,mpesa_transaction_amount) values('$data[9]','$data[6]','$data[8]','$transacton_date','$data[13]')";
                $resultMonthly = mysql_query($queryMonthlyInstallments) or die(mysql_error());
            }
        } else {
            
        }
    } else {
        
    }
}
header("location: dashboard.php");
/* }else {
  header("location: manage_members.php");
  } */
?>

