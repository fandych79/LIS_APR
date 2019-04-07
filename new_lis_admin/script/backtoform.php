<?php

  $form=$_REQUEST['form'];
  $userid=$_REQUEST['userid'];
  $userpwd=$_REQUEST['userpwd'];
  $targetprgcode=$_REQUEST['targetprgcode'];
  $targetgrpcode=$_REQUEST['targetgrpcode'];
  $targetprgact=$_REQUEST['targetprgact'];
  
  $targetproccode = "";
  if (isset($_REQUEST['targetproccode']))
  {
     $targetproccode=$_REQUEST['targetproccode'];
  }
if($form=="signin.php"){
	$err=$_REQUEST['err'];
}

  include ("bin/lib/formatError.php");
  require ("bin/lib/open_con.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Expired" CONTENT="0">
<meta http-equiv="Cache-Control" CONTENT="no-Cache">
<meta http-equiv="Pragma" CONTENT="no-Cache">
<title>CTS BII</title>
<script language="JavaScript"><!--
name = 'utama';
//--></script>
    <Script type="text/javascript">
    	function runappl()
    	{
		      document.formsubmit.action = "./<? echo $form ?>";
				document.formsubmit.submit();
    	}
    </script> 
</head>
<body link="blue" alink="blue" vlink="blue" onload=runappl()>
    <div align=center>
    <form name=formsubmit id="formsubmit" class="niceform" method=post>
    <input type=hidden name=userid value='<? echo $userid; ?>'>
    <input type=hidden name=userpwd value='<? echo $userpwd; ?>'>
    <input type=hidden name=userprgcode>
    <input type=hidden name=targetprgcode value='<? echo $targetprgcode; ?>'>
    <input type=hidden name=targetprgact value='<? echo $targetprgact; ?>'>
    <input type=hidden name=targetgrpcode value='<? echo $targetgrpcode; ?>'>
    <input type=hidden name=targetproccode value='<? echo $targetproccode; ?>'>
    <input type=hidden name=act>
    <input type=hidden name=arr value='<? echo $err;?>'>
    </form>
</body>
</html>

<?
  require ("bin/lib/close_con.php");
exit;
?>