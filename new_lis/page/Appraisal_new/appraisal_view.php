<?

require("../../lib/open_conAPPR.php");
require("../../lib/formatError.php");
require("../../requirepage/parameter.php");

$maxofficer = 2;
$x = 1;

$v_luas_tnh = 0;
$v_luas_bang = 0;
$value_smf = 0;
$value_sm = 0;
$_col_tan = "";
$_col_tnb = "";
$_col_vhc = "";



//echo $_POST['theid'];

$theid = isset($_REQUEST['col_id']) ? $_REQUEST['col_id'] : '';



//echo $_POST['theid'];
$appjenis="";
$strsql = "SELECT * FROM Tbl_Cust_MasterCol WHERE col_id = '$theid'";
//echo $strsql;
$sqlcon = sqlsrv_query($conn, $strsql);
if ($sqlcon === false) die(FormatErrors(sqlsrv_errors()));
if (sqlsrv_has_rows($sqlcon)) {
if ($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC)) {
$appjenis = $rows['cust_jeniscol'];
}
}

$nama_jaminan="";
$col_cef="";
$strsql = "SELECT * FROM TblCollateralType WHERE col_code = '$appjenis'";
//echo $strsql;
$sqlcon = sqlsrv_query($conn, $strsql);
if ($sqlcon === false) die(FormatErrors(sqlsrv_errors()));
if (sqlsrv_has_rows($sqlcon)) {
if ($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC)) {
	$nama_jaminan= $rows['col_name'];
	$col_cef= $rows['col_cef'];

}
}



$strsql = "SELECT * FROM appraisal_custmaster WHERE _custnomid = '$custnomid'";
$sqlcon = sqlsrv_query($conn, $strsql);
if ($sqlcon === false) die(FormatErrors(sqlsrv_errors()));
if (sqlsrv_has_rows($sqlcon)) {
if ($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC)) {
$list_type = $rows['_cust_listype'];
}
}

if ($appjenis == "V01" || $appjenis == "V02" || $appjenis == "V03" || $appjenis == "V04") {
$_col_vhc = "";
$strsqlv01 = "SELECT * FROM appraisal_vhc WHERE _collateral_id = '$theid'";
//echo $strsqlv01;
$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
if ($sqlconv01 === false) die(FormatErrors(sqlsrv_errors()));
if (sqlsrv_has_rows($sqlconv01)) {
if ($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC)) {
$v_type = $rowsv01['_type'];
//echo $v_type;
$v_merk = $rowsv01['_merk'];
$v_model = $rowsv01['_model'];
$v_jns = $rowsv01['_jns_kendaraan'];
$v_thnpem = $rowsv01['_thnpembuatan'];
$v_silinder_isi = $rowsv01['_silinder_isi'];
$v_silinder_warna = $rowsv01['_silinder_wrn'];
$v_norangka = $rowsv01['_norangka'];
$v_nomesin = $rowsv01['_nomesin'];
$v_bpkb_tgl = $rowsv01['_bpkb_tgl'];
$v_stnk_exp = $rowsv01['_stnk_exp'];
$v_faktur_tgl = $rowsv01['_faktur_tgl'];
$v_bahanbakar = $rowsv01['_bahanbakar'];
$v_bpkb_nama = $rowsv01['_bpkb_nama'];
$v_bpkb_addr1 = $rowsv01['_bpkb_addr1'];
$v_bpkb_addr2 = $rowsv01['_bpkb_addr2'];
$v_bpkb_addr3 = $rowsv01['_bpkb_addr3'];
$v_perlengkapan = $rowsv01['_perlengkapan'];
$v_notes = $rowsv01['_notes'];
$v_opini = $rowsv01['_opini'];
}
}

