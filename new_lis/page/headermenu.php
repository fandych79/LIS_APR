<!--	
	<div class="panel panel-default" style="margin-bottom:0px;">
	  <div class="panel-body" style="position:fixed;">
		<img src="http://127.0.0.1/lis/new_lis/images/header_lis2.jpg" style="width:100%;"></img>
	  </div>
	</div>
	<div class="container" style="padding-left:0px;margin-top:6%;">
		<div class="panel panel-default" style="float:left;width:20%;height:87%;position:fixed;">
			<div class="panel-body">
				<ul class="nav nav-pills nav-stacked" style="width:100%;height:20px;margin-top:30px;">

				</ul>
			</div>
			<img src="http://127.0.0.1/lis/new_lis/images/gimmick_logo.png" style="position:absolute;bottom:0;width:60%;margin-left:20%;margin-right:20%;"></img>
		</div>-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<script src="../js/menu_ce.js" type="text/javascript"></script>
		<link href="../css/menu_ce.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div id="cssmenu">
			<ul>
<?
	$d = date("d");
	$m = date("m");
	$y = date("y");
	$h = date("h");
	$i = date("i");
	$s = date("s");
	$randomtime = $h.$i.$s;
	
	$tsql2 = "select * from Tbl_SE_User U LEFT JOIN Tbl_Branch B ON U.user_branch_code = B.branch_code where user_id='$userid'";
	$cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	$params2 = array(&$_POST['query']);
	//echo $tsql2;
	$sqlConn2 = sqlsrv_query($conn, $tsql2, $params2, $cursorType2);
	if ( $sqlConn2 === false)
	die( FormatErrors( sqlsrv_errors() ) );

	if(sqlsrv_has_rows($sqlConn2))
	{
		$rowCount2 = sqlsrv_num_rows($sqlConn2);
		if( $row2 = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_NUMERIC))
		{
			$userbranch = $row2[7];
			$userpwd = $row2[9];
			$userregion = $row2[21];
		}
	}
			
	$tsql = "select Tbl_SE_GrpProgram.grp_code, Tbl_SE_GrpProgram.grp_name from Tbl_SE_GrpProgram, Tbl_SE_Program, Tbl_SE_UserProgram
				where Tbl_SE_UserProgram.program_code=Tbl_SE_Program.program_code
				AND Tbl_SE_Program.program_group=Tbl_SE_GrpProgram.grp_code
				AND Tbl_SE_UserProgram.user_id='$userid'
				GROUP BY Tbl_SE_GrpProgram.grp_code,Tbl_SE_GrpProgram.grp_name, Tbl_SE_GrpProgram.grp_urut
				ORDER BY Tbl_SE_GrpProgram.grp_urut,Tbl_SE_GrpProgram.grp_name";
	  $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	  $params = array(&$_POST['query']);

	  $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
	  if ( $sqlConn === false)
	  die( FormatErrors( sqlsrv_errors() ) );
	  if(sqlsrv_has_rows($sqlConn))
	  {
		 $rowCount = sqlsrv_num_rows($sqlConn);
		 while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
		 {
			$tsql2 = "SELECT Tbl_SE_Program.program_code,
						Tbl_SE_Program.program_name,Tbl_SE_Program.program_desc
						FROM Tbl_SE_Program, Tbl_SE_UserProgram
						WHERE Tbl_SE_UserProgram.program_code = Tbl_SE_Program.program_code
						AND Tbl_SE_UserProgram.user_id='$userid'
						AND Tbl_SE_Program.program_group='$row[0]'
						ORDER BY program_urut";
						//echo $tsql2;
			  $cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
			  $params2 = array(&$_POST['query']);

			  $sqlConn2 = sqlsrv_query($conn, $tsql2, $params2, $cursorType2);
			  if ( $sqlConn2 === false)
			  die( FormatErrors( sqlsrv_errors() ) );
			  if(sqlsrv_has_rows($sqlConn2))
			  {
				 $rowCount2 = sqlsrv_num_rows($sqlConn2);
				 
				 if($row['0']=="$programgcd"){
					 echo "<li class='selected'>";
					 echo "<a href='#'><span>".$row['1']."</span></a>";
				 }else{
					 echo "<li>";
					 echo "<a href='#'><span>".$row['1']."</span></a>";
				 }
				 
				 if($rowCount2 > '15')
				 {
					echo "<ul style='overflow-x:hidden;overflow-y:scroll;white-space:nowrap;height:150px;'>";
				 }else{
					echo "<ul>";
				 }
				 
				 while( $row2 = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_NUMERIC))
				 {
					if($row2[2]=="$programname" && $row2[0]=="$programcd")
					{
						echo "<li class='sub_selected'><a href='./".$row2[2].".php?r=".$randomtime."&userid=".$userid."&userpwd=".$userpwd."&userbranch=".$userbranch."&userregion=".$userregion."&userwfid=".$row2[0]."'>".$row2[1]."</a></li>";
					}else{
						echo "<li><a href='./".$row2[2].".php?r=".$randomtime."&userid=".$userid."&userpwd=".$userpwd."&userbranch=".$userbranch."&userregion=".$userregion."&userwfid=".$row2[0]."'>".$row2[1]."</a></li>";
					}
				 }
			  }
			  sqlsrv_free_stmt( $sqlConn2 );
				 echo "</ul>";
				 echo "</li>";
		 }
	  }
	  sqlsrv_free_stmt( $sqlConn );
?>
			</ul>
		</div>
	</body>
</html>