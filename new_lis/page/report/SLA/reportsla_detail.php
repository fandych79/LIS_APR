<?php
include ("../../../lib/formatError.php");
require ("../../../lib/open_con.php");
$search = $_REQUEST['custnomid'];
//ini_set("display_errors", 0);
set_time_limit(3000);



//GET PARAM BRANCH

$tsql = "select * from Tbl_branch";
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
	while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
	{
	   $param_branch[$row[0]]=$row[1];
	}
}
sqlsrv_free_stmt( $sqlConn );


//GET PARAM PLAFOND
$tsql = "select * from tbl_customerMasterPerson";
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
		$custNomId = $row['custnomid'];
		
		$tsqlf = "select sum(custcreditplafond)as plafond from Tbl_customerFacility2 where custnomid = '$custNomId'";
		$cursorTypef = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
		$paramsf = array(&$_POST['query']);
		$sqlConnf = sqlsrv_query($conn, $tsqlf, $paramsf, $cursorTypef);
		
		if($sqlConnf === false)
		{
			die(FormatErrors(sqlsrv_errors()));
		}
		
		if(sqlsrv_has_rows($sqlConnf))
		{
			$rowCountf = sqlsrv_num_rows($sqlConnf);
			while( $rowf = sqlsrv_fetch_array( $sqlConnf, SQLSRV_FETCH_ASSOC))
			{
				$param_plafond[$custNomId]=$rowf['plafond'];
			}
		}
		sqlsrv_free_stmt( $sqlConnf );
	  	
	}
}
sqlsrv_free_stmt( $sqlConn );



//GET PARAM DEBITUR NAME

$tsql = "select * from tbl_customerMasterPerson where custnomid = '$search'";
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
		if($row['custsex'] == "0")
		{
	   		$param_debitur[$row['custnomid']]=$row['custbusname'];
		}
		else
		{
			$param_debitur[$row['custnomid']]=$row['custfullname'];
		}
	}
}
sqlsrv_free_stmt( $sqlConn );


//GET PARAM FLOW NAME
$sql_query = "SELECT * FROM Tbl_workflow where wf_id <> 'START' order by wf_urut ";
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);
$sqlConn = sqlsrv_query($conn, $sql_query, $params, $cursorType);
if ( $sqlConn === false)
{
	die( FormatErrors( sqlsrv_errors() ) );
}
if(sqlsrv_has_rows($sqlConn))
{
	$x=0;
	$rowCount = sqlsrv_num_rows($sqlConn);
	while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
	{
		
		$paramFlowName[$row['wf_id']] = $row['wf_name'];
		$paramSLATime[$row['wf_id']] = $row['wf_time'];
		
		$allFlow[$x] = $row['wf_id'];
		$x++;
	}
}
sqlsrv_free_stmt( $sqlConn);
//END PARAM FLOW NAME

//array_shift($allFlow);
array_pop($allFlow);

//print_r($param_plafond);


/*
echo "<pre>";
print_r($allFlow);
echo "</pre>";
*/

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../../../css/d.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SLA REPORT</title>
<!--
<style type="text/css" title="currentStyle">
    @import "../../lib/css/demo_page.css";
    @import "../../lib/css/demo_table_jui.css";
    @import "../../lib/css/cupertino/jquery-ui-1.8.21.custom.css";
</style>
<script type="text/javascript" language="javascript" src="../js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" language="javascript" src="../js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
/*

$(document).ready( function()
{
	var oTable = $('#example').dataTable(
	{
		"sScrollY": 400,
		"bJQueryUI": true,
		"sScrollX": "100%",
		"sScrollXInner": "150%",
		"bScrollCollapse": true,
		"sPaginationType": "full_numbers",
		"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		"oLanguage": {
            "sSearch": "Search All:"
		},

		"fnDrawCallback": function ( oSettings ) {
            if ( oSettings.aiDisplay.length == 0 )
            {
                return;
            }
             
            var nTrs = $('#example tbody tr');
            var iColspan = nTrs[0].getElementsByTagName('td').length;
            var sLastGroup = "";
            for ( var i=0 ; i<nTrs.length ; i++ )
            {
                var iDisplayIndex = oSettings._iDisplayStart + i;
                var sGroup = oSettings.aoData[ oSettings.aiDisplay[iDisplayIndex] ]._aData[0];
                if ( sGroup != sLastGroup )
                {
                    var nGroup = document.createElement( 'tr' );
                    var nCell = document.createElement( 'td' );
                    nCell.colSpan = iColspan;
                    nCell.className = "group";
                    nCell.innerHTML = sGroup;
                    nGroup.appendChild( nCell );
                    nTrs[i].parentNode.insertBefore( nGroup, nTrs[i] );
                    sLastGroup = sGroup;
                }
            }
        },
		"aaSortingFixed": [[ 0, 'asc' ]],
        "aaSorting": [[ 1, 'asc' ]],
        "sDom": 'lfr<"giveHeight"t>ip'
	
		
		
	} );
	
		
} );

*/
</script>
-->

</head>

<body>
<div align="center">
<div id="dt_example">
<div id="title" align="center">REPORT SLA</div>
<table class="display" id="example" width="960px" border="1" cellspacing="0" cellpadding="0">
<thead>
    <tr>
        <th width="10%" scope="col">Customer ID</th>
        <th width="20%" scope="col">Debitur</th>
        <th width="15%" scope="col">Plafond</th>
        
        <th width="10%" scope="col">Process</th>
        <th width="5%" scope="col">Input Date</th>
        <th width="5%" scope="col">Approve Date</th>
        <th width="5%" scope="col">Duration</th>
        <th width="5%" scope="col">SLA</th>
        <th width="5%" scope="col">Notes</th>
    </tr>
</thead>

