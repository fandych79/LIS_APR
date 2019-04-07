<?
	require ("../../lib/open_con.php");
	require ("../../lib/formatError.php");
	require ("../../requirepage/parameter.php");
	
	if($custnomid != "")
	{
		
	}
?>
<html>
	<head>
		<title>Appraisal</title>
		<link rel="stylesheet" href="../../bin/css/css-bj.css" type="text/css" />
		<link rel="shortcut icon" href="../../bin/img/favicon.png" type="image/x-icon">
		<link href="../../bin/css/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css">
		<script src="../../bin/css/SpryMenuBar.js" type="text/javascript"></script>
		
		<script type="text/javascript" src="../../bin/bootstrap/dist/js/jquery-1.11.3.js" ></script>
		<script type="text/javascript" src="../../bin/bootstrap/dist/js/bootstrap.min.js" ></script>
		
		<script type="text/javascript" src="../../bin/js/datatable.js"></script>
		<script type="text/javascript" src="../../bin/js/bootstraptable.js"></script>
		<script type="text/javascript" src="../../bin/js/bootstrap-datepicker.min.js"></script>
		
		<link href="../../bin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../../bin/bootstrap/dist/css/bootstrap-datepicker.min.css"></link>
		<link rel="stylesheet" href="../../bin/bootstrap/dist/css/bootstrap-datepicker3.min.css"></link>
		
		<script language="javascript" type="text/javascript" src="../../bin/javascript/niceforms.js"></script>
		<link href="../../bin/css/table.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" media="screen" href="../../bin/css/styles_idr.css" >
		<script type="text/javascript">
			$(document).ready(function() {
					$('#example').DataTable();
					$('.tanggal').datepicker({format: 'yyyy-mm-dd',todayBtn: "linked"});
					$(".tanggal").keydown(function(e){
						e.preventDefault();
					});
				} );
		

			function checktype(){
				var arr= $("#collateral_id").val().split(" - ");
				var ap_lisregno= $("#custnomid").val();
				var desc = $("#deskripsi").val();
				
				var a="pbb";
				if(arr[1]!="V01" && desc=="PBB"){
					$.ajax({
						type: "GET",
						url: "ajax.php",
						data: "a="+a+"&col_id="+arr[0]+"&ap_lisregno="+ap_lisregno+"&random="+ <?php echo time(); ?> +"",
						success: function(response)
						{	//alert(response);
							var pecahString = response.split("|");
							
							$("#amount1").val(tandaPemisahTitik(pecahString[1]));
							$("#amount1_unit").val("Global");
							$("#amount2").val(tandaPemisahTitik(pecahString[3]));
							$("#amount2_unit").val("Global");
						}
					});
				}
				else{
						$("#amount1").val("0");
						$("#amount1_unit").val("");
						$("#amount2").val("0");
						$("#amount2_unit").val("");
					}
			}
			
			function check1(){
				var arr= $("#collateral_id").val().split(" - ");
				var ap_lisregno= $("#custnomid").val();
				var desc = $("#deskripsi").val();
				var unit = $("#amount1_unit").val();
				
				if(arr.length>1)
				{
					var a="pbb";
					if(arr[1]!="V01" && desc=="PBB"){
						$.ajax({
							type: "GET",
							url: "ajax.php",
							data: "a="+a+"&col_id="+arr[0]+"&ap_lisregno="+ap_lisregno+"&random="+ <?php echo time(); ?> +"",
							success: function(response)
							{	//alert(response);
								var pecahString = response.split("|");
								
								if(unit =="Per Meter")
								{
									$("#amount1").val(tandaPemisahTitik(pecahString[0]));
									$("#amount1_unit").val("Per Meter");
								}
								else
								{
									$("#amount1").val(tandaPemisahTitik(pecahString[1]));
									$("#amount1_unit").val("Global");
								}
							}
						});
					}
				}
			}
			
			function check2(){
				var arr= $("#collateral_id").val().split(" - ");
				var ap_lisregno= $("#custnomid").val();
				var desc = $("#deskripsi").val();
				var unit = $("#amount2_unit").val();
				
				if(arr.length > 1){
					var a="pbb";
					if(arr[1]!="V01" && desc=="PBB"){
						$.ajax({
							type: "GET",
							url: "ajax.php",
							data: "a="+a+"&col_id="+arr[0]+"&ap_lisregno="+ap_lisregno+"&random="+ <?php echo time(); ?> +"",
							success: function(response)
							{	//alert(response);
								var pecahString = response.split("|");
								
								if(unit =="Per Meter")
								{
									$("#amount2").val(tandaPemisahTitik(pecahString[2]));
									$("#amount2_unit").val("Per Meter");
								}
								else
								{
									$("#amount2").val(tandaPemisahTitik(pecahString[3]));
									$("#amount2_unit").val("Global");
								}
							}
						});
					}
				}
			}
			
			function tandaPemisahTitik(b){
				var _minus = false;
				if (b<0) _minus = true;
				b = b.toString();
				b=b.replace(",","");
				b=b.replace("-","");
				c = "";
				panjang = b.length;
				j = 0;
				for (i = panjang; i > 0; i--){
					 j = j + 1;
					 if (((j % 3) == 1) && (j != 1)){
					   c = b.substr(i-1,1) + "," + c;
					 } else {
					   c = b.substr(i-1,1) + c;
					 }
				}
				if (_minus) c = "-" + c ;
				return c;
			}
		</script>
		
		<script type="text/javascript" src="../../js/full_function.js" ></script>
		<script type="text/javascript" src="../../js/accounting.js" ></script>
		<script type="text/javascript" src="../../js/my.js" ></script>
	</head>
