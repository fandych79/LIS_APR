<?php
	require_once('open_con.php');
	
	
	$tmpupdate ="";
	$strsql = " select * from INFORMATION_SCHEMA.TABLES 
				where TABLE_NAME like 'Tbl_F%' 
				and TABLE_NAME NOT like 'Tbl_Format%'
				and TABLE_NAME NOT like 'Tbl_Flow_Status%'
				and TABLE_NAME NOT like 'Tbl_FSTART%'
				and TABLE_NAME NOT like 'tbl_format%'";
	$sqlcon = sqlsrv_query($conn, $strsql);
	echo $strsql;
	if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlcon))
	{
		while($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
		{
			$tmpupdate= " update ".$rows['TABLE_NAME']." set txn_action='I' where txn_id='KUK4170100055' ";
			echo $tmpupdate;
			$params1 = array(&$_POST['query']);
			$stmt1 = sqlsrv_prepare( $conn, $tmpupdate, $params1);
			if( !$stmt1 )
			{
			echo "Error in preparing statement.\n";
			die( print_r( sqlsrv_errors(), true));
			}

			if( !sqlsrv_execute( $stmt1))
			{
			echo "Error in executing statement.\n";
			die( print_r( sqlsrv_errors(), true));
			}
			sqlsrv_free_stmt( $stmt1);
		}
	}
	
	
?>
