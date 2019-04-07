<?php
	
	//include ("../../../lib/formatError.php");
	require ("../../../lib/open_con.php");
	//require ("../../../lib/open_con_apr.php");
	
	
	$JmlLND = 0;
	$TotalLND = 0;
	$JmlBA1 = 0;
	$TotalBA1 = 0;
	$JmlRUK = 0;
	$TotalRUK = 0;
	$JmlKI2 = 0;
	$TotalKI2 = 0;
	$JmlVHC = 0;
	$TotalVHC = 0;
	
	$tsql = "select count(*) as jumlah, convert(varchar(50),cast(sum(convert(BIGINT, _nilai_tanah_total)) as money), -1) as total from appraisal_lnd_value";			
	$aside = sqlsrv_query($conn, $tsql);
	if ($aside === false) die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($aside)){  
		while($rowside = sqlsrv_fetch_array($aside, SQLSRV_FETCH_ASSOC)){ 
			$JmlLND = $rowside['jumlah'];
			$TotalLND = $rowside['total'];
		}
	}
		
	$tsql = "select count(*) as jumlah, convert(varchar(50),cast(sum(convert(BIGINT, _nilai_bang_imb_total)) as money), -1) as total from appraisal_tnb_value where _collateral_id in (select _collateral_id from appraisal_tnb where _type_jaminan = 'BA1')";
	$bse = sqlsrv_query($conn, $tsql);
	if ($bse === false)
		die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($bse))
	{  
		while($rowmp = sqlsrv_fetch_array($bse, SQLSRV_FETCH_ASSOC))
		{ 
			$JmlBA1 = $rowmp['jumlah'];
			$TotalBA1 = $rowmp['total'];
		}
	}
	sqlsrv_free_stmt( $bse );
	
	$tsql = "select count(*) as jumlah, convert(varchar(50),cast(sum(convert(BIGINT, _nilai_bang_imb_total)) as money), -1) as total from appraisal_tnb_value where _collateral_id in (select _collateral_id from appraisal_tnb where _type_jaminan = 'RUK')";
	$cse = sqlsrv_query($conn, $tsql);
	if ($cse === false)
		die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($cse))
	{  
		while($rowmp = sqlsrv_fetch_array($cse, SQLSRV_FETCH_ASSOC))
		{ 
			$JmlRUK = $rowmp['jumlah'];
			$TotalRUK = $rowmp['total'];
		}
	}
	sqlsrv_free_stmt( $cse );
	
	$tsql = "select count(*) as jumlah, convert(varchar(50),cast(sum(convert(BIGINT, _nilai_bang_imb_total)) as money), -1) as total from appraisal_tnb_value where _collateral_id in (select _collateral_id from appraisal_tnb where _type_jaminan = 'KI2')";
	$dse = sqlsrv_query($conn, $tsql);
	if ($dse === false)
		die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($dse))
	{  
		while($rowmp = sqlsrv_fetch_array($dse, SQLSRV_FETCH_ASSOC))
		{ 
			$JmlKI2 = $rowmp['jumlah'];
			$TotalKI2 = $rowmp['total'];
		}
	}
	sqlsrv_free_stmt( $dse );
	
	$tsql = "select count(*) as jumlah, convert(varchar(50),cast(sum(convert(BIGINT, _nilai_kendaraan)) as money), -1) as total from appraisal_vhc_value";
	$ese = sqlsrv_query($conn, $tsql);
	if ($ese === false)
		die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($ese))
	{  
		while($rowmp = sqlsrv_fetch_array($ese, SQLSRV_FETCH_ASSOC))
		{ 
			$JmlVHC = $rowmp['jumlah'];
			$TotalVHC = $rowmp['total'];
		}
	}
	sqlsrv_free_stmt( $ese );
	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Expires" CONTENT="0">
<meta http-equiv="Cache-Control" CONTENT="no-cache">
<meta http-equiv="Pragma" CONTENT="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DAFTAR REPORT APPRAISAL</title>

<script type="text/javascript" src="../../../bootstrap/dist/js/jquery-1.11.3.js" ></script>
<script type="text/javascript" src="../../../bootstrap/dist/js/bootstrap.min.js" ></script>

