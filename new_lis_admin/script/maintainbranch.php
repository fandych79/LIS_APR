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
   $tsql = "SELECT * FROM INFORMATION_SCHEMA.Columns WHERE TABLE_NAME = 'Tbl_Branch'";
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
?>
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>LIS PARAM</title>
      <LINK media=screen href="../style/menu.css" rel=stylesheet>
      <script src='./javabits.js' language='Javascript'></script>
      <script src='../js/full_function.js' language='Javascript'></script>
	  
      <Script language="Javascript">
<?
   $tsql = "SELECT * FROM Tbl_Branch";
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
	  
	  $clusterbrahnch="";
		$strsqlbranch="select * from tbl_branchcluster where branch ='".$row['branch_code']."' and flag ='0'";
		//echo $strsqlbranch;
		$cursorTypebranch = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
		$paramsbranch = array(&$_REQUEST['query']);
		$sqlconbranch = sqlsrv_query($conn, $strsqlbranch, $paramsbranch, $cursorTypebranch);
		if ( $sqlconbranch === false)die( FormatErrors( sqlsrv_errors() ) );
		//$rowCounter = sqlsrv_num_rowsbranch($sqlconbranchn);
		if(sqlsrv_has_rows($sqlconbranch))
		{
			while($rowsbranch = sqlsrv_fetch_array($sqlconbranch, SQLSRV_FETCH_ASSOC))
			{
				$clusterbrahnch .=$rowsbranch['branchto'].$rowsbranch['flag'].',';
			}
		}
		
		
		$nominaltarget="0";
		$apptarget="0";
		$strsqlbranch="select * from tbl_branch_target where branchid ='".$row['branch_code']."'";
		$cursorTypebranch = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
		$paramsbranch = array(&$_REQUEST['query']);
		$sqlconbranch = sqlsrv_query($conn, $strsqlbranch, $paramsbranch, $cursorTypebranch);
		if ( $sqlconbranch === false)die( FormatErrors( sqlsrv_errors() ) );
		//$rowCounter = sqlsrv_num_rowsbranch($sqlconbranchn);
		if(sqlsrv_has_rows($sqlconbranch))
		{
			while($rowsbranch = sqlsrv_fetch_array($sqlconbranch, SQLSRV_FETCH_ASSOC))
			{
				$nominaltarget=number_format($rowsbranch['nominal_target']);
				$apptarget=$rowsbranch['app_target'];
			}
		}
		
		
		//echo substr($clusterbrahnch,0,-1);
	  
         $vartemp = "var D" . $row['branch_code'] . "=  new Array(";
        for ($zz=0;$zz<$countfield;$zz++)
        {
				  $aa = substr($datafield[$zz],strlen($datafield[$zz])-11);
        	if ($aa <> "create_time")
        	{
				    $aa = $row[$datafield[$zz]];
						$vartemp .= "\"'" . $aa . "'\",";
        	}
        	else
        	{
        		$aa = date('Y-m-d H:m:s');
						$vartemp .= "\"'" . $aa . "'\",";
          }
        }
        $vartemp .= "\"'" . substr($clusterbrahnch,0,-1) . "'\",'".$nominaltarget."','".$apptarget."');";
?>
				    <? echo $vartemp; ?>

