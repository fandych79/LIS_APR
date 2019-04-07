<?php

  $act=$_POST['act'];

   if ($act == "edittable")
   {
      EDITTABLE();
   }
   if ($act == "savetable")
   {
      SAVETABLE();
   }
   if ($act == "savetxt")
   {
      SAVETXT();
   }
   if ($act == "deltable")
   {
      DELTABLE();
   }

function DELTABLE()
{
   $tablename=$_POST['tablename'];
   $tabledesc=$_POST['tabledesc'];
   $tempfield=$_POST['tempfield'];
   $datafield=explode(",",$tempfield);

    $countfield = 0;
   	foreach ($datafield as $t)
		{
			 $countfield++;
    }
   $prikey=$_POST[$datafield[0]];
   $seckey=$_POST[$datafield[1]];

    
require ("../lib/open_con.php");
   
   $tsql = "SELECT COUNT(*) as b FROM $tablename
   					WHERE $datafield[0]='$prikey'
   					AND $datafield[1]='$seckey'";
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
      	 $rowcount = $row['b'];
      }
   }
   sqlsrv_free_stmt( $sqlConn );
   
   if ($rowcount > 0)
   {
      $tsql = "DELETE FROM $tablename
   					WHERE $datafield[0]='$prikey'
   					AND $datafield[1]='$seckey'";

      $params = array(&$_POST['query']);

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

   }

   EDITTABLE();

exit;
}

function SAVETABLE()
{
   $tablename=$_POST['tablename'];
   $tabledesc=$_POST['tabledesc'];
   $tempfield=$_POST['tempfield'];
   $datafield=explode(",",$tempfield);

    $countfield = 0;
   	foreach ($datafield as $t)
		{
			 $countfield++;
    }
   $prikey=$_POST[$datafield[0]];
   $seckey=$_POST[$datafield[1]];

    
require ("../lib/open_con.php");
   
   $tsql = "SELECT COUNT(*) as b FROM $tablename
   					WHERE $datafield[0]='$prikey'
   					AND $datafield[1]='$seckey'";
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
      	 $rowcount = $row['b'];
      }
   }
   sqlsrv_free_stmt( $sqlConn );
   
   if ($rowcount > 0)
   {
      $tsql = "UPDATE $tablename SET ";
      for ($zz=1;$zz<$countfield-1;$zz++)
      {
         $varvalue=$_POST[$datafield[$zz]];
         $tsql .= $datafield[$zz] . "=" . "'" . $varvalue . "',";
      }
   		$tsql = substr($tsql,0,strlen($tsql)-1) .	" WHERE $datafield[0]='$prikey' AND $datafield[1]='$seckey'";
   }
   else
   {
      $tsql = "INSERT INTO $tablename VALUES('$prikey', ";
      for ($zz=1;$zz<$countfield-1;$zz++)
      {
         $varvalue=$_POST[$datafield[$zz]];
         $tsql .= "'" . $varvalue . "',";
      }
   		$tsql = substr($tsql,0,strlen($tsql)-1) .	")";
   }

      $params = array(&$_POST['query']);

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

   EDITTABLE();

exit;
}

function SAVETXT()
{
   $tablename=$_POST['tablename'];
   $tabledesc=$_POST['tabledesc'];
   $tempfield=$_POST['tempfield'];
   $datafield=explode(",",$tempfield);

    $countfield = 0;
   	foreach ($datafield as $t)
		{
			 $countfield++;
    }
   $prikey=$_POST[$datafield[0]];
   $seckey=$_POST[$datafield[1]];

    
require ("../lib/open_con.php");


   $ourFileName = "c:/xampp/htdocs/lismega_DEVEL/version/" . $tablename . ".bfn";
   $ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
   $line = "code|desc\n";
   fwrite($ourFileHandle,$line);

   $tsql = "SELECT * FROM $tablename";
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
      	 $line = "";
         for ($zz=0;$zz<$countfield-1;$zz++)
         {
         	  $vartemp = "chk" . $datafield[$zz];
            $varvalue=$_POST[$vartemp];
            if ($varvalue == "Y")
            {
   				     $line .= $row[$datafield[$zz]] . "|";
            }
         }
         if ($line != "")
         {
         	  $line = substr($line,0,strlen($line)-1) . "\n";
            fwrite($ourFileHandle,$line);
         }
      }
   }
   sqlsrv_free_stmt( $sqlConn );
   fclose($ourFileHandle);
   
