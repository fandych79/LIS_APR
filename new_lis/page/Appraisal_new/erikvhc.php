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

if ($_officer_code == "")
{
   $tsql = "select _cust_appraiser_id from appraisal_custmaster where _custnomid = '".$custnomid."'";
   $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   $params = array(&$_POST['query']);
   $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
   $rowCount = sqlsrv_num_rows($sqlConn);
   if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
   if(sqlsrv_has_rows($sqlConn))
   {
      while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
      {
      	$_officer_code = str_replace("\\","'",$row['_cust_appraiser_id']);
      }
  }
}

require ("../../lib/open_conLIS.php");

$tsql = "SELECT * FROM tbl_COL_Vehicle WHERE ap_lisregno = '".$custnomid."' AND col_id = '".$col_id."'";
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);
$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
$rowCount = sqlsrv_num_rows($sqlConn);
if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
if(sqlsrv_has_rows($sqlConn))
{
    while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
    {
		if($_type=="")
		{
			$_type = str_replace("\\","'",$row['col_type']);
		}
		
		if($_merk=="")
		{
			$_merk = str_replace("\\","'",$row['col_merk']);
		}
		
		if($_model=="")
		{
			$_model = str_replace("\\","'",$row['col_model']);
		}
		
		if($_jns_kendaraan=="")
		{
			$_jns_kendaraan = str_replace("\\","'",$row['col_jeniskendaraan']);
		}
		
		if($_thnpembuatan=="")
		{
			$_thnpembuatan = str_replace("\\","'",$row['col_tahunpembuatan']);
		}
		
		if($_silinder_isi=="")
		{
			$_silinder_isi = str_replace("\\","'",$row['col_silinder']);
		}
		
		if($_silinder_wrn=="")
		{
			$_silinder_wrn = str_replace("\\","'",$row['col_warna']);
		}
		
		if($_norangka=="")
		{
			$_norangka = str_replace("\\","'",$row['col_norangka']);
		}
		
		if($_nomesin=="")
		{
			$_nomesin = str_replace("\\","'",$row['col_nomesin']);
		}
		
		if($_bpkb_nama=="")
		{
			$_bpkb_nama = str_replace("\\","'",$row['col_bpkbnama']);
		}
		
		if($_bpkb_addr1=="")
		{
			$_bpkb_addr1 = str_replace("\\","'",$row['col_bpkbaddr1']);
		}
		
		if($_bpkb_tgl=="")
		{
			$_bpkb_tgl = $row['col_bpkbtgl']->format('d/m/Y');
		}
    }
}
require ("../../lib/close_con.php");
require ("../../lib/open_conAPPR.php");

//echo $_opini;

//appraisal_tnb
?>


<table border="0" style="border:0px solid black;width:100%;">
    <tr>
        <td valign="top" style="width:50%">
            <table style="width:100%;">
                <tr>
                <td style="width:150px">Kode officer</td>
                <td><input  eriktype="text" class="erikrequire" type="text" name="_officer_code" id="_officer_code" maxlength="50" readonly=readonly value="<?=$_officer_code;?>"   erikmsg="Kode Officer"/>    </td>
                </tr>
            </table>
        </td>
        <td valign="top" style="width:50%">&nbsp;
        </td>
    </tr>
