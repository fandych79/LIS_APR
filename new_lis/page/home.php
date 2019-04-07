<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

$userid=$_REQUEST['userid'];
$programname="home";

    include ("../lib/formatError.php");
  	require ("../lib/open_con.php");
  	//require ("../lib/open_con_dm.php");

/*   $varsystem = "c:/xampp/htdocs/lismega_web_version_UAT/script/form/Bin/Lib/bgProc/SPINLic.exe $userid";
   system($varsystem);
   $file = "c:/temp/" . $userid;
   $f = fopen($file, "r");
   $urut = 0;
   $bisalanjut = 0;
   while ( $line = fgets($f, 1000) )
   {
   	  $urut++;
   	  if ($urut == 1)
   	  {
   	  	if (substr($line,0,2) == "OK")
   	  	{
   				$bisalanjut = 1;
   	  	}
   	  }
   }
   fclose($f);*/
   $bisalanjut = 1;
   if ($bisalanjut <= 0)
   {
        Header("Location:/cgi-bin/signin.lic");
   }
   
   $tsql2 = "select program_group from Tbl_SE_Program
			where program_desc like '%$programname%'
			and program_code like '%$_GET[userwfid]%'";
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
			$program_code = $row2[0];
			echo $program_code."ini code";
		}
	}
	sqlsrv_free_stmt( $sqlConn2 );
   
?>
 
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
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
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../js/speedo/jquery-1.4.min.js"></script>
	<script src="../js/speedo/jquery.speedometer.js"></script>
	<script src="../js/speedo/jquery.jqcanvas-modified.js"></script>
	<script src="../js/speedo/excanvas-modified.js"></script>
    <link href="../js/CSS/niceforms-default.css" type="text/css" rel="stylesheet" />
    <link href="../js/CSS/greenyours.css" type="text/css" rel="stylesheet" />
 
    <script type="text/javascript" src="../js/datetimepicker_css.js"></script>
 
    <script language="javascript" type="text/javascript" src="../js/javascript/niceforms.js"></script>
    <Script type="text/javascript">
    	 function goDel(thenomid,thetanggal)
    	 {
    	 	   document.formhome.thenomid.value = thenomid;
    	 	   document.formhome.thetanggal.value = thetanggal;
           document.formhome.act.value = "delnotif";
           document.formhome.target = "utama";
           document.formhome.action = "./homedetail.php";
					 submitform = window.confirm("DELETE ?")
				if (submitform == true)
				{
					document.formhome.submit();
				} 
    	 }
    	 function goRollBack(thenomid,thewfid,thetanggal)
    	 {
    	 	   document.formhome.thenomid.value = thenomid;
    	 	   document.formhome.thewfid.value = thewfid;
    	 	   document.formhome.thetanggal.value = thetanggal;
           document.formhome.act.value = "rollbacknotif";
           document.formhome.target = "utama";
           document.formhome.action = "./homedetail.php";
					 submitform = window.confirm("Rollback " + thenomid + " ?")
					 if (submitform == true)
				   {
						document.formhome.submit();
						return true;
					 }
    	 }
       function viewDetail(thestatus)
       {
           document.formhome.act.value = "";
           document.formhome.thestatus.value = thestatus;
           document.formhome.target = "lainnya";
           document.formhome.action = "./homedetail.php";
            window.open('./homedetail.php',"lainnya",'scrollbars=yes,width=600,height=450,screenX=0,screenY=0,top=0,left=0,status=yes');
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
<body link=black alink=black vlink=black>
<script language="JavaScript"><!--
name = 'utama';
//--></script>
    <form name=formhome id="form1" class="niceform" method=post>
			<div style="position:fixed;width:100%">
				<img src="../images/header_lis2.jpg" style="width:100%;"></img>
			</div>
			<div style="border:0px solid black;width:23%;height:545px;margin-top:7%;float:left;position:fixed;">
<?
		include("headermenu.php");
?>
				<img src="../images/gimmick_logo.png" style="position:absolute;bottom:0;width:60%;margin-left:20%;margin-right:20%;"></img>
			</div>
			<div align=center style="float:right;width:75%;margin-top:7%;margin-right:2%;">
			   <table width=90% cellpadding=0 cellspacing=0 border=0>
				 <tr>
				   <Td width=40% align=center valign=top>
						<table class="ContainerWrapper" width="95%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#e7e3e7">
						<tr class="boxesTable">
							<td colspan="2" align="center">
								<strong>MY PROJECTS</strong>
							</td>
						</tr>
						<tr>
							<td class="TdGenap" align="left" width="25%" colspan="2">
								<img src="../images/Compose Email.png" alt="Compose Project" />
<?
      $hittxn = 0;
      $tsql = "SELECT txn_id FROM 
      					Tbl_Flow_Status, Tbl_SLADetail
      				  WHERE Tbl_Flow_Status.txn_id=Tbl_SLADetail.sla_nomid
      				  AND Tbl_SLADetail.sla_userid='$userid'
      				  GROUP BY Tbl_Flow_Status.txn_id";
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
         	   $hitung = $row[0];
         }
         $hittxn = $rowCount;
      }
      sqlsrv_free_stmt( $sqlConn );

