<?php
require_once ("lib/formatError.php");
require_once ("lib/open_con.php");

$userid=$_POST['userid'];
$userpwd=$_POST['userpwd'];

//$userid="admin";
//$userpwd="nicccniccc";

if(substr($userid,1-1,5) != "admin")
{
   header("location:restricted.php");
}

$tsql = "SELECT COUNT(*) FROM Tbl_SE_User WHERE user_id='$userid' AND user_pwd='$userpwd'";
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);
$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);

if($sqlConn === false)
{
die(FormatErrors(sqlsrv_errors()));
}

if(sqlsrv_has_rows($sqlConn))
{
	$rowCount = sqlsrv_num_rows($sqlConn);
	while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
	{
		$thecount = $row[0];
	}
}
sqlsrv_free_stmt( $sqlConn );

if($thecount == "0")
{
	echo "User ID / Password Salah";
	exit;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Workflow Menu V2.0[Beta]</title>
<link rel="stylesheet" href="style/jquery.treeview.css">
<link rel="stylesheet" href="style/screen.css">
<link rel="stylesheet" type="text/css" href="style/d.css" />
<script src='./script/javabits.js' language='Javascript'></script>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.cookie.js" type="text/javascript"></script>
<script src="js/jquery.treeview.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$("#tree").treeview({
		collapsed: true,
		animated: "fast",
		control:"#sidetreecontrol",
		prerendered: true,
		persist: "location"
	});
})
</script>
</head>

<body>
<div id="main">
<form name="formsec" method="post">
    <div id="sidetree">
    
    
<table align="center" width="960" border="0" style="">
<tr style="margin-bottom:px;">
<td align="center"><img src="./images/Header Mega (L).png" width=100% width=100%></td>
</tr>
</table>
<br/>
<table width="960" border="0" align="center">
<tr>
<td width=60% align=left valign=top>
<div id="tit_menu">Menu Admin</div>
</td>
<td width=20% align=right valign=top>
<div id="tit_menu"><A HREF="javascript:chgpwd()">Change Password</A></div>
</td>
<td width=20% align=right valign=top>
<div id="tit_menu"><A HREF=./index.php>Logout</A></div>
</td>
</tr>
</table>
    
<table align="center" width="960" border="0" style="">  
<tr style="margin-bottom:px;">
<td>  
    <div class="treeheader">&nbsp;</div>
    <div id="sidetreecontrol"><a href="">Collapse All</a> | <a href="">Expand All</a></div>
    <br />
        <ul class="treeview" id="tree">
        
        <?
		// SELECT GROUP
		
		$tsql = "select * from tbl_programgroupadmin order by group_seq ASC";
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
				$groupCode = $row['group_code'];
				?>
                <li class="expandable"><div class="hitarea expandable-hitarea"></div><span title="<? echo $row['group_description'];?>" class=""><? echo $row['group_name'];?></span>
                    <ul style="display: none;">
						<?
                        // SELECT CHILD
                        
						if ($userid == "admin")
   						{
                        	$tsql_child = "select * from tbl_programadmin where group_code = '$groupCode'";
						}
						else
						{
							$tsql_child = "SELECT Tbl_ProgramAdmin.programcode,Tbl_ProgramAdmin.programname,Tbl_ProgramAdmin.programact ,Tbl_ProgramAdmin.group_code
							FROM Tbl_ProgramAdmin, Tbl_SE_AdminProgram
							WHERE Tbl_ProgramAdmin.group_code = '$groupCode' and Tbl_ProgramAdmin.programcode=Tbl_SE_AdminProgram.program_code
							AND Tbl_SE_AdminProgram.user_id='$userid'";

						}						
						
                        $cursorType_child = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
                        $params_child = array(&$_POST['query']);
                        
                        $sqlConn_child = sqlsrv_query($conn, $tsql_child, $params_child, $cursorType_child);
                        
                        if ( $sqlConn_child === false)
                        die( FormatErrors( sqlsrv_errors() ) );
                        
						$rowCount_child = 0;
						
                        if(sqlsrv_has_rows($sqlConn_child))
                        {
							$rowCount_child = sqlsrv_num_rows($sqlConn_child);
							while( $row_child = sqlsrv_fetch_array( $sqlConn_child, SQLSRV_FETCH_ASSOC))
							{
								$programact = str_replace("<q>","'",$row_child['programact']);
								?>
								<li><a href="<? echo $programact;?>" title="<? echo $row_child['programname']?>" ><? echo $row_child['programname']?></a></li>
                                <?
							}							
                        }
							//echo $rowCount_child;
							
							if($rowCount_child == 0)
							{
								?>
								<li>Not Available</li>
                                <?
							}
							
                        sqlsrv_free_stmt( $sqlConn_child );
                        ?>
                        
                    </ul>
                </li>
                <?
			}
		}
		sqlsrv_free_stmt( $sqlConn );
		?>
        </ul>
</td>
</tr>
</table>  
<br /> 
<br /> 
<br />     
    </div>
<input type="hidden" name="userid" value="<? echo $userid; ?>"/>
<input type="hidden" name="userpwd" value="<? echo $userpwd; ?>"/>
</form>
</div>
<div id="footer" align="center">
© Copyright SPIN Technology 2011 - <? echo Date('Y') ?>, All Right Reserved
</div>
<br /> 
<br /> 
</body>
</html>
<?
require_once ("lib/close_con.php");
?>