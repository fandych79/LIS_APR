<?php

  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];

    
require ("../lib/open_con.php");

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

   if ($act == "")
   {
      MAIN();
   }


function MAIN()
{
    
require ("../lib/open_con.php");
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];

   $tempfield = "";
   $countfield = 0;
   $tsql = "SELECT * FROM INFORMATION_SCHEMA.Columns WHERE TABLE_NAME = 'Tbl_RSSFeeds'";
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
      	$countfield++;
      	 $tempfield .= $row['COLUMN_NAME'] . ",";
      }
   }
   sqlsrv_free_stmt( $sqlConn );
   $datafield=explode(",",$tempfield);
   	//echo $datafield[0]."<br>";
	//echo $datafield[1]."<br>";
	//echo $datafield[2]."<br>";
	//echo $datafield[3]."<br>";
	//echo $datafield[4]."<br>";
	//echo $datafield[5]."<br>";
   
?>
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>LIS PARAM</title>
      <LINK media=screen href="../style/menu.css" rel=stylesheet>
      <script src='./javabits.js' language='Javascript'></script>
      <Script language="Javascript">
<?
   $tsql = "SELECT RSS_ID,RSS_SEQ,RSS_TITLE,cast(RSS_DATETIME as varchar),RSS_DESCRIPTION,RSS_LINK FROM Tbl_RSSFeeds";
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
         $vartemp = "var D" . $row['RSS_ID'] . "=  new Array(";
        for ($zz=0;$zz<$countfield;$zz++)
        {
				  $aa = substr($datafield[$zz],strlen($datafield[$zz])-11);
        	if ($aa != "create_time" && $datafield[$zz] != "RSS_DATETIME")
        	{
				//echo $datafield[$zz];
				    $aa = $row[$datafield[$zz]];
						$vartemp .= "\"'" . $aa . "'\",";
        	}
        	else
        	{
        		$aa = date('Y-m-d H:m:s');
						$vartemp .= "\"'" . $aa . "'\",";
          }
        }
        $vartemp .= "'');";
?>
				    <? echo $vartemp; ?>

