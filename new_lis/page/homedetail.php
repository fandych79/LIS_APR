<?php

require ("../lib/formatError.php");
require ("../lib/open_con.php");
require ("../lib/open_con_dm.php");


$userid=$_REQUEST['userid'];
$act=$_REQUEST['act'];
$thestatus=$_REQUEST['thestatus'];



$kondisistatus = "";
if ($thestatus == "P")
{
	$theheader = "DETAIL SELURUH APPLICATION ID ";
}
else
{
	$kondisistatus = "AND Tbl_Flow_Status.txn_action='$thestatus'";
	$theheader = "DETAIL APPLICATION ID ";
	if ($thestatus == "I")
	{
		$theheader .= " YANG MASIH POSISI INPUT";
	}
	else
	{
		$theheader .= " YANG SUDAH POSISI APPROVE";
	}
	
}



if ($act == "delnotif")
{
      DELNOTIF();
}

if ($act == "rollbacknotif")
{
      RBNOTIF();
}

  $slacount = 0;
	$tsql = "select sum(Tbl_Workflow.wf_score)
   					from Tbl_Workflow";
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
			$slacount = $row[0];
		}
	}	
	sqlsrv_free_stmt( $sqlConn );

?>
 
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Expired" CONTENT="0">
<meta http-equiv="Cache-Control" CONTENT="no-Cache">
<meta http-equiv="Pragma" CONTENT="no-Cache">
<head >
    <title></title>
    <style type="text/css">
        body
        {
            margin-top: 0;
            margin-bottom: 0;
            margin-left: 0;
            margin-right: 0;
            padding-left: 0;
            padding-right: 0;
        }
        #left
        {
            position: absolute;
            left: 5px;
            padding: 0px;
            top: 0px;
            width: 25%;
        }
        #center
        {
            margin-left: 25%;
            padding: 0px;
            margin-right: 200px;
            top: 0px;
            width: 50%;
        }
        #right
        {
            position: absolute;
            right: 5px;
            padding: 0px;
            top: 0px;
            width: 25%;
        }
    </style>
	<script src="/eoffice/Includes/speedo/jquery-1.4.min.js"></script>


	<script src="/eoffice/Includes/speedo/jquery.speedometer.js"></script>
	<script src="/eoffice/Includes/speedo/jquery.jqcanvas-modified.js"></script>
	<script src="/eoffice/Includes/speedo/excanvas-modified.js"></script>
    <link href="/eoffice/Includes/CSS/niceforms-default.css" type="text/css" rel="stylesheet" />
    <link href="/eoffice/Includes/CSS/greenyours.css" type="text/css" rel="stylesheet" />
 
    <script type="text/javascript" src="/eoffice/Includes/Javascript/datetimepicker_css.js"></script>
 
    <script language="javascript" type="text/javascript" src="/eoffice/Includes/Javascript/niceforms.js"></script>
    <Script type="text/javascript">
       function viewDetail()
       {
           document.formhome.act.value = "";
           document.formhome.target = "lainnya";
           document.formhome.action = "./homedetail.php";
           document.formhome.submit();
       }
    </script>
	<script>

		$(function(){
			$('#test').speedometer();

			$('.changeSpeedometer').click(function(){
				$('#test').speedometer({ percentage: $('.speedometer').val() || 0 });
			});

		});


		
	</script>		
 
</head>
<body link=black alink=black vlink=black onload=self.focus()>
    <form name=formhome id="form1" class="niceform" method=post>
    	<div align=center>
    		<BR>
    		<center><font face=Arial size=3><b> <? echo $theheader ?></b></font></center>
    		<BR><BR>
    	   <table width=580 cellpadding=12 cellspacing=0 border=1 bordercolor="#000000" bordercolorlight="#000000" bordercolordark="#FFFFFF">
    	   	 <tr>
    	   	   <Td width=15% align=center valign=top>
    	   	   	 <font face=Arial size=2><b>ID</b></font>
    	   	  </td>
    	   	   <Td width=40% align=center valign=top>
    	   	   	 <font face=Arial size=2><b>NAMA</b></font>
    	   	  </td>
    	   	   <Td width=15% align=center valign=top>
    	   	   	 <font face=Arial size=2><b>FLOW</b></font>
    	   	  </td>
    	   	   <Td width=30% align=center valign=top>
    	   	   	 <font face=Arial size=2><b>PERSENTASE</b></font>
    	   	  </td>
    	   	 </tr>