<body>
<div id="page"> 
<?php

	$jeniscol = isset($_REQUEST['jeniscol']) ? $_REQUEST['jeniscol'] : "";
	$col_id = isset($_REQUEST['col_id']) ? $_REQUEST['col_id'] : "";
	

	if(isset($_REQUEST['id'])){
		$id = $_REQUEST['id'];
	}else{
		$id = "";
	}
	
	if(isset($_REQUEST['act'])){
		$act = $_REQUEST['act'];
	}else{
		$act = "";
	}
	
	
	$id="";
	$col_code="";
	
	$deskripsi="";
	$tglkunjungan="";
	$harga1="0";
	$harga2="0";
	$officer="";
	$keterangan="";
	$cretedate="";
	$creteby="";
	
	$strsqlv01="SELECT * FROM appraisal_datapembanding2 WHERE col_id = '$col_id'";
	$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
	if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlconv01))
	{
		if($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
		{
			$id=$rowsv01['id'];
			$custnomid=$rowsv01['custnomid'];
			$col_code=$rowsv01['col_code'];
			 $col_id=$rowsv01['col_id'];
			$deskripsi=$rowsv01['deskripsi'];
			$tglkunjungan=$rowsv01['tglkunjungan'];
			$harga1=$rowsv01['harga1'];
			$harga2=$rowsv01['harga2'];
			$officer=$rowsv01['officer'];
			$keterangan=$rowsv01['keterangan'];
			$cretedate="asd";
			$creteby=$rowsv01['creteby'];

		}
	}

  if ($officer == "")
  {
	  $strsqlv01="select _cust_appraiser_id from appraisal_custmaster where _custnomid = '".$custnomid."'";
	  $sqlconv01 = sqlsrv_query($conn, $strsqlv01);
	  if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
	  if(sqlsrv_has_rows($sqlconv01))
	  {
		  if($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
		  {
			  $officer = $rowsv01['_cust_appraiser_id'];
		  }
	  }
  }
		
?>
	
<div style="padding:0px;margin:0px;"><img src="../../images/header_lis2.jpg"></img></div>
	<br><br><br>
		<div class="divcenter">
			<table border="1" style ="width:900px; border-color:black;" align="center">
				<tr>
					<td align="left" colspan="2" style="font-size:10pt;">
					<div align="left" style="padding:20px;">
					<form class="contact_form" action="datapembanding_do.php" method="post" name="contact_form">
						<ul>
							<li>
								 <h2><?php echo "<a href=\"javascript:history.go(-1)\"><img src='../../bin/img/back.png' style='width:40px;'/></a>";?> Data Pembanding</h2>
								 <span class="required_notification"><!--* Denotes Required Field--></span>
							</li>
							<li>
								<label for="name">Custnomid</label>
								<?php echo $custnomid;?>
								<input type="hidden" id="custnomid" name="custnomid" value="<?php echo $custnomid;?>" />
							</li>
							<li>
								<label for="name">Collateral ID</label>
							
							
							<select id="col_id" name="col_id" <?php if($act=="v"||$id!=""){echo "";} ?>  <? echo $varjava ?>  required>
							
									<?php
									
									
									
										$strsqlv01="select * from Tbl_Cust_MasterCol a
														join TblCollateralType b on a.cust_jeniscol = b.col_code


														and ap_lisregno = '$custnomid'";
										$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
										if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
										if(sqlsrv_has_rows($sqlconv01))
										{
											while($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
											{
												$m_col_id = $rowsv01['col_id'];
												$m_cust_jeniscol = $rowsv01['cust_jeniscol'];
												$col_name = $rowsv01['col_name'];
												
												
												?><option <?php if($col_id==$m_col_id){ echo "selected";}?> value="<?=$m_col_id?>"><?=$m_col_id.' - '.$col_name?></option><?
											}
										}
										
									?>
								
								</select>
								
							</li>
							<li>
								<label for="name">Deskripsi</label>


								<select id="deskripsi" name="deskripsi" <?php if($act=="v"||$id!=""){echo "";} ?>  <? echo $varjava ?>  required>
									<option value="">-Select-</option>
<?
              if ($jeniscol != "V01")
              {
?>
									<option value="PBB" <?php if($deskripsi=="PBB"){ echo "selected";}?>>PBB</option>
<?
              }
?>
									<option value="Appraisal Pembanding" <?php if($deskripsi=="Appraisal Pembanding"){ echo "selected";}?>>Appraisal Independent</option>
									<option value="Nilai Pasar" <?php if($deskripsi=="Nilai Pasar"){ echo "selected";}?>>Nilai Pasar</option>
								</select>
							</li>
							<li>
								<label for="name">Tanggal Kunjungan</label>
								<input  type="text" id="tglkunjungan" name="tglkunjungan" maxlength="200" value="<?php echo $tglkunjungan;?>" class="tanggal" <?php if($act=="v"){echo "disabled";} ?> required/>
							</li>

							<li>
								<label for="name">Harga 1 </label>
								<input type="text" id="harga1" name="harga1" maxlength="20" value="<?php echo number_format($harga1);?>" onkeypress="return isNumberKey(event)" onkeydown="return numbersonly(this, event);" <?php if($act=="v"){echo "disabled";} ?> required/> 
							</li>
							
							<li>
								<label for="name">Harga 2 </label>
								<input type="text" id="harga2" name="harga2" maxlength="20" value="<?php echo number_format($harga2);?>" onkeypress="return isNumberKey(event)" onkeydown="return numbersonly(this, event);" <?php if($act=="v"){echo "disabled";} ?> required/> 
							</li>
							

							<li>
								<label for="name">Officer</label>
								<input type="text" id="officer" name="officer" maxlength="50" value="<?php echo $officer;?>" <?php if($act=="v"){echo "disabled";} ?> required/>
							</li>
							<li>
								<label for="name">Keterangan</label>
								<textarea id="keterangan" name="keterangan" maxlength="500" cols="200" rows="6" <?php if($act=="v"){echo "disabled";} ?> required ><?php echo $keterangan;?></textarea>
							</li>
							<li>
								<?php if($act!="v"){?>
								<button id="submit" name="submit" class="submit" type="submit">Submit Form</button>
								<?} ?>
							</li>
						</ul>
						<input type="hidden" id="id" name="id" value="<?php echo $id;?>" />		
						<? require ("../../requirepage/hiddenfield.php");?>
						</form>	
						</div>
					</td>
				</tr>
			</table>
						
						
						
						
		
</body>
</html>