<?php
	
	//include ("../../../lib/formatError.php");
	require ("../../../lib/open_con.php");
	
	$type = $_REQUEST['type'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Expires" CONTENT="0">
<meta http-equiv="Cache-Control" CONTENT="no-cache">
<meta http-equiv="Pragma" CONTENT="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DETAIL HEADER APPRAISAL</title>
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
	<div align=center valign=top> <strong>DAFTAR REPORT APPRAISAL</strong></div>
				
		</br></br>
		<div align="left" style="padding:20px;">
		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
			
			<tr>
				<td style="border:1px solid black;" width=3% align=center><strong>NO.</strong></td>
				<td style="border:1px solid black;" width=20% align=center><strong>Collateral ID</strong></td>
				<td style="border:1px solid black;" width=20% align=center><strong>Nilai Jaminan</strong></td>
				<td style="border:1px solid black;" width=15% align=center><strong>Lihat Posisi</strong></td>
				<td style="border:1px solid black;" width=15% align=center><strong>INFO Detail</strong></td>
			</tr>
				
			<?php if($type=="LND"){ 
				$i = 0;
				$tsql = "select *, convert(varchar(50),cast( _nilai_tanah_total as money), -1) as total from appraisal_lnd_value a, appraisal_lnd b where a._collateral_id = b._collateral_id";			
				$aside = sqlsrv_query($conn, $tsql);
				if ($aside === false) die( FormatErrors( sqlsrv_errors() ) );
				if(sqlsrv_has_rows($aside)){  
					while($rowside = sqlsrv_fetch_array($aside, SQLSRV_FETCH_ASSOC)){ 
					$i++;	
			?>
		
			<tr>
				<td style="border:1px solid black;" width=3% align=center><?php echo $i;?></td>
				<td style="border:1px solid black;" width=20% align=center><?php echo $rowside['_collateral_id']; ?></td>
				<td style="border:1px solid black;" width=20% align=center><?php echo $rowside['total']; ?></td>
				<td style="border:1px solid black;" width=15% align=right><a href="info_maps.php?collateral_id=<?php echo $rowside['_collateral_id'];?>&latitude=<?php echo $rowside['_latitude'];?>&longitude=<?php echo $rowside['_longitude'];?>">Lihat di map</a></td>
				<td style="border:1px solid black;" width=15% align=right><a href="info_detail_lnd.php?type=<?php echo $type;?>&collateral_id=<?php echo $rowside['_collateral_id']; ?>">Lihat Detail >></a></td>
			</tr>
			<?php	
					}
				}
			} else if($type=="BA1"||$type=="KI2"||$type=="RUK"){ 
				$i = 0;
				$tsql = "select *, convert(varchar(50),cast( _nilai_bang_imb_total as money), -1) as total from appraisal_tnb_value a, appraisal_tnb b where a._collateral_id = b._collateral_id and _type_jaminan = '$type'";			
				$aside = sqlsrv_query($conn, $tsql);
				if ($aside === false) die( FormatErrors( sqlsrv_errors() ) );
				if(sqlsrv_has_rows($aside)){  
					while($rowside = sqlsrv_fetch_array($aside, SQLSRV_FETCH_ASSOC)){ 
					$i++;	
			?>
		
			<tr>
				<td style="border:1px solid black;" width=3% align=center><?php echo $i;?></td>
				<td style="border:1px solid black;" width=20% align=center><?php echo $rowside['_collateral_id']; ?></td>
				<td style="border:1px solid black;" width=20% align=center><?php echo $rowside['total']; ?></td>
				<td style="border:1px solid black;" width=15% align=right><a href="info_maps.php?collateral_id=<?php echo $rowside['_collateral_id'];?>&latitude=<?php echo $rowside['_latitude'];?>&longitude=<?php echo $rowside['_longitude'];?>">Lihat di map</a></td>
				<td style="border:1px solid black;" width=15% align=right><a href="info_detail_bld.php?type=<?php echo $type;?>&collateral_id=<?php echo $rowside['_collateral_id']; ?>">Lihat Detail >></a></td>
			</tr>
			<?php	
					}
				}
			} else if($type=="VHC"){ 
				$i = 0;
				$tsql = "select *, convert(varchar(50),cast( _nilai_kendaraan as money), -1) as total from appraisal_vhc_value a, appraisal_vhc b where a._collateral_id = b._collateral_id";			
				$aside = sqlsrv_query($conn, $tsql);
				if ($aside === false) die( FormatErrors( sqlsrv_errors() ) );
				if(sqlsrv_has_rows($aside)){  
					while($rowside = sqlsrv_fetch_array($aside, SQLSRV_FETCH_ASSOC)){ 
					$i++;	
			?>
		
			<tr>
				<td style="border:1px solid black;" width=3% align=center><?php echo $i;?></td>
				<td style="border:1px solid black;" width=20% align=center><?php echo $rowside['_collateral_id']; ?></td>
				<td style="border:1px solid black;" width=20% align=center><?php echo $rowside['total']; ?></td>
				<td style="border:1px solid black;" width=15% align=right>not available</td>
				<td style="border:1px solid black;" width=15% align=right><a href="info_detail_vhc.php?type=<?php echo $type;?>&collateral_id=<?php echo $rowside['_collateral_id']; ?>">Lihat Detail >></a></td>
			</tr>
			<?php	
					}
				}
			} ?>
			
		</table>
		</div>
</BODY>
</html>
<?
   	require("../../../lib/close_con.php");
?>