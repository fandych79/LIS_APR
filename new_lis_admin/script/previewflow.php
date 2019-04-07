<?php

   require ("../lib/open_con.php");

?>
<HTML>
   <HEAD>
      <TITLE>PREVIEW FLOW</TITLE>
   </HEAD>
   <BODY>
   	 <table width=1050 cellpadding=0 cellspacing=0 border=0 bgcolor=#EEDD77>
   	 	  <tr>
   	 	  	<td width=100% align=left valign=top>
   	 	  		 <table width=100% cellpadding=0 cellspacing=0 border=0>
   	 	  		 	   <tr>
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
      $oldwfurut = "";
      $hitparalel = "";
      while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
      {
      	if ($oldwfurut != $row[2])
      	{
      		if ($oldwfurut != "")
      		{
?>
   	 	  		           </table>
   	 	  		 	   	  </td>
   	 	  		 	   	  <td width=1% align=center valign=top>
   	 	  		 	   	  	&nbsp
   	 	  		 	   	  </td>
<?
      		}
      		$oldwfurut = $row[2];
?>
   	 	  		 	   	  <td width=4% align=center valign=middle>
   	 	  		           <table width=100% cellpadding=0 cellspacing=0 border=1 bordercolor="#000000" bordercolorlight="#000000" bordercolordark="#FFFFFF">
<?
      	}
?>
   	 	  		           	  <tr>
   	 	  		           	  	  <td width=100% align=center valign=top>
   	 	  		           	  	  	<font face=Arial size=2><? echo $row[0] ?></font>
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
   	 	  	</td>
   	 	  </tr>
   	</table>
   </BODY>
</HTML>
<?
exit;