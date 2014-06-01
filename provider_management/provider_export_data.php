<?php
session_start();
@mysql_connect('ambush2006.db.11283971.hostedresource.com', 'ambush2006', 'Velociter@1985') or die("Unable to connect to MySql Server");
	@mysql_select_db('ambush2006') or die("Unable to select database");
        
//        @mysql_connect('localhost','root','') or die("Unable to connect to MySql Server");
//		@mysql_select_db('ambush2006') or die("Unable to select database");
        
$res = mysql_query("SELECT * FROM providers");
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
header("Content-Disposition: attachment;filename=BIMA-POA Provider Data.xls");
header("Content-Transfer-Encoding: binary ");
xlsBOF();
//xlsWriteLabel(0,0,"S.No");
xlsWriteLabel(0,0,"provider_id");
xlsWriteLabel(0,1,"provider_name");
xlsWriteLabel(0,2,"address");
xlsWriteLabel(0,3,"provider_code");
xlsWriteLabel(0,4,"status");
$xlsRow = 1;
while($row = mysql_fetch_object($res)) {
	//xlsWriteNumber($xlsRow,0,$xlsRow);
	xlsWriteLabel($xlsRow,0,$row->provider_id);
	xlsWriteLabel($xlsRow,1,$row->provider_name);
	xlsWriteLabel($xlsRow,2,$row->address);
	xlsWriteLabel($xlsRow,3,$row->provider_code);
	xlsWriteLabel($xlsRow,4,$row->status);
	
	$xlsRow++;
}
xlsEOF();
?>