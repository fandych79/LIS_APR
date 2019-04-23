<form name="form_officer_sign" method="POST" action="appraisal_sign.php">
<div align="center">
<table border="1" style="background-color:WHITE;" >
<tr>
	<td valign="top" colspan="2" width="100%" align="center">
		<?
			$off = "";
			$total_sign = 0;
			$strsqlv02="SELECT * FROM appraisal_officer where custnom_id = '$custnomid' order by seq";
			$sqlconv02 = sqlsrv_query($conn, $strsqlv02);
			if ( $sqlconv02 === false)die( FormatErrors( sqlsrv_errors() ) );
			if(sqlsrv_has_rows($sqlconv02))
			{
				$x=1;
				while($rowsv02 = sqlsrv_fetch_array($sqlconv02, SQLSRV_FETCH_ASSOC))
				{
					$off = $rowsv02['officer_id'];
					$flag = $rowsv02['flag'];
		?>
				<div style="float:left;width:295px;height:120px;">
					</br>
					Officer <?=$x;?>
		<?php
					//$strsqlv01="SELECT * FROM appraisal_paramofficer where _appraiser_id = '$off'";
					$strsqlv01="SELECT user_id,user_name FROM tbl_se_user where user_id = '$off'";
					//echo $strsqlv01;
					$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
					if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
					if(sqlsrv_has_rows($sqlconv01))
					{
						while($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
						{
							$id = $rowsv01['user_id'];
							$name = $rowsv01['user_name'];
																			
							$jvs = "javascript:officer_sign('".$custnomid."')";
							$jvs2 = "javascript:officer_unsign('".$custnomid."')";
							
							if($flag == "")
							{
								if($off!="" && strtoupper($off) == strtoupper($userid))
								{
								echo "</br>";
									echo '<input type="button" name="sign" id="sign" class="buttonsaveflow" onClick="'.$jvs.'" style="width:50%;" value="SIGN" />';
									echo '<br><br>';
									echo '<input type="button" name="unsign" id="unsign" onClick="'.$jvs2.'" style="width:50%;" value="NOT SIGN - ROLLBACK" />';
								echo "</br><br>";
								}else{
								echo "</br></br></br>";
									echo '<font style="color:red;font-weight:bold;">NOT SIGNED</font>';
								echo "</br></br></br>";
								}
							}else if($flag == "S"){
							  echo "</br></br></br>";
								echo '<font style="color:green;font-weight:bold;">SIGNED</font>';
							  echo "</br></br></br>";
							  $total_sign ++;
							}
							
							
							echo "<font style='font-weight:bold;'>".$name."</font>";
						}
					}
		?>
				</div>
		<?
				$x++;
				}
			}
		?>
	</td>
</tr>
</table>
<input type="hidden" id="offiger_sign_stat" name="offiger_sign_stat" value ="">
<input type="hidden" id="officer_custnomid" name="officer_custnomid" value ="">

<?
require ("../../requirepage/hiddenfield.php");
?>

<script type="text/javascript">
	function changeform(theid)
	{
		document.frm.theid.value = theid;
		document.frm.action = "./view_custappraisal.php";
		document.frm.submit();
	}
	
	function officer_sign(thecolid)
	{
		submitform = window.confirm("Setuju ? " + thecolid);

		if (submitform == true)
		{	
			document.getElementById("offiger_sign_stat").value = "SIGN";
			document.getElementById("officer_custnomid").value = thecolid;
			document.form_officer_sign.action = "./appraisal_sign.php";
			document.form_officer_sign.submit();
		}
		else
		{
			return false;
		}
	}
	
	function officer_unsign(thecolid)
	{
		submitform = window.confirm("Tidak Setuju ?")
		if (submitform == true)
		{
			document.getElementById("offiger_sign_stat").value = "UNSIGN";
			document.getElementById("officer_custnomid").value = thecolid;
			document.form_officer_sign.action = "./appraisal_sign.php";
			document.form_officer_sign.submit();
		}
		else
		{
			return false;
		}
	}  
</script>
</div>
</form>