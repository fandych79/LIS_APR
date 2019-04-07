<?php

  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
  $userprogramact="settingcontrols.php";

   require ("../lib/open_con.php");

  $userprogramcode = "";
	$tsql = "SELECT programcode,programact FROM Tbl_ProgramAdmin WHERE programact like '%$userprogramact%'";
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
   			$datafield=explode("<q>",$row[1]);
   			if ($datafield[1] == $userprogramact)
   			{
   		   $userprogramcode = $row[0];
   			}
      }
   }
   sqlsrv_free_stmt( $sqlConn );

	$tsql = "SELECT COUNT(*) FROM Tbl_SE_User WHERE user_id='$userid' AND user_pwd='$userpwd'";
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
   		   $thecount = $row[0];
      }
   }
   sqlsrv_free_stmt( $sqlConn );
   
   if($thecount == "0")
   {
	   header("location:restricted.php");
   }

   $act = "";

   $act = "";

   if ($act == "")
   {
      MAIN();
   }


function MAIN()
{

  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
  global $userprogramcode;
  global $userprogramact;
   require ("../lib/open_con.php");

// PROFILE
  $profilebranchcode = "";
  $profilelevelcode = "";
	$tsql = "SELECT user_branch_code, user_level_code
										FROM Tbl_SE_User 
										WHERE user_id='$userid'";
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
   		$profilebranchcode = $row[0];
  		$profilelevelcode = $row[1];
    }
  }
  sqlsrv_free_stmt( $sqlConn );

// END PROFILE

	$tsql = "SELECT convert(varchar,getdate(),120)";
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
   		   $signintime = $row[0];
   		   $datenow = substr($row[0],1-1,4)  . "/" . substr($row[0],6-1,2) . "/" . substr($row[0],9-1,2);
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>LIS PARAM</title>
      <LINK media=screen href="../style/menu.css" rel=stylesheet>
      <script src='./javabits.js' language='Javascript'></script>
      <Script language="Javascript">
        function cekHistory(thefield,thebackup,thenew)
        {
				   	   if (thebackup != thenew)
				   	   {
				   	   	  document.formsubmit.actionhistory.value = document.formsubmit.actionhistory.value + thefield + thebackup + " >> " + thenew + "//";
				   	   }
        }
        function goSave(theid)
        {
        	 document.formsubmit.actionhistory.value = "";
<?
$tsql = "select * from ms_control";
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
			$countprofile = 0;
			if ($profilelevelcode == "A")
			{
					$countprofile = 1;
			}
			else
			{
   			  $tsql2 = "SELECT COUNT(*)
						        FROM PARAM_TblFormAkses
						        WHERE param_formname='$userprogramact'
						        AND param_fieldform='$row[0]'
						        AND param_usercode like '%$profilelevelcode%'";
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
      		   	  $countprofile = $row2[0];
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
			}
		if ($countprofile > 0)
		{
		?>
				   if (document.formsubmit.in_<? echo $row[0]; ?>.value == "")
				   {
				   	   alert("Please fill Value");
				   	   document.formsubmit.in_<? echo $row[0]; ?>.focus();
				   	   return false;
				   }
				   else
				   {
				   	   cekHistory("<? echo $row[1]?> : ",document.formsubmit.back_<? echo $row[0]; ?>.value,document.formsubmit.in_<? echo $row[0]; ?>.value);
				   }		
		<?
	  }
	}
}
sqlsrv_free_stmt( $sqlConn );
?>
           if (document.formsubmit.actionhistory.value == "")
           {
              alert("Anda Belum Melakukan Perubahan Apapun");
              return false;
           }
           else
           {
           		document.formsubmit.target = "utama";
           		document.formsubmit.act.value = "save";
           		document.formsubmit.action = "./do_settingcontrols.php";
           		varmsg = "Are your sure to SAVE ? Perubahan Terhadap : " + "\n";
           		arrdata = document.formsubmit.actionhistory.value.split('//');
				   		for (vari=0;vari<arrdata.length-1;vari++)
				   		{
				   			varmsg = varmsg + arrdata[vari] + "\n";
				   		}

           		submitform = window.confirm(varmsg);
           		if (submitform == true)
           		{
              	document.formsubmit.submit();
           		}
           }
        }
      </Script>
   </head>
   <body style="background:url(../images/Background%20Mega.png) no-repeat center;">
