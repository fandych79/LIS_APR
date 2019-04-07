<?
require_once ("../../../lib/open_con.php");
require_once ("../../../lib/formatError.php");

$userid=$_REQUEST['userid'];
$userbranch=$_REQUEST['userbranch'];
$userregion=$_REQUEST['userregion'];

require("../../../requirepage/level.php");



$contentperpage=10;

$clickpage=1;
if(isset($_REQUEST['page']))
{
$clickpage=$_REQUEST['page'];
}


/*
$totalpage=0;
$strsql="
select  cast((COUNT(*)/".$contentperpage.") as int)+ (case when (COUNT(*)%".$contentperpage.")<>0 then 1 else 0 end) as 'totalpage', count(*) as 'ttlapp'
from Tbl_CustomerMasterPerson2 a
join Tbl_FSTART b on a.custnomid = b.txn_id
where ".substr($querylevelcode,0,-4)."";
$sqlcon = sqlsrv_query($conn, $strsql);
if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
if(sqlsrv_has_rows($sqlcon))
{
	if($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
	{
		$totalpage=$rows['totalpage'];
		$ttlapp=$rows['ttlapp'];
	}
}

$startrow=($clickpage-1)*10;
if ($clickpage!="1")
{
$startrow+=1;
}
$endrow=$clickpage*10;
*/




?>



<html>
	<head>
		<script type="text/javascript" src="../../../js/datetimepicker_css.js"></script>
		<script type="text/javascript" src="../../../js/jquery-1.7.2.min.js" ></script>
		<script type="text/javascript" src="../../../js/full_function.js" ></script>
		<script type="text/javascript" src="../../../js/accounting.js" ></script>
		<link href="../../../css/d.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
			var userid = "<?echo $userid?>";
			var userbranch = "<?echo $userbranch?>";
			var userregion = "<?echo $userregion?>";
			
			function btnpage(thisid)
			{
				var rand_no1 = Math.random();
				var rand_no2 = Math.random();
				var rand_no = rand_no1 * rand_no2;
				var page = $("#"+thisid).val();
				//alert (page);
				$.ajax	
				({
					type: "GET",
					url: "returnajax.php",
					data: "page="+page+"&userbranch="+userbranch+"&userregion="+userregion+"&userid="+userid+"&random="+ rand_no +"",
					success: function(response)
					{
						//alert(response);
						$("#result").html(response);
					}
				});
			}
		</script>
	</head>
	<body>
		<form id="formentry" name="formentry" method="post">
			<div style="font-size:16;font-weight:bold; text-align:center;">REPORT SLA</div>
			<div>&nbsp;</div>
			<div>&nbsp;</div>
			<div id="result">
				<? require("returnajax.php");?>
			<div>
		</form>
	</body>
</html>