?>
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml">
      <head>
      	<title>LISMEGA</title>
      </head>
      <body>
   	   <div align=center>
   	      <table width="760" border=0 cellpadding=0 cellspacing=0>
   	      	<tr>
   	      		<td width=50% align=left valign=top>
     	   	       <A HREF="./maintaintable2.php"><font face=Arial size=2>Back To Main</font></A>
   	      		</td>
   	      		<td width=50% align=left valign=top>
     	   	       <A HREF="/lismega_DEVEL/version/<? echo $tablename; ?>.bfn"><font face=Arial size=2>Click Here To Download <? echo $tablename; ?>.bfn</font></A>
   	      		</td>
   	      	</tr>
   	      </table>
   	      <BR><BR>
   	   </div>      	
      </body>    
   </html>
<?
   require("../lib/close_con.php");

exit;
}

function EDITTABLE()
{
   $tablename=$_POST['tablename'];
   $tabledesc=$_POST['tabledesc'];

    
require ("../lib/open_con.php");

   $tempfield = "";
   $tsql = "SELECT * FROM INFORMATION_SCHEMA.Columns WHERE TABLE_NAME = '$tablename'";
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
      	 $tempfield .= $row['COLUMN_NAME'] . ",";
      }
   }
   sqlsrv_free_stmt( $sqlConn );
   $datafield=explode(",",$tempfield);

    $countfield = 0;
   	foreach ($datafield as $t)
		{
			 $countfield++;
    }

   $tsql = "SELECT COUNT(*) as b FROM $tablename";
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
      <title>LIS PARAM</title>
      <LINK media=screen href="/lismega_DEVEL/style/menu.css" rel=stylesheet>
      <Script language="Javascript">
<?
   $tsql = "SELECT * FROM $tablename
   					ORDER BY $datafield[0]";
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
         $vartemp = "var D" . $row[$datafield[0]] . $row[$datafield[1]] . "=  new Array(";
        for ($zz=0;$zz<$countfield-1;$zz++)
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
        	  goNew();
	   	      var selectedArray = eval(document.formsubmit.updcode.options[document.formsubmit.updcode.selectedIndex].value);
<?
         for ($zz=0;$zz<$countfield-1;$zz++)
         {
						$aa = $datafield[$zz];
?>
	   		    eval("document.formsubmit.<? echo $aa; ?>.value=" + selectedArray[<? echo $zz; ?>]);
<?
         }