<script type="text/javascript" src="../../../js/datatable.js"></script>
<script type="text/javascript" src="../../../js/bootstraptable.js"></script>
<script type="text/javascript" src="../../../js/bootstrap-datepicker.min.js"></script>

<link href="../../../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../../../bootstrap/dist/css/bootstrap-datepicker.min.css"></link>
<link rel="stylesheet" href="../../../bootstrap/dist/css/bootstrap-datepicker3.min.css"></link>
<link href="../../../css/table.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	$(document).ready(function() {
		$('#example').DataTable();
	} );
</script>
	
</head>

<BODY>
<script language="Javascript">
				name="utama";
</script>
<?
?>

	<br>
	<div align=center valign=top> <strong>DAFTAR REPORT APPRAISAL</strong></div>
				
		</br></br>
		<div align="left" style="padding:20px;">
		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
	<tbody>
			<tr>
				<td style="border:1px solid black;" width=3% align=center><strong>NO.</strong></td>
				<td style="border:1px solid black;" width=20% align=center><strong>TIPE JAMINAN</strong></td>
				<td style="border:1px solid black;" width=20% align=center><strong>JUMLAH</strong></td>
				<td style="border:1px solid black;" width=15% align=center><strong>NILAI TOTAL</strong></td>
				<td style="border:1px solid black;" width=15% align=center><strong>DETAIL</strong></td>
			</tr>
				
		
		
		
			<tr>
				<td style="border:1px solid black;" width=3% align=center>1.</td>
				<td style="border:1px solid black;" width=20% align=center>Tanah Kosong</td>
				<td style="border:1px solid black;" width=20% align=center><?php echo $JmlLND;?></td>
				<td style="border:1px solid black;" width=15% align=right><?php echo $TotalLND?></td>
				<td style="border:1px solid black;" width=15% align=right><a href="info_header.php?type=LND">Lihat Detail >></a></td>
			</tr>
			
			<tr>
				<td style="border:1px solid black;" width=3% align=center>2.</td>
				<td style="border:1px solid black;" width=20% align=center>Tanah dan Bangunan</td>
				<td style="border:1px solid black;" width=20% align=center><?php echo $JmlBA1;?></td>
				<td style="border:1px solid black;" width=15% align=right><?php echo $TotalBA1?></td>
				<td style="border:1px solid black;" width=15% align=right><a href="info_header.php?type=BA1">Lihat Detail >></a></td>
			</tr>
			
			<tr>
				<td style="border:1px solid black;" width=3% align=center>3.</td>
				<td style="border:1px solid black;" width=20% align=center>Ruko</td>
				<td style="border:1px solid black;" width=20% align=center><?php echo $JmlRUK;?></td>
				<td style="border:1px solid black;" width=15% align=right><?php echo $TotalRUK?></td>
				<td style="border:1px solid black;" width=15% align=right><a href="info_header.php?type=RUK">Lihat Detail >></a></td>
			</tr>
			
			<tr>
				<td style="border:1px solid black;" width=3% align=center>4.</td>
				<td style="border:1px solid black;" width=20% align=center>Kios</td>
				<td style="border:1px solid black;" width=20% align=center><?php echo $JmlKI2;?></td>
				<td style="border:1px solid black;" width=15% align=right><?php echo $TotalKI2?></td>
				<td style="border:1px solid black;" width=15% align=right><a href="info_header.php?type=KI2">Lihat Detail >></a></td>
			</tr>
			
			<tr>
				<td style="border:1px solid black;" width=3% align=center>5.</td>
				<td style="border:1px solid black;" width=20% align=center>Kendaraan</td>
				<td style="border:1px solid black;" width=20% align=center><?php echo $JmlVHC;?></td>
				<td style="border:1px solid black;" width=15% align=right><?php echo $TotalVHC?></td>
				<td style="border:1px solid black;" width=15% align=right><a href="info_header.php?type=VHC">Lihat Detail >></a></td>
			</tr>
		</tbody>
			
			
		</table>
		</div>
</BODY>
</html>
<?
   	require("../../../lib/close_con.php");
?>