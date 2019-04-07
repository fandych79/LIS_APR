<?php

require ("../../lib/open_conAPPR.php");
require ("../../lib/formatError.php");
require ("../../requirepage/parameter.php");
require ("../../requirepage/security.php");

$_kesiapan = $_POST['_kesiapan'];
$_kondisi = $_POST['_kondisi'];
$_catatan = $_POST['_catatan'];
$_keterangan = $_POST['_keterangan'];
$custnomid = $_POST['custnomid'];
$jeniscol = $_POST['jeniscol'];
$_tgl = $_POST['_tgl'];
$_nama1 = $_POST['_nama1'];
$_nama2 = $_POST['_nama2'];
$_jabatan1 = $_POST['_jabatan1'];
$_jabatan2 = $_POST['_jabatan2'];
$col_id = $_POST['col_id'];

//echo $custnomid;
//echo $jeniscol;
print_r($_kesiapan);
print_r($_kondisi);
print_r($_catatan);
print_r($_keterangan);


$tsql = "select _idx from ms_perihal where _collateral_id = '".$jeniscol."' and _flag = '0'";
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);
$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
$rowCount = sqlsrv_num_rows($sqlConn);

if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
if(sqlsrv_has_rows($sqlConn))
{
	$no=0;
	while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
	{
		echo $row['_idx'].'<br/>';
		
		$strsql="	delete from tr_perihal where _idx='".$row['_idx']."' and _ap_lisregno='".$custnomid."'
				
				INSERT INTO [dbo].[tr_perihal]
				   ([_idx]
				   ,[_ap_lisregno]
				   ,[_kesiapan]
				   ,[_kondisi]
				   ,[_catatan]
				   ,[_keterangan])
			 VALUES
				   (
				   '".$row['_idx']."',
				   '".$custnomid."',
				   '".$_kesiapan[$no]."',
				   '".$_kondisi[$no]."',
				   '".$_catatan[$no]."',
				   '".$_keterangan[$no]."'
				   )
				";
				
			$no++;
									
				$stmt = sqlsrv_prepare( $conn, $strsql);
				if(!$stmt)
				{
					echo "Error in preparing statement.\n";
					die( print_r( sqlsrv_errors(), true));
					return false;
				}
				if(!sqlsrv_execute( $stmt))
				{
					echo "Cannot insert table ". $strsql;
					die( print_r( sqlsrv_errors(), true));
					return false;
				}	
				sqlsrv_free_stmt( $stmt);

		
	}
}



$strsql="
delete from tr_pemeriksaan where _ap_lisregno='".$custnomid."'
INSERT INTO [dbo].[tr_pemeriksaan]
           ([_ap_lisregno]
           ,[_tgl]
           ,[_nama1]
           ,[_jabatan1]
           ,[_nama2]
           ,[_jabatan2])
     VALUES
           (
		   '".$custnomid."',
		   '".$_tgl."',
		   '".$_nama1."',
		   '".$_jabatan1."',
		   '".$_nama2."',
		   '".$_jabatan2."'
		   )";
					
					
$stmt = sqlsrv_prepare( $conn, $strsql);
if(!$stmt)
{
	echo "Error in preparing statement.\n";
	die( print_r( sqlsrv_errors(), true));
	return false;
}
if(!sqlsrv_execute( $stmt))
{
	echo "Cannot insert table ". $strsql;
	die( print_r( sqlsrv_errors(), true));
	return false;
}	
sqlsrv_free_stmt( $stmt);

//header("location:../flow.php?userid=$userid&userpwd=$userpwd&userbranch=$userbranch&userregion=$userregion&userwfid=$userwfid");
//echo "apperik.php?custnomid=$custnomid&userwfid=$userwfid&userpermission=$userpermission&buttonaction=&userbranch=$userbranch&userregion=$userregion&userid=$userid&userpwd=$userpwd&col_id=$col_id"
header("location:./perihal.php?custnomid=$custnomid&userwfid=$userwfid&userpermission=$userpermission&buttonaction=&userbranch=$userbranch&userregion=$userregion&userid=$userid&userpwd=$userpwd&col_id=$col_id");


?>