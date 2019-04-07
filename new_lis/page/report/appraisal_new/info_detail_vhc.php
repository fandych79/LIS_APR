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
				$tsql = "select *, convert(varchar(50),cast(convert(BIGINT, _nilai_kendaraan) as money), -1) as total from appraisal_vhc_value a, appraisal_vhc b where a._collateral_id = b._collateral_id and a._collateral_id = '$collateral_id'";			
				$aside = sqlsrv_query($conn, $tsql);
				if ($aside === false) die( FormatErrors( sqlsrv_errors() ) );
				if(sqlsrv_has_rows($aside)){  
					while($rowside = sqlsrv_fetch_array($aside, SQLSRV_FETCH_ASSOC)){ 
						
						$_cond_code  = $rowside['_cond_code'];
						$_type  = $rowside['_type'];
						$_merk  = $rowside['_merk'];
						$_model  = $rowside['_model'];
						$_jns_kendaraan  = $rowside['_jns_kendaraan'];
						$_thnpembuatan  = $rowside['_thnpembuatan'];
						$_silinder_isi  = $rowside['_silinder_isi'];
						$_silinder_wrn  = $rowside['_silinder_wrn'];
						$_norangka  = $rowside['_norangka'];
						$_nomesin	= $rowside['_nomesin'];
						$_bpkb_tgl	= $rowside['_bpkb_tgl'];
						$_stnk_exp	= $rowside['_stnk_exp'];
						$_faktur_tgl	= $rowside['_faktur_tgl'];
						$_bahanbakar	= $rowside['_bahanbakar'];
						$_bpkb_nama	= $rowside['_bpkb_nama'];
						$_bpkb_addr1	= $rowside['_bpkb_addr1'];
						$_bpkb_addr2	= $rowside['_bpkb_addr2'];
						$_bpkb_addr3	= $rowside['_bpkb_addr3'];
						$_perlengkapan	= $rowside['_perlengkapan'];
						$_notes	= $rowside['_notes'];
						$_opini	= $rowside['_opini'];
					
					}
				}
			?>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Kondisi</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_cond_code;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Tipe</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_type;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Merk</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_merk;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Model</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_model;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Jenis Kendaraan</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_jns_kendaraan;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Tahun Pembuatan</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_thnpembuatan;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Silinder isi</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_silinder_isi;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Silinder warna</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_silinder_wrn;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>No Rangka</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_norangka;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>No Mesin</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_nomesin;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Tanggal BPKB</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_bpkb_tgl;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>STNK Expired</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_stnk_exp;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Tanggal Faktur</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_faktur_tgl;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Bahan Bakar</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_bahanbakar;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Nama BPKB</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_bpkb_nama;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Alamat BPKB 1</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_bpkb_addr1;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Alamat BPKB 2</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_bpkb_addr2;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Alamat BPKB 3</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_bpkb_addr3;?></strong></td>
			</td>
			<tr>
				<td style="border:1px solid black;" width=20% align=left><strong>Perlengkapan</strong></td>
				<td style="border:1px solid black;" width=50% align=left><strong><?php echo $_perlengkapan;?></strong></td>
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