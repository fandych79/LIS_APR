<?php
	include ("../../lib/formatError.php");
	require ("../../lib/open_con.php");
	require ("../../lib/open_con_apr.php");
	
	$Custnomid=$_GET['custnomid'];
	$custnomid = $Custnomid;
	$liscolid = $_GET['liscolid'];
	
	
	$wfname = "Aprraisal Response";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Expires" CONTENT="0">
<meta http-equiv="Cache-Control" CONTENT="no-cache">
<meta http-equiv="Pragma" CONTENT="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Appraisal Entry</title>
<link rel="stylesheet" type="text/css" href="../../lib/tab-view.css" />
<script type="text/javascript" src="../../lib/datetimepicker_css.js"></script>
<script type="text/javascript" src="../../lib/slide_down.js"></script>
<script type="text/javascript" src="../../lib/full_function.js"></script>
<link href="../../lib/crw.css" rel="stylesheet" type="text/css" />
</head>
<br><br><br>
<center>
        
    <table width="500" border="0" cellspacing="0" cellpadding="0" align=center class="preview">
      <tr>
        <td align =center width="500" height="400" valign=top>
        	<CENTER><font face=Arial size=2><b>DOCUMENT STATUS :</b></font></CENTER>
        	<BR>
        	<table width=100% cellpadding=0 cellspacing=0 border=0>
        		<?
					$i = 0;
					$tsql = "select * from collateral_doc where colmaster_id in (SELECT COLMASTER_ID FROM COLLATERAL_LND WHERE LISCOL_ID = '$liscolid') and UPL_BY <> '' AND UPL_BY <> 'LIS'";
					$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$params = array(&$_POST['query']);
					$sqlConn = sqlsrv_query($connapr, $tsql, $params, $cursorType);
					
					if($sqlConn === false)
					{
						die(FormatErrors(sqlsrv_errors()));
					}
					if(sqlsrv_has_rows($sqlConn))
					{
						$rowCount = sqlsrv_num_rows($sqlConn);
						while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
						{
							$i++;
				?>
				<tr>
					<td align="center"><a href="<? echo $row['DOC_PATH']."/".$row['DOC_FILE'];?>" target="_blank" >Gambar Appraisal <? echo $i;?></a></td>
				</tr>
				<?
						}
					}
				?>
				<tr>
					<td>&nbsp </td>
				</tr>
				<!--<tr>
					<td align="center"><a href="viewaprresponse_v2.php?custnomid=<?echo $custnomid; ?>&userid=<? echo $userid; ?>&userpwd=<? echo $userpwd; ?>&userbranch=<? echo $userbranch; ?>&userregion=<? echo $userregion; ?>&userwfid=<? echo $userwfid; ?>&userpermission=<? echo $userpermission; ?>&buttonaction=<? echo $buttonaction; ?>">Kembali</a></td>
				</tr>-->
        	</table>
        </td>
        
      </tr>

    </table>
						<input type=hidden name=thedoctype>
        			 	<input type=hidden name=act>
        			 	<input type=hidden name=custnomid value='<? echo $custnomid; ?>'>
        			 	
<br>
</center>
	