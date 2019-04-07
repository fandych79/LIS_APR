<?
if(!isset($userid) && !isset($userpwd) && !isset($userbranch) && !isset($userregion) && !isset($userwfid) )
{
	header("location:restricted.php");
}

// SECURITY
$strsql = "SELECT COUNT(*) FROM Tbl_SE_User
WHERE user_id='$userid'
AND user_pwd='$userpwd'";
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);
$sqlConn = sqlsrv_query($conn, $strsql, $params, $cursorType);
if ( $sqlConn === false){die( FormatErrors( sqlsrv_errors()));}
if(sqlsrv_has_rows($sqlConn))
{
	$rowCount = sqlsrv_num_rows($sqlConn);
	while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
	{
		$thecount = $row[0];
	}
}
sqlsrv_free_stmt( $sqlConn );

if ($thecount == 0){header("location:restricted.php");}

$strsql = "SELECT COUNT(*) FROM Tbl_SE_UserProgram
		WHERE user_id='$userid'
		AND program_code='$userwfid'";
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);
$sqlConn = sqlsrv_query($conn, $strsql, $params, $cursorType);
if ( $sqlConn === false){die( FormatErrors( sqlsrv_errors()));}

if(sqlsrv_has_rows($sqlConn))
{
	$rowCount = sqlsrv_num_rows($sqlConn);
	while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
	{
		$thecount = $row[0];
	}
}
sqlsrv_free_stmt( $sqlConn );

if ($thecount == 0){header("location:restricted.php");}

$userpinp = "";
$userpchk = "";
$userpapr = "";
$strsql = "SELECT * FROM Tbl_SE_UserProgram
		WHERE user_id='$userid'
		AND program_code='$userwfid'";
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);
$sqlConn = sqlsrv_query($conn, $strsql, $params, $cursorType);
if ( $sqlConn === false){die( FormatErrors( sqlsrv_errors()));}
if(sqlsrv_has_rows($sqlConn))
{
	$rowCount = sqlsrv_num_rows($sqlConn);
	while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
	{
		$userpinp = substr($row[2],1-1,1);
		$userpchk = substr($row[2],2-1,1);
		$userpapr = substr($row[2],3-1,1);
	}
}

// END SECURITY

// PROFILE USER ID (AO / TL / PINCA)
$strsql = "SELECT user_ao_code, user_level_code, user_child FROM Tbl_SE_User
		WHERE user_id='$userid'";
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);
$sqlConn = sqlsrv_query($conn, $strsql, $params, $cursorType);
if ( $sqlConn === false){die( FormatErrors( sqlsrv_errors() ) );}

if(sqlsrv_has_rows($sqlConn))
{
	$rowCount = sqlsrv_num_rows($sqlConn);
	while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
	{
		$profileaocode = $row[0];
		$profilelevelcode = $row[1];
		$profileuserchild = $row[2];
	}
}

// END PROFILE
//SELECT From Tbl_Workflow & PrevFlow
$strsql = "select * from Tbl_Workflow where wf_id='$userwfid'";
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);
$sqlConn = sqlsrv_query($conn, $strsql, $params, $cursorType);

if($sqlConn === false){die(FormatErrors(sqlsrv_errors()));}

if(sqlsrv_has_rows($sqlConn))
{
  $rowCount = sqlsrv_num_rows($sqlConn);
  while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
  {
	   $wfname = $row[1];
	   $wftime = $row[3];
	   $wfscore = $row[4];
	   $wfaction = $row[5];
	   $wfflag = $row[7];
  }
}
//END GET WFNAME*/

?>