?>

									<A HREF="javascript:viewDetail('P')" style="text-decoration:none;">Project (<? echo $hittxn; ?>)</A>
								</td>
							</tr>
							<tr>
								<td class="TdGenap" align="left" width="25%" colspan="2">
									<img src="../images/Mail.png" alt="Compose Email" />
<?
			$hittxn = 0;
      $tsql = "SELECT Tbl_Flow_Status.txn_id
      					FROM Tbl_Flow_Status, Tbl_SLADetail
      				  WHERE Tbl_Flow_Status.txn_id=Tbl_SLADetail.sla_nomid
      				  AND Tbl_SLADetail.sla_userid='$userid'
      				  AND Tbl_Flow_Status.txn_action='I'
      				  GROUP BY Tbl_FLow_Status.txn_id";
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
         	   $hitung = $row[0];
         }
         $hittxn = $rowCount;
      }
      sqlsrv_free_stmt( $sqlConn );

?>

									<A HREF="javascript:viewDetail('I')" style="text-decoration:none;">Input (<? echo $hittxn; ?>)</A>
								</td>
							</tr>
							<tr>
								<td class="TdGenap" align="left" width="25%" colspan="2">
									<img src="../images/Mail Outbox.png" alt="Compose Email" />
<?
			$hittxn = 0;
      $tsql = "SELECT Tbl_Flow_Status.txn_id
      					FROM Tbl_Flow_Status, Tbl_SLADetail
      				  WHERE Tbl_Flow_Status.txn_id=Tbl_SLADetail.sla_nomid
      				  AND Tbl_SLADetail.sla_userid='$userid'
      				  AND Tbl_Flow_Status.txn_action='A'
      				  GROUP BY Tbl_Flow_Status.txn_id";
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
         	   $hitung = $row[0];
         }
         $hittxn = $rowCount;
      }
      sqlsrv_free_stmt( $sqlConn );

?>

									<A HREF="javascript:viewDetail('A')" style="text-decoration:none;">Approve (<? echo $hittxn; ?>)</A>
								</td>
							</tr>
							<tr>
								<td class="TdGenap" align="left" width="25%" colspan="2">
									<img src="../images/Trash.png" alt="Compose Email" />
<?
      $tsql = "SELECT COUNT(*) FROM Tbl_Flow_Status
      				  WHERE (txn_user_id='$userid'
      				  or txn_ao_code='$userid')
      				  AND txn_action='R'";
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
         	   $hitung = $row[0];
         }
      }
      sqlsrv_free_stmt( $sqlConn );

?>

                    		Reject (<? echo $hitung; ?>)
                		</td>
            		</tr>
            		<tr>
                		<td  align="left" width="25%" colspan="2">
                    		&nbsp
                		</td>
            		</tr>
            		<tr>
                		<td class="TdGenap" align="center" width="25%" colspan="2">
                			<BR>
								   		<div id="test">
