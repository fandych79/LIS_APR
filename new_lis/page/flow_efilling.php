<?php
	require ("../lib/formatError.php");
	require ("../lib/open_con.php");
	require ("../lib/open_con_dm.php");
	require ("../lib/sqlsrv.efilling.php");
	
	$userid=$_REQUEST['userid'];
  	$userpwd=$_REQUEST['userpwd'];
  	$userbranch=$_REQUEST['userbranch'];
  	$userregion=$_REQUEST['userregion'];
  	$userwfid=$_REQUEST['userwfid'];
	if($userwfid==""){
		$userwfid=$_POST['userwfid'];
	}
	
	$tsql2 = "select program_group, program_code, program_desc from Tbl_SE_Program
			where program_code like '%$userwfid%'";
	$cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	$params2 = array(&$_POST['query']);

	$sqlConn2 = sqlsrv_query($conn, $tsql2, $params2, $cursorType2);
		$custname = "&nbsp";
	if ( $sqlConn2 === false)
	die( FormatErrors( sqlsrv_errors() ) );

	if(sqlsrv_has_rows($sqlConn2))
	{
		$rowCount2 = sqlsrv_num_rows($sqlConn2);
		if( $row2 = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_NUMERIC))
		{
			$programgcd = $row2[0];
			$programcd = $row2[1];
			$programname = $row2[2];
		}
	}
	sqlsrv_free_stmt( $sqlConn2 );
		
	function CountTotalDateTime($Start, $End)
	{
		$debugMode = false;
		
		$TotalMenitKerja = 0;
		$TotalJamKerja = 0;
		
		require_once ("../lib/formatError.php");
		require("../lib/open_con.php");
		
		$tanggalStart =  $Start->format("d");
		$bulanStart = $Start->format("m");
		$tahunStart = $Start->format("Y");
		$hourStart = $Start->format("H");
		$minuteStart = $Start->format("i");
		$secondStart = $Start->format("s");
		
		$tanggalEnd =  $End->format("d");
		$bulanEnd = $End->format("m");
		$tahunEnd = $End->format("Y");
		$hourEnd = $End->format("H");
		$minuteEnd = $End->format("i");
		$secondEnd = $End->format("s");	
		
		$FullDateStart = date("Y-m-d H:i:s", mktime($hourStart,$minuteStart,$secondStart,$bulanStart,$tanggalStart,$tahunStart));
		$FullDateEnd = date("Y-m-d H:i:s", mktime($hourEnd,$minuteEnd,$secondEnd,$bulanEnd,$tanggalEnd,$tahunEnd));
		
		$OnlyDateStart = date("Y-m-d", mktime($hourStart,$minuteStart,$secondStart,$bulanStart,$tanggalStart,$tahunStart));
		$OnlyDateEnd = date("Y-m-d", mktime($hourEnd,$minuteEnd,$secondEnd,$bulanEnd,$tanggalEnd,$tahunEnd));
		
		$diff_day = 0;
		// SELECT NUMERIC

		$tsql = "select datediff(day,convert(varchar,'$FullDateStart',121),convert(varchar,'$FullDateEnd',121))";

		if($debugMode == true)
		{
			echo $tsql."<br>";
		}
		else
		{
		}

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
				$diff_day = $row[0];
			}
		}
		sqlsrv_free_stmt( $sqlConn );
		
		if($debugMode == true)
		{
			echo $FullDateStart." ===SAMPAI=== ".$FullDateEnd."<br>";
		}
		else
		{
		}
		
		
		$paramStatusHoliday = "";
		
		
		if($debugMode == true)
		{
			echo "SELISIH HARI = ".$diff_day."<br>";
		}
		else
		{
		}
		
		
		for($x = 0 ; $x <= $diff_day ; $x++)
		{
			
			if($debugMode == true)
			{
				echo date("Y-m-d", mktime($hourStart,$minuteStart,$secondStart,$bulanStart,$tanggalStart + $x ,$tahunStart));
			}
			else
			{
			}
			

			
			$checkTanggal = date("Y-m-d H:i:s", mktime($hourStart,$minuteStart,$secondStart,$bulanStart,$tanggalStart + $x ,$tahunStart));
			$checkTanggalSaja = date("Y-m-d", mktime($hourStart,$minuteStart,$secondStart,$bulanStart,$tanggalStart + $x ,$tahunStart));
			
			
			// CHECK HOLIDAY

			$tsql = "select count(*) from TblHariLibur where libur_tanggal = '$checkTanggalSaja'";
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
					if($row[0] == 0)
					{
						$paramStatusHoliday[$checkTanggalSaja] = "KERJA";
					}
					else				
					{
						$paramStatusHoliday[$checkTanggalSaja] = "LIBUR";
					}
					
					//echo "<br>";
				}
			}
			sqlsrv_free_stmt( $sqlConn );
			
			
			if($checkTanggalSaja == $OnlyDateEnd)
			{
				
				if($paramStatusHoliday[$checkTanggalSaja] == "LIBUR")
				{

					$TotalMenitKerja = $TotalMenitKerja + 0;

				}
				else if($paramStatusHoliday[$checkTanggalSaja] == "KERJA")
				{

					if($hourStart > 8 && $hourStart < 22)
					{
						if($diff_day > 0)
						{
							$CheckDateStart = date("Y-m-d H:i:s", mktime(8,0,$secondStart,$bulanStart,$tanggalStart + $x,$tahunStart));
							$CheckDateEnd = date("Y-m-d H:i:s", mktime($hourEnd,$minuteEnd,$secondEnd,$bulanEnd,$tanggalEnd,$tahunEnd));

							$checkDate1 = new DateTime($CheckDateStart);
							$checkDate2 = new DateTime($CheckDateEnd);
							
							$Diff = $checkDate2->diff($checkDate1);  
			
							$TotalJamKerja = $TotalJamKerja + $Diff->format('%H');
							$TotalMenitKerja = $TotalMenitKerja + $Diff->format('%i');
						}
						else
						{
							$CheckDateStart = date("Y-m-d H:i:s", mktime($hourStart,$minuteStart,$secondStart,$bulanStart,$tanggalStart + $x,$tahunStart));
							$CheckDateEnd = date("Y-m-d H:i:s", mktime($hourEnd,$minuteEnd,$secondEnd,$bulanEnd,$tanggalEnd,$tahunEnd));

							$checkDate1 = new DateTime($CheckDateStart);
							$checkDate2 = new DateTime($CheckDateEnd);
							
							$Diff = $checkDate2->diff($checkDate1);  
			
							$TotalJamKerja = $TotalJamKerja + $Diff->format('%H');
							$TotalMenitKerja = $TotalMenitKerja + $Diff->format('%i');
						}
						
						
					}
					else
					{
		
						$CheckDateStart = date("Y-m-d H:i:s", mktime(8,0,$secondStart,$bulanStart,$tanggalStart + $x,$tahunStart));
						$CheckDateEnd = date("Y-m-d H:i:s", mktime($hourEnd,$minuteEnd,$secondEnd,$bulanEnd,$tanggalEnd,$tahunEnd));

						$checkDate1 = new DateTime($CheckDateStart);
						$checkDate2 = new DateTime($CheckDateEnd);
						
						$Diff = $checkDate2->diff($checkDate1);  
		
						$TotalJamKerja = $TotalJamKerja + $Diff->format('%H');
						$TotalMenitKerja = $TotalMenitKerja + $Diff->format('%i');

					}
					
				}
				
				if($debugMode == true)
				{
					echo " HARI INI / HARI SAMA DENGAN HARI INI [$paramStatusHoliday[$checkTanggalSaja]] [1] <br>";
				}
				else
				{
				}
				
			}
			else if($checkTanggalSaja == $OnlyDateStart)
			{

				if($paramStatusHoliday[$checkTanggalSaja] == "LIBUR")
				{
					$TotalMenitKerja = $TotalMenitKerja + 0;

				}
				else if($paramStatusHoliday[$checkTanggalSaja] == "KERJA")
				{
					if($hourStart > 22)
					{
						$CheckDateStart = date("Y-m-d H:i:s", mktime(8,0,$secondStart,$bulanStart,$tanggalStart + $x,$tahunStart));
						$CheckDateEnd = date("Y-m-d H:i:s", mktime($hourEnd,$minuteEnd,$secondEnd,$bulanEnd,$tanggalEnd,$tahunEnd));
		
						$checkDate1 = new DateTime($CheckDateStart);
						$checkDate2 = new DateTime($CheckDateEnd);
						
						$Diff = $checkDate2->diff($checkDate1);   
		
						$TotalJamKerja = $TotalJamKerja + $Diff->format('%H');
						$TotalMenitKerja = $TotalMenitKerja + $Diff->format('%i');
					}
					else
					{
						$CheckDateStart = date("Y-m-d H:i:s", mktime($hourStart,$minuteStart,$secondStart,$bulanStart,$tanggalStart + $x,$tahunStart));
						$CheckDateEnd = date("Y-m-d H:i:s", mktime(22,0,$secondEnd,$bulanEnd,$tanggalEnd,$tahunEnd));
		
						$checkDate1 = new DateTime($CheckDateStart);
						$checkDate2 = new DateTime($CheckDateEnd);
						
						$Diff = $checkDate2->diff($checkDate1);   
		
						$TotalJamKerja = $TotalJamKerja + $Diff->format('%H');
						$TotalMenitKerja = $TotalMenitKerja + $Diff->format('%i');
					}					
					
				}
				
				if($debugMode == true)
				{
					echo " HARI PERTAMA / TANGGAL PERTAMA [$paramStatusHoliday[$checkTanggalSaja]] [3] <br>";
				}
				else
				{
				}
				
				
			}
			else
			{
		
				if($paramStatusHoliday[$checkTanggalSaja] == "LIBUR")
				{

					$TotalMenitKerja = $TotalMenitKerja + 0;

				}
				else if($paramStatusHoliday[$checkTanggalSaja] == "KERJA")
				{ 
					$TotalJamKerja = $TotalJamKerja + 14;
					$TotalMenitKerja = $TotalMenitKerja + 0;
					
				}
				
				if($debugMode == true)
				{
					echo " HARI DI HITUNG FULL DAY [$paramStatusHoliday[$checkTanggalSaja]] [FULL] <br>";
				}
				else
				{
				}
				
			
			}

		}
		
		if($debugMode == true)
		{
			echo $TotalJamKerja." JAM ".$TotalMenitKerja." MENIT <br><br>";
		}
		else
		{
		}
		
		
		$AkumulasiMenit = ($TotalJamKerja * 60) + $TotalMenitKerja;
		
		
		require('../lib/close_con.php'); 
		
		return $AkumulasiMenit;
	}        	
			
		
	/*
	echo $userid."</br>";
	echo $userpwd."</br>";
	echo $userbranch."</br>";
	echo $userregion."</br>";
	echo $userwfid."</br>";
	echo $setpage."</br>";
	*/
	
	
	
	$nama_workflow="";
	$time_workflow=0;
	$action_workflow="";
	$flag_workflow="";
	$strsql="select * from tbl_workflow where wf_id = '".$userwfid."'";
	$sqlcon = sqlsrv_query($conn, $strsql);
	if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlcon))
	{
		while($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
		{
			$nama_workflow=$rows['wf_name'];
			$flag_workflow=$rows['wf_flag'];
			$time_workflow=$rows['wf_time'];
			$action_workflow=$rows['wf_action'];
		}
	}
	
	$flag4 = substr($flag_workflow,0,1);
	
	
	//echo $flag4;
	

	
	
	
	
	$tsql = "select getdate() as 'date'";
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
			$getdate = $row['date']->format("Y-m-d H:i:s");
		}
	}
	
	
	///get who ao create application
	$getfirstflow="";
	$strsql="select * from Tbl_PrevFlow where prev ='000'";
	$sqlcon = sqlsrv_query($conn, $strsql);
	if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlcon))
	{
		while($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
		{
			$getfirstflow=$rows['Flow'];
		}
	}
	
	
	
	$prev_flow="";
	$flowrules="";
	$nextflowrules="";
	$strsql="select * from Tbl_PrevFlow where Flow ='".$userwfid."'";
	$sqlcon = sqlsrv_query($conn, $strsql);
	if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlcon))
	{
		while($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
		{
			$prev_flow=$rows['Prev'];
			$flowrules=$rows['Next'];
			$nextflowrules=$rows['Rules'];
		}
	}
	
	$user_permissions="";
	$strsql="select * from Tbl_SE_UserProgram where user_id='".$userid."' and program_code='".$userwfid."'";
	$sqlcon = sqlsrv_query($conn, $strsql);
	if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlcon))
	{
		while($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
		{
			$user_permissions=$rows['user_permissions'];
		}
	}
	
	
	//user level 
	$user_level_code="";
	$user_child="";
	$strsql="select * from Tbl_SE_User where user_id='".$userid."'";
	
	
	//$strsql="select * from Tbl_SE_User where user_id='egy252'";
	$sqlcon = sqlsrv_query($conn, $strsql);
	if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlcon))
	{
		while($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
		{
			$user_level_code=$rows['user_level_code'];
			$user_child=$rows['user_child'];
		}
	}
	
	
	
	//Kantor Pusat
	$centerbranch="";
	$strsql="select * from tbl_branch where branch_flag='Y'";
	$sqlcon = sqlsrv_query($conn, $strsql);
	if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlcon))
	{
		while($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
		{
			$centerbranch =$rows['branch_code'];
		}
	}
	
	$kantorpusatcondition="";
	if($centerbranch!="")
	{
	$kantorpusatcondition="";
	}
	
	
	
	//kodisi branchcluster
	
	$branch_to="";
	$branch_name="";
	$strsql="select branch_name,* from tbl_branchcluster a
			join tbl_branch b on a.branchto = b.branch_code 
			where a.branch = '".$userbranch."' and a.flowcode='".$userwfid."'";
	$sqlcon = sqlsrv_query($conn, $strsql);
	if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlcon))
	{
		while($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
		{
			$branch_name=$rows['branch_name'];
			$branch_to=$rows['branchto'];
		}
	}
	
	//get child branch
	$childbranch="";
	$strsql="select branch_name,* from tbl_branchcluster a
			join tbl_branch b on a.branchto = b.branch_code 
			where a.branchto = '".$userbranch."' and a.flowcode='".$userwfid."'";
	$sqlcon = sqlsrv_query($conn, $strsql);
	if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlcon))
	{
		while($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
		{
			$childbranch .=$rows['branch']."','";
		}
	}
	
	$branch_condition=" a.branch in ('".$userbranch."')";
	
	$user_condition='';
	if($user_level_code=="160")
	{
		$user_condition="and isnull(f.txn_user_id,b.txn_user_id) in ('".$userid."')";
	}
	else if($user_level_code=="140")
	{
		$user_condition="and isnull(f.txn_user_id,b.txn_user_id) in (".substr("'".str_replace("|","','",$user_child),0,-2).")";
	}
	
	if($childbranch!="")
	{
		$user_condition="";
		$branch_condition=" a.branch in ('".$userbranch."','".substr($childbranch,0,-2).")";
		
		
	}
	

	
	
	
	$linknewapp='';
	$strsqlshow='';
	$checkprevbtnpage="";
	$checknextbtnpage="";
	$endpage=1;
	if ($prev_flow == "000")
	{
	$linknewapp='
	<div style="position:relative;">
	<div style="position:absolute;margin-top:100px;left:50%;margin-left:-155px;margin-top:100px;">
				<div style="text-align:center;border:0px solid black;float:left;margin-right:10px"><input style="height:100px;width:150px;" id="1" type="button" onclick="newID(this.id)"  value="NEW APP"/></div>
				<div style="text-align:center;border:0px solid black;float:left;"><input style="height:100px;width:150px;" id="2" type="button" onclick="newID(this.id)"  value="TOP UP"/></div>
	</div>
	</div>
	';
	
	}
	else
	{
		//paging
		$strsqlshow="
			select *,CHARINDEX(chxaction,'".$user_permissions."') as 'checkshowbutton' from (
			select ROW_NUMBER() OVER(ORDER BY isnull(b.txn_time,c.txn_time) desc) as 'idx',a.custnomid,a.nama,a.branch,isnull(e.tua_nomid,'') as 'tua_nomid',
			case when ISNULL(b.txn_id,'')='' then 'I' 
			when  b.txn_action ='I' then 'C'
			when  b.txn_action ='C' then 'A'
			else b.txn_action end as 'chxaction',
			isnull(b.txn_action,'') as 'actionatflow',
			DATEDIFF(MINUTE, isnull(b.txn_time,c.txn_time), GETDATE()) as 'txn_time',
			isnull(b.txn_time,c.txn_time) as 'showtime'
			from Tbl_Information_Head a
			join Tbl_FSTART f on f.txn_id = a.custnomid
			join Tbl_F".$prev_flow." c on c.txn_id = a.custnomid
			left join Tbl_F".$userwfid." b on b.txn_id = a.custnomid
			left join Tbl_TemporariUserAkses e on e.tua_nomid=a.custnomid
			where ((b.txn_action <>'A' and b.txn_action <>'J') or ISNULL(b.txn_action,'')='')
			and c.txn_action='A' 
			and( ISNULL(e.tua_userid,'')='' or e.tua_userid='".$userid."')
			and (ISNULL(e.tua_wfid,'')='' or e.tua_wfid='".$userwfid."')
			and (".$branch_condition." or e.tua_userid='".$userid."')
			".$user_condition."
			)tblxxx 
			";
			//echo $strsqlshow;
		$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
		$params = array(&$_REQUEST['query']);
		$sqlcon = sqlsrv_query($conn, $strsqlshow, $params, $cursorType);
		if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
		$rowCounter = sqlsrv_num_rows($sqlcon);
		
		
		
	
	
		//setting perpage
		$maxperpage=5;
		
		$lastpage=intval($rowCounter/$maxperpage)+1;
		
		
		if(isset($_REQUEST['no_page']))
		{
			$endpage=$_REQUEST['no_page'];
		}
		
		//echo $endpage."<br/>";
		$firstpage=$endpage-1; 	
		
		
		
		$startidx=($firstpage*$maxperpage)+1;
		if($endpage=="1")
		{
			$checkprevbtnpage='disabled="disabled"';
			$startidx=0;
		}
		$endidx=$endpage*$maxperpage;
		
		
		
		if($endpage==$lastpage)
		{
			$checknextbtnpage='disabled="disabled"';
		}
		
	}
		
		
		$tmpstatusdoc="";
$checkupload="select * from tbl_docparamworkflow where wf_id='".$userwfid."'";
$ctcu = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_REQUEST['query']);
$sqlcon = sqlsrv_query($conn, $checkupload, $params, $ctcu);
if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
$rowctcu = sqlsrv_num_rows($sqlcon);
if(sqlsrv_has_rows($sqlcon))
{
	while($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
	{
		$tmpstatusdoc.=$rows['doc_id']."','";
	}
}
	$statusdoc="'".substr($tmpstatusdoc,0,-2);
	if($tmpstatusdoc=="")
	{
	$statusdoc="''";
	}
	
	
	//echo $statusdoc;
	
	
?>  

<html> 
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="../js/jquery-latest.min.js" type="text/javascript"></script>
		<link href="../js/CSS/niceforms-default.css" type="text/css" rel="stylesheet" />
		<link href="../js/CSS/greenyours.css" type="text/css" rel="stylesheet" />
		<!--<script type="text/javascript" src="../js/jquery-1.7.2.min.js" ></script>-->
		<script type="text/javascript">
			function show_detail(thisid)
			{
				//alert(thisid);
				$("#dtl"+thisid).css({
					"display":"block"
				});
			}
			
			function hidedtl(thisid)
			{
				//alert("hide");
				$("#dtl"+thisid).css({
					"display":"none"
				});
			}
			
			function doflow(thisid,action)
			{
				document.getElementById('custnomid').value=thisid;
				document.getElementById('userpermission').value = action;
				document.getElementById('formsubmit').action = "./form<?=$userwfid;?>.php";
				document.getElementById('formsubmit').submit();
			}
			
			function docheckflow(thisid,action)
			{
				document.getElementById('custnomid').value=thisid;
				document.getElementById('userpermission').value = action;
				document.getElementById('formsubmit').action = "./checkclusterflow.php";
				document.getElementById('formsubmit').submit();
			}
			
			
			function newID(thisid)
			{
				
				document.getElementById('custnomid').value="";
				document.getElementById('checktypeloaderik').value=thisid;
				document.getElementById('userpermission').value = "I";
				document.getElementById('formsubmit').action = "./form<? echo $userwfid; ?>.php";
				document.getElementById('formsubmit').submit();
			}
			
			function paging(filter)
			{
				//alert(filter);
				if(filter=="next")
				{
					document.getElementById('no_page').value=parseInt(<?=$endpage?>+1);
					document.getElementById('formsubmit').action = "./flow.php";
					document.getElementById('formsubmit').submit();
				}
				else if(filter=="prev")
				{
					document.getElementById('no_page').value=parseInt(<?=$endpage?>-1);
					document.getElementById('formsubmit').action = "./flow.php";
					document.getElementById('formsubmit').submit();
				}
			}
			function refreshhtml()
			{
				window.location.reload()
			}
		</script>
	</head>
		<body>
			<form name=formhome id="formsubmit" class="niceform" method=post>
			<div style="position:fixed;">
				<img src="../images/header_lis2.jpg" style="width:100%;"></img>
			</div>
			<div style="border:0px solid black;width:23%;height:545px;margin-top:7%;float:left;position:fixed;">
<?
		include("headermenu.php");
?>
				<img src="../images/gimmick_logo.png" style="position:absolute;bottom:0;width:60%;margin-left:20%;margin-right:20%;"></img>
			</div>
			<div align=center style="float:right;width:75%;margin-top:7%;margin-right:2%;">
					<div style="border:1px solid black;text-align:center;">
						<div style="line-height:30px"><a href=""><?=$nama_workflow?> (<? echo $userwfid ?>)</a></div>
						<div style="line-height:30px">SLA dihitung mulai jam 8 pagi sampai jam 22. Hari Sabtu / Minggu dan Libur tidak dihitung</div>
						<div style="line-height:30px"><input <?=$checkprevbtnpage?> style="font-size:8px;" onclick="paging('prev')" type="button"value="<"/> <?=$endpage?> <input <?=$checknextbtnpage?> style="font-size:8px;" onclick="paging('next')" type="button" value=">"/></div>
					</div>
					
					<?=$linknewapp?>
					
					<?php
					if ($prev_flow != "000")
					{
					?>
					<div style="border:0px solid black;text-align:center;margin-top:20px;">
					<div style="text-align:right"><a href="javascript:refreshhtml()">refresh</a></div>
						<table style="width:100%;border-collapse:collapse;border:1px solid black;margin-top:5px;">
							<tr style="background:#00B3FF;line-height:30px;height:30px;">
								<th style="width:200px;">No Aplikasi</th>
								<th style="width:400px;">Nama</th>
								<th style="width:150px;">Time</th>
								<th style="width:150px;">Action</th>
							</tr>
								<?php
									$btnaction='';
									
									$strsql=$strsqlshow." where idx between ".$startidx." and ".$endidx." ";
											//echo $strsql;
									$sqlcon = sqlsrv_query($conn, $strsql);
									if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
									if(sqlsrv_has_rows($sqlcon))
									{
										while($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
										{
											$buttonreject='';
											$showtime=$rows['showtime']->format("M d Y H:i:s A");
											$checkdiftime=$rows['showtime']->format("Y-m-d H:i:s");
											
											$dateTemp1 = new DateTime($checkdiftime);
											$dateTemp2 = new DateTime($getdate);

											$hitmenit = CountTotalDateTime($dateTemp1,$dateTemp2);
											
											
											
											$user_ao_code="";
											$strsql2="
													select user_ao_code from Tbl_F".$getfirstflow." a
													join Tbl_SE_User b on a.txn_user_id = b.user_id
													where a.txn_id='".$rows['custnomid']."'
													";
											$sqlcon2 = sqlsrv_query($conn, $strsql2);
											if ( $sqlcon2 === false)die( FormatErrors( sqlsrv_errors() ) );
											if(sqlsrv_has_rows($sqlcon2))
											{
												while($rows2 = sqlsrv_fetch_array($sqlcon2, SQLSRV_FETCH_ASSOC))
												{
													
													$user_ao_code=$rows2['user_ao_code'];
												}
											}
											$countrows=0;
											$strsql2="select count(*) as b from (select doc_id,doc_type from Tbl_Document where doc_id='".$rows['custnomid']."'
														and doc_type in(".$statusdoc.")
														group by doc_id,doc_type) tblxxx";
														//echo $strsql2."</br>";
											$sqlcon2 = sqlsrv_query($conndm, $strsql2);
											if ( $sqlcon2 === false)die( FormatErrors( sqlsrv_errors() ) );
											if(sqlsrv_has_rows($sqlcon2))
											{
												while($rows2 = sqlsrv_fetch_array($sqlcon2, SQLSRV_FETCH_ASSOC))
												{
													
													$countrows=$rows2['b'];
												}
											}
											
											
											
											//$differrentminute=$rows['txn_time'];
											
											if ($hitmenit > $time_workflow)
											{
												$varwarning = "<img src=../images/alert.black.gif> $hitmenit menit, time $time_workflow";
											}
											else
											{
												$varwarning = "$hitmenit menit";
											}
											
											
											
												$uploadgambar="";
												$kuda="";
												
												
												
												//echo $countrows.' - - - '.$rowctcu.' - - '.$kuda;
												
												$showbutton='';
												$trbackground="background:#FFFFCC;";
												$chxaction = $rows['chxaction'];
												$checkshowbutton = $rows['checkshowbutton'];
												$action="";
												
												$key = $rows['custnomid'];
												
												$db = new DB_EFILLING();
												$db->connect();
												
									$sql_total = "select count(*) as total from tbl_doctype";
									$db->executeQuery($sql_total);
									$result_total = $db->lastResults;
									$total = $result_total[0]['total'];
									
									if(false)
									{
										echo "<pre>";
										print_r($result_total);
										echo "</pre>";
									}
									
									$sql_count = "select count(*) as counter from Tbl_Document where doc_index2 ='$key' and doc_type in (select doc_code from tbl_doctype)";
									$db->executeQuery($sql_count);
									$result_count = $db->lastResults;
									$count = $result_count[0]['counter'];
									
									if(false)
									{
										echo "<pre>";
										print_r($result_count);
										echo "</pre>";
									}
												
												//$linkdm='http://'.$ipdm.'/naiprojects/Lis_mikro/spindm/flowuploaddoc.php?custnomid='.$rows['custnomid'].'&userid='.$userid.'&userpwd='.$userpwd.'&userbranch='.$userbranch.'&userregion='.$userregion.'&userwfid='.$userwfid.'&statusdoc='.$userwfid;
												
$linkdm = "http://10.37.129.3/naiprojects/PROJECT_EFILLING/external_upload.php?userid=user&username=user&userpwd=ee11cbb19052e40b07aac0ca060c23ee&userorganization=PRIVATE&thecabinet=eILk6fO0&thedrawer=eILk6kSR&act=upload&key=$key";
									
												if($total>0)
												{
													
													$uploadgambar='<div style="margin-bottom:5px;"><a target="'.$rows['custnomid'].'" href="'.$linkdm.'">Upload Doc('.$countrows.'/'.$rowctcu.')</a></div>';
													
													$uploadgambar='<div style="margin-bottom:5px;"><a target="'.$rows['custnomid'].'" href="'.$linkdm.'">Upload Doc('.$count.'/'.$total.')</a></div>';
													
												}
												
												if($chxaction=="I")
												{
													$trbackground="";
													$action="I";
													
													if($countrows==$rowctcu)
													{
														//echo $rows['custnomid'];
														$kuda='<div style="margin-bottom:5px;"><a style="width:70px:cursor:pointer;" href="javascript:doflow(\''.$rows['custnomid'].'\',\''.$action.'\');" >Submit</a></div>';
													}
													
													$klikinput='javascript:docheckflow(\''.$rows['custnomid'].'\',\''.$action.'\');';
													
													$btnaction='
													<div style="margin-bottom:5px;">
													<a style="width:70px:cursor:pointer;"  href="'.$klikinput.'" >Input</a>
													</div>
													'.$uploadgambar.'
													';
												}
												else if($chxaction=="C")
												{
													$action="C";
														
													if($countrows==$rowctcu)
													{
														//echo $rows['custnomid'];
														$kuda='<div style="margin-bottom:5px;"><a style="width:70px;cursor:pointer;" href="javascript:doflow(\''.$rows['custnomid'].'\',\''.$action.'\');" >Submit</a></div>';
													}	
													
													$btnaction='
													<div style="margin-bottom:5px;">
													<a style="width:70px;cursor:pointer;" href="javascript:doflow(\''.$rows['custnomid'].'\',\''.$rows['actionatflow'].'\');" >Update</a>
													</div>
													'.$uploadgambar.$kuda.'
													';
												}
												else if($chxaction=="A")
												{
													$action="A";
													$btnaction='<a style="width:70px;cursor:pointer;text-decoration:underline;" onclick="doflow(\''.$rows['custnomid'].'\',\''.$action.'\');" >Approve</a>';
												}
												
												
												
												if($flag4=="Y")
												
												{
													$buttonreject = '<div style="margin-top:5px;"><a href="Delete_Application.php?userid=<? echo $userid; ?>&userpwd=<? echo $userpwd; ?>&userbranch=<? echo $userbranch; ?>&userregion=<? echo $userregion; ?>&custnomid=<? echo $rowawal[0]; ?>&userpermission=I&buttonaction=ICA&userwfid=ALL"><font color="#FF0000">Reject Application</font></a></div>';
												}
												
												
												
												
												
												$showbutton="Not Your Autority";	
												
												$indexof = strrpos($user_permissions, $action);
												if ($checkshowbutton >0 ) { 
													$showbutton=$btnaction.$buttonreject;
												}
												
												if($branch_to!="")
												{
													$showbutton="Akan di proses di cabang </br>".$branch_name." </br>(".$branch_to.")";
												}
												
												
												
												$strsql2="select * from tbl_information_detail where custnomid='".$rows['custnomid']."'";
												//$sqlcon2 = sqlsrv_query($conn, $strsql2);
												//if ( $sqlcon2 === false)die( FormatErrors( sqlsrv_errors() ) );
												
												
												$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
												$params = array(&$_REQUEST['query']);
												$sqlcon2 = sqlsrv_query($conn, $strsql2, $params, $cursorType);
												if ( $sqlcon2 === false)die( FormatErrors( sqlsrv_errors() ) );
												$rowCounter2 = sqlsrv_num_rows($sqlcon2);
												
												/*
                                                select b_name from Tbl_CustomerMasterPerson a
                                                join ms_tipedebitur b on a.custtarid = b._idx
                                                */
                                                
												$jeniscustomer="Perorangan";
												$strsql2="  select b._name from Tbl_CustomerMasterPerson a
                                                            join ms_tipedebitur b on a.custtarid = b._idx
                                                            where a.custnomid='".$rows['custnomid']."'";
												//echo $strsql2;
												$sqlcon2 = sqlsrv_query($conn, $strsql2);
												if ( $sqlcon2 === false)die( FormatErrors( sqlsrv_errors() ) );
												if(sqlsrv_has_rows($sqlcon2))
												{
													while($rows2 = sqlsrv_fetch_array($sqlcon2, SQLSRV_FETCH_ASSOC))
													{	
                                                        $jeniscustomer=$rows2['_name'];	
													}
												}
												//echo $jeniscustomer;
												
												
												$strsql2="select * from tbl_reference where custnomid='".$rows['custnomid']."'";
												//$sqlcon2 = sqlsrv_query($conn, $strsql2);
												//if ( $sqlcon2 === false)die( FormatErrors( sqlsrv_errors() ) );
												
												
												$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
												$params = array(&$_REQUEST['query']);
												$sqlcon2 = sqlsrv_query($conn, $strsql2, $params, $cursorType);
												if ( $sqlcon2 === false)die( FormatErrors( sqlsrv_errors() ) );
												$rowCounter333 = sqlsrv_num_rows($sqlcon2);
												
												$jenisbaruortopup = "Top Up";
												if($rowCounter333==0)
												{
												$jenisbaruortopup = "Baru";	
												}
												
												
												
												echo '<tr style="'.$trbackground.' height:100px;">';
													echo '<td>';
													//if($rowCounter2!=0){
														//echo '<a href="javascript:show_detail(\''.$rows['custnomid'].'\')">'.$rows['custnomid'].'</a>';
													//}
													//else
													//{
														echo '<div class="boldstyle">'.$rows['custnomid'].'</div>';
														echo '<div style="font-size:12px;">Branch : '.$rows['branch'].'</div>';
														echo '<div style="font-size:12px;">';
															if($user_ao_code!="")
															{
															echo 'Ao Code : '.$user_ao_code;
															}
														echo '</div>';
													//}
													echo '</td>';
													echo '<td>';
														echo '<div class="boldstyle">'.$jeniscustomer.' ('.$jenisbaruortopup.')</div>';
														echo '<div class="boldstyle">'.$rows['nama'].'</div>';
														echo '<div style="font-size:12px;">'.$varwarning.'</div>';
													echo '</td>';
													echo '<td>'.$showtime.'</td>';
													echo '<td>'.$showbutton.'</td>';
												echo "</tr>";
												if(sqlsrv_has_rows($sqlcon2))
												{
													if($rows2 = sqlsrv_fetch_array($sqlcon2, SQLSRV_FETCH_ASSOC))
													{
													echo '<tr style="'.$trbackground.'" id="dtl'.$rows['custnomid'].'" class="dtlhide">';
														echo '<td colspan="4" style="width:100%;">';
															echo '<table style="width:100%;margin-top:20px;">';
																echo '<tr>';
																	echo '<th colspan="5">Detail Information</th>';
																echo '</tr>';
																echo '<tr>';
																	echo '<td>Field 1</td>';
																	echo '<td>Field 2</td>';
																	echo '<td>Field 3</td>';
																	echo '<td>Field 4</td>';
																echo '</tr>';
																echo '<tr>';
																	echo '<td>'.$rows2['A'].'</td>';
																	echo '<td>'.$rows2['B'].'</td>';
																	echo '<td>'.$rows2['C'].'</td>';
																	echo '<td>'.$rows2['D'].'</td>';
																echo '</tr>';
															echo '</table>';
															echo '</br>';
															echo '<div style="text-align:right;"><a href="javascript:hidedtl(\''.$rows['custnomid'].'\')">Close Detail</a></div>';
															echo '</br>';
															echo '</br>';
														echo '</td>';
													echo "</tr>";
												}
											}
										}
									}
								?>
						</table>
					</div>
					<?php 
					}
					?>
			
				<?
					echo '
					<div>
					<input type="hidden" name="userid" id="userid" value="'.$userid.'" />
					<input type="hidden" name="userpwd" id="userpwd" value="'.$userpwd.'" />
					<input type="hidden" name="userbranch" id="userbranch" value="'.$userbranch.'" />
					<input type="hidden" name="userregion" id="userregion" value="'.$userregion.'" />
					<input type="hidden" name="userwfid" id="userwfid" value="'.$userwfid.'" />
					
					</div>
					';
				?>
				<input type="hidden" name="custnomid" id="custnomid" />
				<input type="hidden" name="userpermission" id="userpermission" />
				<input type="hidden" name="no_page" id="no_page" />
				<input type="hidden" name="buttonaction" id="buttonaction" />
				<input type="hidden" name="checktypeloaderik" id="checktypeloaderik" />
			</div>
		</div>
		</form>
	</body>
</html>     