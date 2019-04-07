<?
include ("../lib/formatError.php");
require ("../lib/open_con.php");
$ao_code = $_REQUEST['aocode'];
$ao_branch = $_REQUEST['aobranch'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DETAIL AO</title>
<LINK media=screen href="../style/menu.css" rel=stylesheet>
<script src='./javabits.js' language='Javascript'></script>
</head>
<?
// SELECT 

$tsql = "select * from tbl_ao where ao_code='$ao_code' and ao_branch_code ='$ao_branch'";
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
		$ao_Name = $row['ao_name'];
		$ao_HP = $row['ao_hp_number'];
		$ao_NIK = $row['ao_nik'];
		$ao_TL = $row['ao_tl'];
	}
}
sqlsrv_free_stmt( $sqlConn );
?>
<body>
<div align="center">
<table align="center" width="960" border="0" style="">
  <tr style="margin-bottom:px;">
    <td align="center"><img src="../images/Header Mega (L).png" width=100%></td>
  </tr>
  </table>
  <table width="800" border="1" cellspacing="1" cellpadding="1">
    <tr>
      <th colspan="2" scope="col">DETAIL AO</th>
    </tr>
    <tr>
      <td width="385"><div align="right">AO Code</div></td>
      <td width="402"><div align="left"><? echo $ao_code; ?></div></td>
    </tr>
    <tr>
      <td><div align="right">AO Name</div></td>
      <td><div align="left"><? echo $ao_Name; ?></div></td>
    </tr>
    <tr>
      <td><div align="right">AO Branch</div></td>
      <td><div align="left"><? echo $ao_branch; ?></div></td>
    </tr>
    <tr>
      <td><div align="right">AO HP</div></td>
      <td><div align="left"><? echo $ao_HP; ?></div></td>
    </tr>
    <tr>
      <td><div align="right">AO NIK</div></td>
      <td><div align="left"><? echo $ao_NIK; ?></div></td>
    </tr>
    <tr>
      <td><div align="right">AO TL</div></td>
      <td><div align="left"><? echo $ao_TL; ?></div></td>
    </tr>
  </table>
</div>
</body>
</html>