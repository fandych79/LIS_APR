<?php
require("sqlsrv.security.php");
ob_start();
session_start();

$db_security = new DB_SECURITY();
$db_security->connect();

if(isset($_REQUEST['username']) && isset($_REQUEST['password']))
{
	$user = $_REQUEST['username'];
	$pass = md5($_REQUEST['password']);

	$sql = "SELECT * FROM se_user u
	JOIN branch b ON u.user_branch_code = b.branch_code
    WHERE LOWER(u.user_id) = '$user' AND user_pwd = '$pass'
    ";
	$db_security->executeQuery($sql);
	$login = $db_security->lastResults;

	$branch = $login[0]['user_branch_code'];
	$region = $login[0]['branch_region_code'];
	$valid_user = $login[0]['user_id'];

    //print_r($login);exit();

	if($login[0]['user_id'])
	{
		$_SESSION['90272dda245ae1fb3cf197e91a8689dc'] = time();
		$_SESSION['e8701ad48ba05a91604e480dd60899a3'] = $valid_user;
		$_SESSION['3feb759615ff626be3c1e36521f2df28'] = $branch;
		$_SESSION['36a449e73c5d9e5e32437c8b4d65c361'] = $region;
		$_SESSION['20b5ef967d3a4e8b21c2d5659cbcb144'] = $pass;
		$_SESSION['e91e6348157868de9dd8b25c81aebfb9'] = md5($user."|".$pass."|".$branch."|".$region);

		header("location:./new_lis/page/home.php?userid=$valid_user");
	}
	else
	{
		header("location:index.php?errmsg=login%20failed");
	}

}
else
{
	header("location:index.php?errmsg=login%20failed");
}
?>
