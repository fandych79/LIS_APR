<?php

require ("../../lib/open_con.php");
require ("../../lib/sqlserverAPR.php");
require ("../../requirepage/parameter.php");

$SQL = new MYSQL();
$SQL->connect();
$debug = false;


$param_tipe_debitur = array();
$tsql = "SELECT * FROM ms_tipedebitur";
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
		$param_tipe_debitur[$row['_idx']] = $row['_name'];
	}
}


$act = "";
if(isset($_POST['act']))
{
	$act=$_POST['act'];
}

if ($act == "")
{
?>
<html>
	<head>
		<title>Appraisal Task</title>
		<script type="text/javascript" src="../../js/datetimepicker_css.js"></script>
		<script type="text/javascript" src="../../js/jquery-1.7.2.min.js" ></script>
		<script type="text/javascript" src="../../js/full_function.js" ></script>
		<script type="text/javascript" src="../../js/accounting.js" ></script>
		<link href="../../css/d.css" rel="stylesheet" type="text/css" />
		<Script Language="JavaScript">
			function goProses(theid)
			{
				document.frm.custnomid.value = theid;
				document.frm.submit()
			}
		</Script>
	</head>
	<body link=blue vlink=blue alink=blue>
	<form id="frm" name="frm" method="post" action="appraisal_task.php">
		<div align=center>
			<font face=Arial size=4>DAFTAR CUSTOMER YANG HARUS DI APPRAISAL</font>
			<BR><BR>
				<a href="./appraisal_history.php?custnomid=<?=$custnomid;?>&userwfid=<?=$userwfid;?>&userpermission=<?=$userpermission;?>&buttonaction=<?=$buttonaction;?>&userbranch=<?=$userbranch;?>&userregion=<?=$userregion;?>&userid=<?=$userid;?>&userpwd=<?=$userpwd;?>">History Appraisal</a>
			<BR><BR>
			<table border="1" cellpadding=5 cellspacing=0 style ="width:900px; border-color:black;">
			
			<tr>
           	 <td width=20% align=left valign=top>
           	 	CUSTNOMID
           	 </td>
           	 <td width=40% align=left valign=top>
           	 	TIPE DEBITUR
           	 </td>
           	 <td width=20% align=left valign=top>
           	 	TIPE KREDIT
           	 </td>
           	 <td width=20% align=left valign=top>
           	 	NAMA
           	 </td>
           </tr>
<?
      $saklar = 0;
			$tsql = "select * from appraisal_request
			         WHERE _flag='N'
					 AND _branchcode = '$userbranch'
			         ORDER BY _createtime DESC";
			$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
			$params = array(&$_POST['query']);
			
			$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
			
			if ( $sqlConn === false)
			die( FormatErrors( sqlsrv_errors() ) );
			
			if(sqlsrv_has_rows($sqlConn))
			{
				$rowCount = sqlsrv_num_rows($sqlConn);
				while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
				{
					if ($saklar == 0)
					{
						$saklar = 1;
						$trbgcolor="yellow";
					}
					else
					{
						$saklar = 0;
						$trbgcolor="white";
					}
?>
           <tr bgcolor=<? echo $trbgcolor ?>>
           	 <td width=20% align=left valign=top>
           	 	<A HREF="javascript:goProses('<? echo $row[0] ?>')"><? echo $row[0] ?></A>
           	 </td>
           	 <td width=40% align=left valign=top>
           	 	<? echo $row[3]; ?>
           	 </td>
           	 <td width=20% align=left valign=top>
           	 	<? echo $row[2]; ?>
           	 </td>
           	 <td width=20% align=left valign=top>
           	 	<? echo $row[4]; ?>
           	 </td>
           </tr>
<?
				}
			}
			sqlsrv_free_stmt( $sqlConn );


?>
			</table>
		</div>
        <? require ("../../requirepage/hiddenfield.php"); ?>        
        <input type=hidden name=act value='proses'>
	</form>
	</body>
</html>
<?
}
else
{
	$custnomid=$_POST['custnomid'];
?>
<html>
	<head>
		<title>Appraisal Task</title>
		<script type="text/javascript" src="../../js/datetimepicker_css.js"></script>
		<script type="text/javascript" src="../../js/jquery-1.7.2.min.js" ></script>
		<script type="text/javascript" src="../../js/full_function.js" ></script>
		<script type="text/javascript" src="../../js/accounting.js" ></script>
		<link href="../../css/d.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
	<form id="frm" name="frm" method="post" action="do_task.php">
		<div class="divcenter">
			<table id="tblform" border="1" style ="width:900px; border-color:black;">
				<tr>
					<td colspan="2">
						<table width="70%">
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>					
							<tr>
								<td colspan="2"><h3>FORM ENTRY APPRAISAL TASK</h3></td>
							</tr>
							<tr>
								<td width="30%">Masukkan Custnomid</td>
								<td><input type="text" id="_custnomid" name="_custnomid" value="<?=$custnomid?>" required/></td>
							</tr>
							<tr>
								<td>Masukkan Officer</td>
								<td>
									<select id="_officer" name="_officer" required>
										<option value=''>-- Silahkan Pilih --</option>
<?
			$tsql = "select tbl_se_user.user_id,tbl_se_user.user_name,tbl_se_user.user_branch_code, tbl_branch.branch_region_code
			        from tbl_se_user, tbl_branch 
			        where tbl_branch.branch_code=tbl_se_user.user_branch_code
			        AND tbl_se_user.user_level_code='160' 
			        order by tbl_se_user.user_name";
			$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
			$params = array(&$_POST['query']);
			
			$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
			
			if ( $sqlConn === false)
			die( FormatErrors( sqlsrv_errors() ) );
			
			if(sqlsrv_has_rows($sqlConn))
			{
				$rowCount = sqlsrv_num_rows($sqlConn);
				while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
				{
					$vartemp = $row[0] . "~" . $row[2] . "~" . $row[3];
					echo "<option value='$vartemp'>$row[1]</option>";
				}
			}
			sqlsrv_free_stmt( $sqlConn );
?>
									</select>
								</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td><input type="submit" id="btnsave" name="btnsave" value="Submit" class="buttonsaveflow" /></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
        <? require ("../../requirepage/hiddenfield.php"); ?>
	</form>
	</body>
</html>
<?
}