$strsqlv01 = "SELECT * FROM appraisal_vhc_value WHERE _collateral_id = '$theid'";
//echo $strsqlv01;
$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
if ($sqlconv01 === false) die(FormatErrors(sqlsrv_errors()));
if (sqlsrv_has_rows($sqlconv01)) {
if ($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC)) {
$_col_vhc = $rowsv01['_collateral_id'];
$value_kend = $rowsv01['_nilai_kendaraan'];
//echo $v_type;
$value_savety = $rowsv01['_safety_margin'];
$value_likuidasi = $rowsv01['_nilai_likuidasi'];
$value_opini = $rowsv01['_opini'];
$value_jml = $rowsv01['jml'];
}
}
} else if ($appjenis == "BA2" || $appjenis == "BA3" || $appjenis == "KI2" || $appjenis == "KI3" || $appjenis == "KI4") {
$v_sertifikat = "";
$v_imb = "";
$_col_tnb = "";
$strsqlv01 = "SELECT * FROM appraisal_tnb WHERE _collateral_id = '$theid'";
//echo $strsqlv01;
$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
if ($sqlconv01 === false) die(FormatErrors(sqlsrv_errors()));
if (sqlsrv_has_rows($sqlconv01)) {
if ($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC)) {
$v_type = $rowsv01['_type_jaminan'];
//echo $v_type;
$v_lokasi = $rowsv01['_lokasi_rumah'];
$v_jmllnt = $rowsv01['_jumlah_lantai'];
$v_luas_bang = $rowsv01['_luas_bangunan'];
$v_panj_bang = $rowsv01['_panjang_bangunan'];
$v_leb_bang = $rowsv01['_lebar_bangunan'];
$v_arah_bang = $rowsv01['_arah_bangunan'];
$v_umur_bang = $rowsv01['_umur_bangunan'];
$v_thn_bang = $rowsv01['_tahun_dibangun'];
$v_thn_renov = $rowsv01['_tahun_renovasi'];
$v_luas_tnh = $rowsv01['_luas_tanah'];
$v_pan_tnh = $rowsv01['_panjang_tanah'];
$v_leb_tnh = $rowsv01['_lebar_tanah'];
$v_utara = $rowsv01['_sisi_utara'];
$v_timur = $rowsv01['_sisi_timur'];
$v_selatan = $rowsv01['_sisi_selatan'];
$v_barat = $rowsv01['_sisi_barat'];
$v_lat = $rowsv01['_latitude'];
$v_long = $rowsv01['_longitude'];
$v_notes = $rowsv01['_notes'];
$v_opini = $rowsv01['_opini'];
}
}

$strsqlv01 = "SELECT * FROM appraisal_tnb_value WHERE _collateral_id = '$theid'";
//echo $strsqlv01;
$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
if ($sqlconv01 === false) die(FormatErrors(sqlsrv_errors()));
if (sqlsrv_has_rows($sqlconv01)) {
if ($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC)) {
$_col_tnb = $rowsv01['_collateral_id'];
$value_tnhpm = $rowsv01['_nilai_tanah_perm2'];
//echo $v_type;
$value_tnht = $rowsv01['_nilai_tanah_total'];
$value_lbf = $rowsv01['_luas_bang_fisik'];
$value_bfpm = $rowsv01['_nilai_bang_fisik_perm2'];
$value_bft = $rowsv01['_nilai_bang_fisik_total'];
$value_bimb = $rowsv01['_luas_bang_imb'];
$value_bimbpm = $rowsv01['_nilai_bangunan_perm2'];
$value_bimbt = $rowsv01['_nilai_bangunan_total'];
$value_tf = $rowsv01['_nilai_total_fisik'];
$value_ti = $rowsv01['_nilai_total_imb'];
$value_sm = $rowsv01['_cef_tanah'];
$value_lf = $rowsv01['_nilai_cef_bangunan'];
$value_li = $rowsv01['_nilai_cef_tanah'];
$value_bfp = $rowsv01['_nilai_bang_fisik_percent'];
$value_bip = $rowsv01['_nilai_bang_imb_percent'];
$value_smf = $rowsv01['_cef_bangunan'];
$value_op = $rowsv01['_opini'];
$_nilai_total_fisik_agunan = $rowsv01['_nilai_total_fisik_agunan'];
$_nilai_total_cef_agunan = $rowsv01['_nilai_total_cef_agunan'];
$luas_bangunan = $rowsv01['_luas_bangunan'];
}
}
} else if ($appjenis == "TN1" || $appjenis == "TAN" || $appjenis == "TPR") {
$_col_tan = "";
$strsqlv01 = "SELECT * FROM appraisal_lnd WHERE _collateral_id = '$theid'";
//echo $strsqlv01;
$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
if ($sqlconv01 === false) die(FormatErrors(sqlsrv_errors()));
if (sqlsrv_has_rows($sqlconv01)) {
if ($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC)) {
$v_luas_tnh = $rowsv01['_luas_tanah'];
$v_pan_tnh = $rowsv01['_panjang_tanah'];
$v_leb_tnh = $rowsv01['_lebar_tanah'];
$v_utara = $rowsv01['_sisi_utara'];
$v_timur = $rowsv01['_sisi_timur'];
$v_selatan = $rowsv01['_sisi_selatan'];
$v_barat = $rowsv01['_sisi_barat'];
$v_lat = $rowsv01['_latitude'];
$v_long = $rowsv01['_longitude'];
$v_notes = $rowsv01['_notes'];
$v_opini = $rowsv01['_opini'];
}
}

