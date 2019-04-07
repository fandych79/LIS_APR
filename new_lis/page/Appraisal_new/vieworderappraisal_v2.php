<?php
	
	include ("../../lib/formatError.php");
	require ("../../lib/open_con.php");
	require ("../../lib/open_con_apr.php");
	
	//PAGING SCRIPT
	if(isset($_REQUEST['hide_currentPage']))
	{
		$currentPage = $_REQUEST['hide_currentPage'];
	}
	else
	{
		$currentPage = 1;
	}

	if(isset($_REQUEST['hide_rowPerPage']))
	{
		$rowPerPage = $_REQUEST['hide_rowPerPage'];
	}
	else
	{
		$rowPerPage = 5;
	}

	if($currentPage <= 0)
	{
		$currentPage = 1;
	}

	$offsetPage = ($currentPage - 1)*$rowPerPage;
	$lastRow = $offsetPage + $rowPerPage;

	//echo "OFFSETPAGE ".$offsetPage;
	//echo "<BR>";
	//echo "LASTROW ".$lastRow;


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Expires" CONTENT="0">
<meta http-equiv="Cache-Control" CONTENT="no-cache">
<meta http-equiv="Pragma" CONTENT="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VIEW ORDER APPRAISAL</title>
<link rel="stylesheet" type="text/css" href="../../lib/tab-view.css" />
<script type="text/javascript" src="../../js/datetimepicker_css.js"></script>
<script type="text/javascript" src="../../lib/slide_down.js"></script>
<script type="text/javascript" src="../../js/full_function.js"></script>
<link href="../../css/crw.css" rel="stylesheet" type="text/css" />

	<style type="text/css" media="print">
		.NonPrintable
		{
		  display: none;
		}
	</style>
	
	<style type="text/css" media="print">
		.break{
		page-break-before: always;
		}
	</style>
<Script Language="JavaScript">

function currentPageValue(paramValue)
{
	document.formsubmit.action = "vieworderappraisal_v2.php";
		
	if(paramValue == "next")
	{
		currPage = parseInt(document.formsubmit.hide_currentPage.value);

		currPage = currPage + 1;
		document.formsubmit.hide_currentPage.value = currPage;
		

	}
	else if(paramValue == "prev")
	{
		currPage = parseInt(document.formsubmit.hide_currentPage.value);
		currPage = currPage - 1;
		document.formsubmit.hide_currentPage.value = currPage;
		
	}
	
	document.formsubmit.submit();
}
</script>
	
</head>

<BODY>
<script language="Javascript">
				name="utama";
</script>
<?
	$tgl1 = $_REQUEST['tgl1'];
	$tgl2 = $_REQUEST['tgl2'];
	$tgl1a = $_REQUEST['tgl1'];
	$tgl2a = $_REQUEST['tgl2'];
	$status = $_REQUEST['Status'];
	$userid = $_REQUEST['userid'];
	$userpwd = $_REQUEST['userpwd'];
	$userbranch = $_REQUEST['userbranch'];
	$userregion = $_REQUEST['userregion'];
?>
<form id="formsubmit" name="formsubmit" method="post" action="">
<input type="hidden" id="hide_currentPage" name="hide_currentPage" value="<? echo $currentPage;?>">
<input type="hidden" id="hide_rowPerPage" name="hide_rowPerPage" value="<? echo $rowPerPage;?>">
<input type="hidden" id="userid" name="userid" value="<? echo $userid;?>" >
<input type="hidden" id="userpwd" name="userpwd" value="<? echo $userpwd;?>" >
<input type="hidden" id="userbranch" name="userbranch" value="<? echo $userbranch;?>" >
<input type="hidden" id="userregion" name="userregion" value="<? echo $userregion;?>" >
<input type="hidden" id="tgl1" name="tgl1" value="<? echo $tgl1a;?>" >
<input type="hidden" id="tgl2" name="tgl2" value="<? echo $tgl2a;?>" >
<input type="hidden" id="Status" name="Status" value="<? echo $status;?>" >

