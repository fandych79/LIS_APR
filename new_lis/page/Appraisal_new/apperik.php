<?php
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
$ap_lisregno = $custnomid;
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
                    var ext = $(this).val().substring($(this).val().lastIndexOf('.') + 1).toLowerCase();
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
                aaaaaaa
                {
                    background:FF00FF;
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
        <form id="frm" method="post" action="eriksave.php" enctype="multipart/form-data">
            <table align="center" id="tblform" border="1" style ="width:1000px; border-color:black;border-collapse:collapse;">
                <tr>
                    <td style="padding:20px 15 20 15px">
                    <!---->
                        <h2>APPRAISAL</h2>
                        <hr>
                        
                            <?php
                                
                                $url = "./apperik.php?custnomid=$custnomid&userwfid=$userwfid&userpermission=$userpermission&buttonaction=$buttonaction&userbranch=$userbranch&userregion=$userregion&userid=$userid&userpwd=$userpwd";
                                $tsql = "select a.*, b.col_name as jenis_col from Tbl_Cust_MasterCol a, TblCollateralType b 
                                        where a.cust_jeniscol = b.col_code
										and a.ap_lisregno = '".$custnomid."' 
                                        and a.flaginsert = '1' 
                                        and a.flagdelete = '0'
                                        order by a.inserttime asc;
                                        
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
                                    <?php
                                    
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
                                           
                                        
                                        $rowCount1=0;
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

                            echo "<pre><code>".$cust_jeniscol."</pre></code>";

                            $type_name=$type = $cust_jeniscol;
                            
                            if($cust_jeniscol=="BA1" || $cust_jeniscol=="BA2"|| $cust_jeniscol=="BA3")
                            {
								require("eriktnb.php");
                            }
                            else if($cust_jeniscol=="TAN" || $cust_jeniscol=="TPR" || $cust_jeniscol=="TN1")
                            {
                                require("entrytpr_v3.php");
                            }
                            else if($cust_jeniscol=="V01" || $cust_jeniscol=="V02"|| $cust_jeniscol=="V03"|| $cust_jeniscol=="V04")
                            {
                                require("erikvhc.php");
                            }
							else if($cust_jeniscol=="G01" || $cust_jeniscol=="G02" || $cust_jeniscol=="AB1" || $cust_jeniscol=="AB2" || $cust_jeniscol=="AB3" || $cust_jeniscol=="AB4")
                            {
                                require("entrymesin_v3.php");
                            }
							else if($cust_jeniscol=="KI2" || $cust_jeniscol=="KI3" || $cust_jeniscol=="KI4")
                            {
                                require("entrykios_v2.php");
                            }
                            else if($cust_jeniscol == "GLD") {

	                            require("entrygld_v3.php");
                            }
                            else if($cust_jeniscol == "GLP") {

	                            require("entryglp_v3.php");
                            }
                            else if($cust_jeniscol == "HWN" || $cust_jeniscol == "PD")
                            {
	                            require("entry_keterangan_v3.php");
                            }
                            else if($cust_jeniscol=="RUK")
                            {
	                            require("entryruko_v2.php");
                            }
                            else
                            {
                                echo "TIDAK ADA YANG DIAPPRASIAL";
                            }
                      
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
		//$strsqlv01="SELECT * FROM Tbl_DocPerson WHERE doc_segmen = '$cust_jeniscol' AND doc_active = 'y'";
		$strsqlv01="SELECT * FROM Tbl_DocPerson WHERE doc_segmen = 'APR' AND doc_active = 'y'";
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
	//echo $strsqlv01;
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
    <Script Language="JavaScript">
			function uploadDocument(thelink)
			{
				varwidth = 980;
				varheight = 640;
				varx = 0;
				vary = 0;
				window.open(thelink,'lainnya','scrollbars=yes,width='+varwidth+',height='+varheight+',screenX='+varx+',screenY='+vary+',top='+varx+',left='+vary+',status=yes');
			}
    </Script>


			
				
                            <table border="0" style="border:0px solid black;width:100%;">
                                <tr>
                                    <td colspan="2" align="right">
                                        <button style="width:125px;color:fff;background:#31B0D5;line-height:30px; text-align:center;cursor:pointer;" type="submit"  >Save Data</button>
                                        <Input style="width:125px;color:fff;background:#31B0D5;line-height:30px; text-align:center;cursor:pointer;float:left;" type="button" onclick="window.location.reload()" value="Refresh"></div>
                                    </td>
                                </tr>
                            </table>
								                &nbsp <A HREF="javascript:uploadDocument('<? echo $linkdmI ?>')"><img src="../../bin/img/add_new.png" style="width:30px;"/> Upload Photo</A>
								                <BR>
								                <IFRAME WIDTH=100% HEIGHT=800 MARGINWIDTH=0 MARGINHEIGHT=0 HSPACE=0 VSPACE=0 FRAMEBORDER=0 SCROLLING=no SRC='<? echo $linkdmV ?>'></iframe>
<?
                            
?>                            
				
                        </div>
							 
                    <!---->
                    </td>
                </tr>
			
				
            </table>
			
			
            <div align="center">
            
            <?
			require ("../../requirepage/hiddenfield.php");
			
			
				include ("../../../spindm_new/Source/lib/open_con.php");
				OpenConn();
				
				$querytemp = "SELECT Tbl_DocType.doc_name, Tbl_Document.doc_id, Tbl_Document.doc_index2
	   		                FROM Tbl_Document, Tbl_DocType
	        	            WHERE Tbl_DocType.doc_code=Tbl_Document.doc_index1
	        	            AND Tbl_Document.doc_sticky_notes='PRIVATE'
	        	            AND Tbl_Document.doc_index3='$custnomid'
							AND Tbl_Document.doc_user_upload='appraisal'
	        	            ORDER BY Tbl_Document.doc_index1";
						//echo $querytemp;
				$resulttemp = mysql_query($querytemp);
				$countdoc = mysql_num_rows($resulttemp);
				//echo $countdoc;
				
//                require ("../../requirepage/hiddenfield.php");
				if($userid != "" && $countdoc > 0)
				{
				require ("../../requirepage/btnview.php");
				}
				require ("../../requirepage/hiddenfield.php");
				require("../../requirepage/btnprint.php");
				
            ?>
            <input type="hidden" name="_collateral_id" id="_collateral_id" maxlength="50" value="<?=$col_id;?>"   />
            <input type="hidden" name="cust_jeniscol" id="cust_jeniscol" maxlength="50" value="<?=$cust_jeniscol;?>"   />
            </div>
           
        </form>
	</body>
</html>