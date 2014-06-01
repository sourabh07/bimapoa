<?php
session_start();
@mysql_connect('ambush2006.db.11283971.hostedresource.com', 'ambush2006', 'Velociter@1985') or die("Unable to connect to MySql Server");
@mysql_select_db('ambush2006') or die("Unable to select database");
$query =mysql_query ("select * from bimapoa_members left outer join mpesa on mpesa.mpesa_account = bimapoa_members.policy_no where bimapoa_members.relation = 'SELF'");

function xlsBOF()
{
	echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
	return;
}
function xlsEOF()
{
	echo pack("ss", 0x0A, 0x00);
	return;
}
function xlsWriteNumber($Row, $Col, $Value)
{
	echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
	echo pack("d", $Value);
	return;
}
function xlsWriteLabel($Row, $Col, $Value )
{
	$L = strlen($Value);
	echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
	echo $Value;
	return;
}
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");;
header("Content-Disposition: attachment;filename=Pending Transcation Data.xls");
header("Content-Transfer-Encoding: binary ");
xlsBOF();


xlsWriteLabel(0,0,"newDateTermination");
xlsWriteLabel(0,1,"installmentsRemaining");
xlsWriteLabel(0,2,"policy_no");
xlsWriteLabel(0,3,"contract_effective_date");
xlsWriteLabel(0,4,"contract_expiry_date");
xlsWriteLabel(0,5,"date_signed");
xlsWriteLabel(0,6,"terminated_date");
xlsWriteLabel(0,7,"membership_no");
xlsWriteLabel(0,8,"membership_name");
xlsWriteLabel(0,9,"chw_code");
xlsWriteLabel(0,10,"mpesa_transaction_date");


$xlsRow = 1;

while($row = mysql_fetch_object($query)) {
    
$count = mysql_num_rows(mysql_query("select * from mpesa where mpesa_account = '".$row->mpesa_account."'"));

if ($row->mpesa_amount != 8000) {
        if (($row->mpesa_amount == 4000 && $count == 1) || ($row->mpesa_amount == 800 && $count != 12)) {
										
        if ($row->mpesa_amount == 4000) {
                
                $amountRemaining = 8000 - (4000 * ($count));
                $installmentsRemaining = 2 - $count;
        } elseif ($row->mpesa_amount == 800) {
                
                $amountRemaining = 9600 - (800 * ($count));
                $installmentsRemaining = 12 - $count;
        }
	xlsWriteLabel($xlsRow,0,$amountRemaining);
	xlsWriteLabel($xlsRow,1,$installmentsRemaining);
	xlsWriteLabel($xlsRow,2,$row->policy_no);
	xlsWriteLabel($xlsRow,3,$row->contract_effective_date);
	xlsWriteLabel($xlsRow,4,$row->contract_expiry_date);
        xlsWriteLabel($xlsRow,5,$row->date_signed);
	xlsWriteLabel($xlsRow,6,$row->terminated_date);
	xlsWriteLabel($xlsRow,7,$row->membership_no);
        xlsWriteLabel($xlsRow,8,$row->membership_name);
        xlsWriteLabel($xlsRow,9,$row->chw_code);
        xlsWriteLabel($xlsRow,10,$row->mpesa_transaction_date);

	$xlsRow++;
       }
}

}

xlsEOF();
?>