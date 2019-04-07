<?php

	$filedocid=$_GET['custnomid'];
	$custnomid=$_GET['custnomid'];
	$statusdoc="APR%";
//	 $filedesc=$_GET['filedesc'];
	$fileindex1=$_GET['fileindex1'];
	$userid=$_GET['userid'];
	$userpwd=$_GET['userpwd'];
	$userbranch=$_GET['userbranch'];
	$userregion=$_GET['userregion'];
	$userwfid=$_GET['userwfid'];
	$userpermission=$_GET['userpermission'];
	$buttonaction = $_GET['buttonaction'];
	
require('../../lib/open_con_dm.php');

    if ($statusdoc == "")
    {
    	$kondisistatusdoc = "";
    }
    else
    {
    	$kondisistatusdoc = "WHERE doc_code like '$statusdoc'";
    }
    if (isset($filedesc))
    {
    	$tempfiledesc = $filedesc;
    }
    else
    {
	     $tempfiledesc="";
    }
    if (isset($fileindex1))
    {
	     $tempfileindex1=$fileindex1;
    }
    else
    {
	     $tempfileindex1="";
    }
	
	
?>
<link href="../../css/crw.css" rel="stylesheet" type="text/css" />
<Script Language="JavaScript">
  	   function cek()
  	   {
	   			if (document.formsubmit.uploaded.value == "")
	   			{
	   				alert("Harap Pilih File Yang Hendak Diupload. Gunakan tombol Browse... untuk memudahkan");
	   				document.formsubmit.uploaded.focus();
	   				return false;
	   			}
	   			if (document.formsubmit.filetype.options[document.formsubmit.filetype.selectedIndex].value == "")
	   			{
	   				alert("Harap Pilih Document Type");
	   				document.formsubmit.filetype.focus();
	   				return false;
	   			}
	   			if (document.formsubmit.filedocid.options[document.formsubmit.filedocid.selectedIndex].value == "")
	   			{
	   				alert("Harap Pilih Folder");
	   				document.formsubmit.filedocid.focus();
	   				return false;
	   			}
	   			if (document.formsubmit.fileindex1.value != "")
	   			{
	   				if (document.formsubmit.fileindex1.value.indexOf(" ") != -1)
	   				{
	   					alert("File Index tidak boleh ada spasi");
	   					document.formsubmit.fileindex1.focus();
	   					return false;
	   				}
	   			}
           document.formsubmit.target = "lainnya";
           document.formsubmit.action = "dospin_upload.php";
              window.open('dospin_upload.php',"lainnya",'scrollbars=yes,width=600,height=450,screenX=0,screenY=0,top=0,left=0,status=yes');
	        document.formsubmit.submit();
  	   }
  	   function view(theid)
  	   {
		
           document.formsubmit.thedoctype.value = theid;alert(theid);
           document.formsubmit.action = "dospin_view.php";
           document.formsubmit.target = "lainnya";
              window.open('dospin_view.php',"lainnya",'scrollbars=yes,width=600,height=450,screenX=0,screenY=0,top=0,left=0,status=yes');
	        document.formsubmit.submit();
  	   }
  	   function isiIndex()
  	   {
  	   	  if (document.formsubmit.filetype.options[document.formsubmit.filetype.selectedIndex].value != "")
  	   	  {
  	   	  	document.formsubmit.fileindex1.value = document.formsubmit.filetype.options[document.formsubmit.filetype.selectedIndex].value;
  	   	  	document.formsubmit.filedesc.value = document.formsubmit.filetype.options[document.formsubmit.filetype.selectedIndex].text;
  	   	  }
  	   }
  	   function cek2()
  	   {
           document.formsubmit.action = "/spindm/saveflow.php";
           document.formsubmit.target = "utama";
           submitform = window.confirm("Are your sure to SAVE FLOW ?")
           if (submitform == true)
           {
              document.formsubmit.submit();
           }
           else
           {
           		return false;
           }
  	   }
	</Script>
	<script src="Bin/Script/Swap.js" type="text/javascript"></script>
<center>
<br><br>
    <center>
        
    <table width="500" border="1" cellspacing="0" cellpadding="0" align=center class="preview">
      <tr>
        <td align =center width="500" height="400" valign=top>
        	<CENTER><font face=Arial size=2><b>DOCUMENT STATUS :</b></font></CENTER>
        	<BR>
        	<table width=100% cellpadding=0 cellspacing=0 border=0>
<?
	$tsql = "SELECT * FROM Tbl_DocType
						$kondisistatusdoc";//echo $tsql;
   	$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   	$params = array(&$_POST['query']);
   	$sqlConn = sqlsrv_query($conndm, $tsql, $params, $cursorType);
	
	if($sqlConn === false)
	{
		die(FormatErrors(sqlsrv_errors()));
	}
	
	if(sqlsrv_has_rows($sqlConn))
	{
      $rowCount = sqlsrv_num_rows($sqlConn);
      while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
      {
   			  $tsql2 = "SELECT COUNT(*)
						        FROM Tbl_Document
						        WHERE doc_id='$filedocid'
						        AND doc_type='$row[0]'
								AND doc_index1 = '$tempfileindex1'"; //echo $tsql2;
          $cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   			  $params2 = array(&$_POST['query']);

   		    $sqlConn2 = sqlsrv_query($conndm, $tsql2, $params2, $cursorType2);

			    $thecount = 0;
          if ( $sqlConn2 === false)
      			die( FormatErrors( sqlsrv_errors() ) );

   			  if(sqlsrv_has_rows($sqlConn2))
   			  {
      		   $rowCount2 = sqlsrv_num_rows($sqlConn2);
      			 while( $row2 = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_NUMERIC))
      		   {
      		   	  $thecount = $row2[0];
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
?>
        		<tr>
        			<td width=1% align=left valign=top>
   		          &nbsp
        			</td>
        			<td width=98% align=center valign=top>
<?
   	      if ($thecount > 0)
   	      {
?>
   		          <A HREF="http://<? echo $ipdm?>/spindm/dospin_view.php?custnomid=<? echo $custnomid; ?>&thedoctype=<? echo $row[0]; ?>&fileindex1=<? echo $fileindex1;?>" target=lainnya><font face=Arial style="font-size: 12;"><? echo $row[1]; ?> (<? echo $thecount; ?>)</font></A>
<?
   	      }
   	      else
   	      {
?>
   		          <font face=Arial style="font-size: 12;"><? echo $row[1]; ?> (<? echo $thecount; ?>)</font>
<?
   	      }
?>
        			</td>
        			<td width=1% align=left valign=top>
   		          &nbsp
        			</td>
					<td width=1% align=left valign=top>
						&nbsp
        			</td>
        		</tr>

<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
				<tr>
					<td>&nbsp </td>
					<td align="center">&nbsp </td>
				</tr>
				<!--<tr>
					<td>&nbsp </td>
					<td align="center"><a href="viewaprdbentry_v2.php?custnomid=<?echo $custnomid; ?>&userid=<? echo $userid; ?>&userpwd=<? echo $userpwd; ?>&userbranch=<? echo $userbranch; ?>&userregion=<? echo $userregion; ?>&userwfid=<? echo $userwfid; ?>&userpermission=<? echo $userpermission; ?>&buttonaction=<? echo $buttonaction; ?>">Kembali</a></td>
				</tr>-->
        	</table>
        </td>
        
      </tr>

    </table>
						<input type=hidden name=thedoctype>
        			 	<input type=hidden name=act>
        			 	<input type=hidden name=custnomid value='<? echo $custnomid; ?>'>
        			 	
<br>
</center>
