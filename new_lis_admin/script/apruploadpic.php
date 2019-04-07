<?php
   $wfid=$_GET['Texcustnomid'];

    
require ("../lib/open_con.php");
?>
<HTML>
   <HEAD>
      <META http-equiv=Content-Type content='text/html; charset=iso-8859-1'>
      <META http-equiv='Pragma' content='no-cache'>
      <META content='MSHTML 5.50.4134.100' name=GENERATOR>
      <TITLE>SPIN UPLOAD</TITLE>
      <Script Language="JavaScript">
	function cekthis()
	{
	   if (document.formsubmit.uploaded.value == "")
	   {
	   	alert("Harap Pilih File Yang Hendak Diupload. Gunakan tombol Browse... untuk memudahkan");
	   	document.formsubmit.uploaded.focus();
	   	return false;
	   }
	   if (document.formsubmit.where.value == "")
	   {
	   	alert("Harap tentukan lokasi upload");
	   	document.formsubmit.where.focus();
	   	return false;
	   }
	   if (document.formsubmit.filedoc.options[document.formsubmit.filedoc.selectedIndex].value == "")
	   {
	   	alert("Harap Pilih Document");
	   	document.formsubmit.filedoc.focus();
	   	return false;
	   }
	   document.formsubmit.submit();
	}
      </Script>
   </HEAD>
   <BODY>
<script language="JavaScript"><!--
name = 'utama';
//--></script>
      <div align=center>
      <TABLE cellPadding=5 width="100%" border=0>
        <TR>
    	  <TD vAlign=top width=1>
            <TABLE cellSpacing=0 cellPadding=0 width="95%" border=0>
              <TR>
                <TD class=backW vAlign=center>
          	</TD>
              </TR>
            </TABLE>
          </TD>
          <TD align=left valign=top>
            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TR>
                <TD class=borderForm align=right bgColor=black>
                      <font style="font-size: 12;" color=#FFFFFF><B>Form type : Upload &nbsp</B></font>
                </TD>
              </TR>
              <TR>
                <TD height=15></TD>
              </TR>
              <TR>
                <TD class=borderB>
                  <TABLE cellSpacing=1 cellPadding=13 width="100%" border=0>
                    <TR>
                      <TD class=backW>
                  	<form name=formsubmit ENCTYPE='multipart/form-data' method=post action=dospin_upload.php target='lainnya'>
                  	   <TABLE WIDTH=100% CELLPADDING=1 CELLSPACING=1 border=0>                  	   	
<?
      $tsql = "SELECT * FROM Tbl_CustomerMasterPerson
      				 WHERE custnomid='$wfid'";
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
							          <tr>
							          	 <td width=20% align=left valign=top>
							          	 	<font face=Arial size=2>Customer ID : <? echo $wfid; ?></font>
							          	</td>
							          	 <td width=80% align=left valign=top>
							          	 	<font face=Arial size=2>Customer Name : <? echo $row['custfullname']; ?></font>
							          	</td>
							          </tr>
<?
         }
      }
      sqlsrv_free_stmt( $sqlConn );
