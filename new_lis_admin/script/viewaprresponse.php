<?php
	$custnomid=$_GET['custnomid'];
	$custjeniscol = $_GET['custjeniscol'];

    
require ("../lib/open_con.php");
?>

<HTML>
   <HEAD>
      <META http-equiv=Content-Type content='text/html; charset=iso-8859-1'>
      <META http-equiv='Pragma' content='no-cache'>
      <META content='MSHTML 5.50.4134.100' name=GENERATOR>
      <TITLE>APPRAISAL DATA ENTRY</TITLE>
      <script type="text/javascript" src="../lib/datetimepicker_css.js"></script>
      <Script Language="JavaScript">
	function cekthis()
	{
           submitform = window.confirm("Submit Data ?")
           if (submitform == true)
           {
	            document.formsubmit.submit();
              return true;
           }
           else
           {
              return false;
           }
	}
      </Script>
</HEAD>
<BODY bgcolor=#FFFFCC>
<?php
if (isset($_GET["custnomid"]) && $_GET["custnomid"]!="")  { // jika querystring tbl ada
	$Custnomid = $_GET["custnomid"]; 
?>

<?php
	if($custjeniscol == "V01")
	{
?>
	<?
		$tsql = "SELECT distinct * FROM tbl_COL_Vehicle where ap_lisregno = '$custnomid'";

		$a = sqlsrv_query($conn, $tsql);

		if ( $a === false)
			die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($a))
		{  
			while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
			{ 
			
		$ysql = "SELECT distinct cast(col_stnkexp as varchar) as col_stnkexp, cast(col_fakturtgl as varchar) as col_fakturtgl, cast(col_bpkbtgl as varchar) as col_bpkbtgl, cast(col_appraisdate as varchar) as col_appraisdate FROM tbl_COL_Vehicle where ap_lisregno = '$custnomid'";

		$b = sqlsrv_query($conn, $ysql);

		if ( $b === false)
			die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($b))
		{  
			if($rowcast = sqlsrv_fetch_array($b, SQLSRV_FETCH_ASSOC))
			{ 
	?>
		<table width = "500" align = "center" border = "0">
			<tr>
				<td width=100% colspan = "3" style="font-size:20;"><strong>Collateral Vehicle</strong></td>			
			</tr>
			</br>
			<tr>
				<td width=40%>Application Number</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['ap_lisregno'];?></td>				
			</tr>
			<tr>
				<td width=40%>Collateral ID   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_id'];?></td>				
			</tr>
			<tr>
				<td width=40%>Address 1</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_addr1'];?></td>				
			</tr>
			<tr>
				<td width=40%>Address 2</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_addr2'];?></td>				
			</tr>
			<tr>
				<td width=40%>Address 3</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_addr3'];?></td>				
			</tr>
			<tr>
				<td width=40%>Kodepos   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_kodepos'];?></td>				
			</tr>
			<tr>
				<td width=40%>Nopol   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_nopol'];?></td>				
			</tr>
			<tr>
				<td width=40%>STNK No   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_stnk_no'];?></td>				
			</tr>
			<tr>
				<td width=40%>STNK Exp   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowcast['col_stnkexp'];?></td>				
			</tr>
			<tr>
				<td width=40%>Faktur No  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_fakturno'];?></td>				
			</tr>
			<tr>
				<td width=40%>Faktur Tgl   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowcast['col_fakturtgl'];?></td>				
			</tr>
			<tr>
				<td width=40%>BPKB No  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_bpkbno'];?></td>				
			</tr>
			<tr>
				<td width=40%>BPKB Tgl   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowcast['col_bpkbtgl'];?></td>				
			</tr>
			<tr>
				<td width=40%>Condition   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_condition'];?></td>				
			</tr>
			<tr>
				<td width=40%>Type</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_type'];?></td>				
			</tr>
			<tr>
				<td width=40%>Model</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_model'];?></td>				
			</tr>
			<tr>
				<td width=40%>Merk</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_merk'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tahun Pembuatan</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_tahunpembuatan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Jenis Kendaran</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_jeniskendaran'];?></td>				
			</tr>
			<tr>
				<td width=40%>Silinder</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_silinder'];?></td>				
			</tr>
			<tr>
				<td width=40%>Warna</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_warna'];?></td>				
			</tr>
			<tr>
				<td width=40%>No Rangka</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_norangka'];?></td>				
			</tr>
			<tr>
				<td width=40%>No Mesin</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_nomesin'];?></td>				
			</tr>
			<tr>
				<td width=40%>BPKB Nama  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_bpkbnama'];?></td>				
			</tr>
			<tr>
				<td width=40%>BPKB Addr 1  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_bpkbaddr1'];?></td>				
			</tr>
			<tr>
				<td width=40%>BPKB Addr 2  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_bpkbaddr2'];?></td>				
			</tr>
			<tr>
				<td width=40%>BPKB Addr 3  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_bpkbaddr3'];?></td>				
			</tr>
			<tr>
				<td width=40%>Perlengkapan</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_perlengkapan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Desc</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_desc'];?></td>				
			</tr>
			<tr>
				<td width=40%>Nilai Wajar</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_nilaiwajar'];?></td>				
			</tr>
			<tr>
				<td width=40%>Nilai Likuidasi</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_nilailikuidasi'];?></td>				
			</tr>
			<tr>
				<td width=40%>Safe Margin</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_safemargin'];?></td>				
			</tr>
			<tr>
				<td width=40%>Appraiser</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_appraiser'];?></td>				
			</tr>
			<tr>
				<td width=40%>Appraise Date </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowcast['col_appraisdate'];?></td>				
			</tr>
			<?
				if ($row['col_MK_CODE'] == "MK_M")
				{
					$mkcode = "Marketable";
				}
				else if ($row['col_MK_CODE'] == "MK_T")
				{
					$mkcode = "Tidak Marketable";				
				}
				else{}
			?>
			<tr>
				<td width=40%>MK CODE</td>
				<td width=10%>:</td>
				<td width=50%><? echo $mkcode;?></td>				
			</tr>
			
		</table>
	<?
			} //tutup cast
		}
			}
		}
	?>
