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
	    $colid = $col_id;
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
                                $tsql = "
                                select a.*, b.col_name as jenis_col from Tbl_Cust_MasterCol a, TblCollateralType b 
                                        where a.cust_jeniscol = b.col_code
										and a.ap_lisregno = '$custnomid' 
                                        and a.flaginsert = '1' 
                                        and a.flagdelete = '0'
                                        order by a.inserttime asc;
                                        ";

                                //echo $tsql;
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

	                                    $rowCount1 = 0;

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

                            echo "<pre>";
                            echo "<code>($cust_jeniscol)</code>";
                            echo "</pre>";
                            echo "<br>";

                            $type = $cust_jeniscol;
                            /*
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
                            */


                            if($type == "TAN" || $type == "TPR" || $type == "TN1")
                            {
	                            require("viewtpr_v3.php");
                            }
                            else if($type == "BA1" || $type == "BA2" || $type == "BA3")
                            {
	                            require("eriktnb_v.php");
                            }
                            else if($type == "V01" || $type == "V02" || $type == "V03" || $type == "V04")
                            {
	                            require("erikvhc_v.php");
                            }
                            else if($type == "TT1" || $type == "TT2"|| $type == "TT3")
                            {
	                            require("viewtermyn_v3.php");
                            }
                            else if($type == "GLD")
                            {
	                            require("viewgld_v3.php");
                            }
                            else if($type == "GLP")
                            {
	                            require("viewglp_v3.php");
                            }
                            else if($type == "G01" || $type == "G02"|| $type == "AB1"|| $type == "AB2"|| $type == "AB3"|| $type == "AB4")
                            {
	                            require("viewmesin_v3.php");
                            }
                            else if($type == "HWN" || $type == "PD")
                            {
	                            require("view_keterangan_v3.php");
                            }
                            else if ($type == "KI2" || $type == "KI3"|| $type == "KI4")
                            {
	                            require("viewkios_v2.php");
                            }
                            else if ($type == "RUK")
                            {
	                            require("viewruko_v2.php");
                            }
                            else {

	                            echo "TIDAK ADA YANG DIAPPRASIAL";
                            }


                            //if($cust_jeniscol=="BA1" || $cust_jeniscol=="RUK" || $cust_jeniscol=="KI2" || $cust_jeniscol=="TAN" || $cust_jeniscol=="V01" )
								if(1)
                            {

  $custcif = "";
	$strsql="SELECT * FROM Tbl_CustomerMasterPerson2
      				 WHERE custnomid='$custnomid'";
	$sqlcon = sqlsrv_query($conn, $strsql);
	if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlcon))
	{
		if($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
		{
			$custcif = $rows['custaplno'];
		}
	}

    $statusdoc="";
    $kondisistatusdoc = "";
		$strsqlv01="SELECT * FROM Tbl_DocPerson WHERE doc_segmen = 'APR'";
		$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
		if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
		if(sqlsrv_has_rows($sqlconv01))
		{
			while($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
			{
		    $statusdoc .= $rowsv01['doc_id'] . ",";
        $kondisistatusdoc .= "doc_type='" . $rowsv01['doc_id'] . "' or ";
			}
		}

    if ($kondisistatusdoc != "")
    {
	     $kondisistatusdoc = "AND (" . substr($kondisistatusdoc,0,strlen($kondisistatusdoc)-3) . ")";
    } 

  $ipdm = "";
  $userdm = "";
	$strsql="select control_value from ms_control where control_code='IPDM'";
	//echo $strsql;
	$sqlcon = sqlsrv_query($conn, $strsql);
	if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlcon))
	{
		if($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_NUMERIC))
		{
	 		$arrsplit=explode(",",$rows[0]);
	 		$ipdm = $arrsplit[0];
	 		$userdm = $arrsplit[1];
		}
	}
$key = $custcif . "_" . $custnomid;
$linkdmI = $ipdm. '/external_upload.php?dmuserid=' . $userdm . '&username=user&userpwd=ee11cbb19052e40b07aac0ca060c23ee&dmuserorganization=PRIVATE&thecabinet=eILk6fO0&dmbranchcode=' . $userbranch . '&act=upload&key=' . $key . '&dmstatusdoc=' . $statusdoc;
$linkdmA = $ipdm. '/external_view.php?dmuserid=' . $userdm . '&username=user&userpwd=ee11cbb19052e40b07aac0ca060c23ee&dmuserorganization=PRIVATE&thecabinet=eILk6fO0&dmbranchcode=' . $userbranch . '&act=cek&key=' . $key . '&dmstatusdoc=' . $statusdoc;
$linkdmV = $ipdm. '/external_view2.php?dmuserid=' . $userdm . '&username=user&userpwd=ee11cbb19052e40b07aac0ca060c23ee&dmuserorganization=PRIVATE&thecabinet=eILk6fO0&dmbranchcode=' . $userbranch . '&act=view&key=' . $key . '&dmstatusdoc=' . $statusdoc;
?>
                             <IFRAME WIDTH=100% HEIGHT=800 MARGINWIDTH=0 MARGINHEIGHT=0 HSPACE=0 VSPACE=0 FRAMEBORDER=0 SCROLLING=no SRC='<? echo $linkdmV ?>'></iframe>
<?
                            }
?>
                            
                        </div>
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