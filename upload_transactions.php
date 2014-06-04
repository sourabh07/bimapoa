<?php
ob_start();
//$db = mysql_connect("localhost", "root", "") or die("Could not connect.");
//if (!$db)
//    die("no db");
//if (!mysql_select_db("ambush2006", $db))
//    die("No database selected.");
$db = mysql_connect("ambush2006.db.11283971.hostedresource.com", "ambush2006", "Velociter@1985") or die("Could not connect.");
if(!$db)
	die("no db");
if(!mysql_select_db("ambush2006",$db))
	die("No database selected.");
$fileName = $_FILES['data']['tmp_name'];
if (is_uploaded_file($_FILES['data']['tmp_name'])) {
    readfile($_FILES['data']['tmp_name']);
}

$handle = fopen($_FILES['data']['tmp_name'], "r");

while (($data = fgetcsv($handle, 50000, ","))) {
    
    $transactiondate = $data[4];
    $policy_number = $data[9];
    $mpesatransactioncode = $data[8];
    $description = mysql_real_escape_string($data[5]);
    
   $queryBimaPoaMembers = "Select * from bimapoa_members where relation='SELF' AND policy_no ='".$policy_number."' OR national_id ='".$policy_number."'";
   $resultMembers = mysql_query($queryBimaPoaMembers) or die(mysql_error());
    if (mysql_num_rows($resultMembers) > 0)
    {
        $fetchmemfortransaction = mysql_fetch_array($resultMembers);
        if($fetchmemfortransaction['date_signed'] == $transactiondate)
        {
          
        }
        else
        {
            list($y, $m, $d) = explode('-', $transactiondate);
            $date_signed = $transactiondate;
            $neweffectdate = "";
            if ($d > 20) {
                $mod_date = strtotime($transactiondate . "+ 2 months");
                $neweffectdate = date("Y-m", $mod_date) . "-1";
            } else if ($d < 20) {
                $mod_date = strtotime($transactiondate. "+ 1 months");
                $neweffectdate = date("Y-m", $mod_date) . "-1";
            }

            $mod_date = strtotime($neweffectdate . "+ 364 days");
            $contractexpiredate = date("Y-m-d", $mod_date);

            $formvarsneweffectdate = $neweffectdate;
            $formvarscontractexpiredate = $contractexpiredate;
            
            $val = mysql_query("update bimapoa_members set contract_effective_date='".$formvarsneweffectdate."' , contract_expiry_date='".$formvarscontractexpiredate."' , date_signed='".$date_signed."' where policy_no = '".$policy_number."' AND relation='SELF'");
                    
        }
    }

    $selectMpesa = "SELECT * FROM `mpesa` WHERE `mpesa_account`='" . $policy_number . "' AND `mpesa_code`='" . $mpesatransactioncode . "'";
    $resultMpesa = mysql_query($selectMpesa) or die(mysql_error());
    if (mysql_num_rows($resultMpesa) == 0) {
    	
        $needle = "/";
        if (strpos($data[4],$needle) == TRUE) {
            list($m, $d, $y) = explode('/', $data[4]);
            $transacton_date = $y . '-' . $m . '-' . $d;
        } else {
            $transacton_date = $data[4];
        }
    
        $import = "INSERT into mpesa(id,mpesa_timestamp,mpesa_text,mpesa_code,mpesa_account,mpesa_transaction_date,status)
		values('$data[0]','$transactiondate','$description','$mpesatransactioncode','$policy_number','$transactiondate','$data[17]')";
        $insertmpesa = mysql_query($import) or die(mysql_error());

        if($insertmpesa){
        $acnt = strtoupper($policy_number);
        if ($data[13] == '4000') {
            if (strpos($acnt, 'APN') !== false) {
                $selectMpesa = "SELECT * FROM `two_time_payment` WHERE `policy_no`='" . $policy_number . "' AND `mpesa_transaction_date`='" . $transactiondate . "'";
                $resultMpesa = mysql_query($selectMpesa) or die(mysql_error());
                if (mysql_num_rows($resultMpesa) == 0) {
                    $queryTwoInstallments = "INSERT into two_time_payment(policy_no,member_name,mpesa_transaction_code,mpesa_transaction_date,mpesa_transaction_amount) values('$policy_number','$data[6]','$mpesatransactioncode','$transactiondate','$data[13]')";
                    $resultM = mysql_query($queryTwoInstallments) or die(mysql_error());
                } else {
                    
                }
            } else {
                $queryTwoInstallments = "INSERT into two_time_payment(national_id,member_name,mpesa_transaction_code,mpesa_transaction_date,mpesa_transaction_amount) values('$policy_number','$data[6]','$mpesatransactioncode','$transactiondate','$data[13]')";
                $resultM = mysql_query($queryTwoInstallments) or die(mysql_error());
            }
        } elseif ($data[13] == '8000') {
            if (strpos($acnt, 'APN') !== false) {
                $selectMpesa = "SELECT * FROM `one_time_payment` WHERE `policy_no`='" . $policy_number. "' AND `mpesa_transaction_date`='" . $transactiondate . "'";
                $resultMpesa = mysql_query($selectMpesa) or die(mysql_error());
                if (mysql_num_rows($resultMpesa) == 0) {
                    $queryTwelveInstallments = "INSERT into one_time_payment(policy_no,member_name,mpesa_transaction_code,mpesa_transaction_date,mpesa_transaction_amount) values('$policy_number','$data[6]','$mpesatransactioncode','$transactiondate','$data[13]')";
                    $resultMt = mysql_query($queryTwelveInstallments) or die(mysql_error());
                } else {
                    
                }
            } else {
                $queryTwelveInstallments = "INSERT into one_time_payment(national_id,member_name,mpesa_transaction_code,mpesa_transaction_date,mpesa_transaction_amount) values('$policy_number','$data[6]','$mpesatransactioncode','$transactiondate','$data[13]')";
                $resultMt = mysql_query($queryTwelveInstallments) or die(mysql_error());
            }
        } elseif ($data[13] == '800') {
            if (strpos($acnt, 'APN') !== false) {
                $selectMpesa = "SELECT * FROM `monthly_payment` WHERE `policy_no`='" . $policy_number . "' AND `mpesa_transaction_date`='" .$transacton_date. "'";
                $resultMpesa = mysql_query($selectMpesa) or die(mysql_error());
                if (mysql_num_rows($resultMpesa) == 0) {
                    $queryMonthlyInstallments = "INSERT into monthly_payment(policy_no,member_name,mpesa_transaction_code,mpesa_transaction_date,mpesa_transaction_amount) values('$policy_number','$data[6]','$mpesatransactioncode','$transactiondate','$data[13]')";
                    $resultMonthly = mysql_query($queryMonthlyInstallments) or die(mysql_error());
                } else {
                    
                }
            } else {
                $queryMonthlyInstallments = "INSERT into monthly_payment(national_id,member_name,mpesa_transaction_code,mpesa_transaction_date,mpesa_transaction_amount) values('$policy_number','$data[6]','$mpesatransactioncode','$transactiondate','$data[13]')";
                $resultMonthly = mysql_query($queryMonthlyInstallments) or die(mysql_error());
            }
        } else {
            
        }
    } 
    }else {
        
    }
}
header("location: dashboard.php");

?>

