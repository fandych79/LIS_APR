<?


	$strsql="select txn_branch_code,txn_region_code from tbl_fstart where txn_id='".$custnomid."'";
	$sqlcon = sqlsrv_query($conn, $strsql);
	if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlcon))
	{
		if($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
		{
			$txn_region_code = $rows['txn_region_code'];
			$txn_branch_code = $rows['txn_branch_code'];
		}
	}
	
	
	$strsql="INSERT INTO Tbl_Txn_History([txn_id],[txn_action],[txn_time],[txn_user_id],[txn_notes],[txn_flow],[txn_branch_code],[txn_region_code])
					VALUES('$custnomid','I',GETDATE(),'$userid','','$userwfid','$txn_branch_code','$txn_region_code')
					INSERT INTO Tbl_Txn_History([txn_id],[txn_action],[txn_time],[txn_user_id],[txn_notes],[txn_flow],[txn_branch_code],[txn_region_code])
					VALUES('$custnomid','C',GETDATE(),'$userid','','$userwfid','$txn_branch_code','$txn_region_code')
					
					INSERT INTO Tbl_Txn_History([txn_id],[txn_action],[txn_time],[txn_user_id],[txn_notes],[txn_flow],[txn_branch_code],[txn_region_code])
					VALUES('$custnomid','A',GETDATE(),'$userid','','$userwfid','$txn_branch_code','$txn_region_code')
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



?>