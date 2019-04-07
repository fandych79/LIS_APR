<?php
	require_once ("../../lib/formatError.php");
	require_once ("../../lib/open_con.php");
	require_once ("../../lib/open_con_apr.php");
	
	$userid=$_GET['userid'];
	$userpwd=$_GET['userpwd'];
	$userbranch=$_GET['userbranch'];
	$userregion=$_GET['userregion'];
	$userwfid=$_GET['userwfid'];
	$userpermission=$_GET['userpermission'];
	$buttonaction=$_GET['buttonaction'];
	$Custnomid=$_GET['custnomid'];
	$custnomid = $Custnomid;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Expires" CONTENT="0">
<meta http-equiv="Cache-Control" CONTENT="no-cache">
<meta http-equiv="Pragma" CONTENT="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>APPRAISALRESPONSE</title>
<script type="text/javascript" src="../../js/jquery-1.7.2.min.js" ></script>
<script type="text/javascript" src="../../js/full_function.js"></script>
<link href="../../css/crw.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="1000px" align="center" style="border:1px solid black;" class="preview2">
<form id="formentry" name="formentry" method="post" action="">
<tr>
	<td colspan="2" style="text-align:center;font-weight:bold;font-size:20px;">IDENTIFIKASI DATA AGUNAN</td>
</tr>
<tr>
	<td colspan="2">&nbsp;</td>
</tr>
<tr>
	<td colspan="2">&nbsp;</td>
</tr>
<?php
$flagapr = "";
$tsql = "SELECT CUSTFLAGAPR FROM Tbl_CustomerFlag where custnomid = '$Custnomid'";

$a = sqlsrv_query($conn, $tsql);

  if ( $a === false)
  die( FormatErrors( sqlsrv_errors() ) );