$strsqlv01 = "SELECT * FROM appraisal_lnd_value WHERE _collateral_id = '$theid'";
//echo $strsqlv01;
$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
if ($sqlconv01 === false) die(FormatErrors(sqlsrv_errors()));
if (sqlsrv_has_rows($sqlconv01)) {
if ($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC)) {
$_col_tan = $rowsv01['_collateral_id'];
$value_tnhpm = $rowsv01['_nilai_tanah_perm2'];
//echo $v_type;
$value_tnht = $rowsv01['_nilai_tanah_total'];
$value_sm = $rowsv01['_safety_margin'];
$value_lf = $rowsv01['_nilai_likuidasi'];
$value_op = $rowsv01['_opini'];
}
}
}
?>
<html>
    <head>
        <title>Appraisal</title>
        <script type="text/javascript" src="../../js/datetimepicker_css.js"></script>
        <script type="text/javascript" src="../../js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="../../js/full_function.js"></script>
        <script type="text/javascript" src="../../js/accounting.js"></script>
        <script type="text/javascript" src="../../js/my.js"></script>
        <link href="../../css/d.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript">
           
        </script>
    </head>
    <body style="margin:0;">
        <div style="padding:0px;margin:0px;"><img src="../../images/header_lis2.jpg"></img></div>
        <br><br><br>
        <form id="frm" name="frm" method="post" action="appraisal_cef.php">
            <div class="divcenter">
                <table id="tblform" border="1" style="width:900px; border-color:black;" cellspacing="0">
                    <tr>
                        <td colspan="2">
                            <table>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><h3>FORM ENTRY APPRAISAL VALUE (<? echo $custnomid ?>) </h3></td>
                                </tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td><a href="../flow.php?&userwfid=<?= $userwfid ?>&userpermission=<?= $userpermission ?>&buttonaction=<?= $buttonaction ?>&userbranch=<?= $userbranch ?>&userregion=<?= $userregion ?>&userid=<?= $userid ?>&userpwd=<?= $userpwd ?>">back to flow</a></td>
								</tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <table>
                                <tr>
<?php
$strsqlv01 = "select * from Tbl_Cust_MasterCol a
														join TblCollateralType b on a.cust_jeniscol = b.col_code
														and ap_lisregno = '$custnomid'";
$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
if ($sqlconv01 === false)
    die(FormatErrors(sqlsrv_errors()));