<?		
	}
	if($custjeniscol == "TAN")
	{
		$tsql = "SELECT distinct * FROM tbl_COL_Land where ap_lisregno = '$custnomid' and col_id like '$custnomid"."LND%'";
		$a = sqlsrv_query($conn, $tsql);

		if ( $a === false)
			die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($a))
		{  
			while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
			{ 

		$ysql = "SELECT distinct cast(col_certdate as varchar) as col_certdate, cast(col_certdue as varchar) as col_certdue, cast(col_haktanggungantgl as varchar) as col_haktanggungantgl, cast(col_appraisdate as varchar) as col_appraisdate FROM tbl_COL_Land where ap_lisregno = '$custnomid' and col_id like '$custnomid"."LND%'";
		$b = sqlsrv_query($conn, $ysql);

		if ( $b === false)
			die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($b))
		{  
			if($rowcast = sqlsrv_fetch_array($b, SQLSRV_FETCH_ASSOC))
			{ 

?>
		<table width = "500" align = "center" border = "0">
			<tr>
				<td width=100% colspan = "3" style="font-size:20;"><strong>Collateral Land</strong></td>			
			</tr>
			</br>
			<tr>
				<td width=40%>Application Number  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['ap_lisregno'];?></td>				
			</tr>
			<tr>
				<td width=40%>Collateral ID   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_id'];?></td>				
			</tr>
			<tr>
				<td width=40%>Alamat Jaminan   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_addr1'];?></td>				
			</tr>
			<tr>
				<td width=40%>Alamat Calon Debitur   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_addr2'];?></td>				
			</tr>
			<tr>
				<td width=40%>Address 3   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_addr3'];?></td>				
			</tr>
			<tr>
				<td width=40%>Kodepos</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_kodepos'];?></td>				
			</tr>
			<tr>
				<td width=40%>Certificate Type </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_certtype'];?></td>				
			</tr>
			<tr>
				<td width=40%>Certificate No</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_certno'];?></td>				
			</tr>
			<tr>
				<td width=40%>Pemegang Hak Atas Sertifikat   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_certatasnama'];?></td>				
			</tr>
			<tr>
				<td width=40%>Luas Tanah   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_certluas'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal Terbit Sertifikat </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowcast['col_certdate'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal Jatuh Tempo Sertifikat  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowcast['col_certdue'];?></td>				
			</tr>
			<tr>
				<td width=40%>Relcode   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_relcode'];?></td>				
			</tr>
			<tr>
				<td width=40%>Nomor Hak Tanggungan </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_haktanggungan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal Hak Tanggungan</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowcast['col_haktanggungantgl'];?></td>				
			</tr>
			<tr>
				<td width=40%>Identification   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_identification'];?></td>				
			</tr>
			<tr>
				<td width=40%>Topografi   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_topografi'];?></td>				
			</tr>
			<tr>
				<td width=40%>Bentuk Tanah</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_bentuktanah'];?></td>				
			</tr>
			<tr>
				<td width=40%>Panjang Tanah</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_panjangtnh'];?></td>				
			</tr>
			<tr>
				<td width=40%>Lebar Tanah</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_lebartnh'];?></td>				
			</tr>
			<tr>
				<td width=40%>Arah Depan</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_arahdepan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Arah Belakang</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_arahbelakang'];?></td>				
			</tr>
			<tr>
				<td width=40%>Arah Kanan</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_arahkanan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Arah Kiri</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_arahkiri'];?></td>				
			</tr>
			<tr>
				<td width=40%>Batas Depan</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_batasdepan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Batas Belakang</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_batasbelakang'];?></td>				
			</tr>
			<tr>
				<td width=40%>Batas Kanan</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_bataskanan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Batas Kiri</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_bataskiri'];?></td>				
			</tr>
			<tr>
				<td width=40%>Banjir</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_banjir'];?></td>				
			</tr>
			<tr>
				<td width=40%>NJOP Year </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_njopyear'];?></td>				
			</tr>
			<tr>
				<td width=40%>NJOP Val  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_njopval'];?></td>				
			</tr>
			<tr>
				<td width=40%>Remark   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_remark'];?></td>				
			</tr>
			<tr>
				<td width=40%>Safe Margin   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_safemargin'];?></td>				
			</tr>
			<tr>
				<td width=40%>Appraiser   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_appraiser'];?></td>				
			</tr>
			<tr>
				<td width=40%>Appraise Date   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowcast['col_appraisdate'];?></td>				
			</tr>
			<tr>
				<td width=40%>NILAIWAJAR  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['COL_NILAIWAJAR'];?></td>				
			</tr>
			<tr>
				<td width=40%>NILAILIKUIDASI   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['COL_NILAILIKUIDASI'];?></td>				
			</tr>
			<?
				if ($row['COL_MK_CODE'] == "MK_M")
				{
					$mkcode = "Marketable";
				}
				else if ($row['COL_MK_CODE'] == "MK_T")
				{
					$mkcode = "Tidak Marketable";				
				}
				else{}
			?>
			<tr>
				<td width=40%>MK CODE</td>
				<td width=10%>:</td>
				<td width=50%><? echo $mkcode;?></td>				
			</tr>
			
		</table>

	<?
			} //tutup cast
		}
			}
		}
	?>