?>
        }
        function goNew()
        {        	
<?
         for ($zz=0;$zz<$countfield-1;$zz++)
         {
						$aa = $datafield[$zz];
						$varvalue = "";
									if (substr($datafield[$zz],strlen($datafield[$zz])-11) == "create_time")
									{										
										$varvalue = date('Y-m-d h:m:s');
								  }
									if (substr($datafield[$zz],strlen($datafield[$zz])-13) == "create_userid")
									{										
										$varvalue = "admin";
								  }
?>
	   		    document.formsubmit.<? echo $aa; ?>.value='<? echo $varvalue; ?>';
<?
         }
?>
        }
        function cekDel()
        {
           document.formsubmit.target = "utama";
           document.formsubmit.act.value = "deltable";
           document.formsubmit.action = "./domaintaintable2.php";
           submitform = window.confirm("Are your sure to DELETE ?")
           if (submitform == true)
           {
              document.formsubmit.submit();
           }
        }
        function cekTXT()
        {
           document.formsubmit.target = "utama";
           document.formsubmit.act.value = "savetxt";
           document.formsubmit.action = "./domaintaintable2.php";
           submitform = window.confirm("Are your sure to CREATE TXT ?")
           if (submitform == true)
           {
              document.formsubmit.submit();
           }
        }
        function cekSave()
        {
           document.formsubmit.target = "utama";
           document.formsubmit.act.value = "savetable";
           document.formsubmit.action = "./domaintaintable2.php";
           submitform = window.confirm("Are your sure to SAVE ?")
           if (submitform == true)
           {
              document.formsubmit.submit();
           }
        }
	function findString(themethod)
	{
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
	   for (vari=varstart;vari<<? echo $hituser; ?>;vari++)
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



<table style="background-color:#;"width="760"  cellpadding="0" cellspacing="0" border="0" align="center" bordercolor="#4476b3" bordercolorlight="#000000" bordercolordark="#ffffff" >

   	      	<tr>
   	      		<td width=100% align=left valign=top>
     	   	       <A HREF="./maintaintable2.php"><font face=Arial size=2>Back To Main</font></A>
   	      		</td>
   	      	</tr>
   	      	<tr>
   	      		<td width=100% align=center valign=top>
   	  	      	 <font face=Arial size=3><b>MANAGE <? echo $tabledesc; ?> [<? echo $tablename; ?>]</b></font>
   	      		</td>
   	      	</tr>
   	      </table>
   	      <BR><BR>
   	      <table width="760" border=0 cellpadding=0 cellspacing=0>
   	  	      <tr>
   	  	      	<td width=100% align=left valign=top>
   	  	      		<form name=formsubmit method=post>
                  	   <font face=Arial style="font-size: 10;">Search String :</font> &nbsp
                  	   <input type=text name=updstring size=20 maxlength=60>
                  	   <input type=button value='Find (From Top)' style="width: 40mm;" onclick="javascript:findString(0);">
                  	   <input type=button value='Find Next (From Last Position)' style="width: 60mm;" onclick="javascript:findString(1);">
                 	   <hr size=2>
   	  	      		   <table width=100% border=0 cellpadding=0 cellspacing=0>
   	  	      			    <tr>
   	  	      			    	<td width=50% align=center valign=top>
   	  	      			    		<font face=Arial size=2>Daftar <? echo $tabledesc; ?></font>
   	  	      			    		<BR>
   	  	      			    		<select name=updcode size=25 style='width: 80mm' onChange="javascript:viewDetail();">
<?
   $tsql = "SELECT * FROM $tablename
   					ORDER BY $datafield[0]";
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
   	  	      			         <option value='D<? echo $row[$datafield[0]]; ?><? echo $row[$datafield[1]]; ?>'><? echo $row[$datafield[0]]; ?> - <? echo $row[$datafield[1]]; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      			    		</select>
   	  	      			    	</td>
   	  	      			    	<td width=50% align=center valign=top>
   	  	      			    		<font face=Arial size=2>Detail <? echo $tabledesc; ?></font>
   	  	      			    		<BR><BR>
   	  	      		   	      <table width=100% border=0 cellpadding=2 cellspacing=2>
<?
        		    for ($zz=0;$zz<$countfield-1;$zz++)
								{
									$varvalue = "";
									if (substr($datafield[$zz],strlen($datafield[$zz])-13) == "create_userid")
									{										
										$varvalue = "admin";
								  }
									if (substr($datafield[$zz],strlen($datafield[$zz])-11) == "create_time")
									{										
										$varvalue = date('Y-m-d h:m:s');
								  }
?>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=50% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2><? echo $datafield[$zz]; ?> &nbsp</font>
   	  	      		   	      			<input type=checkbox name=chk<? echo $datafield[$zz]; ?> value='Y'>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=50% align=left valign=top>
   	  	      		   	      			<input type=text name=<? echo $datafield[$zz]; ?> size=20 maxlength=250 value='<? echo $varvalue; ?>'>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
<?
							  }
?>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=50% align=right valign=top>
   	  	      		   	      			<input type=button value='Create TXT (checked)' onclick=cekTXT()>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=50% align=left valign=top>
   	  	      		   	      			<input type=button value='Save' onclick=cekSave()>
   	  	      		   	      			<input type=button value='Delete' onclick=cekDel()>
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
    								 <input type=hidden name=tablename value='<? echo $tablename; ?>'>
    								 <input type=hidden name=tabledesc value='<? echo $tabledesc; ?>'>
    								 <input type=hidden name=tempfield value='<? echo $tempfield; ?>'>
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
