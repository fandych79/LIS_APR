<?
	require ("../../lib/open_conAPPR.php");
	require ("../../lib/formatError.php");
	require ("../../requirepage/parameter.php");
	
	$maxofficer = 5;
	$x = 1;
	
	$theid = $_POST['thecolid'];
	
	$v_kend = $_POST['value_kend'];
	$v_kend = str_replace(',', '', $v_kend);
	$v_likuidasi = $_POST['value_likuidasi'];
	$v_likuidasi = str_replace(',', '', $v_likuidasi);
	
	$v_savety = $_POST['value_savety'];
	$v_opini = $_POST['value_opini'];
	
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
	
	$strsqlv01="SELECT COUNT(*) as jml FROM appraisal_vhc_value WHERE _collateral_id = '$theid'";
	//echo $strsqlv01;
	$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
	if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlconv01))
	{
		if($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
		{
			if($rowsv01['jml']>0)
			{
				$strsql = "DELETE FROM appraisal_vhc_value WHERE _collateral_id = '$theid'";
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
	
	$strsql = "INSERT INTO appraisal_vhc_value (_collateral_id,_nilai_kendaraan,_safety_margin,_nilai_likuidasi,_opini) VALUES ('$theid','$v_kend','$v_savety','$v_likuidasi','$v_opini')";
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