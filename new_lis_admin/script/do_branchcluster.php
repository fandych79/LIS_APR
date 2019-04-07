<?php
require ("../lib/open_con.php");
require ("../lib/formatError.php");

if($_REQUEST['newbranchid']!="")
{
	$utilformname=$_POST['utilformname'];
	$utilformfield=$_POST['utilformfield'];
	$newcluster=$_POST['newcluster'];
	$newbranchid="";
	$newbranchname="";
	$btnname="";
	$flowde="";
	$branchde="";
	if(isset($_REQUEST['newbranchid']))
	{
	$newbranchid=$_REQUEST['newbranchid'];
	}
	if(isset($_REQUEST['newbranchname']))
	{
	$newbranchname=$_REQUEST['newbranchname'];
	}
	if(isset($_REQUEST['btnname']))
	{
	$btnname=$_REQUEST['btnname'];
	}
	if(isset($_REQUEST['flowde']))
	{
	$flowde=$_REQUEST['flowde'];
	}
	if(isset($_REQUEST['branchde']))
	{
	$branchde=$_REQUEST['branchde'];
	}

	$strsql="select getdate()";
	if ($btnname=="add")
	{
		$strsql = "insert into tbl_branchcluster_oto(branch,flowcode,branchto,method,flag) values ('".$newbranchid."','".$_REQUEST['flow']."','".$_REQUEST['branch']."','0','1')";
	}
	else if ($btnname=="edit")
	{
		$sqlbranchto="";
		$sqlbranchmethod="";
		$strsql="select * from tbl_branchcluster_oto where flowcode='".$flowde."' and branch='".$newbranchid."'";
		$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
		$params = array(&$_REQUEST['query']);
		$sqlcon = sqlsrv_query($conn, $strsql, $params, $cursorType);
		if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
		$rowCounter = sqlsrv_num_rows($sqlcon);
		
		$strsql="select getdate()";
		if ($rowCounter!=0)
		{
			$strsql = "update tbl_branchcluster_oto set branchto='".$branchde."', method='".$branchde."', flag='2'  where flowcode='".$flowde."' and branch='".$newbranchid."'";
		}
	}
	else if ($btnname=="del")
	{
		$strsql = "update tbl_branchcluster_oto set branchto='".$branchde."', method='".$branchde."', flag='3'  where flowcode='".$flowde."' and branch='".$newbranchid."'";
		//$strsql = "delete from tbl_branchcluster_oto where flowcode='".$flowde."' and branch='".$newbranchid."'";
	}


	//echo $strsql;
	$params = array(&$_POST['query']);
	$stmt = sqlsrv_prepare( $conn, $strsql, $params);
	if(!$stmt ){
	echo "Error in preparing statement.\n";
	die( print_r( sqlsrv_errors(), true));
	}
	if(!sqlsrv_execute( $stmt)){
	echo "Error in executing statement.\n";
	die( print_r( sqlsrv_errors(), true));
	}
	sqlsrv_free_stmt( $stmt);


	if ($btnname!="")
	{
	?>
	<html>
		<head>
			<script type="text/javascript" src="../js/jquery-1.7.2.min.js" ></script>
			<script type="text/javascript">
				
				function bodyonload()
				{
					document.getElementById('frm').action = "./addbranchcluster.php";
					document.getElementById('frm').submit();
				}
				
			</script>
		</head>
		<body onload="bodyonload();">
			<form id="frm" name="frm" method="post">
				<input type="hidden" name="newbranchid" id="newbranchid" value="<?=$newbranchid?>"/>
				<input type="hidden" name="fromthispage" id="fromthispage" value="<?=$newbranchid?>"/>
				<input type="hidden" name="newbranchname" id="newbranchname" value="<?=$newbranchname?>"/>
				<input type="hidden" name="utilformname" id="utilformname" value="<?=$utilformname?>"/>
				<input type="hidden" name="utilformfield" id="utilformfield" value="<?=$utilformfield?>"/>
				<input type="hidden" name="newcluster" id="newcluster" value="<?=$newcluster?>"/>
			</form>
		</body>
	</html>
	<?php
	}
}
?>