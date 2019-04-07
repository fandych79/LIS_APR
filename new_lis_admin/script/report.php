<?  
require ("../lib/open_con.php");?>
<html>
<head>
<title>Report</title>

<link rel="stylesheet" type="text/css" href="style/d.css" />
</head>
<body style="background:url(../images/Background%20Mega.png) no-repeat top;">

<table align="center" width="960" border="0" style="">
  <tr style="margin-bottom:px;">
    <td align="center"><img src="../images/Header Mega (L).png" width=100%></td>
  </tr>
  </table>
  <br/>
<form action="./do_report.php" method="get">
	 <table style="background-color:#;"width="300"  cellpadding="0" cellspacing="0" border="1" align="center" bordercolor="#4476b3" bordercolorlight="#000000" bordercolordark="#ffffff" >
	<tr>
     <td width="30%" align="center">Region</td>

		<td width="70%">
			<select name="Branch">
				<option value="National">--National--</option>
					<?
						$sql_query = "SELECT * FROM Tbl_region ORDER BY region_name";
						$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
						$params = array(&$_POST['query']);
						$sqlConn = sqlsrv_query($conn, $sql_query, $params, $cursorType);
						if ( $sqlConn == false){die( FormatErrors( sqlsrv_errors()));}
						if(sqlsrv_has_rows($sqlConn))
							{
								$rowCount = sqlsrv_num_rows($sqlConn);
								while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
									{
										print "<option value='$row[1]'>$row[0] - $row[1]</option>";
									}
							}
						sqlsrv_free_stmt( $sqlConn);
					?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="right" colspan="2">
		<input  type="submit" name="submit" id="submit" value="Submit" />
		</td>
    </tr>
</table>
</form>
<? require ("../lib/close_con.php")?>
</body>
</html>