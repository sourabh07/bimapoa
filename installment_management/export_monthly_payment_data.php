<?php
session_start();
@mysql_connect('ambush2006.db.11283971.hostedresource.com', 'ambush2006', 'Velociter@1985') or die("Unable to connect to MySql Server");
@mysql_select_db('ambush2006') or die("Unable to select database");
$res = mysql_query("SELECT * FROM monthly_payment");
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
header("Content-Disposition: attachment;filename=BIMA_POA Member Monthly Payment Data.xls");
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
xlsWriteLabel(0,11,"mpesa_transaction_code_3");
xlsWriteLabel(0,12,"mpesa_transaction_date_3");
xlsWriteLabel(0,13,"mpesa_transaction_amount_3");
xlsWriteLabel(0,14,"mpesa_transaction_code_4");
xlsWriteLabel(0,15,"mpesa_transaction_date_4");
xlsWriteLabel(0,16,"mpesa_transaction_amount_4");
xlsWriteLabel(0,17,"mpesa_transaction_code_5");
xlsWriteLabel(0,18,"mpesa_transaction_date_5");
xlsWriteLabel(0,19,"mpesa_transaction_amount_5");
xlsWriteLabel(0,20,"mpesa_transaction_code_6");
xlsWriteLabel(0,21,"mpesa_transaction_date_6");
xlsWriteLabel(0,22,"mpesa_transaction_amount_6");
xlsWriteLabel(0,23,"mpesa_transaction_code_7");
xlsWriteLabel(0,24,"mpesa_transaction_date_7");
xlsWriteLabel(0,25,"mpesa_transaction_amount_7");
xlsWriteLabel(0,26,"mpesa_transaction_code_8");
xlsWriteLabel(0,27,"mpesa_transaction_date_8");
xlsWriteLabel(0,28,"mpesa_transaction_amount_8");
xlsWriteLabel(0,29,"mpesa_transaction_code_9");
xlsWriteLabel(0,30,"mpesa_transaction_date_9");
xlsWriteLabel(0,31,"mpesa_transaction_amount_9");
xlsWriteLabel(0,32,"mpesa_transaction_code_10");
xlsWriteLabel(0,33,"mpesa_transaction_date_10");
xlsWriteLabel(0,34,"mpesa_transaction_amount_10");
xlsWriteLabel(0,35,"mpesa_transaction_code_11");
xlsWriteLabel(0,36,"mpesa_transaction_date_11");
xlsWriteLabel(0,37,"mpesa_transaction_amount_11");
xlsWriteLabel(0,38,"mpesa_transaction_date_12");
xlsWriteLabel(0,39,"mpesa_transaction_code_12");
xlsWriteLabel(0,40,"mpesa_transaction_amount_12");
xlsWriteLabel(0,41,"status");
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
        xlsWriteLabel($xlsRow,11,$row->mpesa_transaction_code_3);
        xlsWriteLabel($xlsRow,12,$row->mpesa_transaction_date_3);
        xlsWriteLabel($xlsRow,13,$row->mpesa_transaction_amount_3);
        xlsWriteLabel($xlsRow,14,$row->mpesa_transaction_code_4);
        xlsWriteLabel($xlsRow,15,$row->mpesa_transaction_date_4);
        xlsWriteLabel($xlsRow,16,$row->mpesa_transaction_amount_4);
        xlsWriteLabel($xlsRow,17,$row->mpesa_transaction_code_5);
        xlsWriteLabel($xlsRow,18,$row->mpesa_transaction_date_5);
        xlsWriteLabel($xlsRow,19,$row->mpesa_transaction_amount_5);
        xlsWriteLabel($xlsRow,20,$row->mpesa_transaction_code_6);
        xlsWriteLabel($xlsRow,21,$row->mpesa_transaction_date_6);
        xlsWriteLabel($xlsRow,22,$row->mpesa_transaction_amount_6);
        xlsWriteLabel($xlsRow,23,$row->mpesa_transaction_code_7);
        xlsWriteLabel($xlsRow,24,$row->mpesa_transaction_date_7);
        xlsWriteLabel($xlsRow,25,$row->mpesa_transaction_amount_7);
        xlsWriteLabel($xlsRow,26,$row->mpesa_transaction_code_8);
        xlsWriteLabel($xlsRow,27,$row->mpesa_transaction_date_8);
        xlsWriteLabel($xlsRow,28,$row->mpesa_transaction_amount_8);
        xlsWriteLabel($xlsRow,29,$row->mpesa_transaction_code_9);
        xlsWriteLabel($xlsRow,30,$row->mpesa_transaction_date_9);
        xlsWriteLabel($xlsRow,31,$row->mpesa_transaction_amount_9);
        xlsWriteLabel($xlsRow,32,$row->mpesa_transaction_code_10);
        xlsWriteLabel($xlsRow,33,$row->mpesa_transaction_date_10);
        xlsWriteLabel($xlsRow,34,$row->mpesa_transaction_amount_10);
        xlsWriteLabel($xlsRow,35,$row->mpesa_transaction_code_11);
        xlsWriteLabel($xlsRow,36,$row->mpesa_transaction_date_11);
        xlsWriteLabel($xlsRow,37,$row->mpesa_transaction_amoune_11);
        xlsWriteLabel($xlsRow,38,$row->mpesa_transaction_code_12);
        xlsWriteLabel($xlsRow,39,$row->mpesa_transaction_date_12);
        xlsWriteLabel($xlsRow,40,$row->mpesa_transaction_amount_12);
        xlsWriteLabel($xlsRow,41,$row->status);
        
        
	$xlsRow++;
}
xlsEOF();
?>