<?
// HITUNG SLA
      $varsla = 0;

      $tsql = "SELECT sum(sla_sum),sum(sla_count) FROM Tbl_SLAHead
      				  WHERE sla_userid='$userid'";
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
         	  if ($row[1] > 0)
         	  {
      			  $varsla = round(($row[0] / $row[1]) * 100,2);
				  numberFormat($varsla);
         	  }
         }
      }
      sqlsrv_free_stmt( $sqlConn );
      
// END HITUNG SLA
?>

															<? echo $varsla ?>
													</div>
								</td>
							</tr>
						 </table>
					  </td>
					  <Td width=60% align=center valign=top>
						  <table class="ContainerWrapper" width="95%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#e7e3e7">
							<tr class="boxesTable">
								<td colspan="2" align="center" width=20%>
												&nbsp
								</td>
								<td colspan="2" align="center" width=60%>
									<strong>MY NOTIFICATION</strong>
								</td>
								<td colspan="2" align="center" width=20%>
									&nbsp
								</td>
							</tr>
						  </table>
							<table class="ContainerWrapper" width="95%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#e7e3e7">
<?
      $tsql = "SELECT custnomid,note_wfid,note_userid,
      					cast(note_tanggal as varchar), note_status, note_description, note_flag
      					FROM Tbl_Notification
      				  WHERE note_userid='$userid'
      				  AND note_flag='N'
      				  ORDER BY note_tanggal";
      $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
      $params = array(&$_POST['query']);

      $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
      if ( $sqlConn === false)
      die( FormatErrors( sqlsrv_errors() ) );
      $urut = 0;
      if(sqlsrv_has_rows($sqlConn))
      {
         $rowCount = sqlsrv_num_rows($sqlConn);
         while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
         {
         	$thenomid = $row[0];
         	$thetanggal = $row[3];
         	$urut++;
   			  $tsql2 = "SELECT 'a'= case when custsex='0' then custbusname else custfullname end
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
			
			//added by INDRA ------------------------------------
			
			$id_note = $row[1];
			$status = $row[4];
			$description = $row[5];
			
			if($id_note == "COL" && $status == "A03")
			{
				$status = "BACK TO AO";
				$tsql2 = "SELECT BACK_DESC
						        FROM RFBACKTOAO
						        WHERE BACK_ID='$description'";
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
						$description = $row2[0];
					}
   				}
				sqlsrv_free_stmt( $sqlConn2 );
			}
			else
			{
			}
			
			
			//---------------------------------------------------
?>
							<tr>
								<td class="TdGenap" align="left" width="25%" height="24">
									&nbsp;<? echo $row[1]; ?>
								</td>
								<td class="TdGanjil" align="left" width="70%" height="24">
									&nbsp  <font face=Arial size=2><? echo $row[0]; ?> - <? echo $custname; ?></font>
									<BR>
								&nbsp <font face=Arial size=2><? echo $status; ?> - <? echo $description; ?></font>
								</td>
								<td class="TdGenap" align="left" width="5%" height="24">
								<A HREF="javascript:goDel('<? echo $thenomid; ?>','<? echo $thetanggal; ?>')">del</a>
								</td>
							</tr>
<?
         }
      }
      sqlsrv_free_stmt( $sqlConn );
?>
						  </table>
					  </td>
					 </tr>
				   </table>
			  </div>
		</div>
    <input type=hidden name=userid value='<? echo $userid; ?>'>
    <input type=hidden name=userpwd value='<? echo $userpwd; ?>'>
    <input type=hidden name=userprgcode>
    <input type=hidden name=thestatus>
    <input type=hidden name=thenomid>
    <input type=hidden name=thewfid>
    <input type=hidden name=thetanggal>
    <input type=hidden name=act>
    </form>
</body>
</html>

<?
require("../lib/close_con.php");

exit;