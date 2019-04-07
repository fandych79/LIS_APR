<?php
session_start();
//echo $_REQUEST['hid_saveValue'];
require ("../lib/formaterror.php");
require ("../lib/open_con.php");

$saveValue = $_REQUEST['hid_saveValue'];

//echo $saveValue;

$arrSaveValue = explode("|",$saveValue);

//print_r($arrSaveValue);

for($x=0;$x<count($arrSaveValue);$x++)
{	
	$target = $arrSaveValue[$x];
	
	//echo $target;
	
	$assign_type = "";
	// SELECT GET INFO RE ASSIGNMENT

	$tsql = "select * from tbl_assignment_history_log where assignment_ID = '$target'";
	echo $tsql;
	$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	$params = array(&$_POST['query']);
	
	$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
	
	if ( $sqlConn === false)
	  die( FormatErrors( sqlsrv_errors() ) );
	
	if(sqlsrv_has_rows($sqlConn))
	{
		$rowCount = sqlsrv_num_rows($sqlConn);
		if( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
		{
			$assign_type = $row['assignment_type'];
			$assign_from = $row['assignment_from'];
			$assign_replace = $row['assignment_replace'];
			$assign_apps = $row['assignment_apps'];
		}
	}
	sqlsrv_free_stmt( $sqlConn );
	
	if($assign_type == "USER")
	{		
		$tsql = "select * from tbl_prevFlow where flow <> 'TAR'";
		$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
		$params = array(&$_POST['query']);
		
		$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
		
		if ( $sqlConn === false)
		  die( FormatErrors( sqlsrv_errors() ) );
		
		if(sqlsrv_has_rows($sqlConn))
		{
			$rowCount = sqlsrv_num_rows($sqlConn);
			while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
			{
				$flowCode = $row['Flow'];

				//UPDATE THE TBL HISTORY AUTHORIZED
				$tsql_user = "update tbl_F$flowCode set txn_user_id = '$assign_replace'  where txn_user_id = '$assign_from'";
				$params_user = array(&$_POST['query']);
				$stmt_user = sqlsrv_prepare( $conn, $tsql_user, $params_user);
				if( $stmt_user )
				{
				} 
				else
				{
					echo "Error in preparing statement.\n";
					die( print_r( sqlsrv_errors(), true));
				}
				
				if( sqlsrv_execute( $stmt_user))
				{
				}
				else
				{
					echo "Error in executing statement.\n";
					die( print_r( sqlsrv_errors(), true));
				}
				sqlsrv_free_stmt( $stmt_user);				
			}
		}
		sqlsrv_free_stmt( $sqlConn );		
	}
	else if($assign_type == "APPS")
	{
		
		$tsql = "select * from tbl_prevFlow where flow <> 'TAR'";
		$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
		$params = array(&$_POST['query']);
		
		$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
		
		if ( $sqlConn === false)
		  die( FormatErrors( sqlsrv_errors() ) );
		
		if(sqlsrv_has_rows($sqlConn))
		{
			$rowCount = sqlsrv_num_rows($sqlConn);
			while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
			{
				$flowCode = $row['flow'];

				//UPDATE THE TBL HISTORY AUTHORIZED
				$tsql_user = "update tbl_F$flowCode set txn_user_id = '$assign_replace'  where txn_id = '$assign_apps' and txn_user_id = '$assign_from'";
				$params_user = array(&$_POST['query']);
				$stmt_user = sqlsrv_prepare( $conn, $tsql_user, $params_user);
				if( $stmt_user )
				{
				} 
				else
				{
					echo "Error in preparing statement.\n";
					die( print_r( sqlsrv_errors(), true));
				}
				
				if( sqlsrv_execute( $stmt_user))
				{
				}
				else
				{
					echo "Error in executing statement.\n";
					die( print_r( sqlsrv_errors(), true));
				}
				sqlsrv_free_stmt( $stmt_user);
			}
		}
		sqlsrv_free_stmt( $sqlConn );		
	}
	else
	{
	}

	
	//UPDATE THE TBL HISTORY AUTHORIZED
	$tsql = "update tbl_assignment_history_log set assignment_status = 'H' where assignment_ID = '$target'";
	$params = array(&$_POST['query']);
	$stmt = sqlsrv_prepare( $conn, $tsql, $params);
	if( $stmt )
	{
	} 
	else
	{
		echo "Error in preparing statement.\n";
		die( print_r( sqlsrv_errors(), true));
	}
	
	if( sqlsrv_execute( $stmt))
	{
	}
	else
	{
		echo "Error in executing statement.\n";
		die( print_r( sqlsrv_errors(), true));
	}
	sqlsrv_free_stmt( $stmt);

	
}

header("location:manage_assignment_authorized.php");
?>