<? 	
	$user_level_code = 0;
	$user_ao_code = "";
	$querylevelcode = "";
	$user_child = "";
	
	if($status == "ALL")
	{
		$querystatus = "";
	}
	else
	{
		$querystatus = "TXN_ID IN(SELECT CUSTNOMID FROM TBL_CUSTOMERFLAG WHERE CUSTFLAGAPR = 'Z') AND";
	}
	
	$tsql = "SELECT * FROM Tbl_SE_User WHERE user_id = '$userid'";
			
	$ase = sqlsrv_query($conn, $tsql);

	if ($ase === false)
		die( FormatErrors( sqlsrv_errors() ) );

	if(sqlsrv_has_rows($ase))
	{  
		while($rowse = sqlsrv_fetch_array($ase, SQLSRV_FETCH_ASSOC))
		{ 
			$user_level_code = $rowse['user_level_code'];
			$user_ao_code = $rowse['user_ao_code'];
			$user_child = $rowse['user_child'];
		}
	}
	
	if($user_level_code == 160)
	{
		$querylevelcode = "TXN_ID IN (SELECT CUSTNOMID FROM tbl_customerMasterPerson WHERE CUSTAOCODE = '$user_ao_code') AND ";
	}
	else if($user_level_code == 140)
	{
		$tempcustaocode = "";
		$array_user_child = explode("|", $user_child);
		for($i=0; $i < count($array_user_child)-1; $i++)
		{
			$tsql = "SELECT * FROM Tbl_SE_User WHERE user_id = '$array_user_child[$i]'";
			$ase = sqlsrv_query($conn, $tsql);
			if ($ase === false)
				die( FormatErrors( sqlsrv_errors() ) );
			if(sqlsrv_has_rows($ase))
			{  
				while($rowmp = sqlsrv_fetch_array($ase, SQLSRV_FETCH_ASSOC))
				{ 
					$tempcustaocode = $rowmp['user_ao_code'];
				}
			}

			if($querylevelcode == "")
			{
				$querylevelcode = "TXN_ID IN (SELECT CUSTNOMID FROM tbl_customerMasterPerson WHERE CUSTAOCODE = '$tempcustaocode') AND ";
			}
			else
			{
				$querylevelcode = "TXN_ID IN (SELECT CUSTNOMID FROM tbl_customerMasterPerson WHERE CUSTAOCODE = '$tempcustaocode')"." OR "."$querylevelcode";
			}
		}
	}
	else if($user_level_code == 130 || $user_level_code == 120)
	{
		$querylevelcode = "TXN_BRANCH_CODE = '$userbranch' AND ";
	}
	else if($user_level_code == 110 || $user_level_code == 115)
	{
		$querylevelcode = "TXN_REGION_CODE = '$userregion' AND ";
	}
	else
	{
	}
	
	$totalall = 0;
	
	//SELECT BUAT NYARI TOTAL_ROW
	$tsql_TOTAL_ROW = "select count(*) from TBL_FCOL where  $querylevelcode $querystatus TXN_ACTION = 'A' AND CONVERT(DATETIME, TXN_TIME, 105) BETWEEN CONVERT(DATETIME, '$tgl1', 105) AND DATEADD(DAY, 1, CONVERT(DATETIME, '$tgl2', 105))";
	$cursorType_TOTAL_ROW = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	$params_TOTAL_ROW = array(&$_POST['query']);

	$sqlConn_TOTAL_ROW = sqlsrv_query($conn, $tsql_TOTAL_ROW, $params_TOTAL_ROW, $cursorType_TOTAL_ROW);

	if ( $sqlConn_TOTAL_ROW === false)
	  die( FormatErrors( sqlsrv_errors() ) );

	$total_all = 0;

	if(sqlsrv_has_rows($sqlConn_TOTAL_ROW))
	{
		$rowCount_TOTAL_ROW = sqlsrv_num_rows($sqlConn_TOTAL_ROW);
		while( $row_TOTAL_ROW = sqlsrv_fetch_array( $sqlConn_TOTAL_ROW, SQLSRV_FETCH_NUMERIC))
		{
			$total_all = $row_TOTAL_ROW[0];
		}
		
	}

	sqlsrv_free_stmt( $sqlConn_TOTAL_ROW );

	//echo "TOTAL ALL ".$total_all;
	//echo "OFFSET PAGE ".$offsetPage;
	//echo "LAST ROW ".$lastRow;

	$status_lanjut = 0;
	if($lastRow >= $total_all)
	{
		$status_lanjut = 1;
	}
	
