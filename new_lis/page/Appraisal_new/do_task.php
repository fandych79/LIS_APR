<?php
require ("../../lib/open_con.php");
require ("../../lib/sqlserverAPR.php");
require ("../../requirepage/parameter.php");


$SQL = new MYSQL();
$SQL->connect();
$debug = false;

$_custnomid = $_REQUEST['_custnomid'];
$arrsplit=explode("~",$_REQUEST['_officer']);
$_officer = $arrsplit[0];
$_branch_code = $arrsplit[1];
$_region_code = $arrsplit[2];
$_custname = "";
$_custaddress = "";

$strsqlv01="SELECT _cust_name, _cust_addr FROM appraisal_custmaster WHERE _custnomid = '$_custnomid'";
$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
if(sqlsrv_has_rows($sqlconv01))
{
	if($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_NUMERIC))
	{
		$_custname = $rowsv01[0];
		$_custaddress = $rowsv01[1];
	}
}

/*

//insert ke tbl_appraisal_custmaster dari select Tbl_CustomerMasterPerson; Irfan

$strsqlv01="select * from Tbl_Cust_MasterCol where ap_lisregno = '$_custnomid' and group_col = 'N' and flaginsert = '1' and flagdelete = '0'";
//echo $strsqlv01;
$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
if(sqlsrv_has_rows($sqlconv01))
{
    $tsql = "delete from Tbl_Cust_MasterCol where ap_lisregno ='$_custnomid'";
    $SQL->executeNonQuery($tsql);
	while($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
	{
		$col_id = $rowsv01['col_id'];
		$group_col = $rowsv01['group_col'];
		$cust_jeniscol = $rowsv01['cust_jeniscol'];
		$currency_col = $rowsv01['currency_col'];
		$nilai_col = $rowsv01['nilai_col'];
		$flaginsert = $rowsv01['flaginsert'];
		$flagdelete = $rowsv01['flagdelete'];
		
		$tsql = "INSERT INTO Tbl_Cust_MasterCol (ap_lisregno,col_id,group_col,cust_jeniscol,currency_col, nilai_col, flaginsert, flagdelete, inserttime) VALUES ('$_custnomid','$col_id','$group_col','$cust_jeniscol','$currency_col', '$nilai_col', '$flaginsert', '$flagdelete', getdate())";
		$SQL->executeNonQuery($tsql);
	}
}
*/

$tsql = "
delete from Tbl_FSTART where txn_id='$_custnomid'
insert into Tbl_FSTART values('$_custnomid','A',GETDATE(),'$_officer','','','$_branch_code','$_region_code')
delete from appraisal_task where _custnomid ='$_custnomid'
INSERT INTO appraisal_task (_custnomid,_custname,_custaddress,_officercode,_flag) VALUES ('$_custnomid','$_custname','$_custaddress','$_officer','0')
delete from Tbl_Information_Head  where custnomid ='$_custnomid'
INSERT INTO Tbl_Information_Head VALUES ('$_custnomid','$_custname','$userbranch')
UPDATE appraisal_custmaster set _cust_appraiser_id='$_officer' where _custnomid ='$_custnomid'
UPDATE appraisal_request set _flag='Y' where _custnomid ='$_custnomid'";
$SQL->executeNonQuery($tsql);



require ("../../requirepage/do_saveflow.php");	

header("location:../flow.php?userid=$userid&userpwd=$userpwd&userbranch=$userbranch&userregion=$userregion&userwfid=$userwfid");
?>