<?php
//include ("../../../lib/class.sqlserver.php");
//require ("../../../requirepage/parameter.php");
//  include ("formatError.php");
require ("../../../lib/open_con.php");
require ("../../../lib/formatError.php");
require ("../../../requirepage/parameter.php");
require ("../../../lib/open_con_dm_mysql.php");

$id = $_REQUEST['custnomid'];
$custnomid = $_REQUEST['custnomid'];

   $custcif = "";
   $custname = "";
   $tsql = "SELECT custaplno,custfullname FROM Tbl_CustomerMasterPerson WHERE custnomid ='$custnomid'";//echo $tsql;
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
      	 $custcif = $row[0];
      	 $custname = $row[1];
      }
   }
   sqlsrv_free_stmt( $sqlConn );

$statusdoc="";
$kondisistatusdoc = "";
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
		$statusdoc .= $rows['doc_id'] . ",";
    $kondisistatusdoc .= "doc_type='" . $rows['doc_id'] . "' or ";
	}
}

if ($kondisistatusdoc != "")
{
	 $kondisistatusdoc = "AND (" . substr($kondisistatusdoc,0,strlen($kondisistatusdoc)-3) . ")";
}

  $ipdm = "";
  $userdm = "";
	$strsql="select control_value from ms_control where control_code='IPDM'";
	//echo $strsql;
	$sqlcon = sqlsrv_query($conn, $strsql);
	if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlcon))
	{
		if($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_NUMERIC))
		{
	 		$arrsplit=explode(",",$rows[0]);
	 		$ipdm = $arrsplit[0];
	 		$userdm = $arrsplit[1];
		}
	}
$key = $custcif . "_" . $custnomid;

$linkdmI = $ipdm. '/external_upload.php?dmuserid=' . $userdm . '&username=user&userpwd=ee11cbb19052e40b07aac0ca060c23ee&dmuserorganization=PRIVATE&thecabinet=eILk6fO0&dmbranchcode=' . $userbranch . '&act=upload&key=' . $key . '&dmstatusdoc=' . $statusdoc;
$linkdmA = $ipdm. '/external_view.php?dmuserid=' . $userdm . '&username=user&userpwd=ee11cbb19052e40b07aac0ca060c23ee&dmuserorganization=PRIVATE&thecabinet=eILk6fO0&dmbranchcode=' . $userbranch . '&act=cek&key=' . $key . '&dmstatusdoc=' . $statusdoc;

?>
<html>
	<head>
		<script type="text/javascript" src="jquery-1.10.2.js"></script>
		<script type="text/javascript" src="jquery-ui-1.10.4.custom.js"></script>
		<link href="jquery-ui-1.8rc3.custom.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
			function uploadDocument(thelink)
			{
	        varwidth = 980;
	        varheight = 640;
	        varx = 0;
	        vary = 0;
          window.open(thelink,'lainnya','scrollbars=yes,width='+varwidth+',height='+varheight+',screenX='+varx+',screenY='+vary+',top='+varx+',left='+vary+',status=yes');
			}
			function refreshhtml()
			{
				window.location.reload()
			}
		</script>
	</head>
	<body link=blue vlink=blue alink=blue>
		<h2 align="center">
		<?
		echo "Document Management $id";
		?>
		<BR><BR>
		<A HREF="javascript:uploadDocument('<? echo $linkdmA ?>')">View All Document</A>
		</h2>
	</body>
</html>
<?
exit;

?>
<html>
	<head>
		<script type="text/javascript" src="jquery-1.10.2.js"></script>
		<script type="text/javascript" src="jquery-ui-1.10.4.custom.js"></script>
		<link href="jquery-ui-1.8rc3.custom.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<h2 align="center">
		<?
		echo "Document Management $id";
		?>
		</h2>
		<table cellpadding=5 cellspacing=5 align="center">
<?
	  $query = "SELECT doc_storage, doc_file_masking, doc_desc
	   		      FROM Tbl_Document
	   		      WHERE doc_index3='$id'";
	  $result=mysql_query($query);
	  while($row=mysql_fetch_array($result))
	  {
	  	 $imgsrc = $row[0] . "/" . $row[1];
?>
			<tr>
				<td width=100% align=left valign=top>
					  <font face=Arial size=2><b><? echo $row[2] ?></b></font>
					  <BR>
					  <img src='<? echo $imgsrc ?>'>
			  </td>
			</tr>	
<?
	  }	
?>
		</table>
	</body>
</html>