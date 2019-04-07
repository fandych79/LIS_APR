<?php
require ("../../lib/open_conAPPR.php");
require ("../../lib/formatError.php");

$custnomid=$_REQUEST['col_id'];
$_flag=$_REQUEST['flag'];
 
 
$filePath="";
$tsql = "select * from appraisal_photo where _collateral_id = '".$custnomid."' and _id='".$_flag."'";

$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);
$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
$rowimage = sqlsrv_num_rows($sqlConn);
if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
if(sqlsrv_has_rows($sqlConn))
{
    while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
    {
        $_photo = $row['_collateral_photo'];
        
        $filePath="./".$custnomid."_".$_flag.".jpg";
        
        file_from_encodedtext($_photo,$filePath);
    }
}







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

$fileName = basename($filePath);
$fileSize = filesize($filePath);

// Output headers.
header("Cache-Control: private");
header("Content-Type: application/stream");
header("Content-Length: ".$fileSize);
header("Content-Disposition: attachment; filename=".$fileName);

// Output file.
readfile ($filePath);
unlink($filePath);
exit();

?>