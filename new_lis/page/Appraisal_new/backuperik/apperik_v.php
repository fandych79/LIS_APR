<?
	require ("../../lib/open_conAPPR.php");
	require ("../../lib/formatError.php");
	require ("../../requirepage/parameter.php");
	//require ("../../requirepage/security.php");

    
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
                    border:none;border-bottom:0px solid black;
                }
                
                table tr td textarea
                {
                    border:none;
                    border-bottom:0px solid black;
                    resize:none;
                    width:100%;
                    height:100px;
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
                .iconsave1
                { 
                   background:url(save1.png) bottom no-repeat; 
                   width:16px; 
                   height:16px;
                   display:inline-block;
                }
                .iconsave2
                { 
                   background:url(save2.png) bottom no-repeat; 
                   width:16px; 
                   height:16px;
                   display:inline-block;
                }
            </style>
    </head>        
	<body>
        <form id="frm" method="post">
            <table align="center" id="tblpreview" border="1" style ="width:1000px; border-color:black;border-collapse:collapse;" align="center">
                <tr>
                    <td style="padding:20px 15 20 15px">
                    <!---->
                        <h2>APPRAISAL</h2>
                        <hr>
                        
                            <?php
                                $cust_jeniscol="";
                                $url = "./apperik_v.php?custnomid=$custnomid&userwfid=$userwfid&userpermission=$userpermission&buttonaction=$buttonaction&userbranch=$userbranch&userregion=$userregion&userid=$userid&userpwd=$userpwd";
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
                                        
                                        if($cust_jeniscol1=="BA1" || $cust_jeniscol1=="RUK" || $cust_jeniscol1=="KI2" )
                                        {
                                            $strsql="select  * from appraisal_tnb where _collateral_id='".$row['col_id']."'";
                                        }
                                        elseif($cust_jeniscol1=="TAN")
                                        {
                                            $strsql="select  * from appraisal_lnd where _collateral_id='".$row['col_id']."'";
                                        }
                                        elseif($cust_jeniscol1=="V01")
                                        {
                                            $strsql="select  * from appraisal_vhc where _collateral_id='".$row['col_id']."'";
                                        }
                                           
                                        
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
                                        ?>
                                        <li><a <?=$active;?> href="<?=$url."&col_id=".$row['col_id'];?>"><?=$row['jenis_col'].$spaniconsave?></a></li>
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
                            
                            
                            if($cust_jeniscol=="BA1" || $cust_jeniscol=="RUK" || $cust_jeniscol=="KI2")
                            {
                               require("eriktnb_v.php");
                            }
                             elseif($cust_jeniscol=="TAN")
                            {
                                require("eriklnd_v.php");
                            }
                            elseif($cust_jeniscol=="V01")
                            {
                                require("erikvhc_v.php");
                            }
                            else
                            {
                                echo "TIDAK ADA YANG DIAPPRASIAL";
                            }
                            if($cust_jeniscol=="BA1" || $cust_jeniscol=="RUK" || $cust_jeniscol=="KI2" || $cust_jeniscol=="TAN" || $cust_jeniscol=="V01" )
                            {
                                
                                
                               
                                ?>
                                <hr>
                               
                                <table border="0" style="border:0px solid black;width:100%;">
                                    
									<tr>
										<td colspan="2">
											<?
											
												 echo '<table border="0" style="border:0px solid black;width:100%;">
															<tr>
																<td colspan="2">
																	<table border="0" style="border:0px solid black;width:100%;">
																		<tr>
																			<td style="width:20%;text-align:center;">Photo 1</td>
																			<td style="width:20%;text-align:center;">Photo 2</td>
																			<td style="width:20%;text-align:center;">Photo 3</td>
																			<td style="width:20%;text-align:center;">Photo 4</td>
																			<td style="width:20%;text-align:center;">Photo 5</td>
																		</tr>
																		<tr>
													
													';
												for($i=1;$i<=5;$i++)
												{
													$tdphoto="<td>&nbsp;</td>";
													$tsql = "select * from appraisal_photo where _collateral_id = '".$col_id."' and _id='".$i."'";
													//echo $tsql;
													$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
													$params = array(&$_POST['query']);
													$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
													$rowimage = sqlsrv_num_rows($sqlConn);
													
													if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
													if(sqlsrv_has_rows($sqlConn))
													{
														
														while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
														{
															$_collateral_photo = $row['_collateral_photo'];
															
															
															//echo $tdphoto;
															if($_collateral_photo!="")
															{
																$src = 'data:image/png;base64,'.$_collateral_photo;
																$photo="<img src=\"".$src."\" width=\"150px\" style=\"margin:10px;\"/>";
																
																$tdphoto="<td>".$photo."</td>";
															}
															
															
														}
													}
													echo $tdphoto;
												}
												
												
												echo '
																 </tr>
															</table>
														</td>
													</tr>
												</table>';
												
												
												
											?>
										</td>
									</tr>
									
									<tr>
										<td colspan="2">
											<?
											
												 echo '<table border="0" style="border:0px solid black;width:100%;">
															<tr>
																<td colspan="2">
																	<table border="0" style="border:0px solid black;width:100%;">
																		<tr>
																			<td style="width:20%;text-align:center;">Photo 6</td>
																			<td style="width:20%;text-align:center;">Photo 7</td>
																			<td style="width:20%;text-align:center;">Photo 8</td>
																			<td style="width:20%;text-align:center;">Photo 9</td>
																			<td style="width:20%;text-align:center;">Photo 10</td>
																		</tr>
																		<tr>
													
													';
												for($i=6;$i<=10;$i++)
												{
													$tdphoto="<td>&nbsp;</td>";
													$tsql = "select * from appraisal_photo where _collateral_id = '".$col_id."' and _id='".$i."'";
													//echo $tsql;
													$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
													$params = array(&$_POST['query']);
													$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
													$rowimage = sqlsrv_num_rows($sqlConn);
													
													if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
													if(sqlsrv_has_rows($sqlConn))
													{
														
														while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
														{
															$_collateral_photo = $row['_collateral_photo'];
															
															
															//echo $tdphoto;
															if($_collateral_photo!="")
															{
																$src = 'data:image/png;base64,'.$_collateral_photo;
																$photo="<img src=\"".$src."\" width=\"150px\" style=\"margin:10px;\"/>";
																
																$tdphoto="<td>".$photo."</td>";
															}
															
															
														}
													}
													echo $tdphoto;
												}
												
												
												echo '
																 </tr>
															</table>
														</td>
													</tr>
												</table>';
												
												
												
											?>
										</td>
									</tr>
                                </table>
                                <?
                                
                            }
                            ?>
                            
                        </div>
                    <!---->
                    </td>
                </tr>
            </table>
            <table align="center" style ="width:1000px; border-color:black;border-collapse:collapse;">
                <tr>    
                    <td coslpan="2" align="center">
                    <?
						if($userid != "")
						{
						require ("../../requirepage/btnview.php");
						require ("../../requirepage/hiddenfield.php");
						}
						require("../../requirepage/btnprint.php");
                    ?>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="_collateral_id" id="_collateral_id" maxlength="50" value="<?=$col_id;?>"   />
        </form>
	</body>
</html>