<?
		  $oldtxnid = "";
      $tsql = "SELECT Tbl_Flow_Status.txn_id, Tbl_Flow_Status.txn_flow, Tbl_Flow_Status.txn_action
      				 FROM Tbl_Flow_Status, Tbl_SLADetail
      				  WHERE Tbl_Flow_Status.txn_id=Tbl_SLADetail.sla_nomid
      				  AND Tbl_SLADetail.sla_userid='$userid'
      				  $kondisistatus
      				  ORDER BY Tbl_Flow_Status.txn_time";
      $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
      $params = array(&$_POST['query']);

      $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
      $hitung = 0;
      if ( $sqlConn === false)
      die( FormatErrors( sqlsrv_errors() ) );
      if(sqlsrv_has_rows($sqlConn))
      {
         $rowCount = sqlsrv_num_rows($sqlConn);
         while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
         {
         	 if ($oldtxnid != $row[0])
         	 {
         	 	  $oldtxnid = $row[0];
   			  		$tsql2 = "SELECT custfullname
						        		FROM Tbl_CustomerMasterPerson
						        		WHERE custnomid='$row[0]'";
          		$cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   			  		$params2 = array(&$_POST['query']);
   		    		$sqlConn2 = sqlsrv_query($conn, $tsql2, $params2, $cursorType2);
							$custname = "&nbsp";
          		if ( $sqlConn2 === false)
      					die( FormatErrors( sqlsrv_errors() ) );

   			  		if(sqlsrv_has_rows($sqlConn2))
   			  		{
      		   		$rowCount2 = sqlsrv_num_rows($sqlConn2);
      			 		while( $row2 = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_NUMERIC))
      		   		{
      		   			$custname .= $row2[0];
      		   		}
   						}
   	      		sqlsrv_free_stmt( $sqlConn2 );

							$wfurut = 0;
   			  		$tsql2 = "select wf_urut
   									from Tbl_Workflow
   									WHERE wf_id='$row[1]'";
          		$cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   			  		$params2 = array(&$_POST['query']);
   		    		$sqlConn2 = sqlsrv_query($conn, $tsql2, $params2, $cursorType2);
          		if ( $sqlConn2 === false)
      					die( FormatErrors( sqlsrv_errors() ) );

   			  		if(sqlsrv_has_rows($sqlConn2))
   			  		{
      		   		$rowCount2 = sqlsrv_num_rows($sqlConn2);
      			 		while( $row2 = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_NUMERIC))
      		   		{
      		   			$wfurut = $row2[0];
      		   		}
   						}
   	      		sqlsrv_free_stmt( $sqlConn2 );

							$slasum = 0;
   			  		$tsql2 = "select sum(Tbl_Workflow.wf_score)
   											from Tbl_Workflow
   											WHERE wf_urut <= '$wfurut'";
          		$cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   			  		$params2 = array(&$_POST['query']);

   		    		$sqlConn2 = sqlsrv_query($conn, $tsql2, $params2, $cursorType2);
          		if ( $sqlConn2 === false)
      					die( FormatErrors( sqlsrv_errors() ) );

   			  		if(sqlsrv_has_rows($sqlConn2))
   			  		{
      		   		$rowCount2 = sqlsrv_num_rows($sqlConn2);
      			 		while( $row2 = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_NUMERIC))
      		   		{
      		   			$slasum = $row2[0];
      		   		}
   						}
   	      		sqlsrv_free_stmt( $sqlConn2 );
?>
    	   	 		<tr>
    	   	   		<Td width=15% align=center valign=top>
    	   	   	 		<font face=Arial size=2><? echo $row[0]; ?></font>
    	   	  		</td>
    	   	   		<Td width=40% align=center valign=top>
    	   	   	 		<font face=Arial size=2><? echo $custname; ?></font>
    	   	  		</td>
    	   	   		<Td width=15% align=center valign=top>
    	   	   	 		<font face=Arial size=2><? echo $row[1]; ?> <b>(<? echo $row[2]; ?>)</b></font>
    	   	  		</td>
    	   	   		<Td width=30% align=left valign=top>
