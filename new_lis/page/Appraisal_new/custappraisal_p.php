<?
	require ("../../lib/open_con.php");
	require ("../../lib/formatError.php");
	require ("../../requirepage/parameter.php");
	
	$theid = $_POST['thecolid'];
	
	$aname = $_POST['name'];
	$aalamat = $_POST['address'];
	$akelurahan = $_POST['txtkel'];
	$akecamatan = $_POST['txtkec'];
	$akota = $_POST['txtkota'];
	$aprovinsi = $_POST['txtpro'];
	$akodepos = $_POST['zipcode'];
	$atlp = $_POST['txttlp'];
	$ahp1 = $_POST['txthp'];
	$ahp2 = $_POST['txthp2'];
	$aemail = $_POST['txtemail'];
	$aot1 = $_POST['txtot1'];
	$aot2 = $_POST['txtot2'];
	$anorek = $_POST['txtnorek'];
	$acustcif = $_POST['txtcustcif'];
	$acustlisid = $_POST['txtcustlisid'];
	$acustlistype = $_POST['txtcustlistype'];
	$acustappraiserid = $_POST['txtcustappraiserid'];
	
	$strsqlv01="SELECT COUNT(*) as jml FROM appraisal_custmaster WHERE _custnomid = '$custnomid'";
	//echo $strsqlv01;
	$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
	if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlconv01))
	{
		if($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
		{
			if($rowsv01['jml']>0)
			{
				$strsql = "DELETE FROM appraisal_custmaster WHERE _custnomid = '$custnomid'";
				$stmt = sqlsrv_prepare( $conn, $strsql);
				if(!$stmt)
				{
				echo "Error in preparing statement.\n";
				die( print_r( sqlsrv_errors(), true));
				}
				if(!sqlsrv_execute( $stmt))
				{
				echo "Cannot insert table ". $strsql;
				die( print_r( sqlsrv_errors(), true));
				}	
				sqlsrv_free_stmt( $stmt);
			}
		}
	}
	
	$strsql = "INSERT INTO appraisal_custmaster (_custnomid,_cust_cif,_cust_lisid,_cust_listype,_cust_region_id,_cust_branch_id,_cust_name,_cust_addr,_cust_kelurahan,_cust_kecamatan,_cust_kota,_cust_propinsi,_cust_kodepos,_cust_telp1,_cust_hp1,_cust_hp2,_cust_email1,_cust_orangterdekat1,_cust_orangterdekat2,_cust_norek,_cust_appraiser_id,_cust_createtime,_cust_flag) 
									VALUES ('$custnomid','$acustcif','$acustlisid','$acustlistype','$userregion','$userbranch','$aname','$aalamat','$akelurahan','$akecamatan','$akota','$aprovinsi','$akodepos','$atlp','$ahp1','$ahp2','$aemail','$aot1','$aot2','$anorek','$acustappraiserid',GETDATE(),'')";
	$stmt = sqlsrv_prepare( $conn, $strsql);
	if(!$stmt)
	{
	echo "Error in preparing statement.\n";
	die( print_r( sqlsrv_errors(), true));
	}
	if(!sqlsrv_execute( $stmt))
	{
	echo "Cannot insert table ". $strsql;
	die( print_r( sqlsrv_errors(), true));
	}	
	sqlsrv_free_stmt( $stmt);
	
	$strsql = "UPDATE appraisal_task set _flag='2' where _custnomid = '$custnomid'";
	$stmt = sqlsrv_prepare( $conn, $strsql);
	if(!$stmt)
	{
	echo "Error in preparing statement.\n";
	die( print_r( sqlsrv_errors(), true));
	}
	if(!sqlsrv_execute( $stmt))
	{
	echo "Cannot insert table ". $strsql;
	die( print_r( sqlsrv_errors(), true));
	}	
	sqlsrv_free_stmt( $stmt);

require ("../../requirepage/do_saveflow.php");	

header("location:../flow.php?userid=$userid&userpwd=$userpwd&userbranch=$userbranch&userregion=$userregion&userwfid=$userwfid");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<script>
		
		function iniload()
		{
			document.formappl.action = "./custappraisal.php";
			document.formappl.submit();
		}
		
	</script>
</head>
	<body onload="iniload()">
		<form id="formappl" name="formappl" method="post">
			<input type="hidden" id="theid" name="theid" />
			<?
				require ("../../requirepage/hiddenfield.php");
			?>
		</form>
	</body>
</html>	