<?
	}
	if($custjeniscol == "BA1")
	{ 
		$tsql = "SELECT * FROM tbl_COL_Land where ap_lisregno = '$custnomid' and col_id like '$custnomid"."BLDLND%'";
		$a = sqlsrv_query($conn, $tsql);

		if ( $a === false)
			die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($a))
		{  
			while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
			{ 

		$ysql = "SELECT cast(col_certdate as varchar) as col_certdate, cast(col_certdue as varchar) as col_certdue, cast(col_haktanggungantgl as varchar) as col_haktanggungantgl, cast(col_appraisdate as varchar) as col_appraisdate FROM tbl_COL_Land where ap_lisregno = '$custnomid' and col_id like '$custnomid"."BLDLND%'";
		$b = sqlsrv_query($conn, $ysql);

		if ( $b === false)
			die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($b))
		{  
			if($rowcast = sqlsrv_fetch_array($b, SQLSRV_FETCH_ASSOC))
			{ 
	

?>
		<form id="form1" name="form1" method="get" action="doviewtlapprove.php"> 
		<table width = "500" align = "center" border = "0">
			<tr>
				<td width=100% colspan = "3" style="font-size:20;"><strong>Collateral Building (Land)</strong></td>			
			</tr>
			</br>
			<tr>
				<td width=40%>Application Number   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['ap_lisregno'];?></td>				
			</tr>
			<tr>
				<td width=40%>Collateral ID  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_id'];?></td>				
			</tr>
			<tr>
				<td width=40%>Alamat Jaminan  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_addr1'];?></td>				
			</tr>
			<tr>
				<td width=40%>Alamat Calon Debitur  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_addr2'];?></td>				
			</tr>
			<tr>
				<td width=40%>Address 3  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_addr3'];?></td>				
			</tr>
			<tr>
				<td width=40%>Kodepos </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_kodepos'];?></td>				
			</tr>
			<tr>
				<td width=40%>Certificate Type   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_certtype'];?></td>				
			</tr>
			<tr>
				<td width=40%>Certificate No  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_certno'];?></td>				
			</tr>
			<tr>
				<td width=40%>Pemegang Hak Atas Sertifikat   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_certatasnama'];?></td>				
			</tr>
			<tr>
				<td width=40%>Luas Tanah   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_certluas'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal Terbit Sertifikat   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowcast['col_certdate'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal Jatuh Tempo Sertifikat  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowcast['col_certdue'];?></td>				
			</tr>
			<tr>
				<td width=40%>Relcode   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_relcode'];?></td>				
			</tr>
			<tr>
				<td width=40%>Nomor Hak Tanggungan  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_haktanggungan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal Hak Tanggungan  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowcast['col_haktanggungantgl'];?></td>				
			</tr>
			<tr>
				<td width=40%>Identification   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_identification'];?></td>				
			</tr>
			<tr>
				<td width=40%>Topografi   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_topografi'];?></td>				
			</tr>
			<tr>
				<td width=40%>Bentuk Tanah   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_bentuktanah'];?></td>				
			</tr>
			<tr>
				<td width=40%>Panjang Tanah   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_panjangtnh'];?></td>				
			</tr>
			<tr>
				<td width=40%>Lebar Tanah   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_lebartnh'];?></td>				
			</tr>
			<tr>
				<td width=40%>Arah Depan   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_arahdepan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Arah Belakang</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_arahbelakang'];?></td>				
			</tr>
			<tr>
				<td width=40%>Arah Kanan   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_arahkanan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Arah Kiri   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_arahkiri'];?></td>				
			</tr>
			<tr>
				<td width=40%>Batas Depan   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_batasdepan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Batas Belakang   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_batasbelakang'];?></td>				
			</tr>
			<tr>
				<td width=40%>Batas Kanan   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_bataskanan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Batas Kiri   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_bataskiri'];?></td>				
			</tr>
			<tr>
				<td width=40%>Banjir   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_banjir'];?></td>				
			</tr>
			<tr>
				<td width=40%>NJOP Year   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_njopyear'];?></td>				
			</tr>
			<tr>
				<td width=40%>NJOP Val   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_njopval'];?></td>				
			</tr>
			<tr>
				<td width=40%>Remark  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_remark'];?></td>				
			</tr>
			<tr>
				<td width=40%>Safe Margin   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_safemargin'];?></td>				
			</tr>
			<tr>
				<td width=40%>Appraiser   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_appraiser'];?></td>				
			</tr>
			<tr>
				<td width=40%>Appraise Date   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowcast['col_appraisdate'];?></td>				
			</tr>
			<tr>
				<td width=40%>NILAIWAJAR  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['COL_NILAIWAJAR'];?></td>				
			</tr>
			<tr>
				<td width=40%>NILAILIKUIDASI   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['COL_NILAILIKUIDASI'];?></td>				
			</tr>
			<tr>
				<td width=40%>MK_CODE   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['COL_MK_CODE'];?></td>				
			</tr>


				<?
			} //tutup cast
		}
			}
		}
	?>

	<?
		//----------------------------------------------------------------------- land and building
		
		$tsql2 = "SELECT * FROM tbl_COL_Building where ap_lisregno = '$custnomid'";
		$a2 = sqlsrv_query($conn, $tsql2);

		if ( $a2 === false)
			die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($a2))
		{  
			while($row2 = sqlsrv_fetch_array($a2, SQLSRV_FETCH_ASSOC))
			{ 

		$ysql2 = "SELECT cast(col_imbdate as varchar) as col_imbdate,  cast(col_appraisdate as varchar) as col_appraisdate FROM tbl_COL_Building where ap_lisregno = '$custnomid'";
		$b2 = sqlsrv_query($conn, $ysql2);

		if ( $b2 === false)
			die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($b2))
		{  
			if($rowcast2 = sqlsrv_fetch_array($b2, SQLSRV_FETCH_ASSOC))
			{ 

?>
		<form id="form1" name="form1" method="get" action="doviewtlapprove.php"> 
		<table width = "500" align = "center" border = "0">
			<tr>
				<td width=100% colspan = "3" style="font-size:20;"><strong>Collateral Building (Building)</strong></td>			
			</tr>
			</br>
			<tr>
				<td width=40%>Application Number   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['ap_lisregno'];?></td>				
			</tr>
			<tr>
				<td width=40%>Collateral ID  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_id'];?></td>				
			</tr>
			<tr>
				<td width=40%>Address 1  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_addr1'];?></td>				
			</tr>
			<tr>
				<td width=40%>Address 2  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_addr2'];?></td>				
			</tr>
			<tr>
				<td width=40%>Address 3  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_addr3'];?></td>				
			</tr>
			<tr>
				<td width=40%>Kodepos </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_kodepos'];?></td>				
			</tr>
			<tr>
				<td width=40%>Collateral Type    </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_type'];?></td>				
			</tr>
			<tr>
				<td width=40%>IMB No  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_imbno'];?></td>				
			</tr>
			<tr>
				<td width=40%>IMB Date  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowcast2['col_imbdate'];?></td>				
			</tr>
			<tr>
				<td width=40%>IMB Luas    </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_imbluas'];?></td>				
			</tr>
			<tr>
				<td width=40%>NJOP Year   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_njopyear'];?></td>				
			</tr>
			<tr>
				<td width=40%>NJOP Val  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_njopval'];?></td>				
			</tr>
			<tr>
				<td width=40%>Rangka   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_rangka'];?></td>				
			</tr>
			<tr>
				<td width=40%>Lantai   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_lantai'];?></td>				
			</tr>
			<tr>
				<td width=40%>Dinding  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_dinding'];?></td>				
			</tr>
			<tr>
				<td width=40%>Langit     </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_langit'];?></td>				
			</tr>
			<tr>
				<td width=40%>Rangka Atap   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_rangkaatap'];?></td>				
			</tr>
			<tr>
				<td width=40%>Jumlah Lantai   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_jmllantai'];?></td>				
			</tr>
			<tr>
				<td width=40%>Pembagian Ruang     </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_pembagianruang'];?></td>				
			</tr>
			<tr>
				<td width=40%>Dihuni Oleh   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_dihunioleh'];?></td>				
			</tr>
			<tr>
				<td width=40%>Fasilitas Building     </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_fasilitasbld'];?></td>				
			</tr>
			<tr>
				<td width=40%>Description  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_desc'];?></td>				
			</tr>
			<tr>
				<td width=40%>Pencapaian   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_pencapaian'];?></td>				
			</tr>
			<tr>
				<td width=40%>Jalan     </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_jalan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Lebar Jalan    </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_lebarjalan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Kondisi Jalan   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_kondisijalan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Arah Jalan     </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_arahjalan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Intensitas Jalan    </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_intensitasjalan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Fasilitas Umum   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_fasilitasumum'];?></td>				
			</tr>
			<tr>
				<td width=40%>Fasilitas Angkutan    </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_fasilitasangkutan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Object Penting   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_objekpenting'];?></td>				
			</tr>
			<tr>
				<td width=40%>Peruntukan Lingkungan  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_peruntukanlingkungan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Safe Margin   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_safemargin'];?></td>				
			</tr>
			<tr>
				<td width=40%>Appraiser   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['col_appraiser'];?></td>				
			</tr>
			<tr>
				<td width=40%>Appraise Date   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowcast2['col_appraisdate'];?></td>				
			</tr>
			<tr>
				<td width=40%>NILAIWAJAR  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['COL_NILAIWAJAR'];?></td>				
			</tr>
			<tr>
				<td width=40%>NILAILIKUIDASI   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['COL_NILAILIKUIDASI'];?></td>				
			</tr>
			<tr>
				<td width=40%>MK_CODE   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['COL_MK_CODE'];?></td>				
			</tr>


				<?
			} //tutup cast
		}
			}
		}
	?>

						
		</table>
		</form>
	
	
<?		
	}
	if($custjeniscol == "V02")
	{
		echo $custnomid;
	}
?>

<?php
} else { // else dari if (isset($_GET["tbl"]) && $_GET["tbl"]!="")
?>
<table width="500" align="center">
	<tr>
		<td>
			Status Back to AO
		</td>
	</tr>
</table>

<?
}
?>


</BODY>
</HTML>
<?
   	require("../lib/close_con.php");
?>