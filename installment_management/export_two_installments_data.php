<?php
session_start();
@mysql_connect('ambush2006.db.11283971.hostedresource.com', 'ambush2006', 'Velociter@1985') or die("Unable to connect to MySql Server");
@mysql_select_db('ambush2006') or die("Unable to select database");
$res = mysql_query("SELECT * FROM two_time_payment");
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
header("Content-Disposition: attachment;filename=BIMA_POA Member Two Time Data.xls");
header("Content-Transfer-Encoding: binary ");
xlsBOF();
//xlsWriteLabel(0,0,"S.No");
xlsWriteLabel(0,0,"id");
xlsWriteLabel(0,1,"member_id");
xlsWriteLabel(0,2,"policy_no");
xlsWriteLabel(0,3,"national_id");
xlsWriteLabel(0,4,"member_name");
xlsWriteLabel(0,5,"mpesa_transaction_code");
xlsWriteLabel(0,6,"mpesa_transaction_date");
xlsWriteLabel(0,7,"mpesa_transaction_amount");
xlsWriteLabel(0,8,"mpesa_transaction_code_2");
xlsWriteLabel(0,9,"mpesa_transaction_date_2");
xlsWriteLabel(0,10,"mpesa_transaction_amount_2");
xlsWriteLabel(0,11,"status");
$xlsRow = 1;
while($row = mysql_fetch_object($res)) {
	//xlsWriteNumber($xlsRow,0,$xlsRow);
	xlsWriteLabel($xlsRow,0,$row->id);
	xlsWriteLabel($xlsRow,1,$row->member_id);
	xlsWriteLabel($xlsRow,2,$row->policy_no);
	xlsWriteLabel($xlsRow,3,$row->national_id);
	xlsWriteLabel($xlsRow,4,$row->member_name);
        xlsWriteLabel($xlsRow,5,$row->mpesa_transaction_code);
	xlsWriteLabel($xlsRow,6,$row->mpesa_transaction_date);
	xlsWriteLabel($xlsRow,7,$row->mpesa_transaction_amount);
        xlsWriteLabel($xlsRow,8,$row->mpesa_transaction_code_2);
        xlsWriteLabel($xlsRow,9,$row->mpesa_transaction_date_2);
        xlsWriteLabel($xlsRow,10,$row->mpesa_transaction_amount_2);
        xlsWriteLabel($xlsRow,11,$row->status);
        
        
	$xlsRow++;
}
xlsEOF();
?>