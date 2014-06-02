<?php

session_start();
@mysql_connect('ambush2006.db.11283971.hostedresource.com', 'ambush2006', 'Velociter@1985') or die("Unable to connect to MySql Server");
@mysql_select_db('ambush2006') or die("Unable to select database");
$res = mysql_query("SELECT * FROM bimapoa_members");

function xlsBOF() {
    echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
    return;
}

function xlsEOF() {
    echo pack("ss", 0x0A, 0x00);
    return;
}

function xlsWriteNumber($Row, $Col, $Value) {
    echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
    echo pack("d", $Value);
    return;
}

function xlsWriteLabel($Row, $Col, $Value) {
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
header("Content-Type: application/download");
;
header("Content-Disposition: attachment;filename=BIMA-POA Member Data.xls");
header("Content-Transfer-Encoding: binary ");
xlsBOF();
//xlsWriteLabel(0,0,"S.No");
xlsWriteLabel(0, 0, "member_id");
xlsWriteLabel(0, 1, "scheme");
xlsWriteLabel(0, 2, "policy_no");
xlsWriteLabel(0, 3, "contract_effective_date");
xlsWriteLabel(0, 4, "contract_expiry_date");
xlsWriteLabel(0, 5, "membership_no");
xlsWriteLabel(0, 6, "membership_name");
xlsWriteLabel(0, 7, "dob");
xlsWriteLabel(0, 8, "sex");
xlsWriteLabel(0, 9, "relation");
xlsWriteLabel(0, 10, "national_id");
xlsWriteLabel(0, 11, "area");
xlsWriteLabel(0, 12, "region");
xlsWriteLabel(0, 13, "location");
xlsWriteLabel(0, 14, "selected_provider_code");
xlsWriteLabel(0, 15, "chw_code");
xlsWriteLabel(0, 16, "date_signed");
xlsWriteLabel(0, 17, "date_captured");
xlsWriteLabel(0, 18, "card_issued");
xlsWriteLabel(0, 19, "status");
xlsWriteLabel(0, 20, "terminated_date");
xlsWriteLabel(0, 21, "payment_type");
$xlsRow = 1;
while ($row = mysql_fetch_object($res)) {

    if (is_numeric($row->area)) {
        $area_result = mysql_query("SELECT * FROM area where area_id = '" . $row->area . "'");
        $row_area = mysql_fetch_object($area_result);
        $area_name = $row_area->name;
    } else {
        $area_name = $row->area;
    }
    if (is_numeric($row->region)) {
        $region_result = mysql_query("SELECT * FROM region where region_id = '" . $row->region . "'");
        $row_region = mysql_fetch_object($region_result);
        $region_name = $row_region->region_name;
    } else {
        $region_name = $row->region;
    }
    if (is_numeric($row->location)) {
        $location_result = mysql_query("SELECT * FROM location where location_id = '" . $row->location . "'");
        $row_location = mysql_fetch_object($location_result);
        $location_name = $row_location->location_name;
    } else {
        $location_name = $row->location;
    }

    xlsWriteLabel($xlsRow, 0, $row->member_id);
    xlsWriteLabel($xlsRow, 1, $row->scheme);
    xlsWriteLabel($xlsRow, 2, $row->policy_no);
    xlsWriteLabel($xlsRow, 3, $row->contract_effective_date);
    xlsWriteLabel($xlsRow, 4, $row->contract_expiry_date);
    xlsWriteLabel($xlsRow, 5, $row->membership_no);
    xlsWriteLabel($xlsRow, 6, $row->membership_name);
    xlsWriteLabel($xlsRow, 7, $row->dob);
    xlsWriteLabel($xlsRow, 8, $row->sex);
    xlsWriteLabel($xlsRow, 9, $row->relation);
    xlsWriteLabel($xlsRow, 10, $row->national_id);
    xlsWriteLabel($xlsRow, 11, $area_name);
    xlsWriteLabel($xlsRow, 12, $region_name);
    xlsWriteLabel($xlsRow, 13, $location_name);
    xlsWriteLabel($xlsRow, 14, $row->selected_provider_code);
    xlsWriteLabel($xlsRow, 15, $row->chw_code);
    xlsWriteLabel($xlsRow, 16, $row->date_signed);
    xlsWriteLabel($xlsRow, 17, $row->date_captured);
    xlsWriteLabel($xlsRow, 18, $row->card_issued);
    xlsWriteLabel($xlsRow, 19, $row->status);
    xlsWriteLabel($xlsRow, 20, $row->terminated_date);
    xlsWriteLabel($xlsRow, 21, $row->payment_type);
    $xlsRow++;
}
xlsEOF();
?>