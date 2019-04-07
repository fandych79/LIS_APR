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
	
	print_r($_POST);
	echo '<hr>';
	echo '<hr>';
	
	$custmonid =isset($_POST['custmonid']) && $_POST['custmonid'] != "" ? str_replace(",", "", $_POST["custmonid"]):  
	
	$harga1=isset($_POST['harga1']) && $_POST['harga1'] != "" ? str_replace(",", "", $_POST["harga1"]) : 0; 
	$harga2=isset($_POST['harga2']) && $_POST['harga2'] != "" ? str_replace(",", "", $_POST["harga2"]) : 0; 
	$custnomid=isset($_POST['custnomid']) && $_POST['custnomid'] != "" ? $_POST["custnomid"] : ""; 
	
	$col_id=isset($_POST['col_id']) && $_POST['col_id'] != "" ? $_POST["col_id"] : ""; 
	$deskripsi=isset($_POST['deskripsi']) && $_POST['deskripsi'] != "" ? $_POST["deskripsi"] : ""; 
	$tglkunjungan=isset($_POST['tglkunjungan']) && $_POST['tglkunjungan'] != "" ? $_POST["tglkunjungan"] : ""; 
	$officer=isset($_POST['officer']) && $_POST['officer'] != "" ? $_POST["officer"] : ""; 
	$keterangan=isset($_POST['keterangan']) && $_POST['keterangan'] != "" ? $_POST["keterangan"] : ""; 
	$cretedate=isset($_POST['cretedate']) && $_POST['cretedate'] != "" ? $_POST["cretedate"] : ""; 
	$creteby=isset($_POST['userid']) && $_POST['userid'] != "" ? $_POST["userid"] : ""; 
	
	echo $id=$custmonid.time();
	
	$col_code="";
	$strsqlv01="select * from Tbl_Cust_MasterCol where col_id= '".$col_id."'";
	$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
	if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlconv01))
	{
		while($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
		{
			$col_code = $rowsv01['cust_jeniscol'];
		}
	}
		
		
		//delete from  appraisal_datapembanding2 where col_id= '$col_id' and custnomid='$custnomid'
			echo $strsql = "
			
			
			INSERT INTO appraisal_datapembanding2 
					 ([id]
				   ,[custnomid]
				   ,[col_code]
				   ,[col_id]
				   ,[deskripsi]
				   ,[tglkunjungan]
				   ,[harga1]
				   ,[harga2]
				   ,[officer]
				   ,[keterangan]
				   ,[cretedate]
				   ,[creteby]

		) VALUES (
					'$id',
					'$custnomid',
					'$col_code',
					'$col_id',
					'$deskripsi',
					'$tglkunjungan',
					'$harga1',
					'$harga2',
					'$officer',
					'$keterangan',
					getdate(),
					'$creteby')
					";
		
		
		
		
		echo '<hr>';
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
	
	
	
	
	
	
	
	
	header("Location:datapembanding.php?custnomid=$custnomid&userwfid=$userwfid&userpermission=$userpermission&buttonaction=$buttonaction&userbranch=$userbranch&userregion=$userregion&userid=$userid&userpwd=$userpwd");
}
else if($act=="saveflow")
{
	require ("../../requirepage/do_saveflow.php");	
	
	header("location:../flow.php?userid=$userid&userpwd=$userpwd&userbranch=$userbranch&userregion=$userregion&userwfid=$userwfid");
}
else
{
	$id = $_REQUEST['id'];
	
	$strsql = "DELETE FROM appraisal_datapembanding2 where id = '$id'";
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
	header("Location:datapembanding.php?custnomid=$custnomid&userwfid=$userwfid&userpermission=$userpermission&buttonaction=$buttonaction&userbranch=$userbranch&userregion=$userregion&userid=$userid&userpwd=$userpwd");
}


?>