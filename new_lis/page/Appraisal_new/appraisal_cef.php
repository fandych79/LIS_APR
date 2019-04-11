 <?php
	require ("../../lib/open_conAPPR.php");
	require ("../../lib/formatError.php");
	require ("../../requirepage/parameter.php");
 
 	
	$maxofficer = 2;
	$x = 1;
	
	$theid = $_POST['col_id'];
	$col_code = $_POST['col_code'];
	$custnomid = $_POST['custnomid'];
	$keterangan = $_POST['keterangan'];
	
	$nilai_jaminan = $_POST['nilai_jaminan'];
	$nilai_jaminan = str_replace(',', '', $nilai_jaminan);
	$nominalcef = $_POST['nominalcef'];
	$nominalcef = str_replace(',', '', $nilai_jaminan);
	
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
 
 
	$idx = time().$theid;

	echo $strsql = "DELETE FROM tbl_cef WHERE col_id = '$theid'
	
	
	
			INSERT INTO [dbo].[tbl_cef]
					   ([idx]
					   ,[col_code]
					   ,[col_id]
					   ,[customerid]
					   ,[nilai_jaminan]
					   ,[nilai_cef]
					   ,[keterangan])
				 VALUES
					   ('$idx'
					   ,'$col_code'
					   ,'$theid'
					   ,'$custnomid'
					   ,'$nilai_jaminan'
					   ,'$nominalcef'
					   ,'$keterangan')



	
	update tbl_cef  set persentase_cef = 
    (SELECT b.col_cef FROM tbl_cef a
        INNER JOIN TblCollateralType b ON a.col_code= b.col_code
		where a.col_id = tbl_cef.col_id
		)
		where col_id = '$theid'
	
	
	
";
echo "<hr>";
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
 
 //print_r($_POST);
 
 
 
 
 header("Location:appraisal.php?custnomid=$custnomid&userwfid=$userwfid&userpermission=$userpermission&buttonaction=$buttonaction&userbranch=$userbranch&userregion=$userregion&userid=$userid&userpwd=$userpwd&jeniscol=$col_code&col_id=$theid");