?>
                  	   </TABLE>
                  	   <TABLE WIDTH=100% CELLPADDING=1 CELLSPACING=1 border=0>
      	             	      <tr>
      	                	<td width=100% valign=top align=left>
      	                	   <table width=100% cellpadding=0 cellspacing=0 border=0>
      	                	      <tr>
      	                	         <td width=35% align=left valign=top>
      	                	   	    <font face=Arial size=2>File Name</font>
      	                	         </td>
      	                	         <td width=65% align=left valign=top>
               		   		    <INPUT TYPE='FILE' NAME='uploaded' SIZE='40'>
      	                	         </td>
      	                	      </tr>
      	                      	      <tr>
      	                	 	 <td width=35% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                	 	 <td width=65% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                      	      </tr>
      	                	      <tr>
      	                	         <td width=35% align=left valign=top>
      	                	   	    <font face=Arial size=2>Format</font>
      	                	         </td>
      	                	         <td width=65% align=left valign=top>
      	                	   	    <select name=fileformat>
      	                	   	       <option value='JPG'>JPEG (.jpg)</option>
									   <option value='PRN'>SPIN Image File (.prn)</option>      	                	   	       
      	                	   	    </select>
      	                	         </td>
      	                	      </tr>
      	                      	      <tr>
      	                	 	 <td width=35% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                	 	 <td width=65% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                      	      </tr>
      	                	      <tr>
      	                	         <td width=35% align=left valign=top>
      	                	   	    <font face=Arial size=2>Customer ID</font>
      	                	         </td>
      	                	         <td width=65% align=left valign=top>
      	                	   	    <input type=text name=wfid size=40 maxlength=100 value='<? echo $wfid; ?>'>
      	                	         </td>
      	                	      </tr>
								      <tr>
      	                	 	 <td width=35% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                	 	 <td width=65% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                      	      </tr>
      	                	      <?
										$tsql = "SELECT distinct * FROM Tbl_Cust_MasterCol
												WHERE ap_lisregno='$wfid'";
										$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
										$params = array(&$_POST['query']);

										$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
										if ( $sqlConn === false)
											die( FormatErrors( sqlsrv_errors() ) );

										if(sqlsrv_has_rows($sqlConn))
										{
											$rowCount = sqlsrv_num_rows($sqlConn);
											
								  ?>
								  <tr>
      	                	         <td width=35% align=left valign=top>
      	                	   	    <font face=Arial size=2>Collateral ID</font>
      	                	         </td>
      	                	         <td width=65% align=left valign=top>
										<select name=jeniscol>
										<?	
											while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
											{
												$a = 0;
												$custjeniscol = $row['cust_jeniscol']; 
												
												if($custjeniscol == "V01")
												{	
													$tsql2 = "SELECT * FROM tbl_COL_Vehicle
															WHERE ap_lisregno='$wfid'";
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
															$array[$a] = $row2['col_id'];
															$a++;
														}
													}
												}
												
												if($custjeniscol == "TAN")
												{	
													$tsql2 = "SELECT * FROM tbl_COL_Land
															WHERE ap_lisregno='$wfid'";
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
															$array[$a] = $row2['col_id'];
															$a++;
														}
													}
												}
												
												if($custjeniscol == "BA1")
												{	
													$tsql2 = "SELECT * FROM tbl_COL_Building
															WHERE ap_lisregno='$wfid'";
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
															$array[$a] = $row2['col_id'];
															$a++;
														}
													}
												}

												
												for($i = 0; $i < count($array); $i++)
												{
										?>
											<option value='<? echo $array[$i];?>'><? echo $array[$i]; ?></option>
										<?
												}
											}
										?>
										
										</select>
      	                	         </td>
      	                	      </tr>
								  <?
										}
								  ?>
      	                      	      <tr>
      	                	 	 <td width=35% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                	 	 <td width=65% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                      	      </tr>
      	                	      <tr>
      	                	         <td width=35% align=left valign=top>
      	                	   	    <font face=Arial size=2>Destination</font>
      	                	         </td>
      	                	         <td width=65% align=left valign=top>
      	                	   	    <input type=text name=where size=40 maxlength=100 value='c:/xampp/htdocs/APRimage'>
      	                	         </td>
      	                	      </tr>
      	                      	      <tr>
      	                	 	 <td width=35% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                	 	 <td width=65% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                      	      </tr>
      	                	      <tr>
      	                	         <td width=35% align=left valign=top>
      	                	   	    <font face=Arial size=2>Document</font>
      	                	         </td>
      	                	         <td width=65% align=left valign=top>
      	                	   	       <select name=filedoc>
      	                	   	       	 <option value=''>--Pilih Satu--</option>
<?

      $tsql = "SELECT * FROM RFCOLLATERAL_DOC";
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
																		   <option value='<? echo $row['DOC_CODE']; ?>'><? echo $row['DOC_CODE']; ?> - <? echo $row['DOC_DESC']; ?></option>
<?
         }
      }
      sqlsrv_free_stmt( $sqlConn );
   
?>
      	                	   	      </select>
      	                	         </td>
      	                	      </tr>
      	                      	      <tr>
      	                	 	 <td width=35% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                	 	 <td width=65% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                      	      </tr>
      	                	      <tr>
      	                	         <td width=35% align=left valign=top>
      	                	   	    &nbsp
      	                	         </td>
      	                	         <td width=65% align=left valign=top>
      	                	   	    <input type=button value='U P L O A D' style="width: 200;" onclick=cekthis()>
      	                	         </td>
      	                	      </tr>
      	                      	      <tr>
      	                	 	 <td width=35% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                	 	 <td width=65% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                      	      </tr>
      	                      	      <tr>
      	                	 	 <td width=35% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                	 	 <td width=65% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                      	      </tr>
      	                	   </table>
      	                	</td>
      	                      </tr>
                            </TABLE>
      		     	   <input type=hidden name=userid value='bhartoyo'>
          	     	   <input type=hidden name=userpwd value='1245'>
          	     	   <input type=hidden name=act value='simpandata'>
                  	</form>
                      </TD>
                    </TR>
                    <TR>
                      <TD class=backW></TD>
                    </TR>
                  </TABLE>
                </TD>
              </TR>
              <TR>
                <TD height=15></TD>
              </TR>
              <TR>
                <TD class=borderB>
                </TD>
              </TR>
              <TR>
                <TD height=15>
                   <table width=100% cellpadding=0 cellspacing=0 border=0>
                      <tr>
                         &nbsp
                      <tr>
                      <tr>
                      </tr>
                   </table>
                </TD>
              </TR>
            </TABLE>
          </TD>
        </TR>
      </TABLE>
     </div>
   </BODY>
</HTML>
<?
   require("../lib/close_con.php");
exit;


?> 
