<?php
	
	//include ("../../../lib/formatError.php");
	require ("../../../lib/open_con.php");
	
	$type = $_REQUEST['type'];
	$collateral_id = $_REQUEST['collateral_id'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Expires" CONTENT="0">
<meta http-equiv="Cache-Control" CONTENT="no-cache">
<meta http-equiv="Pragma" CONTENT="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>INFO DETAIL APPRAISAL</title>
<script type="text/javascript" src="../../../js/datetimepicker_css.js"></script>
<script type="text/javascript" src="../../../js/full_function.js"></script>

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

<br>
	<div align=center valign=top> <strong>DAFTAR REPORT APPRAISAL <?php echo $collateral_id;?></strong></div>
				
		</br></br>
		<div align="left" style="padding:20px;">
		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
				
				
			<?php
				$tsql = "select *, convert(varchar(50),cast(convert(BIGINT, _nilai_bang_imb_total) as money), -1) as total from appraisal_tnb_value a, appraisal_tnb b where a._collateral_id = b._collateral_id and a._collateral_id = '$collateral_id' and b._type_jaminan = '$type'";			
				$aside = sqlsrv_query($conn, $tsql);
				if ($aside === false) die( FormatErrors( sqlsrv_errors() ) );
				if(sqlsrv_has_rows($aside)){  
					while($rowside = sqlsrv_fetch_array($aside, SQLSRV_FETCH_ASSOC)){ 
						
						$_type_jaminan	= $rowside['_type_jaminan'];
						$_lokasi_rumah	= $rowside['_lokasi_rumah'];
						$_jumlah_lantai	= $rowside['_jumlah_lantai'];
						$_luas_bangunan	= $rowside['_luas_bangunan'];
						$_panjang_bangunan	= $rowside['_panjang_bangunan'];
						$_lebar_bangunan	= $rowside['_lebar_bangunan'];
						$_arah_bangunan	= $rowside['_arah_bangunan'];
						$_umur_bangunan	= $rowside['_umur_bangunan'];
						$_tahun_dibangun	= $rowside['_tahun_dibangun'];
						$_tahun_renovasi	= $rowside['_tahun_renovasi'];
						
						$_luas_tanah  = $rowside['_luas_tanah'];
						$_panjang_tanah  = $rowside['_panjang_tanah'];
						$_lebar_tanah  = $rowside['_lebar_tanah'];
						$_sisi_utara  = $rowside['_sisi_utara'];
						$_sisi_timur  = $rowside['_sisi_timur'];
						$_sisi_selatan  = $rowside['_sisi_selatan'];
						$_sisi_barat  = $rowside['_sisi_barat'];
						$_latitude  = $rowside['_latitude'];
						$_longitude  = $rowside['_longitude'];
						$_notes	= $rowside['_notes'];
						$_opini	= $rowside['_opini'];
					
					}
				}
			 ?>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Tipe Jaminan</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_type_jaminan;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Lokasi Rumah</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_lokasi_rumah;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Jumlah Lantai</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_jumlah_lantai;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Luas Bangunan</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_luas_bangunan;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Panjang Bangunan</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_panjang_bangunan;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Lebar Bangunan</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_lebar_bangunan;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Arah Bangunan</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_arah_bangunan;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Umur Bangunan</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_umur_bangunan;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Tahun dibangun</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_tahun_dibangun;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Tahun Renovasi</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_tahun_renovasi;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Luas Tanah</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_luas_tanah;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Panjang Tanah</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_panjang_tanah;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Lebar Tanah</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_lebar_tanah;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Sisi Utara</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_sisi_utara;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Sisi Timur</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_sisi_timur;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Sisi Selatan</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_sisi_selatan;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Sisi Barat</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_sisi_barat;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Latitude</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_latitude;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Longitude</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_longitude;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Notes</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_notes;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Opini</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_opini;?></strong></td>
			</td>
			
		</table>
		</div>
</BODY>
</html>
<?
   	require("../../../lib/close_con.php");
?>