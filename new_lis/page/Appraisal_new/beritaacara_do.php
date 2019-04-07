<?php
require ("../../lib/open_con.php");
require ("../../lib/formatError.php");
require ("../../requirepage/parameter.php");

if(isset($_REQUEST['act'])){
		$act = $_REQUEST['act'];
}else{
	$act = "";
}

if($act=="")
{
	$custnomid = $_POST["custnomid"];
	$tanggal_beritaacara = $_POST["tanggal_beritaacara"];
	$nama_petugas1 = $_POST["nama_petugas1"];
	$jabatan_petugas1 = $_POST["jabatan_petugas1"];
	$nama_petugas2 = $_POST["nama_petugas2"];
	$jabatan_petugas2 = $_POST["jabatan_petugas2"];
	
	
	
	$strsql = "DELETE FROM berita_acara_trans2 where custnomid = '$custnomid' DELETE FROM berita_acara_trans where custnomid = '$custnomid'
				INSERT INTO berita_acara_trans2 (custnomid, tanggal_beritaacara, nama_petugas1, jabatan_petugas1, nama_petugas2, jabatan_petugas2) VALUES
				('$custnomid', '$tanggal_beritaacara', '$nama_petugas1', '$jabatan_petugas1', '$nama_petugas2', '$jabatan_petugas2')
	";
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
	
	$strsqlv02="SELECT * FROM berita_acara_detail WHERE flag = '1'";
	$sqlconv02 = sqlsrv_query($conn, $strsqlv02);
	if ( $sqlconv02 === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlconv02))
	{
		while($rowsv02 = sqlsrv_fetch_array($sqlconv02, SQLSRV_FETCH_ASSOC))
		{
			$detail_code = $rowsv02['code'];
			$kesiapan = $_POST["kesiapan".$detail_code];
			$kondisi = $_POST["kondisi".$detail_code];
			$catatan = $_POST["catatan".$detail_code];
			$keterangan = $_POST["keterangan".$detail_code];
			
			$strsql = "INSERT INTO berita_acara_trans (custnomid, detail_code, kesiapan, kondisi, catatan, keterangan, flag)
						VALUES ('$custnomid', '$detail_code', '$kesiapan', '$kondisi', '$catatan', '$keterangan', '1')
				";
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
	
	header("Location:beritaacara.php?custnomid=$custnomid&userwfid=$userwfid&userpermission=$userpermission&buttonaction=$buttonaction&userbranch=$userbranch&userregion=$userregion&userid=$userid&userpwd=$userpwd");
}
else if($act=="saveflow")
{
	require ("../../requirepage/do_saveflow.php");	
	
	header("location:../flow.php?userid=$userid&userpwd=$userpwd&userbranch=$userbranch&userregion=$userregion&userwfid=$userwfid");
}



?>