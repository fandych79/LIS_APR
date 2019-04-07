<?php

  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
  $userprogramact="maintainflow.php";

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

   $tempfield = "";
   $countfield = 0;
   $tsql = "SELECT * FROM INFORMATION_SCHEMA.Columns WHERE TABLE_NAME = 'Tbl_Workflow'";
   
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
   //print_r($datafield);
   

   $tsql = "SELECT COUNT(*) as b FROM Tbl_SE_User";
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
      	   $hituser = $row['b'];
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>MAINTAIN FLOW</title>
      <LINK media=screen href="../style/menu.css" rel=stylesheet>
      <script src='./javabits.js' language='Javascript'></script>
      <Script language="Javascript">
<?
   $tsql = "SELECT * FROM Tbl_Workflow";
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
         $vartemp = "var D" . $row['wf_id'] . "=  new Array(";
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
   			  $tsql2 = "SELECT *
						        FROM Tbl_PrevFlow
						        WHERE Flow='$row[wf_id]'";
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
							     $vartemp .= "\"'" . $row2['Prev'] . "'\",";
							     $vartemp .= "\"'" . $row2['Next'] . "'\",";
							     $vartemp .= "\"'" . $row2['Rules'] . "'\",";
							     $vartemp .= "\"'" . $row2['BackTo'] . "'\",";
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );

		  
			$clusterbrahnch="";
			$strsqlbranch="select * from tbl_docparamworkflow where wf_id ='".$row['wf_id']."' and flag=0;";
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
				$clusterbrahnch .=$rowsbranch['doc_id'].$rowsbranch['flag'].',';
			}
			}
		  //echo $clusterbrahnch."";
   			  $tsql2 = "SELECT *
						        FROM Tbl_WorkflowDoc
						        WHERE wf_id='$row[wf_id]'";
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
#							     $vartemp .= "\"'" . $row2['wf_doc'] . "'\",";
							     $vartemp .= "\"" . $row2['wf_doc'] . "\",";
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );

		
		$vartemp .= "\"'" . substr($clusterbrahnch,0,-1) . "'\");";
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
	   	      var selectedArray = eval(document.formsubmit.updcode.options[document.formsubmit.updcode.selectedIndex].value);
				//alert(selectedArray[]);
	   		    eval("document.formsubmit.newwfid.value=" + selectedArray[0]);
	   		    eval("document.formsubmit.backwfid.value=" + selectedArray[0]);
				
	   		    eval("document.formsubmit.newwfname.value=" + selectedArray[1]);
	   		    eval("document.formsubmit.backwfname.value=" + selectedArray[1]);
				
	   		    eval("document.formsubmit.newwfurut.value=" + selectedArray[2]);
	   		    eval("document.formsubmit.backwfurut.value=" + selectedArray[2]);
				
	   		    eval("document.formsubmit.newwftime.value=" + selectedArray[3]);
	   		    eval("document.formsubmit.backwftime.value=" + selectedArray[3]);
				
	   		    eval("document.formsubmit.newwfscore.value=" + selectedArray[4]);
	   		    eval("document.formsubmit.backwfscore.value=" + selectedArray[4]);
				
	   		    eval("document.formsubmit.newproccode.value=" + selectedArray[6]);
	   		    eval("document.formsubmit.backwfproccode.value=" + selectedArray[6]);
				
	   		    eval("document.formsubmit.backdesc_e.value=" + selectedArray[8]);
				    eval("document.formsubmit.desc_e.value=" + selectedArray[8]);
				
	   		    eval("document.formsubmit.newprevflow.value=" + selectedArray[9]);
	   		    eval("document.formsubmit.backprevflow.value=" + selectedArray[9]);
				
	   		    eval("document.formsubmit.newnextflow.value=" + selectedArray[10]);
	   		    eval("document.formsubmit.backnextflow.value=" + selectedArray[10]);
				
				    eval("document.formsubmit.newrulesflow.value=" + selectedArray[11]);
	   		    eval("document.formsubmit.backrulesflow.value=" + selectedArray[11]);

				    eval("document.formsubmit.newbacktoflow.value=" + selectedArray[12]);
	   		    eval("document.formsubmit.backbacktoflow.value=" + selectedArray[12]);
				
	   		    eval("document.formsubmit.backparamdoc.value=" + selectedArray[14]);
				    eval("document.formsubmit.newparamdoc.value=" + selectedArray[14]);
	   		    document.formsubmit.backwfact.value = "";
	   		    for (vari=0;vari<selectedArray[5].length;vari++)
	   		    {
	   		    	if (selectedArray[5].substring(vari,vari+1) == "I")
	   		    	{
	   		    		document.formsubmit.wfactI.checked = true;
	   		    		document.formsubmit.backwfact.value = document.formsubmit.backwfact.value + "I";
	   		      }
	   		    	if (selectedArray[5].substring(vari,vari+1) == "C")
	   		    	{
	   		    		document.formsubmit.wfactC.checked = true;
	   		    		document.formsubmit.backwfact.value = document.formsubmit.backwfact.value + "C";
	   		      }
	   		    	if (selectedArray[5].substring(vari,vari+1) == "A")
	   		    	{
	   		    		document.formsubmit.wfactA.checked = true;
	   		    		document.formsubmit.backwfact.value = document.formsubmit.backwfact.value + "A";
	   		      }
	   		    }
	   		    varflag = "'" + selectedArray[7].substring(1,2) + "'";
	   		    eval("document.formsubmit.newwfflag1.value=" + varflag);
	   		    eval("document.formsubmit.backwfflag1.value=" + varflag);
	   		    varflag = "'" + selectedArray[7].substring(2,3) + "'";
	   		    eval("document.formsubmit.newwfflag2.value=" + varflag);
	   		    eval("document.formsubmit.backwfflag2.value=" + varflag);
	   		    varflag = "'" + selectedArray[7].substring(3,4) + "'";
	   		    eval("document.formsubmit.newwfflag3.value=" + varflag);
	   		    eval("document.formsubmit.backwfflag3.value=" + varflag);
	   		    varflag = "'" + selectedArray[7].substring(4,5) + "'";
	   		    eval("document.formsubmit.newwfflag4.value=" + varflag);
	   		    eval("document.formsubmit.backwfflag4.value=" + varflag);
	   		    varflag = "'" + selectedArray[7].substring(5,6) + "'";
	   		    eval("document.formsubmit.newwfflag5.value=" + varflag);
	   		    eval("document.formsubmit.backwfflag5.value=" + varflag);
            document.formsubmit.backwfdoc.value = "";
            vardata = selectedArray[11].split('|');
            if (vardata.length > 1)
            {
               for(vari=0;vari<vardata.length-1;vari++)
               {
	   		    	   eval("document.formsubmit.DOC" + vardata[vari] + ".checked=true");
            		 document.formsubmit.backwfdoc.value = document.formsubmit.backwfdoc.value + vardata[vari] + "|";
               }
            }
        }
		
		function VinCheck(e)
		{
			var keynum;
			var keychar;
			var charcheck;
			if(window.event) // IE
			   keynum = e.keyCode;
			else if(e.which) // Netscape/Firefox/Opera
			   keynum = e.which;
			keychar = String.fromCharCode(keynum);
			charcheck = /[a-zA-Z0-9]/;
			return charcheck.test(keychar);        
		}
		
		
		
        function goNew()
        {
	   		    document.formsubmit.newwfid.value="";
	   		    document.formsubmit.newwfname.value="";
	   		    document.formsubmit.newwfurut.value="";
	   		    document.formsubmit.newwftime.value="";
	   		    document.formsubmit.newwfscore.value="";
	   		    document.formsubmit.newwfflag1.value="N";
	   		    document.formsubmit.newwfflag2.value="N";
	   		    document.formsubmit.newwfflag3.value="N";
	   		    document.formsubmit.newwfflag4.value="N";
	   		    document.formsubmit.newwfflag5.value="N";
	   		    document.formsubmit.newproccode.value="N";
	   		    document.formsubmit.newprevflow.value="";
	   		    document.formsubmit.newbacktoflow.value="";
	   		    document.formsubmit.newparamdoc.value="";
	   		    document.formsubmit.newrulesflow.value="";
	   		    document.formsubmit.desc_e.value="";
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
           var Money ="0123456789.";
				   if (document.formsubmit.newwfid.value == "")
				   {
				   	   alert("Please fill Workflow ID");
				   	   document.formsubmit.newwfid.focus();
				   	   return false;
				   }
				   if (!cekSpecialChar("WF ID","document.formsubmit.newwfid"))
				   {
				   	  return false;
				   }
				   if (document.formsubmit.newwfname.value == "")
				   {
				   	   alert("Please fill WF Name");
				   	   document.formsubmit.newwfname.focus();
				   	   return false;
				   }
				   else
				   {
				   	   cekHistory("WF Name : ",document.formsubmit.backwfname.value,document.formsubmit.newwfname.value);
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
				   	   cekHistory("WF Urut : ",document.formsubmit.backwfurut.value,document.formsubmit.newwfurut.value);
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
				   	   cekHistory("WF Time : ",document.formsubmit.backwftime.value,document.formsubmit.newwftime.value);
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
				   	   cekHistory("WF Score : ",document.formsubmit.backwfscore.value,document.formsubmit.newwfscore.value);
				   }
				   varreturn = "";
				   if (document.formsubmit.wfactI.checked == true)
				   {
				   	   varreturn = varreturn + "I";
				   }
				   if (document.formsubmit.wfactC.checked == true)
				   {
				   	   varreturn = varreturn + "C";
				   }
				   if (document.formsubmit.wfactA.checked == true)
				   {
				   	   varreturn = varreturn + "A";
				   }
				   if (varreturn == "")
				   {
				   	  alert("Please fill WF Action");
				   	  document.formsubmit.wfactI.focus();
				   	  return false;				   	  
				   }
				   else
				   {
				   	   cekHistory("WF Action : ",document.formsubmit.backwfact.value,varreturn);
				   }
				   if( document.formsubmit.newwfflag4.value=='I')
				   {
						if(document.formsubmit.newrulesflow.value=="")
						{
							alert("Please fill Rules Flow");
							document.formsubmit.newrulesflow.focus();
							return false;
						}
						if(document.formsubmit.newnextflow.value=="")
						{
							alert("Please fill Next Flow");
							document.formsubmit.newnextflow.focus();
							return false;
						}
					
				   }
				   
				   cekHistory("WF Flag Reject : ",document.formsubmit.backwfflag1.value,document.formsubmit.newwfflag1.value);
				   cekHistory("WF Flag Scoring : ",document.formsubmit.backwfflag2.value,document.formsubmit.newwfflag2.value);
				   cekHistory("WF Flag 4 : ",document.formsubmit.backwfflag4.value,document.formsubmit.newwfflag4.value);
				   
				   //cekHistory("WF Flag 5 : ",document.formsubmit.backwfflag5.value,document.formsubmit.newwfflag5.value);
				   cekHistory("Group Program : ",document.formsubmit.backwfproccode.value,document.formsubmit.newproccode.value);
				   cekHistory("Prev Flow : ",document.formsubmit.backprevflow.value,document.formsubmit.newprevflow.value);
				   cekHistory("Back To Flow : ",document.formsubmit.backbacktoflow.value,document.formsubmit.newbacktoflow.value);
				   cekHistory("Next Flow : ",document.formsubmit.backnextflow.value,document.formsubmit.newnextflow.value);
				   cekHistory("Rule Flow : ",document.formsubmit.backrulesflow.value,document.formsubmit.newrulesflow.value);
				   cekHistory("Param DOC : ",document.formsubmit.backparamdoc.value,document.formsubmit.newparamdoc.value);
				   cekHistory("Deskripsi : ",document.formsubmit.backdesc_e.value,document.formsubmit.desc_e.value);
				   varreturn = "";
					arrdata = document.formsubmit.thewfdoc.value.split('|');
				   for (vari=0;vari<arrdata.length-1;vari++)
				   {
				   	   if (eval("document.formsubmit.DOC" + arrdata[vari] + ".checked == true"))
				   	   {
				   	   	   varreturn = varreturn + arrdata[vari] + "|";
				   	   }
				   }
				   document.formsubmit.newwfdoc.value = varreturn;
				   cekHistory("WF Doc : ",document.formsubmit.backwfdoc.value,varreturn);
           if (document.formsubmit.actionhistory.value == "")
           {
              alert("Anda Belum Melakukan Perubahan Apapun");
              return false;
           }
           else
           {
           		document.formsubmit.target = "utama";
           		document.formsubmit.act.value = "save";
           		document.formsubmit.action = "./domaintainflow.php";
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
        function viewRules(theformname,theformfield,thefielddest,thewindow,thedetail)
        {
           document.formsubmit.target = thewindow;
           document.formsubmit.act.value = "rulesflow";
           document.formsubmit.utilwindow.value = thewindow;
           document.formsubmit.utilformname.value = theformname;
           document.formsubmit.utilfielddest.value = thefielddest;
           document.formsubmit.utilformfield.value = theformfield;
           document.formsubmit.utilfieldvalue.value = eval("document.formsubmit." + theformfield + ".value");
           document.formsubmit.utildetail.value = thedetail;
           document.formsubmit.action = "./utilview.php";
           if (thewindow != "smallwindow")
           {
              window.open('./utilview.php',thewindow,'scrollbars=yes,width=600,height=450,screenX=0,screenY=0,top=0,left=0,status=yes').focus();
           }
           else
           {
              window.open('./utilview.php',thewindow,'scrollbars=yes,width=300,height=450,screenX=0,screenY=0,top=0,left=0,status=yes').focus();
           }
           document.formsubmit.submit();
        }
        function viewNext(theformname,theformfield,thefielddest,thewindow,thedetail)
        {
           document.formsubmit.target = thewindow;
           document.formsubmit.act.value = "nextflow";
           document.formsubmit.utilwindow.value = thewindow;
           document.formsubmit.utilformname.value = theformname;
           document.formsubmit.utilfielddest.value = thefielddest;
           document.formsubmit.utilformfield.value = theformfield;
           document.formsubmit.utilfieldvalue.value = eval("document.formsubmit." + theformfield + ".value");
           document.formsubmit.utildetail.value = thedetail;
           document.formsubmit.action = "./utilview.php";
           if (thewindow != "smallwindow")
           {
              window.open('./utilview.php',thewindow,'scrollbars=yes,width=600,height=450,screenX=0,screenY=0,top=0,left=0,status=yes').focus();
           }
           else
           {
              window.open('./utilview.php',thewindow,'scrollbars=yes,width=300,height=450,screenX=0,screenY=0,top=0,left=0,status=yes').focus();
           }
           document.formsubmit.submit();
        }
        function viewFlow(theformname,theformfield,thefielddest,thewindow,thedetail)
        {
           document.formsubmit.target = thewindow;
           document.formsubmit.act.value = "viewflow";
           document.formsubmit.utilwindow.value = thewindow;
           document.formsubmit.utilformname.value = theformname;
           document.formsubmit.utilfielddest.value = thefielddest;
           document.formsubmit.utilformfield.value = theformfield;
           document.formsubmit.utilfieldvalue.value = eval("document.formsubmit." + theformfield + ".value");
           document.formsubmit.utildetail.value = thedetail;
           document.formsubmit.action = "./utilview.php";
           if (thewindow != "smallwindow")
           {
              window.open('./utilview.php',thewindow,'scrollbars=yes,width=600,height=450,screenX=0,screenY=0,top=0,left=0,status=yes').focus();
           }
           else
           {
              window.open('./utilview.php',thewindow,'scrollbars=yes,width=300,height=450,screenX=0,screenY=0,top=0,left=0,status=yes').focus();
           }
           document.formsubmit.submit();
        }
		function paramdocs(theformname,theformfield,thefielddest,thewindow,thedetail)
        {
           document.formsubmit.target = thewindow;
           document.formsubmit.utilwindow.value = thewindow;
           document.formsubmit.utilformname.value = theformname;
           document.formsubmit.utilfielddest.value = thefielddest;
           document.formsubmit.utilformfield.value = theformfield;
           document.formsubmit.utilfieldvalue.value = eval("document.formsubmit." + theformfield + ".value");
           document.formsubmit.utildetail.value = thedetail;
           document.formsubmit.action = "./docparam.php";
           if (thewindow != "smallwindow")
           {
              window.open('./docparam.php',thewindow,'scrollbars=yes,width=600,height=450,screenX=0,screenY=0,top=0,left=0,status=yes').focus();
           }
           else
           {
              window.open('./docparam.php',thewindow,'scrollbars=yes,width=300,height=450,screenX=0,screenY=0,top=0,left=0,status=yes').focus();
           }
           document.formsubmit.submit();
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
   	  	      	 <font face=Arial size=3><b>MANAGE WORKFLOW</b></font>
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
   	  	      			    		<font face=Arial size=2>Daftar Workflow</font>
   	  	      			    		<BR>
   	  	      			    		<select name=updcode size=25 style='width: 80mm' onChange="javascript:viewDetail();">
<?
   $tsql = "SELECT * FROM Tbl_Workflow
   					ORDER BY wf_urut";
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
   	  	      			         <option value='D<? echo $row['wf_id']; ?>'><? echo $row['wf_id']; ?> - <? echo $row['wf_name']; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      			    		</select>
   	  	      			    	</td>
   	  	      			    	<td width="50%" align="center" valign="top">
   	  	      			    		<A HREF=previewflow.php target=_blank><font face=Arial size=2>Detail Workflow</font></A>
   	  	      			    		<BR><BR>
   	  	      		   	      <table width=100% border=0 cellpadding=2 cellspacing=2>
							  <table style="background-color:#;" width=100% border=0 cellpadding=2 cellspacing=2  bordercolor="#4476b3" bordercolorlight="#000000" bordercolordark="#ffffff" >
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>WF ID &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newwfid size=20 maxlength=10 onKeyPress="return VinCheck(event);">
   	  	      		   	      			<input type=hidden name=backwfid>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>WF Name &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newwfname size=30 maxlength=20>
   	  	      		   	      			<input type=hidden name=backwfname>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>WF Urut &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newwfurut size=10 maxlength=6>
   	  	      		   	      			<input type=hidden name=backwfurut>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>WF Time &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newwftime size=10 maxlength=6>
   	  	      		   	      			<font face=Arial size=2 color=blue>[minutes] &nbsp</font>
   	  	      		   	      			<input type=hidden name=backwftime>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>WF Score &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newwfscore size=10 maxlength=6>
   	  	      		   	      			<input type=hidden name=backwfscore>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>WF Action</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			 <input type=checkbox name=wfactI value='Y'><font face=Arial size=2>Input</font>
   	  	      		   	      			 <input type=checkbox name=wfactC value='Y'><font face=Arial size=2>Checker</font>
   	  	      		   	      			 <input type=checkbox name=wfactA value='Y'><font face=Arial size=2>Approve</font>
   	  	      		   	      			<input type=hidden name=backwfact>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2 color=blue><b></b></font>
   	  	      		   	      			<font face=Arial size=2>Flag Reject</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backwfflag1>
   	  	      		   	      			<select name=newwfflag1>
   	  	      		   	      				<option value='N'>--Default--</option>
   	  	      		   	      				<option value='Y'>Reject</option>
   	  	      		   	      			</select>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Flag Scoring</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backwfflag2>
   	  	      		   	      			<select name=newwfflag2>
   	  	      		   	      				<option value='C'>--Default--</option>
   	  	      		   	      				<option value='E'>Yes, When Submit EXECUTE Scoring</option>
   	  	      		   	      			</select>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2 color=blue><b>[N/U]</b></font>
   	  	      		   	      			<font face=Arial size=2>Flag Send</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backwfflag3>
   	  	      		   	      			<select name=newwfflag3>
   	  	      		   	      				<option value='N'>--Default--</option>
   	  	      		   	      				<option value='O'>Overide</option>
   	  	      		   	      				<option value='A'>Approve</option>
   	  	      		   	      				<option value='B'>Overide & Approve</option>
   	  	      		   	      			</select>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Flag 4</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backwfflag4>
   	  	      		   	      			<select name=newwfflag4>
   	  	      		   	      				<option value='N'>--Default--</option>
   	  	      		   	      				<option value='I'>Cek Workflow Bercabang</option>
   	  	      		   	      			</select>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
										<font face=Arial size=2 color=blue><b>[N/U]</b></font>
   	  	      		   	      			<font face=Arial size=2>Flag 5</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backwfflag5>
   	  	      		   	      			<select name=newwfflag5>
											<option value='N'>--Default--</option>
										<?
											$strsql="select * from Tbl_Workflow  order by wf_urut";

											$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
											$params = array(&$_REQUEST['query']);
											$sqlcon = sqlsrv_query($conn, $strsql, $params, $cursorType);
											if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
											//$rowCounter = sqlsrv_num_rows($sqlConn);
											if(sqlsrv_has_rows($sqlcon))
											{
												while($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
												{
													echo '<option value="'.$rows['wf_id'].'">'.$rows['wf_name'].'</option>';
												}
											}
											?>
										
										
											<!--
   	  	      		   	      				<option value='N'>--Default--</option>
   	  	      		   	      				<option value='0'>BI Check</option>
   	  	      		   	      				<option value='1'>Appraisal</option>
   	  	      		   	      				<option value='2'>Legal</option>
   	  	      		   	      				<option value='3'>Drawdawn</option>
   	  	      		   	      				<option value='4'>Credit Officer</option>
                                            <option value='5'>Credit Approval</option>
                                            <option value='6'>Credit Review</option>
                                            <option value='7'>Loan Verification</option>
											-->
   	  	      		   	      			</select>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Group Program</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backwfproccode>
   	  	      		   	      			<select name=newproccode>
   	  	      		   	      				<option value='WRK'>--Default--</option>
<?
   $tsql = "SELECT * FROM Tbl_SE_GrpProgram
   					ORDER BY grp_urut";
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
?>
   	  	      			         <option value='<? echo $row[0]; ?>'><? echo $row[0]; ?> - <? echo $row[1]; ?></option>
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
   	  	      		   	      			<A HREF="javascript:viewFlow('formsubmit','newprevflow','newprevflow','mediumwindow','N')"><font face=Arial size=2>Prev FLOW</font></A>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backprevflow>
   	  	      		   	      			<input type=text name=newprevflow size=30 maxlength=30>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<A HREF="javascript:viewFlow('formsubmit','newbacktoflow','newbacktoflow','mediumwindow','N')"><font face=Arial size=2>Back To FLOW</font></A>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backbacktoflow>
   	  	      		   	      			<input type=text name=newbacktoflow size=30 maxlength=50>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<A HREF="javascript:viewRules('formsubmit','newrulesflow','newrulesflow','mediumwindow','N')"><font face=Arial size=2>Rule(s) FLOW</font></A> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backrulesflow>
   	  	      		   	      			<textarea name=newrulesflow rows=5 cols=30></textarea>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<A HREF="javascript:viewNext('formsubmit','newnextflow','newnextflow','mediumwindow','N')"><font face=Arial size=2>Next FLOW</font></A> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backnextflow>
   	  	      		   	      			<input type=text name=newnextflow size=30 maxlength=30>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<A HREF="javascript:paramdocs('formsubmit','newparamdoc','newparamdoc','mediumwindow','N')"><font face=Arial size=2>Paramdoc</font></A> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backparamdoc>
   	  	      		   	      			<textarea name=newparamdoc rows="5" cols="30"  readonly="readonly"></textarea>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			Description
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
										<input type=hidden name="backdesc_e">
										<textarea rows="10" cols="30" id="desc_e" name="desc_e"></textarea>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<!--<font face=Arial size=2>Document Support</font> &nbsp-->
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
<?
   $thewfdoc = "";
   $tsql = "SELECT * FROM Tbl_DocPerson";
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
      	$thewfdoc .= $row['doc_id'] . "|";
?>
   	  	      			         <input type=hidden name='DOC<? echo $row['doc_id']; ?>' value='Y'><font face=Arial size=2></font>
   	  	      			         
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
																	<input type=hidden name=newwfdoc>
																	<input type=hidden name=thewfdoc value="<? echo $thewfdoc ?>">
   	  	      		   	      			<input type=hidden name=backwfdoc>
   	  	      		   	      			<input type=hidden name=actionhistory>
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
    								 <input type=hidden name=userprogramcode value='<? echo $userprogramcode ?>'>
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
