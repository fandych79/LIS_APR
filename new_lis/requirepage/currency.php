<?
	$currency = "";
	
	$tsql = "SELECT CUSTCURCODE FROM TBL_CUSTOMERMASTERPERSON where custnomid = '$custnomid'";
	$a = sqlsrv_query($conn, $tsql);

	if ( $a === false)
	die( FormatErrors( sqlsrv_errors() ) );

	if(sqlsrv_has_rows($a))
	{  
		if($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
		{
			$currency = $row["CUSTCURCODE"];
		}
	}
	
	if($currency == "")
	{
		$currency = "IDR";
	}
	
?>