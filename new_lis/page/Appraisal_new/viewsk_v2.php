<div align=center>
		<TABLE cellPadding=5 width="700" border=1>
			<TR>
				<TD align=left valign=top>
					<TABLE WIDTH=90% CELLPADDING=1 CELLSPACING=1 border=0 align="center">                  	   	
   	                    <tr>
   	                       <td width=100% align=center valign=top>
   	                          <font face=Arial size=2><b>SURAT KETERANGAN</b></font>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=100% align=center valign=top>
   	                         &nbsp;
   	                       </td>
   	                    </tr>
                  	 </TABLE>
                  	 <TABLE WIDTH=90% CELLPADDING=1 CELLSPACING=1 border=0 align="center">   
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Collateral ID &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          : <? echo $col_id; ?>
   	                       </td>
   	                    </tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
<?
				   $tsql = "SELECT * FROM Tbl_COL_SK WHERE custnomid = '$ap_lisregno'";
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
   	                    <tr>
   	                       <td width=40% align=left valign=top>
							  Type : <? echo $row[3]; ?>
   	                       </td>
   	                       <td width=60% align=left valign=top>
   	                          No. : <? echo $row[4]; ?>
   	                       </td>
						   <input type=hidden id="_skcode[<?php echo $x?>]" name="_skcode[<?php echo $x?>]" size=20 maxlength=45 value='<? echo $row[0]; ?>' style="background:#FF0">
   	                    </tr>
<?
						$x++;
					  }
				   }
				   sqlsrv_free_stmt( $sqlConn );
?>					 
						   <input type=hidden id="sk_custnomid" name="sk_custnomid" size=20 maxlength=45 value='<? echo $ap_lisregno; ?>' style="background:#FF0">
   	                </TABLE>
                  	 <BR>
				
				</TD>
			</TR>
		</TABLE>
     </div>