<?  
require ("../lib/open_con.php");?>
<html>
<head>
<title>Persentase</title>

<link rel="stylesheet" type="text/css" href="style/d.css" />
</head>
<body style="background:url(../images/Background%20Mega.png) no-repeat top;">
<form action="./do_persentase.php" method="get">

<table align="center" width="960" border="0" style="">
  <tr style="margin-bottom:px;">
    <td align="center"><img src="../images/Header Mega (L).png" width=100%></td>
  </tr>
  </table>
  <br/>
<table style="background-color:#FFF;"width="500"  cellpadding="0" cellspacing="0" border="1" align="center" bordercolor="#4476b3" bordercolorlight="#000000" bordercolordark="#ffffff" >
  <tr >
    <td style="padding-left:5px;" width="103">Customer ID</td>
    <td style="padding-left:5px;" width="366"><input type="text" name="customerid" id="customerid" /></td>
  </tr>
  <tr>
    <td style="padding-left:5px;">Filter</td>
    <td style="padding-left:5px;"><select name="filter">
						<option value="A">--ALL--</option>
						<option value="F">Finish</option>
						<option value="N">Not Finish yet</option>
					</select>
     </td>
  </tr>
  <tr>
    <td style="padding-left:5px;">Branch</td>
    <td style="padding-left:5px;">
    	<select name="Branch">
						<option>--ALL--</option>
							<?
							$sql_query = "SELECT * FROM Tbl_Branch ORDER BY branch_code";
							$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
							$params = array(&$_POST['query']);
							
							$sqlConn = sqlsrv_query($conn, $sql_query, $params, $cursorType);
							if ( $sqlConn === false)
								{
								die( FormatErrors( sqlsrv_errors() ) );
								}
							if(sqlsrv_has_rows($sqlConn))
								{
								$rowCount = sqlsrv_num_rows($sqlConn);
								while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
									{
									print "<option value='$row[branch_code]'>$row[branch_code] - $row[branch_name]</option>";
									}
								}
							sqlsrv_free_stmt( $sqlConn);
							?>
					</select>
    </td>
  </tr>
  <tr>
    <td style="padding-left:5px;">AO</td>
    <td style="padding-left:5px;"><select name="AO">
						<option>--ALL--</option>
							<?
						   $sql_query = "SELECT *FROM Tbl_Ao ORDER BY Ao_code";
						   $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
						   $params = array(&$_POST['query']);
						   $sqlConn = sqlsrv_query($conn, $sql_query, $params, $cursorType);

						   if ( $sqlConn === false)
								{
								die( FormatErrors( sqlsrv_errors() ) );
								}
						   if(sqlsrv_has_rows($sqlConn))
								{
								$rowCount = sqlsrv_num_rows($sqlConn);
								while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
									{
									print "<option value='$row[ao_code]'>$row[ao_code] - $row[ao_name]</option>";
									}
								}
						   sqlsrv_free_stmt( $sqlConn );
							?>
					</select>
				
  </tr>
  <tr>
    <td style="padding-left:5px;">Date</td>
    <td style="padding-left:5px;"><select name="tgl2">
      <option>---</option>
      <?
						for($zz=1; $zz<=31;$zz++)
							{
							print "<option value='$zz'>$zz</option>";	
							}
						?>
    </select>
      <select name="bulan2" id="bulan2">
        <option>---</option>
        <?
							for($zz=1; $zz<=12;$zz++)
							{
								print "<option value='$zz'>$zz</option>";	
							}
						?>
      </select>
      <select name="tahun2" id="tahun2">
        <option>---</option>
        <?
							$year=date('Y');
							for($zz=$year-5; $zz<=$year; $zz++)
							{
							print "<option value='$zz'>$zz</option>";	
							}
						?>
      </select>
Until
<select name="tgl2">
  <option>---</option>
  <?
							for($zz=1; $zz<=31;$zz++)
							{
								print "<option value='$zz'>$zz</option>";	
							}
						?>
</select>
<select name="bulan2" id="bulan3">
  <option>---</option>
  <?
							for($zz=1; $zz<=12;$zz++)
							{
								print "<option value='$zz'>$zz</option>";	
							}
						?>
</select>
<select name="tahun2" id="tahun3">
  <option>---</option>
  <?
							$year=date('Y');
							for($zz=$year-5; $zz<=$year; $zz++)
							{
								print "<option value='$zz'>$zz</option>";	
							}
						?>
</select></td>
  </tr>
  <tr>
    <td  align="center" colspan="2"><input type="submit" name="submit" id="submit" value="Submit" /></td>
    </tr>
</table>

</form>
<? require ("../lib/close_con.php")?>
</body>
</html>