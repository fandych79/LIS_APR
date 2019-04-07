<?php

function file_to_encodedtext($file_path)
{
	$raw_data = file_get_contents($file_path);
	return base64_encode($raw_data);
}

function file_from_encodedtext($encoded_text,$target_path)
{
	$raw_data = base64_decode($encoded_text);
	$file = fopen($target_path,"w");
	fwrite($file,$raw_data);
	fclose($file);
	
}

require ("../../lib/open_conAPPR.php");

$tsql = "select * from appraisal_photo where _collateral_id in(select col_id from Tbl_Cust_MasterCol where ap_lisregno='MIKRO4249300161') ";
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);
$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
$rowimage = sqlsrv_num_rows($sqlConn);

$no=0;
if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
if(sqlsrv_has_rows($sqlConn))
{
    while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
    {
        $no++;
        $_photo = $row['_collateral_photo'];
        file_from_encodedtext($_photo,"./".$no.".jpg");
    }
}
?>