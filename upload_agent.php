<?php
ob_start();
include_once './common_include_out.php';
$memberobj = new Members();
$memberobj ->connect();
//$db = mysql_connect("ambush2006.db.11283971.hostedresource.com", "ambush2006", "Velociter@1985") or die("Could not connect.");
//if(!$db)
//	die("no db");
//if(!mysql_select_db("ambush2006",$db))
//	die("No database selected.");

// $db = mysql_connect("localhost", "root", "") or die("Could not connect.");
//if(!$db)
//	die("no db");
//if(!mysql_select_db("ambush2006",$db))
//	die("No database selected.");
if (isset($_POST['submit']))
{
	if (is_uploaded_file($_FILES['data']['tmp_name'])) {
		readfile($_FILES['data']['tmp_name']);
	}

	$handle = fopen($_FILES['data']['tmp_name'], "r");

	/* 	scheme,policy_no,contract_effective_date,contract_expiry_date,membership_no,membership_name,dob,sex,relation,national_id
	 ,area,region,location,selected_provider_code,chw_code,date_signed,date_captured,card_issued,status,terminated_date,payment_type
	*/

	while (($data = fgetcsv($handle, 10000, ",")))
	{
//	 $selectQueryAgent = "SELECT * FROM `agent` WHERE `agent_code`='".$data[3]."'";
//		$resultAgent=mysql_query($selectQueryAgent) or die(mysql_error());
//                
//                	$result_member_name = mysql_query("select * from agent where agent_code='".$resultAgent['agent_code']."'");
//		        $resultAgent = mysql_fetch_array($result_member_name);

            $count = $memberobj->row_count('agent', "agent_code = '".$data[3]."'");
			if ($count == 0)
		{
			$name = mysql_escape_string($data[1]);
			$import="INSERT into agent(agent_id,name,date_created,agent_code,
			phone,status) values('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]')";
			mysql_query($import) or die(mysql_error());
		}
		else
		{
                    
		}
												
		
	}

	ob_end_flush();
	fclose($handle);
	header("location: dashboard.php");

}else {
	header("location: dashboard.php");
}
?>

