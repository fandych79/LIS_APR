<?php



	  
	 
require ("../lib/open_con.php");
	
	$custnomid = $_GET['txtcustnomid'];
	$custfullname = $_GET['txtcustfullname'];
	$regioncode = $_GET['txtregioncode'];
	$branchcode = $_GET['txtbranchcode'];
	$custaddr = $_GET['txtcustaddr'];
	$custtelp = $_GET['txtcusttelp'];
	$taxatype = $_GET['taxatype'];
	$businesstype = $_GET['businesstype'];
	
	$tsql = "SELECT COUNT(*) as baris FROM tbl_COL_App WHERE ap_lisregno = '$custnomid'";
   	$sqlConn = sqlsrv_query($conn, $tsql);
   	if ( $sqlConn === false)
    die( FormatErrors( sqlsrv_errors() ) );
   		if(sqlsrv_has_rows($sqlConn))
   		{
			$rowCount = sqlsrv_num_rows($sqlConn);
      		while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
      		{
				$saklar = $row['baris'];
      		}
   		}
   		sqlsrv_free_stmt( $sqlConn );
	if($saklar == 0)
	{
		$tsql = "INSERT INTO TBL_COL_APP (ap_lisregno, ap_taxatype, ap_regional, ap_branch, ap_date) VALUES ('$custnomid', '$taxatype', '$regioncode', '$branchcode', getdate())
		INSERT INTO TBL_COL_CUSTOMER (ap_lisregno, cust_name, cust_addr1, cust_telp, cust_usaha) VALUES ('$custnomid', '$custfullname', '$custaddr', '$custtelp', '$businesstype')";
		
		$sqlConn = sqlsrv_query($conn, $tsql);
		if ( $sqlConn === false)
		die( FormatErrors( sqlsrv_errors() ) );
		  
		Header("Location:../script/aprdbentry.php?Custnomid=".$custnomid);
	}
	else
	{
		$tsql = "UPDATE TBL_COL_APP SET ap_taxatype = '$taxatype' WHERE ap_lisregno = '$custnomid'
		UPDATE TBL_COL_CUSTOMER SET cust_usaha = '$businesstype' WHERE ap_lisregno = '$custnomid'";
		
		$sqlConn = sqlsrv_query($conn, $tsql);
		if ( $sqlConn === false)
		die( FormatErrors( sqlsrv_errors() ) );
			
		Header("Location:../script/aprdbentry.php?Custnomid=".$custnomid);
	}
?>