<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
        function viewDetail()
        {
        	  goNew();
	   	      var selectedArray = eval("D" + document.formsubmit.updcode.options[document.formsubmit.updcode.selectedIndex].value);
				//alert(selectedArray[14]);
	   		    eval("document.formsubmit.newbranchid.value=" + selectedArray[0]);
	   		    eval("document.formsubmit.backbranchid.value=" + selectedArray[0]);
	   		    eval("document.formsubmit.newbranchname.value=" + selectedArray[1]);
	   		    eval("document.formsubmit.backbranchname.value=" + selectedArray[1]);
	   		    eval("document.formsubmit.newbranchregion.value=" + selectedArray[2]);
	   		    eval("document.formsubmit.backbranchregion.value=" + selectedArray[2]);
	   		    eval("document.formsubmit.newbranchaddr.value=" + selectedArray[3]);
	   		    eval("document.formsubmit.backbranchaddr.value=" + selectedArray[3]);
	   		    eval("document.formsubmit.newbranchcity.value=" + selectedArray[4]);
	   		    eval("document.formsubmit.backbranchcity.value=" + selectedArray[4]);
	   		    eval("document.formsubmit.newbranchzip.value=" + selectedArray[5]);
	   		    eval("document.formsubmit.backbranchzip.value=" + selectedArray[5]);
	   		    eval("document.formsubmit.newbranchorg.value=" + selectedArray[10]);
	   		    eval("document.formsubmit.backbranchorg.value=" + selectedArray[10]);
	   		    eval("document.formsubmit.newbranchbudget.value=" + selectedArray[11]);
	   		    eval("document.formsubmit.backbranchbudget.value=" + selectedArray[11]);
	   		    eval("document.formsubmit.newbranchflags.value=" + selectedArray[8]);
	   		    eval("document.formsubmit.backbranchflags.value=" + selectedArray[8]);
	   		    eval("document.formsubmit.newcluster.value=" + selectedArray[12]);
	   		    eval("document.formsubmit.backcluster.value=" + selectedArray[12]);
	   		    document.formsubmit.newbranchnominal.value= selectedArray[13];
	   		    document.formsubmit.backbranchnominal.value= selectedArray[13];
	   		    document.formsubmit.newbranchapp.value= selectedArray[14];
	   		    document.formsubmit.backbranchapp.value= selectedArray[14];
        }
        function goNew()
        {
	   		    document.formsubmit.newbranchid.value="";
	   		    document.formsubmit.newbranchname.value="";
	   		    document.formsubmit.newbranchregion.value="";
	   		    document.formsubmit.newbranchaddr.value="";
	   		    document.formsubmit.newbranchcity.value="";
	   		    document.formsubmit.newbranchzip.value="";
	   		    document.formsubmit.newbranchorg.value="";
	   		    document.formsubmit.newbranchbudget.value="";
	   		    document.formsubmit.newbranchflags.value="";
	   		    document.formsubmit.newbranchflagbi.value="";
	   		    document.formsubmit.newbranchflagapr.value="";
	   		    document.formsubmit.newbranchflagleg.value="";
	   		    document.formsubmit.newbranchflagdd.value="";
	   		    document.formsubmit.newbranchflagcap.value="";	   		    
				document.formsubmit.newbranchflagco.value="";
	   		    document.formsubmit.newbranchnominal.value="";	   		    
				document.formsubmit.backbranchnominal.value="";
	   		    document.formsubmit.newbranchapp.value="";	   		    
				document.formsubmit.backbranchapp.value="";

        }
        function viewOther(theformname,theformfield,thefielddest,thewindow,thedetail)
        {
           document.formsubmit.target = thewindow;
           document.formsubmit.act.value = "viewother";
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
        function viewOrg(theformname,theformfield,thefielddest,thewindow,thedetail)
        {
           document.formsubmit.target = thewindow;
           document.formsubmit.act.value = "vieworg";
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
		
		 function addclusterbranch(theformname,theformfield,thefielddest,thewindow,thedetail)
        {
           document.formsubmit.target = thewindow;
           document.formsubmit.act.value = "vieworg";
           document.formsubmit.utilwindow.value = thewindow;
           document.formsubmit.utilformname.value = theformname;
           document.formsubmit.utilfielddest.value = thefielddest;
           document.formsubmit.utilformfield.value = theformfield;
           document.formsubmit.utilfieldvalue.value = eval("document.formsubmit." + theformfield + ".value");
           document.formsubmit.utildetail.value = thedetail;
           document.formsubmit.action = "./addbranchcluster.php";
           if (thewindow != "smallwindow")
           {
              window.open('./addbranchcluster.php',thewindow,'scrollbars=yes,width=600,height=450,screenX=0,screenY=0,top=0,left=0,status=yes');
           }
           else
           {
              window.open('./addbranchcluster.php',thewindow,'scrollbars=yes,width=300,height=450,screenX=0,screenY=0,top=0,left=0,status=yes');
           }
           document.formsubmit.submit();
        }
		
		function Clusteradd()
        {
			document.getElementById('formsubmit').action = "./addbranchcluster.php";
			document.getElementById('formsubmit').target= "ini cluster";
			document.getElementById('formsubmit').submit();
        }
        function viewTrustee(theformname,theformfield,thefielddest,thewindow,thedetail)
        {
           document.formsubmit.target = thewindow;
           document.formsubmit.act.value = "viewtrustee";
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
        function cekHistory(thefield,thebackup,thenew)
        {
				   	   if (thebackup != thenew)
				   	   {
				   	   	  document.formsubmit.actionhistory.value = document.formsubmit.actionhistory.value + thefield + thebackup + " >> " + thenew + "//";
				   	   }
        }
        function cekSpecialChar(thetitle,thefield)
        {
					 var iChars = "! @#$%^&*()+=-[]\\\';,./{}|\":<>?";
           for (var i = 0; i < eval(thefield + ".value.length"); i++)
           {
								if (iChars.indexOf(eval(thefield + ".value.charAt(i)")) != -1) 
								{
										alert (thetitle + " tidak boleh menggunakan spesial karakter / spasi");
										eval(thefield + ".focus()");
										return false;
								}
           }
           return true;
        }
        function goSave()
        {
        	 document.formsubmit.actionhistory.value = "";
           var Money ="0123456789";
				   if (document.formsubmit.newbranchid.value == "")
				   {
				   	   alert("Please fill Branch ID");
				   	   document.formsubmit.newbranchid.focus();
				   	   return false;
				   }
				   if (!cekSpecialChar("Branch ID","document.formsubmit.newbranchid"))
				   {
				   	  return false;
				   }
				   if (document.formsubmit.newbranchname.value == "")
				   {
				   	   alert("Please fill Branch Name");
				   	   document.formsubmit.newbranchname.focus();
				   	   return false;
				   }
				   else
				   {
				   	   cekHistory("Branch Name : ",document.formsubmit.backbranchname.value,document.formsubmit.newbranchname.value);
				   }
				   if (document.formsubmit.newbranchregion.options[document.formsubmit.newbranchregion.selectedIndex].value == "")
				   {
				   	   alert("Please fill Region");
				   	   document.formsubmit.newbranchregion.focus();
				   	   return false;
				   }
				   else
				   {
				   	   cekHistory("Region : ",document.formsubmit.backbranchregion.value,document.formsubmit.newbranchregion.value);
				   }
				   if (document.formsubmit.newbranchbudget.value != "")
				   {
              for (var i = 0; i < document.formsubmit.newbranchbudget.value.length; i++)
              {
       	         if (Money.indexOf(document.formsubmit.newbranchbudget.value.charAt(i)) == -1)
       	         {
                    alert("Branch Budget harus berupa angka");
                    document.formsubmit.newbranchbudget.focus();
                    return false;
                 }
              }
				   }
				   else
				   {
				   	   cekHistory("Budget : ",document.formsubmit.backbranchbudget.value,document.formsubmit.newbranchbudget.value);
				   }
				   cekHistory("Address : ",document.formsubmit.backbranchaddr.value,document.formsubmit.newbranchaddr.value);
				   cekHistory("City : ",document.formsubmit.backbranchcity.value,document.formsubmit.newbranchcity.value);
				   cekHistory("Kodepos : ",document.formsubmit.backbranchzip.value,document.formsubmit.newbranchzip.value);
				   cekHistory("O Chart : ",document.formsubmit.backbranchorg.value,document.formsubmit.newbranchorg.value);
				   cekHistory("Cluster : ",document.formsubmit.backcluster.value,document.formsubmit.newcluster.value);
				   cekHistory("Target Nominal : ",document.formsubmit.backbranchnominal.value,document.formsubmit.newbranchnominal.value);
				   cekHistory("Target Applikasi : ",document.formsubmit.backbranchapp.value,document.formsubmit.newbranchapp.value);
				   cekHistory("Flag BI : ",document.formsubmit.backbranchflagbi.value,document.formsubmit.newbranchflagbi.value);
				   cekHistory("Flag Apr : ",document.formsubmit.backbranchflagapr.value,document.formsubmit.newbranchflagapr.value);
				   cekHistory("Flag CAP : ",document.formsubmit.backbranchflagcap.value,document.formsubmit.newbranchflagcap.value);
				   cekHistory("Flag LEG : ",document.formsubmit.backbranchflagleg.value,document.formsubmit.newbranchflagleg.value);
				   cekHistory("Flag DD : ",document.formsubmit.backbranchflagdd.value,document.formsubmit.newbranchflagdd.value);
				   cekHistory("Flag CO : ",document.formsubmit.backbranchflagco.value,document.formsubmit.newbranchflagco.value);
				   cekHistory("Flags : ",document.formsubmit.backbranchflags.value,document.formsubmit.newbranchflags.value);
           if (document.formsubmit.actionhistory.value == "")
           {
              alert("Anda Belum Melakukan Perubahan Apapun");
              return false;
           }
           else
           {
           		document.formsubmit.target = "utama";
           		document.formsubmit.act.value = "save";
           		document.formsubmit.action = "./domaintainbranch.php";
           		varmsg = "Are your sure to SAVE ? Perubahan Terhadap : " + "\n";
           		arrdata = document.formsubmit.actionhistory.value.split('//');
				   		for (vari=0;vari<arrdata.length-1;vari++)
				   		{
				   			varmsg = varmsg + arrdata[vari] + "\n";
				   		}
           		submitform = window.confirm(varmsg)           
           		if (submitform == true)
           		{
		              document.formsubmit.submit();
           		}
           }
        }
        function goDel()
        {
           document.formsubmit.target = "utama";
           document.formsubmit.act.value = "del";
           document.formsubmit.action = "./domaintainbranch.php";
           submitform = window.confirm("Are your sure to DELETE Branch " + document.formsubmit.newbranchid.value + " " + document.formsubmit.newbranchname.value + " ?")
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

  <tr >
   	   <div align=center>
   	      <table style="background-color:#;"width="760"  cellpadding="0" cellspacing="0" border="0" align="center" bordercolor="#4476b3" bordercolorlight="#000000" bordercolordark="#ffffff" >
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
   	  	      	 <font face=Arial size=3><b>MANAGE BRANCH</b></font>
   	      		</td>
   	      	</tr>
   	      </table>
   	      <BR><BR>
   	      <table width="760" border=0 cellpadding=0 cellspacing=0>
   	  	      <tr>
   	  	      	<td width=100% align=left valign=top>
   	  	      		<form name=formsubmit id="formsubmit" method=post>
                  	   <font face=Arial style="font-size: 10;">Search Branch :</font> &nbsp
                  	   <input type=text name=updstring size=20 maxlength=60>
                  	   <input type=button value='Find (From Top)' style="width: 40mm;" onclick="javascript:findString(0);">
                  	   <input type=button value='Find Next (From Last Position)' style="width: 60mm;" onclick="javascript:findString(1);">
                 	   <hr size=2>
   	  	      		   <table width=100% border=0 cellpadding=0 cellspacing=0>
   	  	      			    <tr>
   	  	      			    	<td width=50% align=left valign=top>
   	  	      			    		<font face=Arial size=2>Daftar Branch</font>
   	  	      			    		<BR>
   	  	      			    		<select name=updcode size=32 style='width: 80mm' onChange="javascript:viewDetail();">
<?
   $tsql = "SELECT *
						FROM Tbl_Region
						ORDER BY region_code";
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
   	  	      			         <option value='<? echo $row['region_code']; ?>'><? echo $row['region_code']; ?> - <? echo $row['region_name']; ?></option>
<?
   			  $tsql2 = "SELECT *
						        FROM Tbl_Branch
						        WHERE branch_region_code='$row[region_code]'
						        ORDER BY branch_code";
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
   	  	      			         <option value='<? echo $row2['branch_code']; ?>'>&nbsp &nbsp <? echo $row2['branch_code']; ?> - <? echo $row2['branch_name']; ?></option>
<?
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      			    		</select>
   	  	      			    	</td>
   	  	      			    	<td width=50% align=center valign=top>
   	  	      			    		<font face=Arial size=2>Detail Branch</font>
   	  	      			    		<BR><BR>
   	  	      		   	      <table width=100% border=0 cellpadding=2 cellspacing=2>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Branch ID &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newbranchid size=20 maxlength=20>
   	  	      		   	      			<input type=hidden name=backbranchid>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Branch Name &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newbranchname size=30 maxlength=50>
   	  	      		   	      			<input type=hidden name=backbranchname>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Branch Region &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backbranchregion>
   	  	      		   	      			<select name=newbranchregion style='width: 70mm'>
   	  	      		   	      				<option value=''>--Please Choose One--</option>
<?
   $tsql = "SELECT *
						FROM Tbl_Region
						ORDER BY region_code";
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
   	  	      			         <option value='<? echo $row['region_code']; ?>'><? echo $row['region_code']; ?> - <? echo $row['region_name']; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      		   	      			</select>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Branch Address &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newbranchaddr size=30 maxlength=100>
   	  	      		   	      			<input type=hidden name=backbranchaddr>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Branch City &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newbranchcity size=30 maxlength=100>
   	  	      		   	      			<input type=hidden name=backbranchcity>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Branch Zipcode &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newbranchzip size=30 maxlength=5>
   	  	      		   	      			<input type=hidden name=backbranchzip>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<A HREF="javascript:viewOrg('formsubmit','newbranchorg','newbranchorg','mediumwindow','N')"><font face=Arial size=2>O. Chart</font></A> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newbranchorg size=30 maxlength=50>
   	  	      		   	      			<input type=hidden name=backbranchorg>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Branch Budget &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newbranchbudget size=30 maxlength=20 onkeydown="return isNumberKey(event)" >
   	  	      		   	      			<input type=hidden name=backbranchbudget>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Target Nominal &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newbranchnominal size=30 maxlength=20 onkeydown="return isNumberKey(event)">
   	  	      		   	      			<input type=hidden name=backbranchnominal>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Target App &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newbranchapp size=30 maxlength=20 onkeydown="return isNumberKey(event)" >
   	  	      		   	      			<input type=hidden name=backbranchapp>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
								<!--
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>BI Check &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backbranchflagbi>
   	  	      		   	      			<select name=newbranchflagbi style='width: 70mm'>
   	  	      		   	      				<option value=''>--Please Choose One--</option>
<?
   $tsql = "SELECT *
						FROM Tbl_Branch
						ORDER BY branch_code";
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
   	  	      			         <option value='<? echo $row['branch_code']; ?>'><? echo $row['branch_code']; ?> - <? echo $row['branch_name']; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      		   	      			</select>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Appraisal &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backbranchflagapr>
   	  	      		   	      			<select name=newbranchflagapr style='width: 70mm'>
   	  	      		   	      				<option value=''>--Please Choose One--</option>
<?
   $tsql = "SELECT *
						FROM Tbl_Branch
						ORDER BY branch_code";
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
   	  	      			         <option value='<? echo $row['branch_code']; ?>'><? echo $row['branch_code']; ?> - <? echo $row['branch_name']; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      		   	      			</select>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Credit Approval &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backbranchflagcap>
   	  	      		   	      			<select name=newbranchflagcap style='width: 70mm'>
   	  	      		   	      				<option value=''>--Please Choose One--</option>
<?
   $tsql = "SELECT *
						FROM Tbl_Branch
						ORDER BY branch_code";
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
   	  	      			         <option value='<? echo $row['branch_code']; ?>'><? echo $row['branch_code']; ?> - <? echo $row['branch_name']; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      		   	      			</select>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Legal &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backbranchflagleg>
   	  	      		   	      			<select name=newbranchflagleg style='width: 70mm'>
   	  	      		   	      				<option value=''>--Please Choose One--</option>
<?
   $tsql = "SELECT *
						FROM Tbl_Branch
						ORDER BY branch_code";
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
   	  	      			         <option value='<? echo $row['branch_code']; ?>'><? echo $row['branch_code']; ?> - <? echo $row['branch_name']; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      		   	      			</select>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Drawdown &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backbranchflagdd>
   	  	      		   	      			<select name=newbranchflagdd style='width: 70mm'>
   	  	      		   	      				<option value=''>--Please Choose One--</option>
<?
   $tsql = "SELECT *
						FROM Tbl_Branch
						ORDER BY branch_code";
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
   	  	      			         <option value='<? echo $row['branch_code']; ?>'><? echo $row['branch_code']; ?> - <? echo $row['branch_name']; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      		   	      			</select>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
								
								<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Credit Officer &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backbranchflagco>
   	  	      		   	      			<select name=newbranchflagco style='width: 70mm'>
   	  	      		   	      				<option value=''>--Please Choose One--</option>
<?
   $tsql = "SELECT *
						FROM Tbl_Branch
						ORDER BY branch_code";
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
   	  	      			         <option value='<? echo $row['branch_code']; ?>'><? echo $row['branch_code']; ?> - <? echo $row['branch_name']; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      		   	      			</select>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	-->
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Branch Flags &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newbranchflags size=30 maxlength=20>
   	  	      		   	      			<input type=hidden name=backbranchflags>
   	  	      		   	      			<input type=hidden name=actionhistory>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
								<!--
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Cluster</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
										<a href="javascript:Clusteradd();" > Add Cluster</a>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
								-->
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<A HREF="javascript:addclusterbranch('formsubmit','newcluster','newcluster','mediumwindow','N')"><font face=Arial size=2>Cluster</font></A> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newcluster size=30 readonly="readonly">
   	  	      		   	      			<input type=hidden name=backcluster>
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
   	  	      			    		<BR>
   	  	      			    	</td>
   	  	      			    </tr>
   	  	      		   </table>
						<input type="hidden" name="newbranchflagco" id="newbranchflagco"/>
						<input type="hidden" name="backbranchflagco" id="backbranchflagco"/>


						<input type="hidden" name="newbranchflagdd" id="newbranchflagdd"/>
						<input type="hidden" name="backbranchflagdd" id="backbranchflagdd"/>

						<input type="hidden" name="newbranchflagleg" id="newbranchflagleg"/>
						<input type="hidden" name="backbranchflagleg" id="backbranchflagleg"/>


						<input type="hidden" name="newbranchflagcap" id="newbranchflagcap"/>
						<input type="hidden" name="backbranchflagcap" id="backbranchflagcap"/>

						<input type="hidden" name="newbranchflagapr" id="newbranchflagapr"/>
						<input type="hidden" name="backbranchflagapr" id="backbranchflagapr"/>


						<input type="hidden" name="newbranchflagbi" id="newbranchflagbi"/>
						<input type="hidden" name="backbranchflagbi" id="backbranchflagbi"/>



								
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
