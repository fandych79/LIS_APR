<?php

//  $userid=$_POST['userid'];
//  $userpwd=$_POST['userpwd'];
//  $act=$_POST['act'];

   $act = "";

   if ($act == "")
   {
      MAIN();
   }


function MAIN()
{
  $charzip=$_POST['charzip'];
  if ($charzip == "")
  {
  	$charzip = '1';
  }
    
require ("../lib/open_con.php");
?>
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>LIS PARAM</title>
      <LINK media=screen href="/lismega_devel/style/menu.css" rel=stylesheet>
      <Script language="Javascript">
        function viewDetail()
        {        	
        	  goNew();
	   	      var selectedArray = eval(document.formsubmit.updcode.options[document.formsubmit.updcode.selectedIndex].value);
	   		    eval("document.formsubmit.newwfid.value=" + selectedArray[0]);
	   		    eval("document.formsubmit.newwfname.value=" + selectedArray[1]);
	   		    eval("document.formsubmit.newwfurut.value=" + selectedArray[2]);
	   		    eval("document.formsubmit.newwftime.value=" + selectedArray[3]);
	   		    eval("document.formsubmit.newwfscore.value=" + selectedArray[4]);
	   		    for (vari=0;vari<selectedArray[5].length;vari++)
	   		    {
	   		    	if (selectedArray[5].substring(vari,vari+1) == "I")
	   		    	{
	   		    		document.formsubmit.wfactI.checked = true;
	   		      }
	   		    	if (selectedArray[5].substring(vari,vari+1) == "C")
	   		    	{
	   		    		document.formsubmit.wfactC.checked = true;
	   		      }
	   		    	if (selectedArray[5].substring(vari,vari+1) == "A")
	   		    	{
	   		    		document.formsubmit.wfactA.checked = true;
	   		      }
	   		    }
	   		    varflag = "'" + selectedArray[7].substring(1,2) + "'";
	   		    eval("document.formsubmit.newwfflag1.value=" + varflag);
	   		    varflag = "'" + selectedArray[7].substring(2,3) + "'";
	   		    eval("document.formsubmit.newwfflag2.value=" + varflag);
	   		    eval("document.formsubmit.newprevflow.value=" + selectedArray[8]);
            vardata = selectedArray[9].split('|');
            if (vardata.length > 1)
            {
               for(vari=0;vari<vardata.length-1;vari++)
               {
	   		    	   eval("document.formsubmit.DOC" + vardata[vari] + ".checked=true");
               }
            }
        }
        function goNew()
        {
	   		    document.formsubmit.newwfid.value="";
	   		    document.formsubmit.newwfname.value="";
	   		    document.formsubmit.newwfurut.value="";
	   		    document.formsubmit.newwftime.value="";
	   		    document.formsubmit.newwfscore.value="";
	   		    document.formsubmit.newwfflag1.value="";
	   		    document.formsubmit.newwfflag2.value="";
	   		    document.formsubmit.newprevflow.value="";
	   		   document.formsubmit.wfactI.checked = false;
	   		   document.formsubmit.wfactC.checked = false;
	   		   document.formsubmit.wfactA.checked = false;
<?
   			  $tsql2 = "SELECT *
						        FROM Tbl_DocPerson";
          $cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   			  $params2 = array(&$_POST['query']);

   		    $sqlConn2 = sqlsrv_query($conn, $tsql2, $params2, $cursorType2);

          if ( $sqlConn2 === false)
      			die( FormatErrors( sqlsrv_errors() ) );

   			  if(sqlsrv_has_rows($sqlConn2))
   			  {
      		   $rowCount2 = sqlsrv_num_rows($sqlConn2);
      			 while( $row2 = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_ASSOC))
      		   {
?>
								 document.formsubmit.DOC<? echo $row2['doc_id']; ?>.checked = false;
<?
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
?>
        }
        function viewHirarki(theformname,theformfield,thefielddest,thewindow,thedetail)
        {
           document.formsubmit.target = thewindow;
           document.formsubmit.act.value = "viewhirarki";
           document.formsubmit.utilwindow.value = thewindow;
           document.formsubmit.utilformname.value = theformname;
           document.formsubmit.utilfielddest.value = thefielddest;
           document.formsubmit.utilformfield.value = theformfield;
           document.formsubmit.utilfieldvalue.value = eval("document.formsubmit." + theformfield + ".value");
           document.formsubmit.utildetail.value = thedetail;
           document.formsubmit.action = "./utilview.php";
           if (thewindow != "smallwindow")
           {
              window.open('./utilview.php',thewindow,'scrollbars=yes,width=600,height=450,screenX=0,screenY=0,top=0,left=0,status=yes');
           }
           else
           {
              window.open('./utilview.php',thewindow,'scrollbars=yes,width=300,height=450,screenX=0,screenY=0,top=0,left=0,status=yes');
           }
           document.formsubmit.submit();
        }
        function goSave()
        {
           var Money ="0123456789.";
				   if (document.formsubmit.newwfid.value == "")
				   {
				   	   alert("Please fill Workflow ID");
				   	   document.formsubmit.newwfid.focus();
				   	   return false;
				   }
				   if (document.formsubmit.newwfname.value == "")
				   {
				   	   alert("Please fill WF Name");
				   	   document.formsubmit.newwfname.focus();
				   	   return false;
				   }
				   if (document.formsubmit.newwfurut.value == "")
				   {
				   	   alert("Please fill WF Urut");
				   	   document.formsubmit.newwfurut.focus();
				   	   return false;
				   }
				   else
				   {
              for (var i = 0; i < document.formsubmit.newwfurut.value.length; i++)
              {
       	         if (Money.indexOf(document.formsubmit.newwfurut.value.charAt(i)) == -1)
       	         {
                    alert("WF Urut harus berupa angka");
                    document.formsubmit.newwfurut.focus();
                    return false;
                 }
              }
				   }
				   if (document.formsubmit.newwftime.value == "")
				   {
				   	   alert("Please fill WF Time");
				   	   document.formsubmit.newwftime.focus();
				   	   return false;
				   }
				   else
				   {
              for (var i = 0; i < document.formsubmit.newwftime.value.length; i++)
              {
       	         if (Money.indexOf(document.formsubmit.newwftime.value.charAt(i)) == -1)
       	         {
                    alert("WF Time harus berupa angka");
                    document.formsubmit.newwftime.focus();
                    return false;
                 }
              }
				   }
				   if (document.formsubmit.newwfscore.value == "")
				   {
				   	   alert("Please fill WF Score");
				   	   document.formsubmit.newwfscore.focus();
				   	   return false;
				   }
				   else
				   {
              for (var i = 0; i < document.formsubmit.newwfscore.value.length; i++)
              {
       	         if (Money.indexOf(document.formsubmit.newwfscore.value.charAt(i)) == -1)
       	         {
                    alert("WF Score harus berupa angka");
                    document.formsubmit.newwfscore.focus();
                    return false;
                 }
              }
				   }
           document.formsubmit.target = "utama";
           document.formsubmit.act.value = "save";
           document.formsubmit.action = "./domaintainflow.php";
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
           document.formsubmit.action = "./domaintainflow.php";
           submitform = window.confirm("Are your sure to DELETE Flow " + document.formsubmit.newwfid.value + " " + document.formsubmit.newwfname.value + " ?")
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
	   		changeCode();
	   		return false;
	   	   }
	   	}
	   }
	   alert ("String '" + document.formsubmit.updstring.value + "' Not Found");
	   return false;
	}
			function changeCode()
			{
				 document.formsubmit.zipcode.value = document.formsubmit.updcode.options[document.formsubmit.updcode.selectedIndex].value.substring(1,6);
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
     	   	       &nbsp
   	      		</td>
   	      	</tr>
   	      	<tr>
   	      		<td width=100% align=center valign=top>
   	  	      	 <font face=Arial size=3><b>VIEW ZIPCODE</b></font>
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
                  	   <input type=text name=zipcode size=10 maxlength=5>
                 	   <hr size=2>
   	  	      		   <table width=100% border=0 cellpadding=0 cellspacing=0>
   	  	      			    <tr>
   	  	      			    	<td width=100% align=left valign=top>
   	  	      			    		<font face=Arial size=2>Daftar Zipcode</font>
   	  	      			    		<select name=charzip onChange=document.formsubmit.submit()>
   	  	      			    			 <option value=''>--Choose One--</option>
   	  	      			    			 <option value='1'>1 - Jabodetabek</option>
   	  	      			    			 <option value='2'>2 - Medan</option>
   	  	      			    			 <option value='3'>3 - Palembang</option>
   	  	      			    			 <option value='4'>4 - Bandung</option>
   	  	      			    			 <option value='5'>5 - Semarang</option>
   	  	      			    			 <option value='6'>6 - Surabaya</option>
   	  	      			    			 <option value='7'>7 - Banjarmasin</option>
   	  	      			    			 <option value='8'>8 - Denpasar</option>
   	  	      			    		</select>
   	  	      			    		<BR>
   	  	      			    		<select name=updcode size=25 style='width: 280mm' onClick=changeCode()>
<?
   $tsql = "SELECT * FROM Tbl_ZipCodeNew
   				  WHERE SUBSTRING(kode_pos,1,1)='$charzip'
   					ORDER BY kode_pos";
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
   	  	      			         <option value='D<? echo $row['kode_pos']; ?>'><? echo $row['kode_pos']; ?> - <? echo $row['kelurahan']; ?> - <? echo $row['kecamatan']; ?> - <? echo $row['kota']; ?> - <? echo $row['kabupaten']; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      			    		</select>
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

function FormatErrors( $errors )
{
    /* Display errors. */
    echo "Error information: <br/>";

    foreach ( $errors as $error )
    {
        echo "SQLSTATE: ".$error['SQLSTATE']."<br/>";
        echo "Code: ".$error['code']."<br/>";
        echo "Message: ".$error['message']."<br/>";
    }
}



?> 
