<?php
$_collateral_id="";
$_cond_code="";
$_type="";
$_merk="";
$_model="";
$_jns_kendaraan="";
$_thnpembuatan="";
$_silinder_isi="";
$_silinder_wrn="";
$_norangka="";
$_nomesin="";
$_bpkb_tgl="";
$_stnk_exp="";
$_faktur_tgl="";
$_bahanbakar="";
$_bpkb_nama="";
$_bpkb_addr1="";
$_bpkb_addr2="";
$_bpkb_addr3="";
$_perlengkapan="";
$_notes="";
$_opini="";
$_officer_code="";
$_tanggal_kunjungan="";

$tsql = "select * from appraisal_vhc where _collateral_id = '".$col_id."'";
//echo $tsql;
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);
$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
$rowCount = sqlsrv_num_rows($sqlConn);
if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
if(sqlsrv_has_rows($sqlConn))
{
    while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
    {
        
        $_cond_code=str_replace("||","'",$row['_cond_code']);
        $_type=str_replace("||","'",$row['_type']);
        $_merk=str_replace("||","'",$row['_merk']);
        $_model=str_replace("||","'",$row['_model']);
        $_jns_kendaraan=str_replace("||","'",$row['_jns_kendaraan']);
        $_thnpembuatan=str_replace("||","'",$row['_thnpembuatan']);
        $_silinder_isi=str_replace("||","'",$row['_silinder_isi']);
        $_silinder_wrn=str_replace("||","'",$row['_silinder_wrn']);
        $_norangka=str_replace("||","'",$row['_norangka']);
        $_nomesin=str_replace("||","'",$row['_nomesin']);
        $_bpkb_tgl=str_replace("||","'",$row['_bpkb_tgl']);
        $_stnk_exp=str_replace("||","'",$row['_stnk_exp']);
        $_faktur_tgl=str_replace("||","'",$row['_faktur_tgl']);
        $_bahanbakar=str_replace("||","'",$row['_bahanbakar']);
        $_bpkb_nama=str_replace("||","'",$row['_bpkb_nama']);
        $_bpkb_addr1=str_replace("||","'",$row['_bpkb_addr1']);
        $_bpkb_addr2=str_replace("||","'",$row['_bpkb_addr2']);
        $_bpkb_addr3=str_replace("||","'",$row['_bpkb_addr3']);
        $_perlengkapan=str_replace("||","'",$row['_perlengkapan']);
        $_notes=str_replace("||","'",$row['_notes']);
        $_opini=str_replace("||","'",$row['_opini']);
        $_officer_code=str_replace("||","'",$row['_officer_code']);
        $_tanggal_kunjungan=str_replace("||","'",$row['_tanggal_kunjungan']);
    }
}

//echo $_opini;

//appraisal_tnb
?>



<?
if($customername==""){
?>
<table border="0" style="border:0px solid black;width:100%;">
    <tr>
        <td valign="top" style="width:50%">
            <table style="width:100%;">
                <tr>
                <td style="width:150px">Kode officer</td>
                <td><?=$_officer_code;?></td>
                </tr>
            </table>
        </td>
        <td valign="top" style="width:50%">&nbsp;
        </td>
    </tr>
</table>    
<?
}
else
{
?>
<table border="0" style="border:0px solid black;width:100%;">
    <tr>
        <td valign="top" style="width:50%">
            <table style="width:100%;">
                <tr>
                <td style="width:150px">Nama Debitur</td>
                <td><?=$customername;?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>    
<?	
}
?>

<hr>
<table border="0" style="border:0px solid black;width:100%;">
    <tr>
        <td valign="top" style="width:50%">
            <table style="width:100%;">
                <tr>
                    <td style="width:150px">Kondisi</td>
                    <td><?=$_cond_code;?></td>
                </tr>
                <tr>
                    <td>Tipe</td>
                    <td><?=$_type;?></td>
                </tr>
                <tr>
                    <td>Merek</td>
                    <td><?=$_merk;?></td>
                </tr>
                <tr>
                    <td>Model</td>
                    <td><?=$_model;?></td>
                </tr>
                <tr>
                    <td>Jenis Kendaraan</td>
                    <td><?=$_jns_kendaraan;?></td>
                </tr>
                <tr>
                    <td>Tahun Pembuatan</td>
                    <td><?=$_thnpembuatan;?></td>
                </tr>
                <tr>
                    <td>Silinder Isi</td>
                    <td><?=$_silinder_isi;?></td>
                </tr>
                <tr>
                    <td>Silinder Warna</td>
                    <td><?=$_silinder_wrn;?></td>
                </tr>
                <tr>
                    <td>No Rangka</td>
                    <td><?=$_norangka;?></td>
                </tr>
                <tr>
                    <td>No Mesin</td>
                    <td><?=$_nomesin;?></td>
                </tr>
            </table>
        </td>
        <td valign="top" style="width:50%">
            <table style="width:100%;">
                <tr>
                    <td style="width:150px">Nama BPKB</td>
                    <td><?=$_bpkb_nama;?></td>
                </tr>
                <tr>
                    <td>Alamat BPKB 1</td>
                    <td><?=$_bpkb_addr1;?></td>
                </tr>
                <tr>
                    <td>Alamat BPKB 2</td>
                    <td><?=$_bpkb_addr2;?></td>
                </tr>
                <tr>
                    <td>Alamat BPKB 3</td>
                    <td><?=$_bpkb_addr3;?></td>
                </tr>
                <tr>
                    <td>Tanggal BPKB</td>
                    <td><?=$_bpkb_tgl;?></td>
                </tr>
                <tr>
                    <td>Expired STNK</td>
                    <td><?=$_stnk_exp;?></td>
                </tr>
                <tr>
                    <td>Faktur Tanggal</td>
                    <td><?=$_faktur_tgl;?></td>
                </tr>
                <tr>
                    <td>Bahan Bakar</td>
                    <td><?=$_bahanbakar;?></td>
                </tr>
                <tr>
                    <td>Perlengkapan</td>
                    <td><?=$_perlengkapan;?></td>
                </tr>
				<tr>
                    <td>Tanggal Kunjungan</td>
                    <td><?=$_tanggal_kunjungan;?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<hr>
<?
if($customername==""){
?>
<table border="0" style="border:0px solid black;width:100%;">
    <tr>
        <td>
            <table style="width:100%;">
                <tr>
                    <td valign="top" style="width:150px">Notes</td>
                    <td><?=nl2br($_notes);?></td>
                </tr>
                <tr>
                    <td valign="top" style="width:150px">Opini</td>
                    <td><?=nl2br($_opini);?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?
}
?>
