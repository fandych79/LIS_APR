<?php
require("../lib/class.sqlserver.php");
$newSQLSRV = new SQLSRV();
$newSQLSRV->connect();

$in_back = $_REQUEST['in_back'];
$in_reason = $_REQUEST['in_reason'];

//echo $in_back;
//echo $in_reason;

require_once("parameter.php");

$tsql = "select * from tbl_back_to where back_code = '$in_back'";
$newSQLSRV->executeQuery($tsql);
$arrBackto = $newSQLSRV->lastResults;

echo "<pre>";
//print_r($arrBackto);
echo "</pre>";

$target_flow = $arrBackto[0]['back_target'];
$back_description = $arrBackto[0]['description'];


$tsql = "select * from Tbl_CustomerMasterPerson2 cmp left join Tbl_FSTART fs on cmp.custnomid = fs.txn_id where cmp.custnomid = '$custnomid'";
$newSQLSRV->executeQuery($tsql);
$arrInfoApps = $newSQLSRV->lastResults;

$original_user = $arrInfoApps[0]['txn_user_id'];


$tsql = "select * from Tbl_Workflow ORDER BY wf_urut DESC";
$newSQLSRV->executeQuery($tsql);
$arrWorkflow = $newSQLSRV->lastResults;

if($target_flow == "")
{
	echo "ONLY NOTIFICATION<br><br>";
	$tsql = "insert into tbl_notification (custnomid,note_wfid,note_userid,note_tanggal,note_status,note_description,note_flag) values ('$custnomid','NOTE','$original_user',getdate(),'$back_description','$in_reason','N')";
	//echo $tsql."<br>";
	$newSQLSRV->executeNonQuery($tsql);
	
}
else
{
	echo "FLOW<br><br>";
	$tsql = "insert into tbl_notification (custnomid,note_wfid,note_userid,note_tanggal,note_status,note_description,note_flag) values ('$custnomid','$target_flow','$original_user',getdate(),'$back_description','$in_reason','N')";
	//echo $tsql."<br>";
	$newSQLSRV->executeNonQuery($tsql);
	
	for($i=0;$i<count($arrWorkflow);$i++)
	{
		//echo $arrWorkflow[$i]['wf_id'];
		//echo "<br>";
		
		$delete_flow = $arrWorkflow[$i]['wf_id'];
		
		$tsql = "delete from tbl_F$delete_flow where txn_id = '$custnomid'";
		//echo $tsql."<br>";
		$newSQLSRV->executeNonQuery($tsql);
		
		if($arrWorkflow[$i]['wf_id']== $target_flow)
		{
			break;
		}
		
	}
	
	
	
}

header("location:../page/flow.php?userwfid=$userwfid&userbranch=$userbranch&userregion=$userregion&userid=$userid&userpwd=$userpwd");
?>