?>
<div align="center">
<a href="#" onclick="currentPageValue('prev')">Prev</a>
&nbsp;&nbsp;|&nbsp;&nbsp;
<label id="nai_page"><? echo $currentPage; ?></label>
&nbsp;&nbsp;|&nbsp;&nbsp;
<?
if($status_lanjut == 0)
{
?>
<a href="#" onclick="currentPageValue('next')">Next</a>
<?
}
?>
</div>
	<br>
	<div align=center valign=top> <strong>DAFTAR ORDER APPRAISAL</strong></div>
				
		</br></br>
		
		<table width=800px border=1 align=center valign=top >
			
			<tr>
				<td width=3% align=center><strong>NO.</strong></td>
				<td width=20% align=center><strong>DEBITUR</strong></td>
				<td width=20% align=center><strong>JAMINAN</strong></td>
				<td width=15% align=center><strong>TANGGAL KIRIM</strong></td>
				<td width=15% align=center><strong>NILAI JAMINAN</strong></td>
				<!--<td width=15% align=center><strong>TANGGAL APPRAISAL</strong></td>-->
				<td width=15% align=center><strong>STATUS</strong></td>
			</tr>
				
		<?
			$i = 0;
			
			$tsql = "SELECT * FROM (SELECT ROW_NUMBER() OVER (ORDER BY TXN_TIME ASC) AS TIME,* FROM TBL_FCOL WHERE $querylevelcode $querystatus TXN_ACTION = 'A' AND CONVERT(DATETIME, TXN_TIME, 105) BETWEEN CONVERT(DATETIME, '$tgl1', 105) AND DATEADD(DAY, 1, CONVERT(DATETIME, '$tgl2', 105))) TBL_FCOL WHERE TIME > $offsetPage AND TIME <= $lastRow";
			$aside = sqlsrv_query($conn, $tsql);

			if ($aside === false)
				die( FormatErrors( sqlsrv_errors() ) );

			if(sqlsrv_has_rows($aside))
			{  
				while($rowside = sqlsrv_fetch_array($aside, SQLSRV_FETCH_ASSOC))
				{ 
					$i++;
		?>
		
		<?
			$custnomid = $rowside['txn_id'];
			$debitur = "";
			$jaminan = "";
			$kodejaminan = "";
			$tanggalappraisal = "-";
			$statusappraisal = "-";
			$vehicle = "";
			$land = "";
			$building = "";
			$land = "";
			$building = "";
			$buildingtemp = "";
			
			$col_id = "";
			$jeniscol = "";
			$temp_col_id = "";
			
			$tsqlmp = "SELECT * FROM tbl_customerMasterPerson WHERE custnomid = '$custnomid'";

			$amp = sqlsrv_query($conn, $tsqlmp);

			if ($amp === false)
				die( FormatErrors( sqlsrv_errors() ) );

			if(sqlsrv_has_rows($amp))
			{  
				if($rowmp = sqlsrv_fetch_array($amp, SQLSRV_FETCH_ASSOC))
				{ 
					$debitur = $rowmp['custfullname'];
				}
			}
			
			$tsqlcm = "SELECT * FROM Tbl_Cust_MasterCol WHERE ap_lisregno = '$custnomid' AND FLAGINSERT = '1' AND FLAGDELETE = '0'";
			$acm = sqlsrv_query($conn, $tsqlcm);
			if ($acm === false)
				die( FormatErrors( sqlsrv_errors() ) );

			if(sqlsrv_has_rows($acm))
			{  
				while($rowcm = sqlsrv_fetch_array($acm, SQLSRV_FETCH_ASSOC))
				{ 
					$col_id = $rowcm['col_id'];
					$jeniscol = $rowcm['cust_jeniscol'];
					
					if($jeniscol == "D01" || $jeniscol == "TAB")
					{
						$tsqlcol = "SELECT * FROM TBL_COL_CASH WHERE COL_ID = '$col_id'";
						$acol = sqlsrv_query($conn, $tsqlcol);
						if ($acol === false)
							die( FormatErrors( sqlsrv_errors() ) );

						if(sqlsrv_has_rows($acol))
						{  
							while($rowcol = sqlsrv_fetch_array($acol, SQLSRV_FETCH_ASSOC))
							{
								if($temp_col_id == "")
								{
									$temp_col_id = $rowcol['col_id'];
									$hargacash = numberFormat($rowcol['cash_nilai']);
								}
								else
								{
									$temp_col_id = $temp_col_id."<br>".$rowcol['col_id'];
									$hargacash = $hargacash."<br>".numberFormat($rowcol['cash_nilai']);
								}
								$totalall = $totalall + $rowcol['cash_nilai'];
							}
						}
					}
					
					if($jeniscol == "V01")
					{
						$tsqlcol = "SELECT * FROM TBL_COL_VEHICLE WHERE COL_ID = '$col_id'";
						$acol = sqlsrv_query($conn, $tsqlcol);
						if ($acol === false)
							die( FormatErrors( sqlsrv_errors() ) );

						if(sqlsrv_has_rows($acol))
						{  
							while($rowcol = sqlsrv_fetch_array($acol, SQLSRV_FETCH_ASSOC))
							{
								if($temp_col_id == "")
								{
									$temp_col_id = $rowcol['col_id'];
									$hargacash = numberFormat($rowcol['col_nilaiwajar']);
								}
								else
								{
									$temp_col_id = $temp_col_id."<br>".$rowcol['col_id'];
									$hargacash = $hargacash."<br>".numberFormat($rowcol['col_nilaiwajar']);
								}
								$totalall = $totalall + $rowcol['col_nilaiwajar'];
							}
						}
					}
					
					if($jeniscol == "BA1")
					{
						$tsqlcol = "SELECT * FROM TBL_COL_BUILDING WHERE COL_ID = '$col_id'";
						$acol = sqlsrv_query($conn, $tsqlcol);
						if ($acol === false)
							die( FormatErrors( sqlsrv_errors() ) );

						if(sqlsrv_has_rows($acol))
						{  
							while($rowcol = sqlsrv_fetch_array($acol, SQLSRV_FETCH_ASSOC))
							{
								if($temp_col_id == "")
								{
									$temp_col_id = $rowcol['col_id'];
									$hargacash = numberFormat($rowcol['col_nilaitotalimb']);
								}
								else
								{
									$temp_col_id = $temp_col_id."<br>".$rowcol['col_id'];
									$hargacash = $hargacash."<br>".numberFormat($rowcol['col_nilaitotalimb']);
								}
								$totalall = $totalall + $rowcol['col_nilaitotalimb'];
							}
						}
					}
					
					if($jeniscol == "TAN")
					{
						$tsqlcol = "SELECT * FROM TBL_COL_LAND WHERE COL_ID = '$col_id'";
						$acol = sqlsrv_query($conn, $tsqlcol);
						if ($acol === false)
							die( FormatErrors( sqlsrv_errors() ) );

						if(sqlsrv_has_rows($acol))
						{  
							while($rowcol = sqlsrv_fetch_array($acol, SQLSRV_FETCH_ASSOC))
							{
								if($temp_col_id == "")
								{
									$temp_col_id = $rowcol['col_id'];
									$hargacash = numberFormat($rowcol['COL_NILAIWAJAR']);
								}
								else
								{
									$temp_col_id = $temp_col_id."<br>".$rowcol['col_id'];
									$hargacash = $hargacash."<br>".numberFormat($rowcol['COL_NILAIWAJAR']);
								}
								$totalall = $totalall + $rowcol['COL_NILAIWAJAR'];
							}
						}
					}
				}
			}
			
			$tsqlmp = "SELECT * FROM tbl_COL_App WHERE ap_lisregno = '$custnomid'";

			$amp = sqlsrv_query($conn, $tsqlmp);

			if ($amp === false)
				die( FormatErrors( sqlsrv_errors() ) );

			if(sqlsrv_has_rows($amp))
			{  
				if($rowmp = sqlsrv_fetch_array($amp, SQLSRV_FETCH_ASSOC))
				{ 
					$tanggalappraisal = $rowmp['ap_date']->format('d/n/Y');
					$statusappraisal = $rowmp['ap_status'];
				}
			}
			
			
			if($statusappraisal == "A01")
			{
				$statusappraisal = "Marketable";
			}
			else if($statusappraisal == "A02")
			{
				$statusappraisal = "Tidak Marketable";
			}
			else if($statusappraisal == "A03")
			{
				$statusappraisal = "Back to AO";
			}
			else if($statusappraisal == "")
			{
				$statusappraisal = "-";
			}
			
			
		?>
		
		
			<tr>
				<td width=3% align=center><? echo $i; ?>.</td>
				<td width=20% align=center><? echo $debitur; ?></td>
				<td width=20% align=center><? echo $temp_col_id;?></td>
				<td width=15% align=center><? echo $rowside['txn_time']->format('d/n/Y');?></td>
				<td width=15% align=right><? echo $hargacash; ?></td>
				<!--<td width=15% align=center><? echo $tanggalappraisal; ?></td>-->
				<td width=15% align=center><? echo $statusappraisal; ?></td>
			</tr>
			
		
		<?
				}
			}
		?>
			<tr>
				<td width=3% align=center>&nbsp </td>
				<td width=20% align=center>&nbsp </td>
				<td width=20% align=center>TOTAL </td>
				<td width=15% align=center>&nbsp </td>
				<td width=15% align=right><? echo numberFormat($totalall); ?></td>
				<!--<td width=15% align=center>&nbsp </td>-->
				<td width=15% align=center>&nbsp </td>
			</tr>
			
			
		</table>
		</form>
</BODY>
</html>
<?
   	require("../../lib/close_con.php");
?>