if (sqlsrv_has_rows($sqlconv01)) {
    while ($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC)) {





        $m_col_id = $rowsv01['col_id'];
        $m_cust_jeniscol = $rowsv01['cust_jeniscol'];
        $col_name = $rowsv01['col_name'];
        ?>


                                        <a href="appraisal_view.php?custnomid=<?= $custnomid ?>&userwfid=<?= $userwfid ?>&userpermission=<?= $userpermission ?>&buttonaction=<?= $buttonaction ?>&userbranch=<?= $userbranch ?>&userregion=<?= $userregion ?>&userid=<?= $userid ?>&userpwd=<?= $userpwd ?>&jeniscol=<?= $m_cust_jeniscol ?>&col_id=<?= $m_col_id ?>"><? echo $col_name ?></A>&nbsp
                                        &nbsp
                                        <?
                                        }
                                        }
                                        ?>
                            </tr>
                        </table>
                        </td>
                        </tr>


                        <?


                        /*
                        START HERE

                        */

                        ?>
                        <tr>
                            <td colspan="2">
                                <?
                                $deskripsi="";
	$tglkunjungan="";
	$harga1="0";
	$harga2="0";
	$officer="";
	$keterangan="";
	$cretedate="";
	$creteby="";
	
	$strsqlv01="SELECT * FROM appraisal_datapembanding2 WHERE col_id = '$theid'";
	$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
	if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlconv01))
	{
		while($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
		{
			$id=$rowsv01['id'];
			$custnomid=$rowsv01['custnomid'];
			$col_code=$rowsv01['col_code'];
			 $col_id=$rowsv01['col_id'];
			$deskripsi=$rowsv01['deskripsi'];
			$tglkunjungan=$rowsv01['tglkunjungan'];
			$harga1=$rowsv01['harga1'];
			$harga2=$rowsv01['harga2'];
			//echo "Harga 1 = ".number_format($harga2);
			//echo "<br>";
			//echo "Harga 2 = ".number_format($harga2);
			$officer=$rowsv01['officer'];
			$keterangan=$rowsv01['keterangan'];
			$cretedate="asd";
			$creteby=$rowsv01['creteby'];

			include("box_compare_data.php");
		}
	}

                                

                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:50%" valign="top" rowspan="2">

        <?php
        //V01


        if ($appjenis == "V01" || $appjenis == "V02" || $appjenis == "V03" || $appjenis == "V04") {
            ?>
                                    <table class="tbl100">
                                        <tr>
                                            <td colspan="2"><h4>DATA KENDARAAN</h4></td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Type Kendaraan</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_type; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Merk Kendaraan</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_merk; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Model Kendaraan</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_model; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Jenis Kendaraan</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_jns; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Tahun Pembuatan</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_thnpem; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Isi Silinder</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_silinder_isi; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Warna Silinder</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_silinder_warna; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Nomer Rangka</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_norangka; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Nomer Mesin</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_nomesin; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Tanggal BPKB</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_bpkb_tgl; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">STNK Expired</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_stnk_exp; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Tanggal Faktur</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_faktur_tgl; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Bahan Bakar</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_bahanbakar; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Nama BPKB</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_bpkb_nama; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Alamat BPKB</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_bpkb_addr1; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Perlengkapan</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_perlengkapan; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Notes</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_notes; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Opini</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_opini; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">&nbsp;</td>
                                            <td style="width:500px;">
                                                &nbsp;
                                            </td>
                                        </tr>
                                    </table>
            <?php
        } else if ($appjenis == "BA2" || $appjenis == "BA3" || $appjenis == "KI2" || $appjenis == "KI3" || $appjenis == "KI4") {
            ?>

                                    <!--tanah dan bangunan -->
                                    <table class="tbl100">
                                        <tr>
                                            <td colspan="2"><h4>DATA TANAH DAN BANGUNAN</h4></td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Type Jaminan</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_type; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Lokasi Rumah</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_lokasi; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Sertifikat</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_sertifikat; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">IMB</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_imb; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Jumlah Lantai</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_jmllnt; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Luas Bangunan</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_luas_bang; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Luas Tanah</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_luas_tnh; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Arah Bangunan</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_arah_bang; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Umur Bangunan</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_umur_bang; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Tahun Dibangun</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_thn_bang; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Tahun Renovasi</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_thn_renov; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Sisi Utara</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_utara; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Sisi Timur</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_timur; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Sisi Selatan</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_selatan; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Sisi Barat</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_barat; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Latitude</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_lat; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Longitude</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_long; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Notes</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_notes; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Opini</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_opini; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">&nbsp;</td>
                                            <td style="width:500px;">
                                                &nbsp;
                                            </td>
                                        </tr>
                                    </table>

            <?php
        } else if ($appjenis == "TN1" || $appjenis == "TAN" || $appjenis == "TPR") {
            ?>

                                    <!--
                                                                    tanah
                                    -->

                                    <table class="tbl100">
                                        <tr>
                                            <td colspan="2"><h4>DATA TANAH</h4></td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Luas Tanah</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_luas_tnh; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Panjang Tanah</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_pan_tnh; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Lebar Tanah</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_leb_tnh; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Sisi Utara</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_utara; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Sisi Timur</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_timur; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Sisi Selatan</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_selatan; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Sisi Barat</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_barat; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Latitude</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_lat; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Longitude</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_long; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Notes</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_notes; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">Opini</td>
                                            <td style="width:500px;">
                                                : <?php echo $v_opini; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:300px;">&nbsp;</td>
                                            <td style="width:500px;">
                                                &nbsp;
                                            </td>
                                        </tr>
                                    </table>
            <?php
        }
        ?>


                            </td>
                            <td style="width:50%" valign="top">
							
							<?
							$nilai_jaminan=0;
							?>
							
							<script>
								function hitung(id) {
									var col_cef=  <?=$col_cef?>;
									var newStr = $("#"+id).val().replace(/,/g, '');
									 perhitungan= col_cef/100*newStr;
									
									$("#nominalcef").val(accounting.formatMoney(perhitungan));
									$("#nominalcef2").html(accounting.formatMoney(perhitungan));
			
								}
							</script>
							<?php
							if($appjenis!=""){
								
								$keterangan="";
								$nilai_cef=0;
								$strsql = "SELECT * FROM tbl_cef WHERE [col_id] = '$theid'";
								//echo $strsql;
								$sqlcon = sqlsrv_query($conn, $strsql);
								if ($sqlcon === false) die(FormatErrors(sqlsrv_errors()));
								if (sqlsrv_has_rows($sqlcon)) {
								if ($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC)) {
									$nilai_jaminan= $rows['nilai_jaminan'];
									$nilai_cef= $rows['nilai_cef'];
									$persentase_cef= $rows['persentase_cef'];
									$keterangan= $rows['keterangan'];
									$officer1= $rows['officer1'];
									$officer2= $rows['officer2'];

								}
								}
								
								
								
								
								?>
							
								<table class="tbl100" border="0">
                                        <tr>
                                            <td colspan="2"><h4>DATA CEF</h4></td>
                                        </tr>
                                       
                                        <tr>
                                            <td style="width:100px;">Nilai Jaminan</td>
                                            <td style="width:10px;">: </td>
											<td>
											
											<label><?=number_format($nilai_jaminan)?></label>
											</td>
                                        </tr>
                                        <tr>
                                            <td>CEF</td>
                                            <td>:</td>
											<td><?=$col_cef?></td>
											 
                                        </tr>
                                        <tr>
                                            <td>nilai cef</td>
                                            <td>:</td>
											<td> 
												<div id="nominalcef2"><?=number_format($col_cef / 100 * $nilai_jaminan) ;?></div>
												<input  type="hidden" id="nominalcef" name="nominalcef" readonly = "readonly" value="<??>"/> 
												<input  type="hidden" id="col_id" name="col_id" value="<?=$theid?>"/> 
												<input  type="hidden" id="col_code" name="col_code" value="<?=$appjenis?>"/> 
											</td>
                                        </tr>
										 <tr>
                                            <td>keterangan</td>
                                            <td>:</td>
											<td>
												<p id="keterangan" name="keterangan" style="width:100%;"><?=$keterangan?></p>
											</td>
                                        </tr>
										
										<?
										while($x <=$maxofficer)
										{
											$off = "";
											$name = "";
											$strsqlv02="SELECT * FROM appraisal_officer where custnom_id = '$custnomid' and seq = '$x'";
											$sqlconv02 = sqlsrv_query($conn, $strsqlv02);
											if ( $sqlconv02 === false)die( FormatErrors( sqlsrv_errors() ) );
											if(sqlsrv_has_rows($sqlconv02))
											{
												while($rowsv02 = sqlsrv_fetch_array($sqlconv02, SQLSRV_FETCH_ASSOC))
												{
													$off = $rowsv02['officer_id'];
												}
											}
//											$strsqlv01="SELECT * FROM appraisal_paramofficer where _appraiser_id = '$off'";
                                            if ($off != "")
											{
											   $strsqlv01="SELECT user_name FROM tbl_se_user where user_id = '$off'";
											   $sqlconv01 = sqlsrv_query($conn, $strsqlv01);
											   if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
											   if(sqlsrv_has_rows($sqlconv01))
											   {
												while($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
												{
													$name = $rowsv01['user_name'];
												}
											   }
											}
											
									?>
									<tr>
										<td>Officer <?=$x;?></td>
										<td>:</td>
										<td><?=$name;?></td>
									</tr>
									<?
											$x++;
										}
									?>
										
										<tr>
                                            <td colspan="3">
											<!--<button type="submit">save</submit>-->
											</td>
                                        </tr>
										
                                    </table>
							<?php 
							}
							?>
                            </td>
                        </tr>

        <?php
        /*
          end here
         */
        ?>


                <?
                ?>
                </table>
                <div>&nbsp;</div>
                <?
                //					require ("../../requirepage/hiddenfield.php");
                if($userid != "")
                {
				//	echo $_SERVER['SCRIPT_FILENAME'];
					
				//$path = $_SERVER['SCRIPT_FILENAME'];
				//$file = basename($path);         
                //echo $file = basename($path, ".php");
                
                

                require ("../../requirepage/hiddenfield.php");
				
				
                }
                require("../../requirepage/btnprint.php");
                ?>
                <input type="hidden" id="theid" name="theid"/>
                <input type="hidden" id="thecolid" name="thecolid"/>
        </form>
		
		<form method="POST" action="safe_vlow.php">
		<?
        require ("../../requirepage/hiddenfield.php");
		?>
		<button type="submit" value="submit" style="background-color:blue;color:white;">Submit Flow</button>
		</form>
		
		<?
				//require("../../requirepage/backtoflow.php");
		?>

    </body>
</html>

