<?
require('../../lib/formatError.php');
require('../../lib/open_con.php');
$custnomid=$_REQUEST['custnomid'];
$userid=$_REQUEST['userid'];
$time= date('dmYHis');
echo $time;
?>
<!DOCTYPE>
<html>
	<head>
		<script type="text/javascript" src="../../lib/jquery-1.6.4.min.js"></script>
		<link href="../../lib/crw.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">	
			
			function isNumberKey(evt)
			{
				var charCode = (evt.which) ? evt.which : event.keyCode
				if (charCode > 31 && (charCode < 48 || charCode > 57))
				return false;
				return true;
			}
			function outputMoney(theid)
			{	
			varreplace = replace(eval("document.edit_col." + theid + ".value"),',','');
				//alert("woi");
				eval("document.edit_col." + theid + ".value =  varreplace")
				number = eval("document.edit_col." + theid + ".value");
				newoutput = outputDollars(Math.floor(number-0) + '');
				eval("document.edit_col." + theid + ".value =  newoutput")
				
				 
					
			}
			
			function lala(theid,htheid)
			{	
			//alert(theid);
			//alert(htheid);
			varreplace = replace(eval("document.edit_col." + theid + ".value"),',','');
			//alert("woi");
			eval("document.edit_col." + theid + ".value =  varreplace")
			//alert("woia");
			number = eval("document.edit_col." + theid + ".value");
			//alert("woib");
			newoutput = outputDollars(Math.floor(number-0) + '');
			//alert("woic");
			eval("document.edit_col." + theid + ".value =  newoutput")
			//alert("woid");
			var tmpvalue = eval("document.edit_col."+theid+".value");
			//alert("woiaf");
			//alert(tmpvalue);
			//alert(document.edit_col.npkb.value)
			var inChar = ",";
			var outChar = "";
			var tmpinchar = tmpvalue.split(inChar); 
			tmpoutchar= tmpinchar.join(outChar);
			//alert("woiaas");
			//alert(tmpoutchar);
			document.getElementById(htheid).value=tmpoutchar;
			}
			
			
			function outputDollars(number)
			{
				if (number.length <= 3)
					return (number == '' ? '0' : number);
				else
				{
					var mod = number.length%3;
					var output = (mod == 0 ? '' : (number.substring(0,mod)));
					for (i=0 ; i < Math.floor(number.length/3) ; i++)
					{
						if ((mod ==0) && (i ==0))
						output+= number.substring(mod+3*i,mod+3*i+3);
						else
						output+= ',' + number.substring(mod+3*i,mod+3*i+3);
					}
					return (output);
				}
			}

			function replace(string,text,by)
			{
			   var strLength = string.length, txtLength = text.length;
			   if ((strLength == 0) || (txtLength == 0)) return string;

			   var i = string.indexOf(text);
			   if ((!i) && (text != string.substring(0,txtLength))) return string;
			   if (i == -1) return string;

			   var newstr = string.substring(0,i) + by;

			   if (i+txtLength < strLength)
				  newstr += replace(string.substring(i+txtLength,strLength),text,by);

			   return newstr;
			}

			function goSave()
			{
				var FormName="edit_col";
				var elem = document.getElementById(FormName).elements;
				for(var i = 0; i < elem.length; i++)
				{
					elem[i].value = elem[i].value.toUpperCase();
				}
				
				var StatusAllowSubmit=true;
				var elem = document.getElementById(FormName).elements;
				for(var i = 0; i < elem.length; i++)
				{
					if(elem[i].style.backgroundColor=="#ff0")
					{
						if(elem[i].value == "")
						{
							alert(elem[i].nai + " field Must be filled");
							elem[i].focus();				
							StatusAllowSubmit=false				
							break;
						}
						else if(elem[i].type == "textarea" || elem[i].type == "text")
						{
							//alert(elem[i].type );
							varinvalidcharone = elem[i].value.indexOf('\'');	
							varinvalidchartwo = elem[i].value.indexOf('\"');
							if (varinvalidchartwo != -1 || varinvalidcharone != -1)
							{
								alert(elem[i].nai + " TIDAK BOLEH MENGGUNAKAN TANDA \' atau \"");
								elem[i].focus();
								StatusAllowSubmit=false	
								return false;
							}
							
						}
					}
					else if(elem[i].type == "textarea" || elem[i].type == "text")
					{
						//alert(elem[i].type );
						varinvalidcharone = elem[i].value.indexOf('\'');	
						varinvalidchartwo = elem[i].value.indexOf('\"');
						if (varinvalidchartwo != -1 || varinvalidcharone != -1)
						{
							alert(elem[i].nai + " TIDAK BOLEH MENGGUNAKAN TANDA \' atau \"");
							elem[i].focus();
							StatusAllowSubmit=false	
							return false;
						}
						
					}
				}
				
			if(StatusAllowSubmit == true)
				{			
					document.edit_col.target = "utama";
					document.edit_col.action = "do_pk.php";
					submitform = window.confirm("Save?")
					if (submitform == true)
					{
						document.edit_col.submit();
						return true;
					}
					else
					{
						return false;
					} 
				}
			}
			function getcomment(form,nilaiinput,nilailikuidasi,nilaipersen,nilaipasar,tbl,colcode,ket) 
			{
				alert("bbb");
				var input=$('#'+nilaiinput).val();
				var likui=$('#'+nilailikuidasi).val();
				var persen=$('#'+nilaipersen).val();
				var pasar=$('#'+nilaipasar).val();
				var tbl=$('#'+tbl).val();
				var colcode=$('#'+colcode).val();
				var ket=$('#'+ket).val();
				var timer= '<?echo time()?>';
				var custnomid=$('#custnomid').val();
				/*
				alert(timer);
				alert(input);
				alert(likui);
				alert(persen);
				alert(pasar);
				alert(tbl);
				alert(colcode);
				alert(ket);
				alert(custnomid);
				*/
				$.ajax
				({
					type: "GET",
					url: "override.php",
					data: "form="+form+"&input="+input+"&pasar="+pasar+"&likui="+likui+"&persen="+persen+"&tbl="+tbl+"&custnomid="+custnomid+"&colcode="+colcode+"&ket="+ket+"&time="+timer+"",
					success: function(response)
					{
						//alert(response);
						$('#'+tbl).html(response);
					}
				});
			}
			function masuk(btn,formterbang,keterangan,colidcol,colcodecol)
			{
				var custnomid=$('#custnomid').val();
				var user=$('#user').val();
				var nilai_likui=$('#'+colidcol).val();
				var sqllikuidasi=$('#'+colidcol+'L').val();
				var keterangan=$('#'+keterangan).val();
				var timer= '<?echo time()?>';
				//alert(custnomid);
				//alert(nilai_likui);
				//alert(user);
				//alert(btn);
				//alert(keterangan);
				//alert(formterbang);
				//alert(colidcol);
				//alert(colcodecol);
				if(keterangan!='')
				{
					var erik=window.confirm('Anda Yakin');
					if (erik==true)
					{
					window.location.reload();
					$.ajax
						({
							type: "GET",
							url: "override.php",
							data: "form="+formterbang+"&sqllikuidasi="+sqllikuidasi+"&button="+btn+"&colidcol="+colidcol+"&colcodecol="+colcodecol+"&custnomid="+custnomid+"&user="+user+"&nilai_likui="+nilai_likui+"&keterangan="+keterangan+"&time="+timer+"",
							success: function(response)
							{
								//alert(response);
							}
						});
					}
					else
					{
					window.location.reload();
					}
				}
				else
				{
				alert('comment tidak boleh kosong');
					
				}
				
			}
		</script>
	</head>
	<body>
		<br/>
		<br/>
		<form name="edit_col" method="get">
			<script language="JavaScript">name = 'utama';</script>
			<input type="hidden" name="custnomid"  id="custnomid" value="<?echo $custnomid?>">
			<input type="hidden" name="user"  id="user" value="<?$userid?>">
			<table width="1200" align="center" >
				<tr>
					<td>
					<table width="100%" border="1">
						<tr>
							<td width="25%"><div align="center">Jenis Jaminan </div></td>						
							<td width="20%"><div align="center">Alamat Jaminan</div></td>
							<td width="10%"><div align="center">Bukti Kepemilikan</div></td>
							<td width="15%"><div align="center">Atas Nama</div></td>
							<td width="15%"><div align="center">Nilai Pasar</div></td>
							<td width="15%"><div align="center">Nilai Likuidasi</div></td>
						</tr>
					</table>
					</td>
				</tr>
				<?	
				$allseq=0;
				$alamat="";
				$type_sertifikat="";
				$no_sertifikat="";
				$atasnama="";
				$namajaminan="";
				$nilai_pasar="";
				$nilai_likuidasi="";
				
				$sql_col_land="select cmc.col_id,cmc.ap_lisregno,ct.col_code,ct.col_name,cv.col_nilaiwajar,cv.col_nilailikuidasi, ov.override_persen,
								cv.col_addr1,cv.col_certtype,cv.col_certno,cv.col_certatasnama
								from tbl_COL_Land cv,Tbl_Cust_MasterCol cmc,TblCollateralType ct,tbl_ms_override ov
								where cv.col_id=cmc.col_id 
								and ov.override_type=ct.col_code
								and cmc.ap_lisregno=cv.ap_lisregno 
								and cmc.col_id like '%TNK%' 
								and ct.col_code='TAN'
								and cmc.flagdelete='0' 
								and cmc.ap_lisregno='$custnomid' ";
								//echo $sql_col_land;
				$cursortype_col_land = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
				$params_col_land = array(&$_POST['query']);
				$sqlConn_col_land = sqlsrv_query($conn, $sql_col_land, $params_col_land, $cursortype_col_land);
				if($conn==false){die(FormatErrors(sqlsrv_errors()));}
				if(sqlsrv_has_rows($sqlConn_col_land))
				{
					$rowCount_col_land = sqlsrv_num_rows($sqlConn_col_land);
					while($row_col_land = sqlsrv_fetch_array( $sqlConn_col_land, SQLSRV_FETCH_ASSOC))
					{
						$ket='';
						$tmp=0;
						$allseq+=1;
						$alamat=$row_col_land['col_addr1'];
						$namajaminan=$row_col_land['col_name'];
						$override_persen=$row_col_land['override_persen'];
						$col_id=$row_col_land['col_id'];
						$col_code=$row_col_land['col_code'];
						$type_sertifikat=$row_col_land['col_certtype'];
						$no_sertifikat=$row_col_land['col_certno'];
						$atasnama=$row_col_land['col_certatasnama'];
						$nilai_pasar=$row_col_land['col_nilaiwajar'];
						$nilai_likuidasi=$row_col_land['col_nilailikuidasi'];
						if($rowCount_col_land != 0)
						{
						$tmp=$nilai_likuidasi*$override_persen/100;
						
				?>	

				<tr>
					<td width="100%">
						<table width="100%" border="1" id="T<? echo $col_id ?>" >
							<tr>
								<input type="hidden" id="<?echo $col_code.$allseq?>" value="<?echo $col_code?>"/><!--colcode-->
								<input type="hidden" id="<?echo $col_id.'T'?>" value="<?echo 'T'.$col_id?>"/><!--namatable-->
								<input type="hidden" id="<?echo $col_id.'P'?>" value="<?echo $tmp?>"/><!--nilai persen-->
								<input type="hidden" id="<?echo $col_id.'F'?>" value="<?echo $nilai_pasar?>"/><!--nilaifisik-->
								<input type="hidden" id="<?echo $col_id.'L'?>" value="<?echo $nilai_likuidasi?>"/><!--nilai likuidasi-->
								<input type="hidden" id="<?echo $col_id.'K'?>" value="<?echo $ket?>"/><!--ket-->
								<td width="25%"><?echo $namajaminan;?></td>
								<td width="20%"><?echo $alamat;?></td>
								<td width="10%"><?echo $type_sertifikat;?> <?echo $no_sertifikat;?></td>
								<td width="15%"><?echo $atasnama;  ?></td>
								<td width="15%" align="right"><? echo number_format($nilai_pasar)?></td>
								<td width="15%" align="right">
									<input onkeypress="return isNumberKey(event)" onchange="getcomment('ov_col','<?echo $col_id?>','<?echo $col_id.'L'?>','<?echo $col_id.'P'?>','<?echo $col_id.'F'?>','<?echo $col_id.'T'?>','<?echo $col_code.$allseq?>','<?echo $col_id.'K'?>')" type="text" name="<?echo $col_id?>" id="<?echo $col_id?>" value="<? echo number_format($nilai_likuidasi)?>" maxlength="12" onkeyup="outputMoney('<?echo  $col_id?>');"/>
									<!--<input type="text" name="<?echo $col_id?>" id="<?echo $col_id?>" value="<? echo number_format($nilai_likuidasi)?>" maxlength="12" onkeypress="return isNumberKey(event)" onkeyup="lala('<?echo  $col_id?>','<?echo $col_id.'H'?>');"  onblur="lala('<?echo  $col_id?>','<?ECHO $col_id.'H'?>');" onchange="getcomment('<?echo  $col_id?>','or_col','<?echo $allseq?>','<?echo $col_id.'P'?>','<?echo $col_id.'L'?>','<?echo $col_id.'F'?>','<?echo $col_code.$allseq?>','<? echo $col_id.'K'?>');"/>-->
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<?
						}
					}						
				}
				sqlsrv_free_stmt( $sqlConn_col_land );  
				
				$allseq=0;
				$alamat="";
				$type_sertifikat="";
				$no_sertifikat="";
				$atasnama="";
				$namajaminan="";
				$nilai_pasar="";
				$nilai_likuidasi="";
				
				$sql_col_land="select cmc.flagdelete,cmc.col_id,cmc.ap_lisregno,ct.col_code,ct.col_name, cl.col_certtype,cl.col_certno,cl.col_certatasnama,
								cb.col_nilaitotalfisik,cb.col_nilailikuidasifisik,cb.col_addr1,ov.override_persen
								from tbl_COL_Building cb,tbl_COL_Land cl,Tbl_Cust_MasterCol cmc,TblCollateralType ct,tbl_ms_override ov
								where cmc.ap_lisregno=cl.ap_lisregno
								and cl.ap_lisregno=cb.ap_lisregno
								and ct.col_code=ov.override_type
								and ct.col_code=cmc.cust_jeniscol
								and cl.col_id=cb.col_id
								and cl.col_id=cmc.col_id
								and cmc.flagdelete='0'
								and cl.ap_lisregno='$custnomid'
								and cmc.cust_jeniscol='BA1'";
								//echo $sql_col_land;
				$cursortype_col_land = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
				$params_col_land = array(&$_POST['query']);
				$sqlConn_col_land = sqlsrv_query($conn, $sql_col_land, $params_col_land, $cursortype_col_land);
				if($conn==false){die(FormatErrors(sqlsrv_errors()));}
				if(sqlsrv_has_rows($sqlConn_col_land))
				{
					$rowCount_col_land = sqlsrv_num_rows($sqlConn_col_land);
					while($row_col_land = sqlsrv_fetch_array( $sqlConn_col_land, SQLSRV_FETCH_ASSOC))
					{
						$ket='';
						$tmp=0;
						$allseq+=1;
						$alamat=$row_col_land['col_addr1'];
						$namajaminan=$row_col_land['col_name'];
						$override_persen=$row_col_land['override_persen'];
						$col_id=$row_col_land['col_id'];
						$col_code=$row_col_land['col_code'];
						$type_sertifikat=$row_col_land['col_certtype'];
						$no_sertifikat=$row_col_land['col_certno'];
						$atasnama=$row_col_land['col_certatasnama'];
						$nilai_pasar=$row_col_land['col_nilaitotalfisik'];
						$nilai_likuidasi=$row_col_land['col_nilailikuidasifisik'];
						if($rowCount_col_land != 0)
						{
						$tmp=$nilai_likuidasi*$override_persen/100;
						
				?>	

				<tr>
					<td width="100%">
						<table width="100%" border="1" id="T<? echo $col_id ?>" >
							<tr>
								<input type="hidden" id="<?echo $col_code.$allseq?>" value="<?echo $col_code?>"/><!--colcode-->
								<input type="hidden" id="<?echo $col_id.'T'?>" value="<?echo 'T'.$col_id?>"/><!--namatable-->
								<input type="hidden" id="<?echo $col_id.'P'?>" value="<?echo $tmp?>"/><!--nilai persen-->
								<input type="hidden" id="<?echo $col_id.'F'?>" value="<?echo $nilai_pasar?>"/><!--nilaifisik-->
								<input type="hidden" id="<?echo $col_id.'L'?>" value="<?echo $nilai_likuidasi?>"/><!--nilai likuidasi-->
								<input type="hidden" id="<?echo $col_id.'K'?>" value="<?echo $ket?>"/><!--ket-->
								<td width="25%"><?echo $namajaminan;?></td>
								<td width="20%"><?echo $alamat;?></td>
								<td width="10%"><?echo $type_sertifikat;?> <?echo $no_sertifikat;?></td>
								<td width="15%"><?echo $atasnama;  ?></td>
								<td width="15%" align="right"><? echo number_format($nilai_pasar)?></td>
								<td width="15%" align="right">
									<input onchange="getcomment('ov_col','<?echo $col_id?>','<?echo $col_id.'L'?>','<?echo $col_id.'P'?>','<?echo $col_id.'F'?>','<?echo $col_id.'T'?>','<?echo $col_code.$allseq?>','<?echo $col_id.'K'?>')" type="text" name="<?echo $col_id?>" id="<?echo $col_id?>" value="<? echo number_format($nilai_likuidasi)?>" maxlength="12" onkeyup="outputMoney('<?echo  $col_id?>');"/>
									<!--<input type="text" name="<?echo $col_id?>" id="<?echo $col_id?>" value="<? echo number_format($nilai_likuidasi)?>" maxlength="12" onkeypress="return isNumberKey(event)" onkeyup="lala('<?echo  $col_id?>','<?echo $col_id.'H'?>');"  onblur="lala('<?echo  $col_id?>','<?ECHO $col_id.'H'?>');" onchange="getcomment('<?echo  $col_id?>','or_col','<?echo $allseq?>','<?echo $col_id.'P'?>','<?echo $col_id.'L'?>','<?echo $col_id.'F'?>','<?echo $col_code.$allseq?>','<? echo $col_id.'K'?>');"/>-->
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<?
						}
					}						
				}
				sqlsrv_free_stmt( $sqlConn_col_land );  
				
				$allseq=0;
				$alamat="";
				$type_sertifikat="";
				$no_sertifikat="";
				$atasnama="";
				$namajaminan="";
				$nilai_pasar="";
				$nilai_likuidasi="";
				
				$sql_col_land="select cmc.col_id,cmc.ap_lisregno,ct.col_code,ct.col_name,cv.col_nilaiwajar,cv.col_nilailikuidasi,
								cv.col_addr1,cv.col_bpkbnama,ov.override_persen
								from tbl_COL_Vehicle cv,Tbl_Cust_MasterCol cmc,TblCollateralType ct,tbl_ms_override ov
								where cv.col_id=cmc.col_id
								and ov.override_type=ct.col_code
								and ct.col_apr_code like '%vhc%'
								and cmc.ap_lisregno=cv.ap_lisregno
								and cmc.col_id like '%vhc%'
								and cmc.flagdelete='0'
								and cv.ap_lisregno='P014096300333'
								";
								//echo $sql_col_land;
				$cursortype_col_land = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
				$params_col_land = array(&$_POST['query']);
				$sqlConn_col_land = sqlsrv_query($conn, $sql_col_land, $params_col_land, $cursortype_col_land);
				if($conn==false){die(FormatErrors(sqlsrv_errors()));}
				if(sqlsrv_has_rows($sqlConn_col_land))
				{
					$rowCount_col_land = sqlsrv_num_rows($sqlConn_col_land);
					while($row_col_land = sqlsrv_fetch_array( $sqlConn_col_land, SQLSRV_FETCH_ASSOC))
					{
						$ket='';
						$tmp=0;
						$allseq+=1;
						$alamat=$row_col_land['col_addr1'];
						$namajaminan=$row_col_land['col_name'];
						$override_persen=$row_col_land['override_persen'];
						$col_id=$row_col_land['col_id'];
						$col_code=$row_col_land['col_code'];
						$atasnama=$row_col_land['col_bpkbnama'];
						$nilai_pasar=$row_col_land['col_nilaiwajar'];
						$nilai_likuidasi=$row_col_land['col_nilailikuidasi'];
						if($rowCount_col_land != 0)
						{
						$tmp=$nilai_likuidasi*$override_persen/100;
						
				?>	

				<tr>
					<td width="100%">
						<table width="100%" border="1" id="T<? echo $col_id ?>" >
							<tr>
								<input type="hidden" id="<?echo $col_code.$allseq?>" value="<?echo $col_code?>"/><!--colcode-->
								<input type="hidden" id="<?echo $col_id.'T'?>" value="<?echo 'T'.$col_id?>"/><!--namatable-->
								<input type="hidden" id="<?echo $col_id.'P'?>" value="<?echo $tmp?>"/><!--nilai persen-->
								<input type="hidden" id="<?echo $col_id.'F'?>" value="<?echo $nilai_pasar?>"/><!--nilaifisik-->
								<input type="hidden" id="<?echo $col_id.'L'?>" value="<?echo $nilai_likuidasi?>"/><!--nilai likuidasi-->
								<input type="hidden" id="<?echo $col_id.'K'?>" value="<?echo $ket?>"/><!--ket-->
								<td width="25%"><?echo $namajaminan;?></td>
								<td width="20%"><?echo $alamat;?></td>
								<td width="10%">BPKB</td>
								<td width="15%"><?echo $atasnama;  ?></td>
								<td width="15%" align="right"><? echo number_format($nilai_pasar)?></td>
								<td width="15%" align="right">
									<input onchange="getcomment('ov_col','<?echo $col_id?>','<?echo $col_id.'L'?>','<?echo $col_id.'P'?>','<?echo $col_id.'F'?>','<?echo $col_id.'T'?>','<?echo $col_code.$allseq?>','<?echo $col_id.'K'?>')" type="text" name="<?echo $col_id?>" id="<?echo $col_id?>" value="<? echo number_format($nilai_likuidasi)?>" maxlength="12" onkeyup="outputMoney('<?echo  $col_id?>');"/>
									<!--<input type="text" name="<?echo $col_id?>" id="<?echo $col_id?>" value="<? echo number_format($nilai_likuidasi)?>" maxlength="12" onkeypress="return isNumberKey(event)" onkeyup="lala('<?echo  $col_id?>','<?echo $col_id.'H'?>');"  onblur="lala('<?echo  $col_id?>','<?ECHO $col_id.'H'?>');" onchange="getcomment('<?echo  $col_id?>','or_col','<?echo $allseq?>','<?echo $col_id.'P'?>','<?echo $col_id.'L'?>','<?echo $col_id.'F'?>','<?echo $col_code.$allseq?>','<? echo $col_id.'K'?>');"/>-->
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<?
						}
					}						
				}
				sqlsrv_free_stmt( $sqlConn_col_land ); 
				
				?>
			</table>
		</form>
	</body>
</html>
<?
require('../../lib/close_con.php');
?>