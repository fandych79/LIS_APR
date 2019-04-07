<?php
   $custnomid=$_GET['custnomid'];

    
require ("../lib/open_con.php");
   
	//update flag dari R ke D
	$tsql = "UPDATE Tbl_CustomerFlag SET custflagapr = 'D' WHERE custnomid = '$custnomid'and custflagapr = 'R'";

	$a = sqlsrv_query($conn, $tsql);
	
echo "Sukses Approve";
  
?>