<?
     							$persen = round(($slasum/$slacount) * 100,2);
	   							if ($persen > 50)
	   							{
			      					$imgsrc = "bar_blue.GIF";
	   							}
	   							else
	   							{
			      					$imgsrc = "bar_red.GIF";
	   							}
	   							$varpersen = $persen * 1;
?>
                 	&nbsp <IMG SRC='/eoffice/Includes/images/<? echo $imgsrc; ?>' width=<? echo $varpersen; ?> height=15><font face=Arial size=2>&nbsp <? echo $persen; ?> %</font>
    	   	  		</td>
    	   	 		</tr>
<?
           }
         }
      }
      sqlsrv_free_stmt( $sqlConn );

?>

    	   </table>
      </div>
    <input type=hidden name=userid value=bhartoyo>
    <input type=hidden name=userpwd value=4448dd9a39ab97e1>
    <input type=hidden name=userprgcode>
    <input type=hidden name=act>
    </form>
</body>
</html>

<?

function DELNOTIF()
{
require ("../lib/open_con.php");
require ("../lib/open_con_dm.php");

   $thenomid=$_POST['thenomid'];
   $thetanggal=$_POST['thetanggal'];
   $userid=$_REQUEST['userid'];

	$tsql = "DELETE FROM Tbl_Notification
						WHERE custnomid='$thenomid' AND note_userid = '$userid'
						AND cast(note_tanggal as varchar)='$thetanggal'";
	$params = array(&$_REQUEST['query']);
	$stmt = sqlsrv_prepare( $conn, $tsql, $params);
//   $stmt = sqlsrv_query($conn, $tsql, $params, $cursorType);
	if( $stmt )
	{
	} 
	else
	{
	echo "Error in preparing statement.\n";
	die( print_r( sqlsrv_errors(), true));
	}

	if( sqlsrv_execute( $stmt))
	{
	}
	else
	{
	echo "Error in executing statement.\n";
	die( print_r( sqlsrv_errors(), true));
	}
	sqlsrv_free_stmt( $stmt);

   Header("Location:./home.php?userid=$userid&userpwd=$userpwd&userbranch=$userbranch&userregion=$userregion&userwfid=$userwfid");

}

function RBNOTIF()
{
require ("../lib/open_con.php");
require ("../lib/open_con_dm.php");

   $thenomid=$_POST['thenomid'];
   $thetanggal=$_POST['thetanggal'];
   $thewfid=$_POST['thewfid'];
   $userid=$_REQUEST['userid'];
	$tsql = "DELETE FROM Tbl_Notification
						WHERE custnomid='$thenomid'
						AND cast(note_tanggal as varchar)='$thetanggal'";
	$params = array(&$_REQUEST['query']);
	$stmt = sqlsrv_prepare( $conn, $tsql, $params);
	if( $stmt )
	{
	} 
	else
	{
	echo "Error in preparing statement.\n";
	die( print_r( sqlsrv_errors(), true));
	}

	if( sqlsrv_execute( $stmt))
	{
	}
	else
	{
	echo "Error in executing statement.\n";
	die( print_r( sqlsrv_errors(), true));
	}
	sqlsrv_free_stmt( $stmt);

	$tsql = "UPDATE Tbl_F$thewfid
						set txn_action='I'
						WHERE txn_id='$thenomid'";
	$params = array(&$_REQUEST['query']);
	$stmt = sqlsrv_prepare( $conn, $tsql, $params);
//   $stmt = sqlsrv_query($conn, $tsql, $params, $cursorType);
	if( $stmt )
	{
	} 
	else
	{
	echo "Error in preparing statement.\n";
	die( print_r( sqlsrv_errors(), true));
	}

	if( sqlsrv_execute( $stmt))
	{
	}
	else
	{
	echo "Error in executing statement.\n";
	die( print_r( sqlsrv_errors(), true));
	}
	sqlsrv_free_stmt( $stmt);

   Header("Location:./home.php?userid=$userid&userpwd=$userpwd&userbranch=$userbranch&userregion=$userregion&userwfid=$userwfid");

}
