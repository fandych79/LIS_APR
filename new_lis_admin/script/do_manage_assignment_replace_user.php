<?
session_start();
require ("../lib/formaterror.php");
require ("../lib/open_con.php");


$userFrom = $_REQUEST['hid_userfrom'];
$userReplace = $_REQUEST['in_userreplace'];
$userReason = $_REQUEST['in_textReason'];

$user_system = $_SESSION['nai_userid'];

//echo $userFrom;
//echo "<br>";
//echo $userReplace;
//echo "<br>";
//echo $userReason;

//INSERT
$tsql = "insert into tbl_assignment_history_log
(assignment_admin,assignment_date,assignment_description,assignment_type,assignment_apps,assignment_from,assignment_replace,assignment_reason,assignment_status,flag) 
values 
('$user_system',getdate(),'DESCRIPTION','USER','NOAPPS','$userFrom','$userReplace','$userReason','A','0')";
$params = array(&$_POST['query']);
$stmt = sqlsrv_prepare( $conn, $tsql, $params);
if( $stmt )
{
} 
else
{
	echo "Error in preparing statement.\n";
	die( print_r( sqlsrv_errors(), true));
}

if( sqlsrv_execute( $stmt))
{
}
else
{
	echo "Error in executing statement.\n";
	die( print_r( sqlsrv_errors(), true));
}
sqlsrv_free_stmt( $stmt);


header("location:manage_assignment.php");

?>