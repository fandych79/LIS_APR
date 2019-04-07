<?php
require ("../../lib/open_conAPPR.php");
require ("../../lib/formatError.php");
require ("../../requirepage/parameter.php");
require ("../../requirepage/security.php");

/*
BA1 = tanah dan bangunan - view table appraisal_tnb
RUK = Ruko - view table appraisal_tnb
KI2 = Kios - view table appraisal_tnb
TAN = Tanah - view table appraisal_lnd
V01 = Kendaraan - view table appraisal_vhc
*/
$os = array("BA1", "RUK", "KI2", "TAN", "V01");




$custnomid=str_replace("'","||",$_REQUEST['custnomid']);
$_collateral_id=str_replace("'","||",$_REQUEST['col_id']);
$_id=str_replace("'","||",$_REQUEST['id']);

$strsql = " 
                    delete from appraisal_photo where _collateral_id='".$_collateral_id."' and _id='".$_id."'
                    
                    ";
					
					
$stmt = sqlsrv_prepare( $conn, $strsql);
if(!$stmt)
{
	echo "Error in preparing statement.\n";
	die( print_r( sqlsrv_errors(), true));
	return false;
}
if(!sqlsrv_execute( $stmt))
{
	echo "Cannot insert table ". $strsql;
	die( print_r( sqlsrv_errors(), true));
	return false;
}	
sqlsrv_free_stmt( $stmt);



Header("Location:./apperik.php?custnomid=$custnomid&userwfid=$userwfid&userpermission=$userpermission&buttonaction=$buttonaction&userbranch=$userbranch&userregion=$userregion&userid=$userid&userpwd=$userpwd&col_id=".$_collateral_id);

?>