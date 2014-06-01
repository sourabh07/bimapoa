<?php
session_start();
@mysql_connect('ambush2006.db.11283971.hostedresource.com', 'ambush2006', 'Velociter@1985') or die("Unable to connect to MySql Server");
@mysql_select_db('ambush2006') or die("Unable to select database");
        
//@mysql_connect('localhost','root','') or die("Unable to connect to MySql Server");
//@mysql_select_db('ambush2006') or die("Unable to select database");
//return true;
                
                
$res = mysql_query("SELECT * FROM mpesa");
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
header("Content-Disposition: attachment;filename=BIMA-POA Mpesa Data.xls");
header("Content-Transfer-Encoding: binary ");
xlsBOF();
//xlsWriteLabel(0,0,"S.No");
xlsWriteLabel(0,0,"id");
xlsWriteLabel(0,1,"mpesa_timestamp");
xlsWriteLabel(0,2,"mpesa_code");
xlsWriteLabel(0,3,"mpesa_account");
xlsWriteLabel(0,4,"mpesa_transaction_date");
xlsWriteLabel(0,5,"mpesa_amount");
xlsWriteLabel(0,7,"status");
//xlsWriteLabel(0,8,"sex");
//xlsWriteLabel(0,9,"relation");
//xlsWriteLabel(0,10,"national_id");
//xlsWriteLabel(0,11,"area");
//xlsWriteLabel(0,12,"region");
//xlsWriteLabel(0,13,"location");
//xlsWriteLabel(0,14,"selected_provider_code");
//xlsWriteLabel(0,15,"chw_code");
//xlsWriteLabel(0,16,"date_signed");
//xlsWriteLabel(0,17,"date_captured");
//xlsWriteLabel(0,18,"card_issued");
//xlsWriteLabel(0,19,"status");
//xlsWriteLabel(0,20,"terminated_date");
//xlsWriteLabel(0,21,"payment_type");

$xlsRow = 1;
while($row = mysql_fetch_object($res)) {
	//xlsWriteNumber($xlsRow,0,$xlsRow);
	xlsWriteLabel($xlsRow,0,$row->id);
	xlsWriteLabel($xlsRow,1,$row->mpesa_timestamp);
	xlsWriteLabel($xlsRow,2,$row->mpesa_code);
	xlsWriteLabel($xlsRow,3,$row->mpesa_account);
	xlsWriteLabel($xlsRow,4,$row->mpesa_transaction_date);
	xlsWriteLabel($xlsRow,6,$row->mpesa_amount);
	xlsWriteLabel($xlsRow,7,$row->status);
//	xlsWriteLabel($xlsRow,8,$row->sex);
//	xlsWriteLabel($xlsRow,9,$row->relation);
//        xlsWriteLabel($xlsRow,10,$row->national_id);
//        xlsWriteLabel($xlsRow,11,$row->area);
//        xlsWriteLabel($xlsRow,12,$row->region);
//        xlsWriteLabel($xlsRow,13,$row->location);
//        xlsWriteLabel($xlsRow,14,$row->selected_provider_code);
//        xlsWriteLabel($xlsRow,15,$row->chw_code);
//        xlsWriteLabel($xlsRow,16,$row->date_signed);
//        xlsWriteLabel($xlsRow,17,$row->date_captured);
//        xlsWriteLabel($xlsRow,18,$row->card_issued);
//        xlsWriteLabel($xlsRow,19,$row->status);
//        xlsWriteLabel($xlsRow,20,$row->terminated_date);
//        xlsWriteLabel($xlsRow,21,$row->payment_type);
	
        $xlsRow++;
}
xlsEOF();
?>
