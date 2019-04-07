<?php
require ("../lib/formaterror.php");
require ("../lib/open_con.php");
$userid = $_REQUEST['userid'];

//GET INFORMATION FORM THIS USER
$tsql = "select * from tbl_se_user where user_id = '$userid'";
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
		$userName = $row['user_name'];
		$userBranchCode = $row['user_branch_code'];
		$userLevel = $row['user_level_code'];
		$userAOCode = $row['user_ao_code'];
	}
}
sqlsrv_free_stmt( $sqlConn );


// SELECT PARAM USER LEVEL
$tsql = "select * from tbl_se_level";
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
		$paramUserLevel[$row['level_code']] = $row['level_name'];
	}
}
sqlsrv_free_stmt( $sqlConn );

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Replace User <? echo $userid;?></title>
</head>

<body>
<div id="main" align="center">
<div id="header">
<table align="center" width="960" border="0" style="">
<tr style="margin-bottom:px;">
<td align="center"><img src="../images/Header Mega (L).png" width=100%></td>
</tr>
</table>
</div>

<div id="workarea" align="center">

<form id="formsubmit" name="formsubmit" method="post" action="do_manage_assignment_replace_user.php">
<table width="960" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="5%" scope="col"><a href="javascript:history.back()">Back</a></th>
    <th width="5%" scope="col">&nbsp;</th>
    <th width="80%" scope="col">REPLACE USER <font color="#0066FF"><? echo $userid;?></font> ASSIGNMENT</th>
    <th width="5%" scope="col">&nbsp;</th>
    <th width="5%" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
    
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <th scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>User ID : <font color="#0066FF"> <? echo $userid;?> - <? echo $userName;?> - <? echo $paramUserLevel[$userLevel];?> </font></td>
            <td><input type="hidden" id="hid_userfrom" name="hid_userfrom" value="<? echo $userid;?>">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>Replace With :
            <select id="in_userreplace" name="in_userreplace">
            <option selected="selected" value="">- select user -</option>
            <?
            // SELECT ASSOC

            $tsql = "select user_id,user_name from tbl_se_user where user_id <> '$userid' and user_branch_code = '$userBranchCode' and user_level_code = '$userLevel'";
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
                    <option value="<? echo $row['user_id'];?>"><? echo $row['user_id']." - ".$row['user_name'];?></option>
                    <?
                }
            }
            sqlsrv_free_stmt( $sqlConn );
			
			?>
            </select>
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>Reason : <textarea id="in_textReason" name="in_textReason" cols="100" rows="5"></textarea></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align="center"><input type="submit" id="submitButton" name="submitButton" value="Submit"></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          
        </table>

    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>

</div>

</div>

</body>
</html>