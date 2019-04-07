<?
	require ("../../lib/open_conAPPR.php");
	require ("../../lib/formatError.php");
	require ("../../requirepage/parameter.php");
	
	$maxofficer = 5;
	$x = 1;
	
	$theid = $_POST['thecolid'];
	
	$v_tnhpm = $_POST['value_tnhpm'];
	$v_tnhpm = str_replace(',', '', $v_tnhpm);
	$v_tnht = $_POST['value_tnht'];
	$v_tnht = str_replace(',', '', $v_tnht);
	$v_bfpm = $_POST['value_bfpm'];
	$v_bfpm = str_replace(',', '', $v_bfpm);
	$v_bft = $_POST['value_bft'];
	$v_bft = str_replace(',', '', $v_bft);
	$v_bimbpm = $_POST['value_bimbpm'];
	$v_bimbpm = str_replace(',', '', $v_bimbpm);
	$v_bimbt = $_POST['value_bimbt'];
	$v_bimbt = str_replace(',', '', $v_bimbt);
	$v_tf = $_POST['value_tf'];
	$v_tf = str_replace(',', '', $v_tf);
	$v_lf = $_POST['value_lf'];
	$v_lf = str_replace(',', '', $v_lf);
	$v_ti = $_POST['value_ti'];
	$v_ti = str_replace(',', '', $v_ti);
	$v_li = $_POST['value_li'];
	$v_li = str_replace(',', '', $v_li);
	
	$totalfisik = $_POST['totalfisik'];
	$totalfisik = str_replace(',', '', $totalfisik);
	
	$totalcef = $_POST['totalcef'];
	$totalcef = str_replace(',', '', $totalcef);
	
	$v_lbf = $_POST['value_lbf'];
	$v_bimb = $_POST['value_bimb'];
	$v_sm = $_POST['value_sm'];
	$v_bfp = $_POST['value_bfp'];
	$v_bip = $_POST['value_bip'];
	$v_smf = $_POST['value_smf'];
	$v_opini = $_POST['value_op'];
	$luas_bangunan = $_POST['luas_bangunan'];
	
	while($x <=$maxofficer)
	{
		$off = $_POST['off'.$x];
		
		if($off!="")
		{
			$strsqlv01="SELECT * FROM appraisal_officer where col_id = '$theid' and seq = '$x'";
			$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
			if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
			if(sqlsrv_has_rows($sqlconv01))
			{
				$strsql = "update appraisal_officer set officer_id = '$off' where col_id = '$theid' and seq = '$x'";
				$b = sqlsrv_query($conn, $strsql);
			}
			else
			{
				$strsql = "insert into appraisal_officer (col_id, officer_id, seq) values ('$theid', '$off', '$x')";
				$b = sqlsrv_query($conn, $strsql);
			}
		}
		else
		{
			$strsql = "delete from appraisal_officer where col_id = '$theid' and seq = '$x'";
			$b = sqlsrv_query($conn, $strsql);
		}
		$x++;
	}
	
	$strsqlv01="SELECT COUNT(*) as jml FROM appraisal_tnb_value WHERE _collateral_id = '$theid'";
	//echo $strsqlv01;
	$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
	if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlconv01))
	{
		if($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
		{
			if($rowsv01['jml']>0)
			{
				$strsql = "DELETE FROM appraisal_tnb_value WHERE _collateral_id = '$theid'";
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
	
	$strsql = "INSERT INTO appraisal_tnb_value (_collateral_id,_nilai_tanah_perm2,_nilai_tanah_total,_cef_tanah,_nilai_cef_tanah,_nilai_bangunan_perm2,_nilai_bangunan_total,_cef_bangunan,_nilai_cef_bangunan,_nilai_total_fisik_agunan, _nilai_total_cef_agunan,_opini,_luas_bangunan) 
									VALUES ('$theid','$v_tnhpm','$v_tnht','$v_sm','$v_li','$v_bimbpm','$v_bimbt','$v_smf','$v_lf','$totalfisik','$totalcef', '$v_opini', '$luas_bangunan')";
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