<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
        function viewDetail()
        {        	
        	  goNew()
	   	      var selectedArray = eval(document.formsubmit.updcode.options[document.formsubmit.updcode.selectedIndex].value);
	   		    eval("document.formsubmit.newrssid.value=" + selectedArray[0]);
	   		    eval("document.formsubmit.newrssurut.value=" + selectedArray[1]);
	   		    eval("document.formsubmit.newrsstitle.value=" + selectedArray[2]);
	   		    eval("document.formsubmit.newrsspubdate.value=" + selectedArray[3]);
	   		    eval("document.formsubmit.newrssdesc.value=" + selectedArray[4]);
	   		    eval("document.formsubmit.newrsslink.value=" + selectedArray[5]);
        }
        function goNew()
        {
	   		    document.formsubmit.newrssid.value="";
	   		    document.formsubmit.newrsstitle.value="";
	   		    document.formsubmit.newrssurut.value="";
	   		    document.formsubmit.newrsspubdate.value="";
	   		    document.formsubmit.newrssdesc.value="";
	   		    document.formsubmit.newrsslink.value="";
        }
        function goSave()
        {
           var Money ="0123456789.";
				   if (document.formsubmit.newrssid.value == "")
				   {
				   	   alert("Please fill RSS ID");
				   	   document.formsubmit.newrssid.focus();
				   	   return false;
				   }
				   if (document.formsubmit.newrssurut.value == "")
				   {
				   	   alert("Please fill RSS Urut");
				   	   document.formsubmit.newrssurut.focus();
				   	   return false;
				   }
				   if (document.formsubmit.newrsstitle.value == "")
				   {
				   	   alert("Please fill RSS Title");
				   	   document.formsubmit.newrsstitle.focus();
				   	   return false;
				   }
           document.formsubmit.target = "utama";
           document.formsubmit.act.value = "save";
           document.formsubmit.action = "./domaintainrssfeeds.php";
           submitform = window.confirm("Are your sure to SAVE ?")
           if (submitform == true)
           {
              document.formsubmit.submit();
           }
        }
        function goDel()
        {
           document.formsubmit.target = "utama";
           document.formsubmit.act.value = "del";
           document.formsubmit.action = "./domaintainrssfeeds.php";
           submitform = window.confirm("Are your sure to DELETE Flow " + document.formsubmit.newrssid.value + " " + document.formsubmit.newrsstitle.value + " ?")
           if (submitform == true)
           {
              document.formsubmit.submit();
           }
        }
        function chgProfile()
        {
        	if (document.formsubmit.newuserprofile.options[document.formsubmit.newuserprofile.selectedIndex].value == "cLr")
        	{
               document.formsubmit.newusertrustee.value = "";
               document.formsubmit.newuserother.value = "";
          }
		      else
		      {
            vardata = document.formsubmit.newuserprofile.options[document.formsubmit.newuserprofile.selectedIndex].text.split('~~');
            if(vardata.length > 1)
            {
               vartemp = vardata[1].split('|');
               document.formsubmit.newusertrustee.value = vartemp[0];
               document.formsubmit.newuserother.value = vartemp[1];
            }
		      }
        }
	function findString(themethod)
	{
     varhitdata = document.formsubmit.updcode.length;
	   varstart = -1;
	   varketemu = 0;
	   varstring = document.formsubmit.updstring.value.toUpperCase();
	   if (themethod == 1)
	   {
	      if (document.formsubmit.updcode.selectedIndex >= 0)
	      {
	   	varstart = document.formsubmit.updcode.options[document.formsubmit.updcode.selectedIndex].index;
	      }
	   }
	   varstart = varstart + 1;
	   for (vari=varstart;vari<varhitdata;vari++)
	   {
	   	varsource = document.formsubmit.updcode.options[vari].text.toUpperCase();
	   	for (varj=0;varj<varsource.length;varj++)
	   	{
	   	   if (varsource.substring(varj,varj+varstring.length) == varstring)
	   	   {
	   		document.formsubmit.updcode.selectedIndex = vari;
	   		viewDetail();
	   		return false;
	   	   }
	   	}
	   }
	   alert ("String '" + document.formsubmit.updstring.value + "' Not Found");
	   return false;
	}
      </Script>
   </head>
   <body>
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
<table style="background-color:#FFF;"width="500"  cellpadding="0" cellspacing="0" border="1" align="center" bordercolor="#4476b3" bordercolorlight="#000000" bordercolordark="#ffffff" >

   	      <table width="760" border=0 cellpadding=0 cellspacing=0>
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
   	  	      	 <font face=Arial size=3><b>MANAGE RSS FEEDS</b></font>
   	      		</td>
   	      	</tr>
   	      </table>
   	      <BR><BR>
   	      <table width="760" border=0 cellpadding=0 cellspacing=0>
   	  	      <tr>
   	  	      	<td width=100% align=left valign=top>
   	  	      		<form name=formsubmit method=post>
                  	   <font face=Arial style="font-size: 10;">Search :</font> &nbsp
                  	   <input type=text name=updstring size=20 maxlength=60>
                  	   <input type=button value='Find (From Top)' style="width: 40mm;" onclick="javascript:findString(0);">
                  	   <input type=button value='Find Next (From Last Position)' style="width: 60mm;" onclick="javascript:findString(1);">
                 	   <hr size=2>
   	  	      		   <table width=100% border=0 cellpadding=0 cellspacing=0>
   	  	      			    <tr>
   	  	      			    	<td width=50% align=left valign=top>
   	  	      			    		<font face=Arial size=2>Daftar RSS</font>
   	  	      			    		<BR>
   	  	      			    		<select name=updcode size=25 style='width: 80mm' onChange="javascript:viewDetail();">
<?
   $tsql = "SELECT * FROM Tbl_RSSFeeds
   					ORDER BY RSS_SEQ";
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
?>
   	  	      			         <option value='D<? echo $row['RSS_ID']; ?>'><? echo $row['RSS_ID']; ?> - <? echo $row['RSS_TITLE']; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      			    		</select>
   	  	      			    	</td>
   	  	      			    	<td width=50% align=center valign=top>
   	  	      			    		<font face=Arial size=2>Detail RSS</font>
   	  	      			    		<BR><BR>
   	  	      		   	      <table width=100% border=0 cellpadding=2 cellspacing=2>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>RSS ID &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newrssid size=20 maxlength=10>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>RSS SEQ &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newrssurut size=20 maxlength=6>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>RSS Title &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newrsstitle size=30 maxlength=20>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>RSS Date &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newrsspubdate size=20 maxlength=20 value="<? echo date("d/m/Y") ?>">
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>RSS Desc &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<textarea name=newrssdesc rows=3 cols=30></textarea>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>RSS Link</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newrsslink size=30 maxlength=30>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			&nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
    				         						   <input type=button value='Save' onClick=goSave()>
    				         					     <input type=button value='Delete' onClick=goDel()>
    				         					     <input type=button value='NEW' onClick=goNew()>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      </table>
   	  	      			    		<BR><BR>
   	  	      		   	      <table width=100% border=0 cellpadding=0 cellspacing=0>
   	  	      		   	      </table>
   	  	      			    	</td>
   	  	      			    </tr>
   	  	      		   </table>
    								 <input type=hidden name=act>
    								 <input type=hidden name=utilwindow>
    								 <input type=hidden name=utilformname>
    								 <input type=hidden name=utilformfield>
    							   <input type=hidden name=utilfieldvalue>
    						     <input type=hidden name=utilfielddest>
    				         <input type=hidden name=utildetail>
										  <input type=hidden name=userid value=<? echo $userid; ?>>
										  <input type=hidden name=userpwd value=<? echo $userpwd; ?>>
   	  	      		</form>
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
