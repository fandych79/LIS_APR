<?php
require ("../lib/open_con.php");
require ("../lib/formatError.php");

if($_REQUEST['newwfid']!="")
{
	$utilformname=$_POST['utilformname'];
	$utilformfield=$_POST['utilformfield'];
	//$newcluster=$_POST['newcluster'];
	$newwfid="";
	$newwfname="";
	$btnname="";
	$flowde="";
	$branchde="";
	if(isset($_REQUEST['newwfid']))
	{
	$newwfid=$_REQUEST['newwfid'];
	}
	if(isset($_REQUEST['newwfname']))
	{
	$newwfname=$_REQUEST['newwfname'];
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
		$strsql = "insert into tbl_docparamworkflow(wf_id,doc_id,flag) values ('".$newwfid."','".$_REQUEST['flow']."','1')";
	}
	else if ($btnname=="edit")
	{
		$sqlbranchto="";
		$sqlbranchmethod="";
		$strsql="select * from tbl_docparamworkflow where flowcode='".$flowde."' and branch='".$newwfid."'";
		$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
		$params = array(&$_REQUEST['query']);
		$sqlcon = sqlsrv_query($conn, $strsql, $params, $cursorType);
		if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
		$rowCounter = sqlsrv_num_rows($sqlcon);
		
		$strsql="select getdate()";
		if ($rowCounter!=0)
		{
			$strsql = "update tbl_docparamworkflow set branchto='".$branchde."', method='".$branchde."', flag='2'  where flowcode='".$flowde."' and branch='".$newwfid."'";
		}
	}
	else if ($btnname=="del")
	{
		$strsql = "update tbl_docparamworkflow set wf_id='".$newwfid."', doc_id='".$flowde."', flag='3'  where wf_id='".$newwfid."' and doc_id='".$flowde."'";
		//$strsql = "delete from tbl_docparamworkflow where flowcode='".$flowde."' and branch='".$newwfid."'";
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
					//alert("asdasd");
					document.getElementById('frm').action = "./docparam.php";
					document.getElementById('frm').submit();
				}
				
			</script>
		</head>
		<body onload="bodyonload();">
			<form id="frm" name="frm" method="post">
				<input type="hidden" name="newwfid" id="newwfid" value="<?=$newwfid?>"/>
				<input type="hidden" name="fromthispage" id="fromthispage" value="<?=$newwfid?>"/>
				<input type="hidden" name="newwfname" id="newwfname" value="<?=$newwfname?>"/>
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