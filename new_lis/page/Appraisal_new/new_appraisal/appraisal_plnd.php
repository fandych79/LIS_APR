<?
	require ("../../lib/open_conAPPR.php");
	require ("../../lib/formatError.php");
	require ("../../requirepage/parameter.php");
	
	$theid = $_POST['thecolid'];
	
	$v_tnhpm = $_POST['value_tnhpm'];
	$v_tnhpm = str_replace(',', '', $v_tnhpm);
	$v_tnht = $_POST['value_tnht'];
	$v_tnht = str_replace(',', '', $v_tnht);
	$v_lf = $_POST['value_lf'];
	$v_lf = str_replace(',', '', $v_lf);
	
	$v_sm = $_POST['value_sm'];
	$v_opini = $_POST['value_op'];
	
	$strsqlv01="SELECT COUNT(*) as jml FROM appraisal_lnd_value WHERE _collateral_id = '$theid'";
	//echo $strsqlv01;
	$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
	if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlconv01))
	{
		if($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
		{
			if($rowsv01['jml']>0)
			{
				$strsql = "DELETE FROM appraisal_lnd_value WHERE _collateral_id = '$theid'";
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
	
	$strsql = "INSERT INTO appraisal_lnd_value (_collateral_id,_nilai_tanah_perm2,_nilai_tanah_total,_safety_margin,_nilai_likuidasi,_opini) 
											VALUES ('$theid','$v_tnhpm','$v_tnht','$v_sm','$v_lf','$v_opini')";
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
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<script src="js/jquery-1.9.1.js"></script>
	<script>
		
		function iniload()
		{
			document.formappl.theid.value="<?php echo $theid?>";
			document.formappl.action = "./appraisal.php";
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