<tbody>
<?
// SELECT ASSOC


$tsql = "select * from tbl_customerMasterPerson where custnomid = '$search'"; //echo $tsql;
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
		$custID = $row['custnomid'];
		
		$duit = $param_plafond[$custID];
		
		 
		
		?>
        <tr>
        <td rowspan="<? echo count($allFlow)+1;?>"><? echo $custID;?>&nbsp;</td>
        <td rowspan="<? echo count($allFlow)+1;?>"><? echo $param_debitur[$custID];?>&nbsp;</td>
        <td rowspan="<? echo count($allFlow)+1;?>"><? echo numberFormat($duit);?>&nbsp;</td>
        

        </tr>
        
		<?
		for($i=0;$i<count($allFlow);$i++)
		{
        ?>
        <tr>
        <td width="10%" scope="col"><? echo $paramFlowName[$allFlow[$i]];?>&nbsp;</td>
        
        
        <?
		$inputDate = "<font color=\"#FF0000\">NOT<br>INPUT</font>";
		$approveDate = "<font color=\"#FF0000\">IN<br>PROGRESS</font>";

		$tsqlh = "select * from tbl_sladetail where sla_nomid = '$custID' and sla_wfid = '$allFlow[$i]'";
		$cursorTypeh = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
		$paramsh = array(&$_POST['query']);
		
		$sqlConnh = sqlsrv_query($conn, $tsqlh, $paramsh, $cursorTypeh);
		
		if ( $sqlConnh === false)
		  die( FormatErrors( sqlsrv_errors() ) );
		
		if(sqlsrv_has_rows($sqlConnh))
		{
			$rowCounth = sqlsrv_num_rows($sqlConnh);
			while( $rowh = sqlsrv_fetch_array( $sqlConnh, SQLSRV_FETCH_ASSOC))
			{
				$inputDate = $rowh['sla_time_i']->format("d-M-Y h:i:s");
			}
		}
		sqlsrv_free_stmt( $sqlConnh );
		
		//echo $tsqlh."<br>";
		
		$tsqlh = "select * from tbl_sladetail where sla_nomid = '$custID' and sla_wfid = '$allFlow[$i]'";
		$cursorTypeh = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
		$paramsh = array(&$_POST['query']);
		
		$sqlConnh = sqlsrv_query($conn, $tsqlh, $paramsh, $cursorTypeh);
		
		if ( $sqlConnh === false)
		  die( FormatErrors( sqlsrv_errors() ) );
		
		if(sqlsrv_has_rows($sqlConnh))
		{
			$rowCounth = sqlsrv_num_rows($sqlConnh);
			while( $rowh = sqlsrv_fetch_array( $sqlConnh, SQLSRV_FETCH_ASSOC))
			{
				$approveDate = $rowh['sla_time_a']->format("d-M-Y h:i:s");
			}
		}
		sqlsrv_free_stmt( $sqlConnh );
		
		//echo $tsqlh."<br>";
		?>
        
        <td width="10%" align="center"><? echo $inputDate;?>&nbsp;</td>
        <td width="10%" align="center"><? echo $approveDate;?>&nbsp;</td>
        
        
        <?
		
		if(substr($inputDate,22,3)=="NOT" || substr($approveDate,22,2)=="IN")
		{
			$duration = "<font color=\"#FF0000\">NOT<br>COUNTING</font>";
		}
		else
		{
			$dateTemp1 = new DateTime($inputDate);
			$dateTemp2 = new DateTime($approveDate);

			$hitmenit = CountTotalDateTime($dateTemp1,$dateTemp2);
			$duration = $hitmenit;
		}
		
		?>
        
        <td width="5%" align="center"><? echo $duration;?>&nbsp;</td>
        <td width="5%" align="center"><? echo $paramSLATime[$allFlow[$i]];?>&nbsp;</td>
        
        
        <?
		if(substr($inputDate,22,3)=="NOT" || substr($approveDate,22,2)=="IN")
		{
			$notes = "<font color=\"#FF0000\">NOT<br>COUNTING</font>";
		}
		else
		{
			if($duration > $paramSLATime[$allFlow[$i]])
			{
				$temp = $duration - $paramSLATime[$allFlow[$i]];
				$notes = "> $temp";	
			}
			else
			{
				$temp = $paramSLATime[$allFlow[$i]] - $duration; 
				$notes = "< $temp";	
			}

		}
		?>
        
        <td width="5%" align="center"><? echo $notes;?>&nbsp;</td>
        </tr>
        
        
        <?
		}
		
	}
}
sqlsrv_free_stmt( $sqlConn );
?>
</tbody>

</table>

<?php //echo print_r($param_debitur);?>

</div>
<?php
$tsql = "select * from tbl_FSTART where txn_id = '$search' AND (txn_action = 'R' OR txn_action = 'J') "; //echo $tsql;
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);

$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);

if ( $sqlConn === false)
  die( FormatErrors( sqlsrv_errors() ) );

if(sqlsrv_has_rows($sqlConn))
{
	$rowCount = sqlsrv_num_rows($sqlConn);
	if( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
	{
		echo "<div style=\"border:1px solid red;width:300px;\"><font style=\"font-size:15px\" color=\"#FF0000\">APPLICATION REJECTED</font></div>";
	}
}

?>
</div>
</body>
</html>

<?
function CountTotalDateTime($Start, $End)
{
	$debugMode = false;
	
	$TotalMenitKerja = 0;
	$TotalJamKerja = 0;
	
	require_once ("../../../lib/formatError.php");
	require("../../../lib/open_con.php");
	
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
	
	return $AkumulasiMenit;
}
/*
function numberFormat($num)
{
     return preg_replace("/(?<=\d)(?=(\d{3})+(?!\d))/",",",$num);
}
*/
?>