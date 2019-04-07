<?php
require_once("../../lib/class.sqlserver.php");
$db = new SQLSRV();
$db->connect();

$stat = $_REQUEST['stat'];
$code = $_REQUEST['code'];
$nama = $_REQUEST['nama'];
$ver = $_REQUEST['ver'];
$seq = $_REQUEST['seq'];
$target = $_REQUEST['target'];

if ($stat == "new") {
	$insert = "
	insert into tbl_se_program (program_code,program_name,program_version,program_group,program_urut,program_desc,program_helpdoc,program_flag,Program_active,program_create_userid,program_create_time,program_time,program_score,program_action)
	values
	('$code','$nama','$ver','RPT','$seq','$target','RPT','NCNNN','Y','admin',getdate(),'100','100','ICA')
	";
	echo $insert;
	$db->executeNonQuery($insert);
}
else {
	$update = "
	update tbl_se_program
	set
	program_name = '$nama',
	program_version = '$ver',
	program_urut = '$seq',
	program_desc = '$target'
	where
	program_code = '$code'
	";
	echo $update;
	$db->executeNonQuery($update);
}

header("location:add_report.php");

?>