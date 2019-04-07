<?php
include ("../../lib/formatError.php");
//require ("../../lib/open_con.php");
require ("../../lib/open_conLIS.php");
$a=$_GET['a'];
if($a == "")
{
	echo '||||||';
}
else if($a == "pbb")
{
	$col_id = $_GET['col_id'];
	$ap_lisregno = $_GET['ap_lisregno'];
	
	
	$tsql = "SELECT luas_tanah*harga_permeter_tanah as harga_total_tanah, luas_bangunan*harga_permeter_bangunan as harga_total_bangunan, * FROM tbl_col_nilaipbb WHERE col_id = '$col_id' AND ap_lisregno = '$ap_lisregno'";
	$b = sqlsrv_query($conn, $tsql);
	if ( $b === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($b))
	{ 
		while($rowType = sqlsrv_fetch_array($b, SQLSRV_FETCH_ASSOC))
		{
			$harga_total_tanah = $rowType['harga_total_tanah'];
			$harga_total_bangunan = $rowType['harga_total_bangunan'];
			$harga_permeter_tanah = $rowType['harga_permeter_tanah'];
			$harga_permeter_bangunan = $rowType['harga_permeter_bangunan'];
		}
	}
	

	echo $harga_permeter_tanah."|".$harga_total_tanah."|".$harga_permeter_bangunan."|".$harga_total_bangunan;
	
}

?>