<?php



   MAIN();

function MAIN()
{
  $noaplikasi=$_POST['noaplikasi'];
  $namacust=$_POST['namacust'];

   $ourFileName = "c:/temp/sppk.ps";
   $ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");

   $file = "c:/temp/aac.prn";
   $f = fopen($file, "r");
   $urut = 0;
   while ( $line = fgets($f, 1000) )
   {
   	  $urut++;
   	  $bisacetak = 0;
   	  if ($urut == 12 && $noaplikasi != "")
   	  {
   	  	$bisacetak = 1;
   	  	$varbud = " .0 setgray /Arial-BoldMT findfont 10 scalefont setfont 300 720 moveto (Nomor : " . $noaplikasi . ") show\n";
         fwrite($ourFileHandle,$varbud);
   	  }
   	  if ($urut == 24 && $namacust != "")
   	  {
   	  	$bisacetak = 1;
   	  	$varbud = " .0 setgray /Arial-MT findfont 12 scalefont setfont 50 565 moveto (2	 " . $namacust . ") show\n";
         fwrite($ourFileHandle,$varbud);
   	  }
   	  if ($bisacetak < 1)
   	  {
         fwrite($ourFileHandle,$line);
      }
   }

   $file = "c:/temp/aa.prn";
   $f = fopen($file, "r");
   while ( $line = fgets($f, 1000) )
   {
      fwrite($ourFileHandle,$line);
   }
   fclose($ourFileHandle);


  $varsystem = "d:/spinform/conf/fonts/gswin32c.exe -Id:/spinform/conf/fonts/ -dBATCH  -q -dNOPAUSE -sDEVICE=pdfwrite -sOwnerPassword=BudiGILA -sOutputFile=c:/xampp/htdocs/sppk.pdf c:/temp/sppk.ps";
  system($varsystem);
?>
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>LIS PARAM</title>
      <LINK media=screen href="/lismega_devel/style/menu.css" rel=stylesheet>
      <Script language="Javascript">
      </Script>
   </head>
   <body>
<script language="JavaScript"><!--
name = 'lainnya';
//--></script>
   	   <div align=center>
   	   	   <A HREF='/sppk.pdf'><font color=black size=3>Download : SPPK</font></A>
   	   </div>
   </body>
</html>
<?
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