</table>    
<hr>
<table border="0" style="border:0px solid black;width:100%;">
    <tr>
        <td valign="top" style="width:50%">
            <table style="width:100%;">
                <tr>
                    <td style="width:150px">Kondisi</td>
                    <td><input type="text" name="_cond_code" id="_cond_code" maxlength="50" value="<?=$_cond_code;?>"  erikmsg="Kodisi" /></td>
                </tr>
                <tr>
                    <td>Tipe</td>
                    <td>
                    <input type="text" name="_type" id="_type" maxlength="50" value="<?=$_type;?>"  erikmsg="Tipe" />
                    </td>
                </tr>
                <tr>
                    <td>Merek</td>
                    <td><input type="text" name="_merk" id="_merk" maxlength="50" value="<?=$_merk;?>"  erikmsg="Merek" /></td>
                </tr>
                <tr>
                    <td>Model</td>
                    <td><input type="text" name="_model" id="_model" maxlength="50" value="<?=$_model;?>"  erikmsg="Model" /></td>
                </tr>
                <tr>
                    <td>Jenis Kendaraan</td>
                    <td><input type="text" name="_jns_kendaraan" id="_jns_kendaraan" maxlength="50" value="<?=$_jns_kendaraan;?>"  erikmsg="Jenis Kendaraan" /></td>
                </tr>
                <tr>
                    <td>Tahun Pembuatan</td>
                    <td>
                    <select class="erikrequire" name="_thnpembuatan" id="_thnpembuatan" erikmsg="Tahun Pembuatan">
                        <option value="">-- Pilih Tahun --</option>
                        <?
                            for($x=$yearcurrent;$x>1960;$x--)
                            {
                                $selected="";
                                if($_thnpembuatan==$x)
                                {
                                    $selected = "selected=\"selected\"";
                                }
                                echo "<option ".$selected." value=\"".$x."\">".$x."</option>";
                            }

                        ?>
                    </select>
                    
                    <!--<input type="text" name="_thnpembuatan" id="_thnpembuatan" maxlength="50" value="<?=$_thnpembuatan;?>"  erikmsg="Tahun Pembuatan" />-->
                    
                    </td>
                </tr>
                <tr>
                    <td>Silinder Isi</td>
                    <td><input type="text" name="_silinder_isi" id="_silinder_isi" maxlength="50" value="<?=$_silinder_isi;?>"  erikmsg="Silinder Isi" /></td>
                </tr>
                <tr>
                    <td>Silinder Warna</td>
                    <td><input type="text" name="_silinder_wrn" id="_silinder_wrn" maxlength="50" value="<?=$_silinder_wrn;?>"  erikmsg="" /></td>
                </tr>
                <tr>
                    <td>No Rangka</td>
                    <td><input type="text" name="_norangka" id="_norangka" maxlength="50" value="<?=$_norangka;?>"  erikmsg="No Rangka" /></td>
                </tr>
                <tr>
                    <td>No Mesin</td>
                    <td><input type="text" name="_nomesin" id="_nomesin" maxlength="50" value="<?=$_nomesin;?>"  erikmsg="No Mesin" /></td>
                </tr>
            </table>
        </td>
        <td valign="top" style="width:50%">
            <table style="width:100%;">
            
                <tr>
                    <td style="width:150px">Nama BPKB</td>
                    <td><input type="text" name="_bpkb_nama" id="_bpkb_nama" maxlength="50" value="<?=$_bpkb_nama;?>"  erikmsg="Nama BPKB" /></td>
                </tr>
                <tr>
                    <td>Alamat BPKB 1</td>
                    <td><input type="text" name="_bpkb_addr1" id="_bpkb_addr1" maxlength="50" value="<?=$_bpkb_addr1;?>"  erikmsg="Alamat BPKB 1" /></td>
                </tr>
                <tr>
                    <td>Alamat BPKB 2</td>
                    <td><input type="text" name="_bpkb_addr2" id="_bpkb_addr2" maxlength="50" value="<?=$_bpkb_addr2;?>"  erikmsg="Alamat BPKB 2" /></td>
                </tr>
                <tr>
                    <td>Alamat BPKB 3</td>
                    <td><input type="text" name="_bpkb_addr3" id="_bpkb_addr3" maxlength="50" value="<?=$_bpkb_addr3;?>"  erikmsg="Alamat BPKB 3" /></td>
                </tr>
                <tr>
                    <td>Tanggal BPKB</td>
                    <td><input class="erikrequire" readonly="readonly" onFocus="NewCssCal(this.id,'YYYYMMDD');" type="text" name="_bpkb_tgl" id="_bpkb_tgl" maxlength="50" value="<?=$_bpkb_tgl;?>"  erikmsg="Tanggal BPKB" /></td>
                </tr>
                <tr>
                    <td>Expired STNK</td>
                    <td><input class="erikrequire" readonly="readonly" onFocus="NewCssCal(this.id,'YYYYMMDD');"  type="text" name="_stnk_exp" id="_stnk_exp" maxlength="50" value="<?=$_stnk_exp;?>"  erikmsg="Expired STNK" /></td>
                </tr>
                <tr>
                    <td>Faktur Tanggal</td>
                    <td><input class="erikrequire" readonly="readonly" onFocus="NewCssCal(this.id,'YYYYMMDD');" type="text" name="_faktur_tgl" id="_faktur_tgl" maxlength="50" value="<?=$_faktur_tgl;?>"  erikmsg="Faktur Tanggal" /></td>
                </tr>
                <tr>
                    <td>Bahan Bakar</td>
                    <td><input type="text" name="_bahanbakar" id="_bahanbakar" maxlength="50" value="<?=$_bahanbakar;?>"  erikmsg="Bahan Bakar" /></td>
                </tr>
                <tr>
                    <td>Perlengkapan</td>
                    <td><input type="text" name="_perlengkapan" id="_perlengkapan" maxlength="50" value="<?=$_perlengkapan;?>"  erikmsg="Perlengkapan" /></td>
                </tr>
				<tr>
                    <td>Tanggal Kunjungan</td>
                    <td><input class="erikrequire" readonly="readonly" onFocus="NewCssCal(this.id,'YYYYMMDD');" type="text" name="_tanggal_kunjungan" id="_tanggal_kunjungan" maxlength="50" value="<?=$_tanggal_kunjungan;?>"  erikmsg="Tanggal Kunjungan" /></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<hr>
<table border="0" style="border:0px solid black;width:100%;">
    <tr>
        <td>
            <table style="width:100%;">
                <tr>
                    <td valign="top" style="width:150px">Notes</td>
                    <td><textarea type="text" name="_notes" id="_notes" maxlength="2147483647" rows="" cols="" erikmsg="Notes"><?=$_notes?></textarea></td>
                </tr>
                <tr>
                    <td valign="top" style="width:150px">Opini</td>
                    <td><textarea eriktype="textarea" class="erikrequire" type="text" name="_opini" id="_opini" maxlength="2147483647" rows="" cols="" erikmsg="Opini"><?=$_opini?></textarea></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
