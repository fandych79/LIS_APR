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
	<body link=blue vlink=blue alink=blue>
	<form id="frm" name="frm" method="post" action="appraisal_task.php">
		<div align=center>
			<font face=Arial size=4>DAFTAR CUSTOMER YANG SEDANG DI APPRAISAL</font>
			<BR><BR>
			<table border="1" cellpadding=5 cellspacing=0 style ="width:900px; border-color:black;">
			
			<tr>
           	 <td width=20% align=left valign=top>
           	 	CUSTNOMID
           	 </td>
           	 <td width=40% align=left valign=top>
           	 	NAMA CUSTOMER 
           	 </td>
           	 <td width=20% align=left valign=top>
           	 	OFFICER
           	 </td>
           	 <td width=20% align=left valign=top>
           	 	ACTION
           	 </td>
           </tr>
<?
      $saklar = 0;
			$tsql = "select * from appraisal_task a join appraisal_request b on a._custnomid = b._custnomid where b._branchcode = '$userbranch'
			         and a._flag='0'";
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
           	 	<?=$row[0];?>
           	 </td>
           	 <td width=40% align=left valign=top>
           	 	<? echo $row[1]; ?>
           	 </td>
           	 <td width=20% align=left valign=top>
           	 	<? echo $row[3]; ?>
           	 </td>
           	 <td width=20% align=left valign=top>
           	 	<a href="./do_cancel.php?custnomid=<?=$row[0];?>&userwfid=<?=$userwfid;?>&userpermission=<?=$userpermission;?>&buttonaction=<?=$buttonaction;?>&userbranch=<?=$userbranch;?>&userregion=<?=$userregion;?>&userid=<?=$userid;?>&userpwd=<?=$userpwd;?>">Cancel</a>
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


