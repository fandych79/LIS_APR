<?
	require ("../../lib/open_conAPPR.php");
	require ("../../lib/formatError.php");
	require ("../../requirepage/parameter.php");
	require ("../../requirepage/security.php");
    
    $col_id="";
    $tsql = "select top 1 *
            from Tbl_Cust_MasterCol 
            where ap_lisregno = '".$custnomid."' 
            and group_col = 'N' 
            and flaginsert = '1' 
            and flagdelete = '0'
            order by inserttime asc;
            
            ";
    $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $params = array(&$_POST['query']);
    $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
    $rowCount = sqlsrv_num_rows($sqlConn);
    
    if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
    if(sqlsrv_has_rows($sqlConn))
    {
        while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
        {
            
            $col_id=$row['col_id'];
        }
    }
    
    
    
    
    if(isset($_GET['col_id']))
    {
        $col_id=$_GET['col_id'];
    }
    //echo $c;
    
    
$yearcurrent = date("Y");
//echo $yearcurrent;
?>
<html>
	<head>
		<title>APPRAISAL</title>
		<script type="text/javascript" src="../../js/datetimepicker_css.js"></script>
		<script type="text/javascript" src="../../js/jquery-1.7.2.min.js" ></script>
		<script type="text/javascript" src="../../js/full_function.js" ></script>
		<script type="text/javascript" src="../../js/accounting.js" ></script>
		<link href="../../css/d.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
            $(document).ready(function() {
                $("ul.tabs a").click(function() {
                    $(".pane div").hide();
                    $($(this).attr("href")).show();
                });
                /*
                $("#frm input").each(function(){
                    alert($(this).attr("id")+  "  ====  " +$(this).attr("value"))
                })  
                $("#frm textarea").each(function(){
                    alert($(this).attr("id")+  "  ====  " +$(this).attr("value"))
                })
                */                
            })
            
            
            
            function check()
            {
                var myobj = {};
                nyangkut = "";
                $(".erikrequire").each(function(){
                    var name = $(this).attr('name');
                    var id = $(this).attr('id');
                    
                    grp="";
                    getlength="erikkosong";
                    if(name.slice(-2)=="[]")
                    {
                        grp = 'input[name="'+name+'"]:checked';                            
                        if(grp!=nyangkut)
                        {
                            getlength = grp;
                        }
                    }
                    else
                    {
                        getlength = id ;
                        grp = id ;
                    }
                    if(getlength!="erikkosong")
                    {
                        myobj[id] = getlength;
                    }
                    nyangkut = grp;
                });
                
                total =0;
                $.each(myobj, function(focussid, id) {
                    myval=0;
                    if(id.indexOf("input")==-1)
                    {
                        myval=$("#"+id).val().length;
                        idvalue=$("#"+id).val();
                        if(myval==0)
                        {
                            setTimeout(function() { $("#"+focussid).focus(); }, 10);
                            alert($("#"+focussid).attr("erikmsg")+ " harus di isi");
                            return false;
                        }
                        
                        if($("#"+id).attr("photoed")=="photoed")
                        {
                            //alert("ada photo");
                            
                            var ext = idvalue.substring(idvalue.lastIndexOf('.') + 1);
                            if(ext =="png" || ext=="jpg"){}
                            else
                            {
                                //alert("Extensi Upload Photo 1 salah");
                                setTimeout(function() { $("#"+focussid).focus(); }, 10);
                                alert("Extensi Upload " +$("#"+focussid).attr("erikmsg")+ " salah");
                                myval=0;
                                return false;
                            }
                        }
                        myval=$("#"+id).val().length;
                    }
                    else
                    {
                        myval=$(id).length;
                        if(myval==0)
                        {
                        setTimeout(function() { $("#"+focussid).focus(); }, 10);
                        alert($("#"+focussid).attr("erikmsg")+ " harus di isi");
                        return false;
                        }
                    }
                });
                
                
                $("[photoed]").each(function() {
                    var ext = $(this).val().substring($(this).val().lastIndexOf('.') + 1);
                    if($(this).val().length>0)
                    {
                        //alert($(this).attr("erikmsg")+ "ada isi");
                        if(ext =="png" || ext=="jpg"){}
                        else
                        {
                            //alert("Extensi Upload Photo 1 salah");
                            setTimeout(function() { $(this).focus(); }, 10);
                            alert("Extensi Upload " +$(this).attr("erikmsg")+ " salah");
                            myval=0;
                            return false;
                        }
                    }
                  
                });
                
                
                if(myval!=0)
                {
                    submitform = window.confirm("Are you sure?")
                    if(submitform==true)
                    {
                        $("#frm").submit();
                    }
                }
            }
        </script>
        <style type="text/css">
               #centeredmenu {
                   width:100%;
                   margin-top:10px;
                   border-bottom:4px solid #000;
                   display:inline-block;
                   position:relative;
                }
                #centeredmenu ul {
                   
                   float:left;
                   list-style:none;
                   margin:0;
                   padding:0;
                   text-align:left;
                }
                #centeredmenu ul li {
                   display:inline;
                   float:left;
                   list-style:none;
                   margin:0;
                   padding:0;
                   position:relative;
                }
                /*active inactive*/
                #centeredmenu ul li a {
                   display:inline-block;
                   margin:0 0 0 1px;
                   padding:3px 10px;
                   background:#ddd;
                   color:#000;
                   text-decoration:none;
                   line-height:1.3em;
                }
                /*active hover*/
                #centeredmenu ul li a:hover {
                   background:#31B0D5;
                   color:#fff;
                }
                /*active color*/
                #centeredmenu ul li a.active,
                #centeredmenu ul li a.active:hover {
                   color:#fff;
                   background:#369;/*active color*/
                   font-weight:bold;
                   
                }
                
                table tr td
                {
                    padding:3px;
                }
                
                table tr td input
                {
                    
                }
                
             
                
                .erikbtnsubmit,.erikbtnsubmit a
                {
                   position:relative;
                   width:100px;
                   text-align:center;
                   line-height:30px;
                   background:#31B0D5;
                   text-decoration:none;
                   color:#fff;
                }
                
                .erikbtnsubmit a:hover
                {
                   background:#2F6FA7;
                   color:#fff;
                }
                /*
                .erikbtnsubmit a:active
                {
                   background:#204D74;
                   color:#fff;
                }
                */
                input,textarea,select,radio
                {
                    background:#fff;
                }
                .erikrequire
                {
                    background:#FF0;
                }
                aaaaaaa
                {
                    background:FF00FF;
                }
                .iconsave1
                { 
                   background:url(save.png) bottom no-repeat; 
                   width:16px; 
                   height:16px;
                   display:inline-block;
                }
                .iconsave2
                { 
                   background:url(save.png) bottom no-repeat; 
                   width:16px; 
                   height:16px;
                   display:inline-block;
                }
				
				#perihal thead tr td
				{
					padding:2px;
					font-weight:bold;
					text-align:center;
				}
				textarea 
				{
					
					resize: none;
				}
            </style>
			
    </head>        
	<body>
        <form id="frm" method="post" action="eriksave.php" enctype="multipart/form-data">
            <table align="center" id="tblform" border="1" style ="width:1000px; border-color:black;border-collapse:collapse;">
                <tr>
                    <td style="padding:20px 15 20 15px">
                    <!---->
                        <h2>APPRAISAL CEKLIST PEMERIKSAAN <? echo $custnomid ?></h2>
						
						<?
						$_tgl = date('Y-m-d');
						$tsql = "select * from tr_pemeriksaan where _ap_lisregno ='".$custnomid."'";
						$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
						$params = array(&$_POST['query']);
						$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
						$rowCount = sqlsrv_num_rows($sqlConn);
						
						if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
						if(sqlsrv_has_rows($sqlConn))
						{
							while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
							{
								$_tgl=  $row['_tgl']->format('Y-m-d');
								$_nama1 = $row['_nama1'];
								$_jabatan1 = $row['_jabatan1'];
								$_nama2 = $row['_nama2'];
								$_jabatan2 = $row['_jabatan2'];
								
								
							}
						}
						
						?>
						
						<p>
						Pada tanggal <input style="width:75px;" onFocus="NewCssCal(this.id,'YYYYMMDD');" name="_tgl" id="_tgl" readonly value="<?=$_tgl?>"/>
						kami telah melakukan peninjauan setempat jaminan dari debitur dengan data - data sebagai berikut
						</p>
						<!--
						<table>
							<tr>
								<td>1</td>
								<td><input name="_nama1" value="<?=$_nama1?>" maxlength="100"></td>
								<td><input name="_jabatan1" value="<?=$_jabatan1?>" maxlength="100"></td>
							</tr>
							<tr>
								<td>2</td>
								<td><input name="_nama2" value="<?=$_nama2?>" maxlength="100"></td>
								<td><input name="_jabatan2" value="<?=$_jabatan2?>" maxlength="100"></td>
							</tr>
						</table>
						-->
						<br>
						
						<p>
										
									</p>
						
						<?
						
						
						
						$cust_jeniscol="";
						$tsql = "select ap_lisregno,cust_jeniscol from Tbl_Cust_MasterCol where 
						col_id = '".$col_id."' 
						and group_col = 'N' 
						and flaginsert = '1' 
						and flagdelete = '0'";

						$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
						$params = array(&$_POST['query']);
						$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
						$rowCount = sqlsrv_num_rows($sqlConn);
						
						if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
						if(sqlsrv_has_rows($sqlConn))
						{
							while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
							{
								$cust_jeniscol=  $row['cust_jeniscol'];
								$ap_lisregno=  $row['ap_lisregno'];
							}
						}
						
						$customername="";
						$tsql = "select _cust_name from appraisal_custmaster where _custnomid='".$ap_lisregno."'";
						$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
						$params = array(&$_POST['query']);
						$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
						$rowCount = sqlsrv_num_rows($sqlConn);
						
						if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
						if(sqlsrv_has_rows($sqlConn))
						{
							while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
							{
								$customername=  $row['_cust_name'];
							}
						}
						
						
						$erikcheck="erik";

						if($cust_jeniscol=="BA1" || $cust_jeniscol=="RUK" || $cust_jeniscol=="KI2")
                            {
//                               require("pemeriksaantnb_v.php");
                            }
                             elseif($cust_jeniscol=="TAN")
                            {
//                                require("pemeriksaanlnd_v.php");
                            }
                            elseif($cust_jeniscol=="V01")
                            {
//                                require("pemeriksaanvhc_v.php");
                            }
                            else
                            {
//                                echo "TIDAK ADA YANG DIAPPRASIAL";
                            }
						
						
						
						?>
						
                                 
									
						
                        
                        
                            <?php
                                $cust_jeniscol="";
                                $url = "./perihal.php?custnomid=$custnomid&userwfid=$userwfid&userpermission=$userpermission&buttonaction=$buttonaction&userbranch=$userbranch&userregion=$userregion&userid=$userid&userpwd=$userpwd";
                                
								 $tsql = "select *,
                                        case when cust_jeniscol='BA1' then 'Tanah dan Bangunan'
                                        when cust_jeniscol='RUK' then 'Ruko'
                                        when cust_jeniscol='KI2' then 'Kios'
                                        when cust_jeniscol='TAN' then 'Tanah'
                                        when cust_jeniscol='V01' then 'Kendaraan' else '' end 'jenis_col' from Tbl_Cust_MasterCol 
                                        where ap_lisregno = '".$custnomid."' 
                                        and group_col = 'N' 
                                        and flaginsert = '1' 
                                        and flagdelete = '0'
                                        order by inserttime asc;
                                        
                                        ";
								
                                $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
                                $params = array(&$_POST['query']);
                                $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
                                $rowCount = sqlsrv_num_rows($sqlConn);
                                
                                if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
                                if(sqlsrv_has_rows($sqlConn))
                                {
									
									
									?>
									

									
									
                                    <div id="centeredmenu">
                                    <ul>
                                    <?

                                    while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
                                    {
                                        
                                        $active='';
                                        $strsql="";
                                        $spaniconsave="";
                                        $cust_jeniscol1 = $row['cust_jeniscol'];

										
												


										
                                        
                                        if($col_id==$row['col_id'])
                                        {
                                            $active='class="active"';
                                            $cust_jeniscol = $row['cust_jeniscol'];
                                        }
                                        
										$strsql = "	select * from ms_perihal a
														join tr_perihal b on a._idx = b._idx 
														where a._collateral_id = '".$cust_jeniscol1."'";
                                        
                                        if($strsql!="")
                                        {
                                            $tsql1 = $strsql;
                                            $cursorType1 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
                                            $params1 = array(&$_POST['query']);
                                            $sqlConn1 = sqlsrv_query($conn, $tsql1, $params1, $cursorType1);
                                            $rowCount1 = sqlsrv_num_rows($sqlConn1);
                                        
										
											
                                            if($rowCount1>0)
                                            {
                                                $spaniconsave="&nbsp;&nbsp;<span class=\"iconsave2\"></span>";
                                            }
                                        }
                                        
                                        if($col_id==$row['col_id'])
                                        {
                                            $active='class="active"';
                                            $cust_jeniscol = $row['cust_jeniscol'];
                                            if($rowCount1>0)
                                            {
                                                $spaniconsave="&nbsp;&nbsp;<span class=\"iconsave1\"></span>";
												
                                            }
                                        }
										
										//echo $rowCount1;
                                        ?>
                                        <li><a <?=$active;?> style="line-height:28px;" href="<?=$url."&col_id=".$row['col_id'];?>"><?=$row['jenis_col'].$spaniconsave?></a></li>
                                        <?
                                    }
                                    ?>
                                    </ul>
                                    </div>
                                <?
                                }
                                
                                
                            ?>
                        <div>
						
                            <?php
							
							
								//echo $cust_jeniscol;
							
								$tsql = "select _idx,_nama from ms_perihal where _collateral_id = '".$cust_jeniscol."' and _flag = '0'";
                                $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
                                $params = array(&$_POST['query']);
                                $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
                                $rowCount = sqlsrv_num_rows($sqlConn);

                                if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
                                if(sqlsrv_has_rows($sqlConn))
                                {
									
									
									?>
									
									<table id="perihal" border="1" style="border-collapse:collapse;width:100%;margin-top:10px;">
										<thead>
											<tr>
												<td style="width:25px;" rowspan="2">No.</td>
												<td rowspan="2">Perihal / Pekerjaan</td>
												<td style="width:100px;">Kesiapan</td>
												<td style="width:100px;">Kondisi</td>
												<!--<td style="width:200px;" rowspan="2">Catatan</td>-->
												<td style="width:300px;" rowspan="2">Keterangan</td>
											</tr>
											<tr>
												<td>Ada / Tidak</td>
												<td>Pekerjaan</td>
											</tr>
										</thead>
										<tbody>
									<?
									$kesiapan = array('Ada','Tidak');
									
									$no = 0;
									$allval="";
                                    while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
                                    {
										
										
										$_kesiapan="";
										$_kondisi="";
										$_catatan="";
										$_keterangan="";
										$tsql2 =  "select * from tr_perihal where _ap_lisregno='$custnomid' and _idx ='".$row['_idx']."'";
										$cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
										$params2 = array(&$_POST['query']);
										$sqlConn2 = sqlsrv_query($conn, $tsql2, $params2, $cursorType2);
										$rowCount = sqlsrv_num_rows($sqlConn2);
										
										if ( $sqlConn2 === false)die( FormatErrors( sqlsrv_errors() ) );
										if(sqlsrv_has_rows($sqlConn2))
										{
											while( $rows = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_ASSOC))
											{
												$_kesiapan=$rows['_kesiapan'];
												$_kondisi=$rows['_kondisi'];
												$_catatan=$rows['_catatan'];
												$_keterangan=$rows['_keterangan'];
											}
										}
								
										$no++;
										
										$firstval="";
										if($no==1)
										{
											$firstval =  '
											if($("#_kondisi'.$row['_idx'].'").val()=="")
											{
												alert("_kondisi '.$no .' harus diisi");
												$("#_kondisi'.$row['_idx'] .'").focus();
											}';
										}
										else
										{
											$firstval =  '
											else if($("#_kondisi'.$row['_idx'].'").val()=="")
											{
												alert("_kondisi '.$no .' harus diisi");
												$("#_kondisi'.$row['_idx'] .'").focus();
											}
											';
										}
										
										$allval  .=  $firstval;
										
										
										
										
										
										
										$kondisi="";
										
										?>
										
										<tr>
											<td style="text-align:center;"><?=$no;?></td>
											<td style="padding-left:5px;"><?=$row['_nama'];?></td>
											<td>
												<select name="_kesiapan[]">
													<?
													foreach ($kesiapan as $value)
													{
														$selected = $_kesiapan == $value ? 'selected' : '';
														?><option <?=$selected?> value ="<?=$value?>"><?=$value?></option><?
													}
													?>
												</select>
											</td>
											<td><input id="_kondisi<?=$row['_idx']?>" style="width:90px;" type="text" name="_kondisi[]" maxlength="50" value="<?=$_kondisi;?>"></td>
											<!--<td>
												<textarea id="_catatan<?=$row['_idx']?>" name="_catatan[]" rows="4" cols="25"><?=nl2br($_catatan)?></textarea>
											</td>-->
											<td>
												<textarea id="_keterangan<?=$row['_idx']?>" name="_keterangan[]" rows="4" cols="40"><?=nl2br($_keterangan)?></textarea>
											</td>
										</tr>
										
									
								
										<?
										//echo $row['_idx'].' - '.$row['_nama'].'<br/>';
										
									}
									
									//echo $allval;
									?>
											</tbody>
											<tr>
												<td colspan="6" style="text-align:right;"> <input onclick="savetab();" style="width:125px;color:fff;background:#31B0D5;line-height:30px; text-align:center;cursor:pointer;" type="button" value="Save tab" /></td>
											</tr>
										</table>
										<input type="hidden" name="jeniscol" value="<?=$cust_jeniscol?>"/>
										<input type="hidden" name="col_id" value="<?=$col_id?>"/>
										<script>
																	
												function savetab()
												{
													<?
													echo $allval;
													?>
													else
													{
														$('#frm').attr('action', "savetab.php").submit();
													}
													<?
													
													
													?>
													
													
												}
											</script>
							
										
							
									<?
								}
                            
							?>
							
							
                        </div>
                    <!---->
                    </td>
                </tr>
            </table>
            <div align="center">
            
            <?
//                require ("../../requirepage/hiddenfield.php");
						if($userid != "")
						{
						require ("../../requirepage/btnview.php");
						require ("../../requirepage/hiddenfield.php");
						}
						//require("../../requirepage/btnprint.php");
            ?>
            <input type="hidden" name="_collateral_id" id="_collateral_id" maxlength="50" value="<?=$col_id;?>"   />
            </div>
            
        </form>
	</body>
</html>