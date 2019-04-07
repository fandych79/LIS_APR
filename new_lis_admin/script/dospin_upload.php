<?php
    
require ("../lib/open_con.php");
   
 $target = $_POST['where']; 
 $fileformat = $_POST['fileformat']; 
 $jeniscol = $_POST['jeniscol'];
 $wfid = $_POST['wfid'];
 $filedoc = $_POST['filedoc'];
 $targetfilename = $target."/".$_POST['wfid'];
 $targetfiles = $target . "/" .$_POST['wfid'] . "/" . $_POST['filedoc']. "." .$fileformat; 
 $link = "10.11.10.33/APRimage/". $wfid."/". $filedoc. "." .$fileformat;
 $ok=1;
 $uploaded_size = basename( $_FILES['uploaded']['size']) ; 
 $uploaded_type = basename( $_FILES['uploaded']['type']) ; 
 $uploaded_name = basename( $_FILES['uploaded']['name']) ; 
 $uploaded_stored = basename( $_FILES['uploaded']['tmp_name']) ; 

 
 if(file_exists($targetfilename))
 {
	if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $targetfiles)) 
	{
		echo "The file $uploaded_name Type : ". $uploaded_type . " has been uploaded $uploaded_size bytes, temporari file $uploaded_stored stored in $targetfiles";
		$myfiles="$targetfilename/temp.txt";
		$fh = fopen($myfiles, 'a');
		$insert = $_POST['wfid'] . "-" . $_POST['filedoc'] . "." . $fileformat. "\n";
		fwrite($fh, $insert);
		fclose($fh);
		
		$tsql = "INSERT INTO Tbl_Col_Picture (ap_lisregno, col_id, pic_link, pic_desc) VALUES ('$wfid', '$jeniscol', '$link', '$filedoc')";
		
		$sqlConn = sqlsrv_query($conn, $tsql);
		if ( $sqlConn === false)
		die( FormatErrors( sqlsrv_errors() ) );
	} 
	else 
	{
		echo "Sorry, there was a problem uploading your file.";
	}
 }
 else
 {
	mkdir($targetfilename);
	chmod($targetfilename, 0777);
	if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $targetfiles)) 
	{
		echo "The file $uploaded_name Type : ". $uploaded_type . " has been uploaded $uploaded_size bytes, temporari file $uploaded_stored stored in $targetfiles";
		$myfiles="$targetfilename/temp.txt";
		$fh = fopen($myfiles, 'a');
		$insert = $_POST['wfid'] . "-" . $_POST['filedoc'] . "." . $fileformat. "\n";
		fwrite($fh, $insert);
		fclose($fh);
		
		$tsql = "INSERT INTO Tbl_Col_Picture (ap_lisregno, col_id, pic_link, pic_desc) VALUES ('$wfid', '$jeniscol', '$link', '$filedoc')";
		
		$sqlConn = sqlsrv_query($conn, $tsql);
		if ( $sqlConn === false)
		die( FormatErrors( sqlsrv_errors() ) );
	} 
	else 
	{
		echo "Sorry, there was a problem uploading your file.";
	}
 }
 
 require("../lib/close_con.php");
?> 
