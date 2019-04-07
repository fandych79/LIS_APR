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
  $fromemailaddr=$_POST['fromemailaddr'];
  $toemailaddr=$_POST['toemailaddr'];

    
require ("../lib/open_con.php");

   $ourFileName = "c:/temp/PushEmail/" . "listemplate.tmp";
   $ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
   $line = "varfrom" . chr(9) . 	"$fromemailaddr" . chr(9) . "\n";
   fwrite($ourFileHandle,$line);
   $line = "varname" . chr(9) . 	"LIS Bank Mega" . chr(9) . "\n";
   fwrite($ourFileHandle,$line);
   $line = "varreturn" . chr(9) . 	"ebilling@bankmega.com" . chr(9) . "\n";
   fwrite($ourFileHandle,$line);
   $line = "varcustname" . chr(9) . 	"$toemailaddr" . chr(9) . "\n";
   fwrite($ourFileHandle,$line);
   $line = "varto" . chr(9) . 	"$toemailaddr" . chr(9) . "\n";
   fwrite($ourFileHandle,$line);
   $line = "varsubject" . chr(9) . 	"Order Notaris Periode November 2011" . chr(9) . "\n";
   fwrite($ourFileHandle,$line);
   $line = "varfile" . chr(9) . 	"EBS4201910101234567.pdf" . chr(9) . "\n";
   fwrite($ourFileHandle,$line);
   $line = "varattachname" . chr(9) . 	"EBS4201910101234567.pdf" . chr(9) . "\n";
   fwrite($ourFileHandle,$line);
   $line = "varsmtp" . chr(9) . 	"10.14.1.10" . chr(9) . "\n";
   fwrite($ourFileHandle,$line);
   $line = "varauth" . chr(9) . 	"SMTPAUTHNONE" . chr(9) . "\n";
   fwrite($ourFileHandle,$line);
   $line = "varuserid" . chr(9) . 	"" . chr(9) . "\n";
   fwrite($ourFileHandle,$line);
   $line = "varpassword" . chr(9) . 	"" . chr(9) . "\n";
   fwrite($ourFileHandle,$line);
   $line = "varmethod" . chr(9) . 	"simple" . chr(9) . "\n";
   fwrite($ourFileHandle,$line);
   $line = "vartemplate" . chr(9) . 	"lismega.html" . chr(9) . "\n";
   fwrite($ourFileHandle,$line);
   fclose($ourFileHandle);
   $varsystem = "c:/temp/PushEmail/runlis.bat";
   echo exec($varsystem);

?>
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml">
   <head>
   </head>
   <body style="background:url(../images/Background%20Mega.png) no-repeat center;">
   	DOCUMENT ALREADY SENT TO <? echo $toemailaddr; ?>
   </body>
</html>
<?
   require("../lib/close_con.php");
exit;
}




?> 
