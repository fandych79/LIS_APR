<?php
$ipdm=$_SERVER['SERVER_ADDR'];
  $line = "db_filling,root,,localhost,,2,3,eschool,";
  $arrdatalines = explode(",",$line);
	$namadb = $arrdatalines[0];
	$userdb = $arrdatalines[1];
	$passdb = $arrdatalines[2];

  mysql_connect("localhost", "$userdb", "$passdb")or die("cannot connect");
  mysql_select_db("$namadb")or die("cannot select DB $namadb");



?>
