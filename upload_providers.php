<?php
ob_start();

/*$db = mysql_connect("ambush2006.db.11283971.hostedresource.com", "ambush2006", "Velociter@1985") or die("Could not connect.");
if(!$db)
	die("no db");
if(!mysql_select_db("ambush2006",$db))
	die("No database selected.");
*/
include_once './common_include_out.php';
$providerobj=new Providers();
$providerobj->connect();
//$db = mysql_connect("localhost", "root", "") or die("Could not connect.");
// if(!$db)
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
                $count = $providerobj->row_count('providers', "provider_code = '".$data[3]."'");
                if ($count == 0)
                {
                    //$selectQueryProviders = "SELECT * FROM `providers` WHERE `provider_code`='".$data[2]."'" ;
		//$resultProviders=mysql_query($selectQueryProviders) or die(mysql_error());
		//if (mysql_num_rows($resultProviders) == 0)
		
                    	$name = mysql_escape_string($data[1]);
			$import="INSERT into providers(provider_id,provider_name,address,provider_code,status) values('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]')";
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