if(sqlsrv_has_rows($a))
{  
	if($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
	{
		$flagapr = $row["CUSTFLAGAPR"];
	}
}

$action = "";
$tsql = "SELECT TXN_ACTION FROM Tbl_FAPR where TXN_ID = '$Custnomid'";
$a = sqlsrv_query($conn, $tsql);

  if ( $a === false)
  die( FormatErrors( sqlsrv_errors() ) );

if(sqlsrv_has_rows($a))
{  
	if($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
	{
		$action = $row["TXN_ACTION"];
	}
}

if($flagapr == "Z")
{
	if($userid != "")
	{
?>
<!--<tr>
	<td colspan="2" style="text-align:right;font-weight:bold;padding-right:20px;"><a href="../APPRAISAL/viewaprresponse_v2.php?custnomid=<? echo $custnomid?>&userwfid=<? echo $userwfid?>&userpermission=<? echo $userpermission?>&buttonaction=<? echo $buttonaction?>&userbranch=<? echo $userbranch?>&userregion=<? echo $userregion?>&userid=<? echo $userid?>&userpwd=<? echo $userpwd?>" target="blank" >LINK DETAIL</a></td>
</tr>-->
<?php
	}
	$colid = "";
	$jeniscol = "";
	$rowcountjaminan = 0;
	$tsql = "SELECT * FROM Tbl_Cust_MasterCol where ap_lisregno = '$Custnomid' AND FLAGDELETE = '0' AND FLAGINSERT = '1' AND GROUP_COL = 'C'";
	$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	$params = array(&$_POST['query']);
	$a = sqlsrv_query($conn, $tsql, $params, $cursorType);

	if ( $a === false)
	die( FormatErrors( sqlsrv_errors() ) );
	
	if(sqlsrv_has_rows($a))
	{  
		$rowcountjaminan = sqlsrv_num_rows($a);
		while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
		{
			if($colid == "")
			{
				$colid = $row['col_id'];
				$jeniscol = $row['cust_jeniscol'];
			}
			else
			{
				$colid = $colid."|".$row['col_id'];
				$jeniscol = $jeniscol."|".$row['cust_jeniscol'];
			}
		}
?>
<tr>
	<td colspan="2" style="text-align:left;font-weight:bold;padding-left:20px;">Khusus Agunan Tunai</td>
</tr>
<tr>
	<td colspan="2">&nbsp;</td>
</tr>
<?
	}	
?>

<tr>
	<td colspan="2">
		<table width = "100%" align = "center" border = "0">
			<?
				$arraycolid = explode("|", $colid);
				$arrayjeniscol = explode("|", $jeniscol);
				$jenisjaminan = "";
				for($i=0; $i<$rowcountjaminan; $i++)
				{
				
				$tsql = "SELECT * FROM TblCollateralType where col_code = '$arrayjeniscol[$i]' AND col_active = 'Y'";
				
				$a = sqlsrv_query($conn, $tsql, $params, $cursorType);

				if ( $a === false)
				die( FormatErrors( sqlsrv_errors() ) );
				
				if(sqlsrv_has_rows($a))
				{ 	
					while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
					{
						$jenisjaminan = $row['col_name'];
					}
				}
				
				$type = "";
				$nomorrekening = "";
				$atasnama = "";
				$nominal = "";
				$sukubunga = "";
				$jangkawaktu = "";
				$jatuhtempo = "";
				$tsql = "SELECT * FROM tbl_col_cash where col_id = '$arraycolid[$i]'";
				$a = sqlsrv_query($conn, $tsql, $params, $cursorType);
				if ( $a === false)
				die( FormatErrors( sqlsrv_errors() ) );
				
				if(sqlsrv_has_rows($a))
				{ 	
					while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
					{
						$type = $row["cash_type"];
						if($type == "D01")
						{
							$nomorrekening = $row["cash_nobilyet"];
						}
						else if ($type == "TAB")
						{
							$nomorrekening = $row["cash_noaccount"];
						}
						$atasnama = $row["cash_atasnama"];
						$nominal = $row["cash_nilai"];
						$sukubunga = $row["cash_sukubunga"];
						$jangkawaktu = $row["cash_jangkawaktu"];
						$jatuhtempo = $row["cash_tanggaljatuhtempo"]->format('Y/m/d');
					}
				}
			
			?>
			<tr>
				<td style="width:250px;padding-left:20px;"></td>
				<td style="padding-left:120px;" align="right"><input type="button" style="background-color:blue;color:white;width:100px;font-size:10px" onclick="yuriacetak('<? echo $arraycolid[$i];?>', '<? echo $arrayjeniscol[$i];?>')" value="Cetak Jaminan<? //echo $arrayjeniscol[$i];?>" /></td>
			</tr>
			<tr>
				<td style="width:250px;padding-left:20px;">Jenis Agunan Tunai</td>
				<td ><div style="width:500px;border:1px solid black;padding:1px;"><? echo $jenisjaminan;?></div></td>
			</tr>
			<tr>
				<td style="width:250px;padding-left:20px;">Nomor Rekening</td>
				<td ><div style="width:500px;border:1px solid black;padding:1px;"><? echo $nomorrekening;?></div></td>
			</tr>
			<tr>
				<td style="width:250px;padding-left:20px;">Atas Nama</td>
				<td ><div style="width:500px;border:1px solid black;padding:1px;"><? echo $atasnama;?></div></td>
			</tr>
			<tr>
				<td style="width:250px;padding-left:20px;">Nominal</td>
				<td ><div style="width:500px;border:1px solid black;padding:1px;"><? echo $nominal;?></div></td>
			</tr>
			<tr>
				<td style="width:250px;padding-left:20px;">Suku bunga</td>
				<td ><div style="width:500px;border:1px solid black;padding:1px;"><? echo $sukubunga;?> %</div></td>
			</tr>
			<tr>
				<td style="width:250px;padding-left:20px;">Jangka waktu</td>
				<td ><div style="width:500px;border:1px solid black;padding:1px;"><? echo $jangkawaktu;?> Bulan</div></td>
			</tr>
			<tr>
				<td style="width:250px;padding-left:20px;">Jatuh tempo</td>
				<td ><div style="width:500px;border:1px solid black;padding:1px;"><? echo $jatuhtempo;?></div></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<?
				}
			?>
		</table>
	</td>
</tr>
<tr>
	<td colspan="2">&nbsp;</td>
</tr>
<?php
	$tampil = "0";
	$colid = "";
	$jeniscol = "";
	$rowcountjaminan = 0;
	$tsql = "SELECT * FROM Tbl_Cust_MasterCol where ap_lisregno = '$Custnomid' AND FLAGDELETE = '0' AND FLAGINSERT = '1' AND GROUP_COL = 'N'";
	$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	$params = array(&$_POST['query']);
	$a = sqlsrv_query($conn, $tsql, $params, $cursorType);

	if ( $a === false)
	die( FormatErrors( sqlsrv_errors() ) );
	
	if(sqlsrv_has_rows($a))
	{  
		$tampil = "1";
		$rowcountjaminan = sqlsrv_num_rows($a);
		while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
		{
			if($colid == "")
			{
				$colid = $row['col_id'];
				$jeniscol = $row['cust_jeniscol'];
			}
			else
			{
				$colid = $colid."|".$row['col_id'];
				$jeniscol = $jeniscol."|".$row['cust_jeniscol'];
			}
		}
?>
<tr>
	<td colspan="2" style="text-align:left;font-weight:bold;padding-left:20px;">Agunan Non-Tunai</td>
</tr>
<tr>
	<td colspan="2">&nbsp;</td>
</tr>
<?
	}	
?>

<tr>
	<td colspan="2">
		<table width = "100%" align = "center" border = "0">
			<?
			$arraycolid = explode("|", $colid);
			$arrayjeniscol = explode("|", $jeniscol);
			$jenisjaminan = "";
			$nilaitotal = 0;
			$nilailikuidasi = 0;
			
			for($i=0; $i<$rowcountjaminan; $i++)
			{
				$tsql = "SELECT * FROM TblCollateralType where col_code = '$arrayjeniscol[$i]' AND col_active = 'Y'";
				
				$a = sqlsrv_query($conn, $tsql, $params, $cursorType);

				if ( $a === false)
				die( FormatErrors( sqlsrv_errors() ) );
				
				if(sqlsrv_has_rows($a))
				{ 	
					while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
					{
						$jenisjaminan = $row['col_name'];
					}
				}
				
				//Tanah dan bangunan
				$alamatjaminan1 = "";
				$alamatjaminan2 = "";
				$alamatjaminan3 = "";
				$kepemilikan = "";
				$atasnama = "";
				$buktikepemilikan = "";

				$tsql = "SELECT (SELECT REL_DESC FROM RFRELATION WHERE REL_CODE = COL_RELCODE) AS HUBUNGAN,* FROM TBL_COL_LAND where col_id = '$arraycolid[$i]'";
				$a = sqlsrv_query($conn, $tsql, $params, $cursorType);
				if ( $a === false)
				die( FormatErrors( sqlsrv_errors() ) );
				
				if(sqlsrv_has_rows($a))
				{ 	
					while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
					{
						$alamatjaminan1 = $row["col_addr1"];
						$alamatjaminan2 = $row["col_addr2"];
						$alamatjaminan3 = $row["col_addr3"];
						$kepemilikan = $row["HUBUNGAN"];
						$atasnama = $row["col_certatasnama"];
						$buktikepemilikan = $row["col_certno"];

					}
				}
				
				$tsql = "SELECT (SELECT REL_DESC FROM RFRELATION WHERE REL_CODE = COL_RELCODE) AS HUBUNGAN,* FROM TBL_COL_KIOS where col_id = '$arraycolid[$i]'";
				$a = sqlsrv_query($conn, $tsql, $params, $cursorType);
				if ( $a === false)
				die( FormatErrors( sqlsrv_errors() ) );
				
				if(sqlsrv_has_rows($a))
				{ 	
					while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
					{
						$alamatjaminan1 = "-";
						$alamatjaminan2 = "-";
						$alamatjaminan3 = "-";
						$kepemilikan = $row["HUBUNGAN"];
						$atasnama = $row["col_certatasnama"];
						$buktikepemilikan = $row["col_certno"];
						
					}
				}
				
				$tsql = "SELECT (SELECT REL_DESC FROM RFRELATION WHERE REL_CODE = COL_RELCODE) AS HUBUNGAN,* FROM TBL_COL_RUKO where col_id = '$arraycolid[$i]'";
				$a = sqlsrv_query($conn, $tsql, $params, $cursorType);
				if ( $a === false)
				die( FormatErrors( sqlsrv_errors() ) );
				
				if(sqlsrv_has_rows($a))
				{ 	
					while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
					{
						$alamatjaminan1 = "-";
						$alamatjaminan2 = "-";
						$alamatjaminan3 = "-";
						$kepemilikan = $row["HUBUNGAN"];
						$atasnama = $row["col_certatasnama"];
						$buktikepemilikan = $row["col_certno"];
						
					}
				}
				
				$tsql = "SELECT (SELECT REL_DESC FROM RFRELATION WHERE REL_CODE = COL_RELCODE) AS HUBUNGAN,* FROM TBL_COL_RUKO where col_id = '$arraycolid[$i]'";
				$a = sqlsrv_query($conn, $tsql, $params, $cursorType);
				if ( $a === false)
				die( FormatErrors( sqlsrv_errors() ) );
				
				if(sqlsrv_has_rows($a))
				{ 	
					while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
					{
						$alamatjaminan1 = "-";
						$alamatjaminan2 = "-";
						$alamatjaminan3 = "-";
						$kepemilikan = $row["HUBUNGAN"];
						$atasnama = $row["col_certatasnama"];
						$buktikepemilikan = $row["col_certno"];
						
					}
				}
				
				$tsql = "SELECT * FROM TBL_COL_VEHICLE where col_id = '$arraycolid[$i]'";
				$a = sqlsrv_query($conn, $tsql, $params, $cursorType);
				if ( $a === false)
				die( FormatErrors( sqlsrv_errors() ) );
				
				if(sqlsrv_has_rows($a))
				{ 	
					while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
					{
						$alamatjaminan1 = "-";
						$alamatjaminan2 = "-";
						$alamatjaminan3 = "-";
						$kepemilikan = "-";
						$atasnama = "-";
						$buktikepemilikan = $row["col_bpkbno"];
						
					}
				}
				
				$linkcetak = "";
				
				$tsql = "SELECT * FROM Tbl_Col_Link where col_code = '$arrayjeniscol[$i]'";
				$a = sqlsrv_query($conn, $tsql, $params, $cursorType);
				if ( $a === false)
				die( FormatErrors( sqlsrv_errors() ) );
				
				if(sqlsrv_has_rows($a))
				{ 	
					while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
					{
						$linkcetak = $row["col_linkcetak"];
						
					}
				}
			
			?>
			<tr>
				<td style="width:250px;padding-left:20px;"></td>
				<td style="padding-left:120px;" align="right"><input type="button" style="background-color:blue;color:white;width:100px;font-size:10px" onclick="warukiiimage('<? echo $arraycolid[$i];?>', '<? echo $arrayjeniscol[$i];?>')" value="Gambar Appraisal" /><input type="button" style="background-color:blue;color:white;width:100px;font-size:10px" onclick="warukiicetak('<? echo $linkcetak;?>', '<? echo $arraycolid[$i];?>', '<? echo $arrayjeniscol[$i];?>')" value="Cetak Jaminan<? //echo $arrayjeniscol[$i];?>" /></td>
			</tr>
			<tr>
				<td style="width:250px;padding-left:20px;">Jenis Jaminan</td>
				<td ><div style="width:500px;border:1px solid black;padding:1px;"><? echo $jenisjaminan;?></div></td>
			</tr>
			<tr>
				<td style="width:250px;padding-left:20px;">Alamat Jaminan</td>
				<td ><div style="width:500px;border:1px solid black;padding:1px;"><? echo $alamatjaminan1;?></div></td>
			</tr>
			<tr>
				<td style="width:250px;padding-left:20px;"></td>
				<td ><div style="width:500px;border:1px solid black;padding:1px;"><? echo $alamatjaminan2;?></div></td>
			</tr>
			<tr>
				<td style="width:250px;padding-left:20px;"></td>
				<td ><div style="width:500px;border:1px solid black;padding:1px;"><? echo $alamatjaminan3;?></div></td>
			</tr>
			<tr>
				<td style="width:250px;padding-left:20px;">Kepemilikan</td>
				<td ><div style="width:500px;border:1px solid black;padding:1px;"><? echo $kepemilikan;?></div></td>
			</tr>
			<tr>
				<td style="width:250px;padding-left:20px;">Atas Nama</td>
				<td ><div style="width:500px;border:1px solid black;padding:1px;"><? echo $atasnama;?></div></td>
			</tr>
			<tr>
				<td style="width:250px;padding-left:20px;">Bukti Kepemilikan</td>
				<td ><div style="width:500px;border:1px solid black;padding:1px;"><? echo $buktikepemilikan;?></div></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
		<?
			$tsql = "select (select NILAI_TOTAL_IMB from APPRAISAL_TYPE1_PENILAIAN where COLMASTER_ID = COLLATERAL_BLD.COLMASTER_ID) AS TOTAL,(select NILAI_LIKUIDASI_IMB from APPRAISAL_TYPE1_PENILAIAN where COLMASTER_ID = COLLATERAL_BLD.COLMASTER_ID) AS LIKUIDASI,* from COLLATERAL_BLD where LISCOL_ID = '$arraycolid[$i]'";
			$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
			$params = array(&$_POST['query']);
			$a = sqlsrv_query($connapr, $tsql, $params, $cursorType);
			if ( $a === false)
			die( FormatErrors( sqlsrv_errors() ) );
			
			if(sqlsrv_has_rows($a))
			{ 	
				while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
				{
					$nilaitotal = $nilaitotal + $row["TOTAL"];
					$nilailikuidasi = $nilailikuidasi + $row["LIKUIDASI"];
				}
			}
			
			$tsql = "select (select NILAI_TANAH_TOTAL from APPRAISAL_TYPE6_PENILAIAN where COLMASTER_ID = COLLATERAL_LND.COLMASTER_ID) AS TOTAL,(select NILAI_LIKUIDASI from APPRAISAL_TYPE6_PENILAIAN where COLMASTER_ID = COLLATERAL_LND.COLMASTER_ID) AS LIKUIDASI,LISCOL_ID,* from COLLATERAL_LND where LISCOL_ID = '$arraycolid[$i]'";
			$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
			$params = array(&$_POST['query']);
			$a = sqlsrv_query($connapr, $tsql, $params, $cursorType);
			if ( $a === false)
			die( FormatErrors( sqlsrv_errors() ) );
			
			if(sqlsrv_has_rows($a))
			{ 	
				while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
				{
					$nilaitotal = $nilaitotal + $row["TOTAL"];
					$nilailikuidasi = $nilailikuidasi + $row["LIKUIDASI"];
				}
			}
			
			$tsql = "SELECT (SELECT NILAI_WAJAR_IMB FROM APPRAISAL_TYPE9_PENILAIAN WHERE COLMASTER_ID = COLLATERAL_LND.COLMASTER_ID) AS TOTAL,(SELECT NILAI_LIKUIDASI_IMB FROM APPRAISAL_TYPE9_PENILAIAN WHERE COLMASTER_ID = COLLATERAL_LND.COLMASTER_ID) AS LIKUIDASI,LISCOL_ID,* FROM COLLATERAL_LND WHERE LISCOL_ID = '$arraycolid[$i]'";
			$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
			$params = array(&$_POST['query']);
			$a = sqlsrv_query($connapr, $tsql, $params, $cursorType);
			if ( $a === false)
			die( FormatErrors( sqlsrv_errors() ) );
			
			if(sqlsrv_has_rows($a))
			{ 	
				while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
				{
					$nilaitotal = $nilaitotal + $row["TOTAL"];
					$nilailikuidasi = $nilailikuidasi + $row["LIKUIDASI"];
				}
			}
			
			$tsql = "SELECT (SELECT TOTAL_NILWAJAR FROM APPRAISAL_VHC where COLMASTER_ID = COLLATERAL_VHC.COLMASTER_ID) AS TOTAL,(SELECT NIL_LIKUIDASI FROM APPRAISAL_VHC where COLMASTER_ID = COLLATERAL_VHC.COLMASTER_ID) AS LIKUIDASI,* FROM COLLATERAL_VHC where LISCOL_ID = '$arraycolid[$i]'";
			$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
			$params = array(&$_POST['query']);
			$a = sqlsrv_query($connapr, $tsql, $params, $cursorType);
			if ( $a === false)
			die( FormatErrors( sqlsrv_errors() ) );
			
			if(sqlsrv_has_rows($a))
			{ 	
				while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
				{
					$nilaitotal = $nilaitotal + $row["TOTAL"];
					$nilailikuidasi = $nilailikuidasi + $row["LIKUIDASI"];
				}
			}
			}//end for
			numberFormat($nilaitotal);
				if($tampil == "1")
				{
		?>
			<tr>
				<td colspan="2" style="text-align:left;font-weight:bold;padding-left:20px;">Hasil Appraisal</td>
			</tr>
			<tr>
				<td style="width:250px;padding-left:20px;">Total Nilai Taksasi Jaminan</td>
				<td ><div style="width:500px;border:1px solid black;padding:1px;"><? echo numberFormat($nilaitotal);?></div></td>
			</tr>
			<tr>
				<td style="width:250px;padding-left:20px;">Total Nilai Likuidasi Jaminan</td>
				<td ><div style="width:500px;border:1px solid black;padding:1px;"><? echo numberFormat($nilailikuidasi);?></div></td>
			</tr>
		<?
				}
		?>
		</table>
	</td>
</tr>
<tr>
	<td colspan="2">&nbsp;</td>
</tr>
<tr>
	<td colspan="2">&nbsp;</td>
</tr>
<?php
	$colid = "";
	$jeniscol = "";
	$rowcountjaminan = 0;
	$tsql = "SELECT * FROM Tbl_Cust_MasterCol where ap_lisregno = '$Custnomid' AND FLAGDELETE = '0' AND FLAGINSERT = '1' AND GROUP_COL = 'L'";
	$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	$params = array(&$_POST['query']);
	$a = sqlsrv_query($conn, $tsql, $params, $cursorType);

	if ( $a === false)
	die( FormatErrors( sqlsrv_errors() ) );
	
	if(sqlsrv_has_rows($a))
	{  
		$rowcountjaminan = sqlsrv_num_rows($a);
		while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
		{
			if($colid == "")
			{
				$colid = $row['col_id'];
				$jeniscol = $row['cust_jeniscol'];
			}
			else
			{
				$colid = $colid."|".$row['col_id'];
				$jeniscol = $jeniscol."|".$row['cust_jeniscol'];
			}
		}
?>
<tr>
	<td colspan="2" style="text-align:left;font-weight:bold;padding-left:20px;">Agunan Lainnya</td>
</tr>
<tr>
	<td colspan="2">&nbsp;</td>
</tr>
<?
	}	
?>

<tr>
	<td colspan="2">
		<table width = "100%" align = "center" border = "0">
			<?
				$arraycolid = explode("|", $colid);
				$arrayjeniscol = explode("|", $jeniscol);
				$jenisjaminan = "";
				for($i=0; $i<$rowcountjaminan; $i++)
				{
				
				$tsql = "SELECT * FROM TblCollateralType where col_code = '$arrayjeniscol[$i]' AND col_active = 'Y'";
				
				$a = sqlsrv_query($conn, $tsql, $params, $cursorType);

				if ( $a === false)
				die( FormatErrors( sqlsrv_errors() ) );
				
				if(sqlsrv_has_rows($a))
				{ 	
					while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
					{
						$jenisjaminan = $row['col_name'];
					}
				}
				
				$nomordokumen = "";
				$nilaijaminan = "";
				$tsql = "SELECT * FROM tbl_col_lainnya where col_id = '$arraycolid[$i]'";
				$a = sqlsrv_query($conn, $tsql, $params, $cursorType);
				if ( $a === false)
				die( FormatErrors( sqlsrv_errors() ) );
				
				if(sqlsrv_has_rows($a))
				{ 	
					while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
					{
						$nomordokumen = $row["col_nomordokumen"];
						$nilaijaminan = $row["col_nilaijaminan"];
					}
				}
			
			?>
			<tr>
				<td style="width:250px;padding-left:20px;">Jenis Agunan Tunai</td>
				<td ><div style="width:500px;border:1px solid black;padding:1px;"><? echo $jenisjaminan;?></div></td>
			</tr>
			<tr>
				<td style="width:250px;padding-left:20px;">Nomor Dokumen</td>
				<td ><div style="width:500px;border:1px solid black;padding:1px;"><? echo $nomordokumen;?></div></td>
			</tr>
			<tr>
				<td style="width:250px;padding-left:20px;">Nilai Jaminan</td>
				<td ><div style="width:500px;border:1px solid black;padding:1px;"><? echo $nilaijaminan;?></div></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<?
				}
			?>
		</table>
	</td>
</tr>
<tr>
	<td colspan="2">&nbsp;</td>
</tr>
<tr>
	<td colspan="2">
	<?
		if($action == "A")
		{
		
		}
		else
		{
	?>
		<div align="center"><input type='button' class='blue' style='width:115px;' value='Approve' onclick='warukii();'></div>
	<?
		}
	?>
	</td>
</tr>
<?
}
else
{
?>
<tr>	
	<td colspan="2" align="center"><font size=2px; color="red" style="padding-left : 1px;"><i>Belum di appraisal</i></font></td>
</tr>
<tr>	
	<td colspan="2" align="center"><font size=2px; color="red" style="padding-left : 1px;">&nbsp;</font></td>
</tr>
<tr>	
	<td colspan="2" align="center"><font size=2px; color="blue" style="padding-left : 1px;"><a href="../APPRAISAL/viewaprdbentryTL_v2.php?userid=<? echo $userid?>&userpwd=<? echo $userpwd?>&userbranch=<? echo $userbranch?>&userregion=<? echo $userregion?>&userwfid=<? echo $userwfid?>&userpermission=<? echo $userpermission?>&custnomid=<? echo $custnomid?>&buttonaction=<? echo $buttonaction?>&random=<? echo time()?>">Lihat Data Agunan</a></font></td>
</tr>
<?	
}
?>
<tr>
	<td colspan="2">&nbsp;</td>
</tr>
<input type="hidden" name="userpermission" value='<? echo $userpermission; ?>'></div>	
<input type="hidden" name="act" value='<? echo $userid; ?>'>
<input type="hidden" name="userid"  value='<? echo $userid; ?>'>
<input type="hidden" name="userpwd" value='<? echo $userpwd; ?>'>
<input type="hidden" name="userbranch" value='<? echo $userbranch; ?>'>
<input type="hidden" name="userregion" value='<? echo $userregion; ?>'>
<input type="hidden" name="buttonaction" value='<? echo $buttonaction; ?>'>
<input type="hidden" name="userwfid" value='APR'>
<input type="hidden" id="custnomid" name="custnomid" value='<? echo $Custnomid; ?>'>
<input type="hidden" id="custfullname" name="custfullname" value='<? echo $custfullname; ?>'>
<input type='hidden' id='indra' name='indra' value=''>
</form>
<tr>
	<td colspan="2"><?require("../../requirepage/btnprint.php");?></td>
</tr>
</table>
<script type="text/javascript">
	function warukii() {		
		var custnomid=$("#custnomid").val();
		
		document.formentry.indra.value = "APPROVERESPONSE";
		document.formentry.target = "utama";
		document.formentry.action = "doaprdbentry_v2.php";
		submitform = window.confirm("<? echo $confmsg;?>")
		if (submitform == true)
		{
			document.formentry.submit();
			return true;
		}
		else
		{
			return false;
		} 
	}
	
	function warukiicetak(link, liscolid, jenis) {
		var a="cetakresponse";
		var link = link;
		var jenis = jenis;
		var liscolid = liscolid;
		var custnomid=$("#custnomid").val();
		
		//alert(liscolid);
		window.open("../APPRAISAL/"+link+"?liscolid="+liscolid+"&custnomid="+custnomid+"", 'popUpWindow','height=500,width=800,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
		
	}
	
	function warukiiimage(liscolid, jenis) {
		var a="imageresponse";
		var link = "viewresponseaprimage_v2.php";
		var jenis = jenis;
		var liscolid = liscolid;
		var custnomid=$("#custnomid").val();
		
		//alert(liscolid);
		window.open("../APPRAISAL/"+link+"?liscolid="+liscolid+"&custnomid="+custnomid+"", 'popUpWindow','height=500,width=800,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
		
	}
	
	function yuriacetak(liscolid, jenis) {
		var a="cetakresponse";
		var link = "cetakcash_v2.php";
		var jenis = jenis;
		var liscolid = liscolid;
		var custnomid=$("#custnomid").val();
		
		//alert(jenis);
		window.open("../APPRAISAL/"+link+"?liscolid="+liscolid+"&custnomid="+custnomid+"&jeniscol="+jenis+"", 'popUpWindow','height=500,width=800,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
		
	}
</script>
<script language="Javascript">
	name="utama";
</script>
</body>
</body>
</html>