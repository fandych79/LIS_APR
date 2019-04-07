<?
$tsql = "select * from Tbl_Workflow where wf_id='$userwfid'";
echo $tsql;
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);
$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);

if($sqlConn === false)
{
	die(FormatErrors(sqlsrv_errors()));
}

if(sqlsrv_has_rows($sqlConn))
{
  $rowCount = sqlsrv_num_rows($sqlConn);
  while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
  {

  }
}
sqlsrv_free_stmt( $sqlConn );

?>