<script language="JavaScript"><!--
name = 'utama';
//--></script>
<table align="center" width="960" border="0" style="">
  <tr style="margin-bottom:px;">
    <td align="center"><img src="../images/Header Mega (L).png" width=100%></td>
  </tr>
  </table>
  <br/>

 
   	   <div align=center>
   	      <table style="background-color:#FFF;"width="760"  cellpadding="0" cellspacing="0" border="0" align="center" bordercolor="#4476b3" bordercolorlight="#000000" bordercolordark="#ffffff" >
   	      	<tr>
   	      		<td width=100% align=left valign=top>
   	      			<form name=formsec method=post>
  							   <input type=hidden name=userid value=<? echo $userid; ?>>
  					  	   <input type=hidden name=userpwd value=<? echo $userpwd; ?>>
   	      			</form>
     	   	       <A HREF="javascript:changeMenu('../../menu.php')"><font face=Arial size=2>Back To Main</font></A>
   	      		</td>
   	      	</tr>
   	      	<tr>
   	      		<td width=100% align=center valign=top>
   	  	      	 <font face=Arial size=3><b>SETTING CONTROLS</b></font>
   	      		</td>
   	      	</tr>
   	      </table>
   	      <BR><BR>
   	      <table width="760" border=0 cellpadding=0 cellspacing=0>
   	  	      <tr>
   	  	      	<td width=100% align=left valign=top>
<form id="formsubmit" name="formsubmit" method="post" action="do_settingcontrols.php">
<table width="800" border="0">

<?
$tsql = "select * from ms_control";
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
			$countprofile = 0;
			if ($profilelevelcode == "A")
			{
					$countprofile = 1;
			}
			else
			{
   			  $tsql2 = "SELECT COUNT(*)
						        FROM PARAM_TblFormAkses
						        WHERE param_formname='$userprogramact'
						        AND param_fieldform='$row[0]'
						        AND param_usercode like '%$profilelevelcode%'";
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
      		   	  $countprofile = $row2[0];
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
			}
		if ($countprofile > 0)
		{
		?>
		<tr>
		<td width="10%">&nbsp;</td>
		<td width="40%"><div align="right"><? echo $row[1]?>&nbsp;</div></td>
		<td width="40%"><input type="hidden" name="back_<? echo $row[0]; ?>" id="back_<? echo $row[0]; ?>" value="<? echo $row[2]; ?>" /><input type="text" name="in_<? echo $row[0]; ?>" id="in_<? echo $row[0]; ?>" value="<? echo $row[2]; ?>" />&nbsp;</td>
		<td width="10%">&nbsp;</td>
		</tr>
		<?
	  }
	}
}
sqlsrv_free_stmt( $sqlConn );
?>
</table>
<table width="800" border="0">
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td><div align="center"><input type="button" name="Submit" id="Submit" value="Submit" onClick=goSave() /></div></td>
  </tr>
  </table>
    								 <input type=hidden name=act value='save'>
    								 <input type=hidden name=userprogramcode value='<? echo $userprogramcode ?>'>
    								 <input type=hidden name=actionhistory>
    								 <input type=hidden name=utilwindow>
    								 <input type=hidden name=utilformname>
    								 <input type=hidden name=utilformfield>
    							   <input type=hidden name=utilfieldvalue>
    						     <input type=hidden name=utilfielddest>
    				         <input type=hidden name=utildetail>
										  <input type=hidden name=userid value=<? echo $userid; ?>>
										  <input type=hidden name=userpwd value=<? echo $userpwd; ?>>
      					  </form>
      					  <BR>
      					  <BR><BR>
      	       </td>
      	    </tr>
         </table>
   	  	      	</td>
   	  	      </tr>
   	      </table>
   	   </div>
   </body>
</html>
<?
   require("../lib/close_con.php");
exit;
}

?>

