<?
require("../../lib/class.sqlserverAPR.php");
$db = new SQLSRV();
$db->connect();


ksort($_REQUEST);

echo "<pre>";
print_r($_REQUEST);
echo "</pre>";

foreach ($_REQUEST as $key => $value) {
	$value = str_replace(",","",$value);
	$value = str_replace(".00", "", $value);
	$$key = $value;
}


$source = "SELECT * FROM tbl_FSTART WHERE txn_id = '$custnomid'";
$db->executeQuery($source);
$source = $db->lastResults;

echo "<pre>";
//print_r($db->lastResults);
echo "</pre>";

$originalbranch = $source[0]['txn_branch_code'];
$originalregion = $source[0]['txn_region_code'];

if($userpermission == "I") {
    $txn_action = "I";
}
else {
    $txn_action = "A";
}

$delete = "DELETE FROM Tbl_F$userwfid WHERE txn_id = '$custnomid'";
$db->executeNonQuery($delete);

$input = "INSERT INTO Tbl_F$userwfid ([txn_id],[txn_action],[txn_time],[txn_user_id],[txn_notes],[txn_branch_code],[txn_region_code])
VALUES('$custnomid','$txn_action',getdate(),'$userid','$notes', '$originalbranch','$originalregion')";
$db->executeNonQuery($input);


header("location:../flow.php?userwfid=$userwfid&userpermission=$userpermission&buttonaction=$buttonaction&userbranch=$userbranch&userregion=$userregion&userid=$userid&userpwd=$userpwd&jeniscol=$col_code&col_id=$theid");
?>