<?php

require ("../../lib/open_conAPPR.php");
require ("../../lib/formatError.php");
require ("../../requirepage/parameter.php");
require ("../../requirepage/security.php");
$_collateral_id = $_POST['_collateral_id'];
//echo "masuk sini";exit;

/*
  BA1 = tanah dan bangunan - view table appraisal_tnb
  RUK = Ruko - view table appraisal_tnb
  KI2 = Kios - view table appraisal_tnb
  TAN = Tanah - view table appraisal_lnd
  V01 = Kendaraan - view table appraisal_vhc
 */
$os = array("BA1", "RUK", "KI2", "TAN", "V01");

$cust_jeniscol = $_POST['cust_jeniscol'];


echo "<pre>";
Print_r($_POST);
echo "</pre>";

echo $type = $cust_jeniscol;
$_collateral_id = str_replace("'", "||", $_REQUEST['_collateral_id']);

/*
  $cust_jeniscol="";
  $tsql = "select cust_jeniscol from Tbl_Cust_MasterCol
  where ap_lisregno = '".$custnomid."'
  and group_col = 'N'
  and flaginsert = '1'
  and flagdelete = '0'
  and col_id ='".$_collateral_id."'";
  $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
  $params = array(&$_POST['query']);
  $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
  $rowCount = sqlsrv_num_rows($sqlConn);
  //echo $rowCount."<br>";
  if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
  if(sqlsrv_has_rows($sqlConn))
  {
  while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
  {
  $cust_jeniscol = $row['cust_jeniscol'];
  }
  }
 */
//echo "halo: ".$cust_jeniscol;


/*
  |	=================================	|
  |         Update Niko DAN erik 		|
  |	=================================	|
 */


$indra = "UPDATE";
if ($indra == "UPDATE") {
    $type = $cust_jeniscol;
    $custnomid = $_POST['custnomid'];
    $userid = $_POST['userid'];
    $userpwd = $_POST['userpwd'];
    $userbranch = $_POST['userbranch'];
    $userregion = $_POST['userregion'];
    $userwfid = $_POST['userwfid'];
    $userpermission = $_POST['userpermission'];
    $buttonaction = $_POST['buttonaction'];

    if ($type == "TAN" || $type == "TPR" || $type == "TN1") {
        $lndap_lisregno = $_POST["lndap_lisregno"];
        $lndcol_id = $_POST["lndcol_id"];
        $lndcol_addr1 = $_POST["lndcol_addr1"];
        $lndcol_addr2 = $_POST["lndcol_addr2"];
        $lndcol_addr3 = $_POST["lndcol_addr3"];
        $lndcol_kodepos = $_POST["lndcol_kodepos"];
        $lndcol_certtype = $_POST["lndcol_certtype"];
        $lndcol_certno = $_POST["lndcol_certno"];
        $lndcol_certatasnama = $_POST["lndcol_certatasnama"];
        $lndcol_luastanah = $_POST["lndcol_luastanah"];
        $lndcol_certdate = $_POST["lndcol_certdate"];
        $lndcol_certdue = $_POST["lndcol_certdue"];
        $lndcol_relcode = $_POST["lndcol_relcode"];
        $lndcol_haktanggungan = $_POST["lndcol_haktanggungan"];
        $lndcol_haktanggungantgl = $_POST["lndcol_haktanggungantgl"];
        $lndcol_identification = $_POST["lndcol_identification"];
        $lndcol_njopyear = $_POST["lndcol_njopyear"];
        $lndcol_njopval = $_POST["lndcol_njopval"];
        $lndcol_remark = $_POST["lndcol_remark"];

        $lndcol_devname = "";
        if ($lndcol_relcode == "DVL") {
            $lndcol_devname = $_POST["lndcol_devname"];
        }

        $lndcol_njopval = str_replace(",", "", $lndcol_njopval);
        if ($lndcol_addr2 == "") {
            $lndcol_addr2 = "-";
        }
        if ($lndcol_addr3 == "") {
            $lndcol_addr3 = "-";
        }
        if ($lndcol_haktanggungan == "") {
            $lndcol_haktanggungan = "-";
        }

        $tsql = "UPDATE appraisal_land SET col_addr1 = '$lndcol_addr1', col_addr2 = '$lndcol_addr2', col_addr3 = '$lndcol_addr3', 
					col_kodepos = '$lndcol_kodepos', col_certtype = '$lndcol_certtype', col_certno = '$lndcol_certno', col_certatasnama = '$lndcol_certatasnama', 
					col_certluas = '$lndcol_luastanah', col_certdate = '$lndcol_certdate', col_certdue = '$lndcol_certdue', col_relcode = '$lndcol_relcode', col_haktanggungan = '$lndcol_haktanggungan', 
					col_haktanggungantgl = '$lndcol_haktanggungantgl', col_identification = '$lndcol_identification', col_njopyear = '$lndcol_njopyear', col_njopval = '$lndcol_njopval', col_remark = '$lndcol_remark'
					WHERE _collateral_id = '$lndcol_id'";

        echo $tsql;
        $params = array(&$_POST['query']);

        $stmt = sqlsrv_prepare($conn, $tsql, $params);
        if ($stmt) {
            
        } else {
            echo "Error in preparing statement.\n";
            die(print_r(sqlsrv_errors(), true));
        }

        if (sqlsrv_execute($stmt)) {
            
        } else {
            echo "Error in executing statement.\n";
            die(print_r(sqlsrv_errors(), true));
        }
        sqlsrv_free_stmt($stmt);
    } else if ($type == "BA1" || $type == "BA2" || $type == "BA3") {

        $tsql = "select * from appraisal_tnb where _collateral_id = '" . $_collateral_id . "'";
        $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
        $params = array(&$_POST['query']);
        $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
        $rowCount = sqlsrv_num_rows($sqlConn);
        $insert1rows = "";
        if ($rowCount == "0") {
            $insert1rows = "   INSERT INTO appraisal_tnb(_collateral_id) VALUES ('" . $_collateral_id . "')";
        }

        $_type_jaminan = str_replace("'", "||", $_REQUEST['_type_jaminan']);
        $_lokasi_rumah = str_replace("'", "||", $_REQUEST['_lokasi_rumah']);
        $_jumlah_lantai = str_replace("'", "||", $_REQUEST['_jumlah_lantai']);
        //$_panjang_bangunan=str_replace("'","||",$_REQUEST['_panjang_bangunan']);
        //$_lebar_bangunan=str_replace("'","||",$_REQUEST['_lebar_bangunan']);
        $_arah_bangunan = str_replace("'", "||", $_REQUEST['_arah_bangunan']);
        $_umur_bangunan = str_replace("'", "||", $_REQUEST['_umur_bangunan']);
        $_tahun_dibangun = str_replace("'", "||", $_REQUEST['_tahun_dibangun']);
        $_tahun_renovasi = str_replace("'", "||", $_REQUEST['_tahun_renovasi']);
        //$_panjang_tanah=str_replace("'","||",$_REQUEST['_panjang_tanah']);
        //$_lebar_tanah=str_replace("'","||",$_REQUEST['_lebar_tanah']);
        $_sisi_utara = str_replace("'", "||", $_REQUEST['_sisi_utara']);
        $_sisi_timur = str_replace("'", "||", $_REQUEST['_sisi_timur']);
        $_sisi_selatan = str_replace("'", "||", $_REQUEST['_sisi_selatan']);
        $_sisi_barat = str_replace("'", "||", $_REQUEST['_sisi_barat']);
        $_latitude = str_replace("'", "||", $_REQUEST['_latitude']);
        $_longitude = str_replace("'", "||", $_REQUEST['_longitude']);
        $_notes = str_replace("'", "||", $_REQUEST['_notes']);
        $_opini = str_replace("'", "||", $_REQUEST['_opini']);
        $_officer_code = str_replace("'", "||", $_REQUEST['_officer_code']);
        $_tanggal_kunjungan = str_replace("'", "||", $_REQUEST['_tanggal_kunjungan']);
        $_luas_bangunan = str_replace("'", "||", $_REQUEST['_luas_bangunan']);
        $_luas_tanah = str_replace("'", "||", $_REQUEST['_luas_tanah']);

        //$_luas_bangunan = $_panjang_bangunan*$_lebar_bangunan;
        //$_luas_tanah = $_panjang_tanah*$_lebar_tanah;
        $strsql = $insert1rows . "   UPDATE appraisal_tnb SET 
                _type_jaminan= '" . $_type_jaminan . "',
                _lokasi_rumah= '" . $_lokasi_rumah . "',
                _jumlah_lantai= '" . $_jumlah_lantai . "',
                _luas_bangunan= '" . $_luas_bangunan . "',
                _panjang_bangunan= '" . $_panjang_bangunan . "',
                _lebar_bangunan= '" . $_lebar_bangunan . "',
                _arah_bangunan= '" . $_arah_bangunan . "',
                _umur_bangunan= '" . $_umur_bangunan . "',
                _tahun_dibangun= '" . $_tahun_dibangun . "',
                _tahun_renovasi= '" . $_tahun_renovasi . "',
                _luas_tanah= '" . $_luas_tanah . "',
                _panjang_tanah= '" . $_panjang_tanah . "',
                _lebar_tanah= '" . $_lebar_tanah . "',
                _sisi_utara= '" . $_sisi_utara . "',
                _sisi_timur= '" . $_sisi_timur . "',
                _sisi_selatan= '" . $_sisi_selatan . "',
                _sisi_barat= '" . $_sisi_barat . "',
                _latitude= '" . $_latitude . "',
                _longitude= '" . $_longitude . "',
                _notes= '" . $_notes . "',
                _opini= '" . $_opini . "',
                _tanggal_kunjungan= '" . $_tanggal_kunjungan . "',
                _officer_code= '" . $_officer_code . "'
                WHERE _collateral_id= '" . $_collateral_id . "'";
        //echo $strsql;
        $stmt = sqlsrv_prepare($conn, $strsql);
        if (!$stmt) {
            echo "Error in preparing statement.\n";
            die(print_r(sqlsrv_errors(), true));
            return false;
        }
        if (!sqlsrv_execute($stmt)) {
            echo "Cannot insert table " . $strsql;
            die(print_r(sqlsrv_errors(), true));
            return false;
        }
        sqlsrv_free_stmt($stmt);


        /*
          echo "_collateral_id ==> ".$_collateral_id."</br>";
          echo "_type_jaminan ==> ".$_type_jaminan."</br>";
          echo "_lokasi_rumah ==> ".$_lokasi_rumah."</br>";
          echo "_jumlah_lantai ==> ".$_jumlah_lantai."</br>";
          echo "_luas_bangunan ==> ".$_luas_bangunan."</br>";
          echo "_panjang_bangunan ==> ".$_panjang_bangunan."</br>";
          echo "_lebar_bangunan ==> ".$_lebar_bangunan."</br>";
          echo "_arah_bangunan ==> ".$_arah_bangunan."</br>";
          echo "_umur_bangunan ==> ".$_umur_bangunan."</br>";
          echo "_tahun_dibangun ==> ".$_tahun_dibangun."</br>";
          echo "_tahun_renovasi ==> ".$_tahun_renovasi."</br>";
          echo "_luas_tanah ==> ".$_luas_tanah."</br>";
          echo "_panjang_tanah ==> ".$_panjang_tanah."</br>";
          echo "_lebar_tanah ==> ".$_lebar_tanah."</br>";
          echo "_sisi_utara ==> ".$_sisi_utara."</br>";
          echo "_sisi_timur ==> ".$_sisi_timur."</br>";
          echo "_sisi_selatan ==> ".$_sisi_selatan."</br>";
          echo "_sisi_barat ==> ".$_sisi_barat."</br>";
          echo "_latitude ==> ".$_latitude."</br>";
          echo "_longitude ==> ".$_longitude."</br>";
          echo "_notes ==> ".$_notes."</br>";
          echo "_opini ==> ".$_opini."</br>";
          echo "_officer_code ==> ".$_officer_code."</br>";
         */
    } else if ($type == "V01" || $type == "V02" || $type == "V03" || $type == "V04") {
        $tsql = "select * from appraisal_vhc where _collateral_id = '" . $_collateral_id . "'";
        $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
        $params = array(&$_POST['query']);
        $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
        $rowCount = sqlsrv_num_rows($sqlConn);
        $insert1rows = "";
        if ($rowCount == "0") {
            $insert1rows = "   INSERT INTO appraisal_vhc(_collateral_id) VALUES ('" . $_collateral_id . "')";
        }


        $_cond_code = str_replace("'", "||", $_REQUEST['_cond_code']);
        $_type = str_replace("'", "||", $_REQUEST['_type']);
        $_merk = str_replace("'", "||", $_REQUEST['_merk']);
        $_model = str_replace("'", "||", $_REQUEST['_model']);
        $_jns_kendaraan = str_replace("'", "||", $_REQUEST['_jns_kendaraan']);
        $_thnpembuatan = str_replace("'", "||", $_REQUEST['_thnpembuatan']);
        $_silinder_isi = str_replace("'", "||", $_REQUEST['_silinder_isi']);
        $_silinder_wrn = str_replace("'", "||", $_REQUEST['_silinder_wrn']);
        $_norangka = str_replace("'", "||", $_REQUEST['_norangka']);
        $_nomesin = str_replace("'", "||", $_REQUEST['_nomesin']);
        $_bpkb_tgl = str_replace("'", "||", $_REQUEST['_bpkb_tgl']);
        $_stnk_exp = str_replace("'", "||", $_REQUEST['_stnk_exp']);
        $_faktur_tgl = str_replace("'", "||", $_REQUEST['_faktur_tgl']);
        $_bahanbakar = str_replace("'", "||", $_REQUEST['_bahanbakar']);
        $_bpkb_nama = str_replace("'", "||", $_REQUEST['_bpkb_nama']);
        $_bpkb_addr1 = str_replace("'", "||", $_REQUEST['_bpkb_addr1']);
        $_bpkb_addr2 = str_replace("'", "||", $_REQUEST['_bpkb_addr2']);
        $_bpkb_addr3 = str_replace("'", "||", $_REQUEST['_bpkb_addr3']);
        $_perlengkapan = str_replace("'", "||", $_REQUEST['_perlengkapan']);
        $_notes = str_replace("'", "||", $_REQUEST['_notes']);
        $_opini = str_replace("'", "||", $_REQUEST['_opini']);
        $_officer_code = str_replace("'", "||", $_REQUEST['_officer_code']);
        $_tanggal_kunjungan = str_replace("'", "||", $_REQUEST['_tanggal_kunjungan']);

        $strsql = $insert1rows . "   UPDATE appraisal_vhc SET 
                _cond_code= '" . $_cond_code . "',
                _type= '" . $_type . "',
                _merk= '" . $_merk . "',
                _model= '" . $_model . "',
                _jns_kendaraan= '" . $_jns_kendaraan . "',
                _thnpembuatan= '" . $_thnpembuatan . "',
                _silinder_isi= '" . $_silinder_isi . "',
                _silinder_wrn= '" . $_silinder_wrn . "',
                _norangka= '" . $_norangka . "',
                _nomesin= '" . $_nomesin . "',
                _bpkb_tgl= '" . $_bpkb_tgl . "',
                _stnk_exp= '" . $_stnk_exp . "',
                _faktur_tgl= '" . $_faktur_tgl . "',
                _bahanbakar= '" . $_bahanbakar . "',
                _bpkb_nama= '" . $_bpkb_nama . "',
                _bpkb_addr1= '" . $_bpkb_addr1 . "',
                _bpkb_addr2= '" . $_bpkb_addr2 . "',
                _bpkb_addr3= '" . $_bpkb_addr3 . "',
                _perlengkapan= '" . $_perlengkapan . "',
                _notes= '" . $_notes . "',
                _opini= '" . $_opini . "',
                _tanggal_kunjungan= '" . $_tanggal_kunjungan . "',
                _officer_code= '" . $_officer_code . "'
                WHERE _collateral_id= '" . $_collateral_id . "'";
        //echo $strsql;
        $stmt = sqlsrv_prepare($conn, $strsql);
        if (!$stmt) {
            echo "Error in preparing statement.\n";
            die(print_r(sqlsrv_errors(), true));
            return false;
        }
        if (!sqlsrv_execute($stmt)) {
            echo "Cannot insert table " . $strsql;
            die(print_r(sqlsrv_errors(), true));
            return false;
        }
        sqlsrv_free_stmt($stmt);
    } else if ($type == "D01" || $type == "TAB" || $type == "GIR") {
        $cash_aplisregno = $_POST["cash_aplisregno"];
        $cash_colid = $_POST["cash_colid"];
        $cash_norek = $_POST["cash_norek"];
        $cash_atasnama = $_POST["cash_atasnama"];
        $cash_nominal = $_POST["cash_nominal"];
        $cash_jangkawaktu = isset($_POST["cash_jangkawaktu"]) ? $_POST["cash_jangkawaktu"] : "";
        $cash_tanggal_mulai = $_POST["cash_tanggal_mulai"];
        $cash_tanggal_berakhir = $_POST["cash_tanggal_berakhir"];
        $cash_keterangan = $_POST["cash_keterangan"];

        $cash_nominal = str_replace(",", "", $cash_nominal);

        $tsql = "Delete from tbl_col_cash_v3 where ap_lisregno = '$cash_aplisregno' and col_id = '$cash_colid'
				INSERT INTO tbl_col_cash_v3 (ap_lisregno, col_id, cash_type, cash_norek, cash_atasnama, cash_nominal, cash_jangkawaktu, cash_tanggal_mulai, cash_tanggal_berakhir, cash_keterangan)
				VALUES('$cash_aplisregno', '$cash_colid', '$type', '$cash_norek', '$cash_atasnama', '$cash_nominal', '$cash_jangkawaktu', '$cash_tanggal_mulai', '$cash_tanggal_berakhir', '$cash_keterangan')";
        echo $tsql;
        $stmt = sqlsrv_prepare($conn, $tsql, $params);
        if ($stmt) {
            
        } else {
            echo "Error in preparing statement.\n";
            die(print_r(sqlsrv_errors(), true));
        }

        if (sqlsrv_execute($stmt)) {
            
        } else {
            echo "Error in executing statement.\n";
            die(print_r(sqlsrv_errors(), true));
        }
        sqlsrv_free_stmt($stmt);
    } else if ($type == "TT1" || $type == "TT2" || $type == "TT3") {
        $cash_aplisregno = $_POST["cash_aplisregno"];
        $cash_colid = $_POST["cash_colid"];
        $term_nama_proyek = $_POST["term_nama_proyek"];
        $term_lokasi_proyek = $_POST["term_lokasi_proyek"];
        $term_pemilik_proyek = $_POST["term_pemilik_proyek"];
        $term_nilai_proyek = $_POST["term_nilai_proyek"];
        $term_tagihan_termyn = $_POST["term_tagihan_termyn"];
        $term_fisik_proyek = $_POST["term_fisik_proyek"];
        $term_jangka_waktu_proyek = $_POST["term_jangka_waktu_proyek"];
        $term_pengikatan = $_POST["term_pengikatan"];
        $term_keterangan = $_POST["term_keterangan"];

        $term_nilai_proyek = str_replace(",", "", $term_nilai_proyek);
        $term_tagihan_termyn = str_replace(",", "", $term_tagihan_termyn);

        $tsql = "Delete from tbl_col_termyn_v3 where ap_lisregno = '$cash_aplisregno' and col_id = '$cash_colid'
				INSERT INTO tbl_col_termyn_v3 (ap_lisregno, col_id, term_type, term_nama_proyek, term_lokasi_proyek, term_pemilik_proyek, term_nilai_proyek, term_tagihan_termyn, term_fisik_proyek, term_jangka_waktu_proyek, term_pengikatan, term_keterangan)
				VALUES('$cash_aplisregno', '$cash_colid', '$type', '$term_nama_proyek', '$term_lokasi_proyek', '$term_pemilik_proyek', '$term_nilai_proyek', '$term_tagihan_termyn', '$term_fisik_proyek', '$term_jangka_waktu_proyek', '$term_pengikatan', '$term_keterangan')";
        echo $tsql;
        $stmt = sqlsrv_prepare($conn, $tsql, $params);
        if ($stmt) {
            
        } else {
            echo "Error in preparing statement.\n";
            die(print_r(sqlsrv_errors(), true));
        }

        if (sqlsrv_execute($stmt)) {
            
        } else {
            echo "Error in executing statement.\n";
            die(print_r(sqlsrv_errors(), true));
        }
        sqlsrv_free_stmt($stmt);
    } else if ($type == "GLD") {
        $cash_aplisregno = $_POST["cash_aplisregno"];
        $cash_colid = $_POST["cash_colid"];
        $gld_id_number = $_POST["gld_id_number"];
        $gld_berat = $_POST["gld_berat"];
        $gld_dimensi = $_POST["gld_dimensi"];
        $gld_harga = $_POST["gld_harga"];
        $gld_keterangan = $_POST["gld_keterangan"];

        $gld_harga = str_replace(",", "", $gld_harga);

        $tsql = "Delete from appraisal_gld where  _collateral_id = '$cash_colid'
				INSERT INTO appraisal_gld ( _collateral_id, gld_type, gld_id_number, gld_berat, gld_dimensi, gld_harga, gld_keterangan)
				VALUES( '$cash_colid', '$type', '$gld_id_number', '$gld_berat', '$gld_dimensi', '$gld_harga', '$gld_keterangan')";
        echo $tsql;
        $stmt = sqlsrv_prepare($conn, $tsql, $params);
        if ($stmt) {
            
        } else {
            echo "Error in preparing statement.\n";
            die(print_r(sqlsrv_errors(), true));
        }

        if (sqlsrv_execute($stmt)) {
            
        } else {
            echo "Error in executing statement.\n";
            die(print_r(sqlsrv_errors(), true));
        }
        sqlsrv_free_stmt($stmt);
    } else if ($type == "GLP") {
        $cash_aplisregno = $_POST["cash_aplisregno"];
        $cash_colid = $_POST["cash_colid"];
        $glp_jenis_perhiasan = $_POST["glp_jenis_perhiasan"];
        $glp_karat = $_POST["glp_karat"];
        $glp_berat = $_POST["glp_berat"];
        $glp_harga = $_POST["glp_harga"];
        $glp_keterangan = $_POST["glp_keterangan"];

        $glp_harga = str_replace(",", "", $glp_harga);

        $tsql = "Delete from appraisal_glp where _collateral_id = '$cash_colid'
				INSERT INTO appraisal_glp ( _collateral_id, glp_type, glp_jenis_perhiasan, glp_karat, glp_berat, glp_harga, glp_keterangan)
				VALUES('$cash_colid', '$type', '$glp_jenis_perhiasan', '$glp_karat', '$glp_berat', '$glp_harga', '$glp_keterangan')";
        echo $tsql;
        $stmt = sqlsrv_prepare($conn, $tsql, $params);
        if ($stmt) {
            
        } else {
            echo "Error in preparing statement.\n";
            die(print_r(sqlsrv_errors(), true));
        }

        if (sqlsrv_execute($stmt)) {
            
        } else {
            echo "Error in executing statement.\n";
            die(print_r(sqlsrv_errors(), true));
        }
        sqlsrv_free_stmt($stmt);
    } else if ($type == "G01" || $type == "G02" || $type == "AB1" || $type == "AB2" || $type == "AB3" || $type == "AB4") {
        $cash_aplisregno = $_POST["cash_aplisregno"];
        $cash_colid = $_POST["cash_colid"];
        $jenis_mesin = $_POST["jenis_mesin"];
        $nama_mesin = $_POST["nama_mesin"];
        $nomor_mesin = $_POST["nomor_mesin"];
        $nomor_surat = $_POST["nomor_surat"];
        $tahun_pembuatan = $_POST["tahun_pembuatan"];
        $umur_mesin = $_POST["umur_mesin"];
        $keterangan = $_POST["keterangan"];

        $tsql = "Delete from appraisal_mesin where _collateral_id = '$cash_colid'
				INSERT INTO appraisal_mesin (_collateral_id, jenis_mesin, nama_mesin, nomor_mesin, nomor_surat, tahun_pembuatan, umur_mesin, keterangan)
				VALUES('$cash_colid', '$jenis_mesin', '$nama_mesin', '$nomor_mesin', '$nomor_surat', '$tahun_pembuatan', '$umur_mesin','$keterangan')";
        echo $tsql;
        $stmt = sqlsrv_prepare($conn, $tsql, $params);
        if ($stmt) {
            
        } else {
            echo "Error in preparing statement.\n";
            die(print_r(sqlsrv_errors(), true));
        }

        if (sqlsrv_execute($stmt)) {
            
        } else {
            echo "Error in executing statement.\n";
            die(print_r(sqlsrv_errors(), true));
        }
        sqlsrv_free_stmt($stmt);

        $ysql = "UPDATE Tbl_Cust_MasterCol SET FLAGINSERT = '1' WHERE COL_ID = '$cash_colid'";
        $y = sqlsrv_query($conn, $ysql);
    } else if ($type == "HWN" || $type == "PD") {
        $cash_aplisregno = $_POST["cash_aplisregno"];
        $cash_colid = $_POST["cash_colid"];
        $keterangan = $_POST["keterangan"];

        $tsql = "Delete from appraisal_keterangan where  _collateral_id = '$cash_colid'
				INSERT INTO appraisal_keterangan ( _collateral_id, keterangan)
				VALUES( '$cash_colid', '$keterangan')";
        //echo $tsql;
        $stmt = sqlsrv_prepare($conn, $tsql, $params);
        if ($stmt) {
            
        } else {
            echo "Error in preparing statement.\n";
            die(print_r(sqlsrv_errors(), true));
        }

        if (sqlsrv_execute($stmt)) {
            
        } else {
            echo "Error in executing statement.\n";
            die(print_r(sqlsrv_errors(), true));
        }
        sqlsrv_free_stmt($stmt);

        $ysql = "UPDATE Tbl_Cust_MasterCol SET FLAGINSERT = '1' WHERE COL_ID = '$cash_colid'";
        $y = sqlsrv_query($conn, $ysql);
    } else if ($type == "KI2" || $type == "KI3" || $type == "KI4") {
        $kios_aplisregno = $_POST['kios_aplisregno'];
        $kios_colid = $_POST['kios_colid'];
        $kios_haktanggungan = $_POST['kios_haktanggungan'];
        $kios_haktanggungantgl = $_POST['kios_haktanggungantgl'];
        $kios_relcode = $_POST['kios_relcode'];
        $kios_njopyearlnd = $_POST['kios_njopyearlnd'];
        $kios_njopvallnd = $_POST['kios_njopvallnd'];
        $kios_keteranganlnd = $_POST['kios_keteranganlnd'];
        $kios_certno = $_POST['kios_certno'];
        $kios_certtype = $_POST['kios_certtype'];
        $kios_certluas = $_POST['kios_certluas'];
        $kios_certdate = $_POST['kios_certdate'];
        $kios_certdue = $_POST['kios_certdue'];
        $kios_certatasnama = $_POST['kios_certatasnama'];
        $kios_gssuno = $_POST['kios_gssuno'];
        $kios_gssutgl = $_POST['kios_gssutgl'];
        $kios_imbno = $_POST['kios_imbno'];
        $kios_imbdate = $_POST['kios_imbdate'];
        $kios_imbluas = $_POST['kios_imbluas'];
        $kios_njopyearbld = $_POST['kios_njopyearbld'];
        $kios_njopvalbld = $_POST['kios_njopvalbld'];
        $kios_keteranganbld = $_POST['kios_keteranganbld'];
        $kios_ppjb = $_POST['kios_ppjb'];

        $lndcol_addr1 = $_POST["lndbldcol_addr1"];
        $lndcol_addr2 = $_POST["lndbldcol_addr2"];
        $lndcol_addr3 = $_POST["lndbldcol_addr3"];
        $lndcol_kodepos = $_POST["lndbldcol_kodepos"];

        $kios_devname = "";
        if ($kios_relcode == "DVL") {
            $kios_devname = $_POST["kios_devname"];
        }

        $kios_njopvallnd = str_replace(",", "", $kios_njopvallnd);
        $kios_njopvalbld = str_replace(",", "", $kios_njopvalbld);

        if ($kios_haktanggungan == "") {
            $kios_haktanggungan = "-";
        }
        if ($kios_keteranganlnd == "") {
            $kios_keteranganlnd = "-";
        }
        if ($kios_certno == "") {
            $kios_certno = "-";
        }
        if ($kios_certtype == "") {
            $kios_certtype = "-";
        }
        if ($kios_certluas == "") {
            $kios_certluas = 0;
        }
        if ($kios_certatasnama == "") {
            $kios_certatasnama = "-";
        }
        if ($kios_gssuno == "") {
            $kios_gssuno = "-";
        }
        if ($kios_keteranganbld == "") {
            $kios_keteranganbld = "-";
        }
        if ($kios_ppjb == "") {
            $kios_ppjb = "-";
        }

        $tsql = "UPDATE appraisal_kios SET col_haktanggungan = '$kios_haktanggungan', col_haktanggungantgl = '$kios_haktanggungantgl', col_relcode = '$kios_relcode', col_njopyearlnd = '$kios_njopyearlnd', col_njopvallnd = '$kios_njopvallnd', col_keteranganlnd = '$kios_keteranganlnd', col_certno = '$kios_certno', col_certtype = '$kios_certtype', col_certluas = '$kios_certluas', col_certdate = '$kios_certdate', col_certdue = '$kios_certdue', col_certatasnama = '$kios_certatasnama', col_gssuno = '$kios_gssuno', col_gssutgl = '$kios_gssutgl', col_imbno = '$kios_imbno', col_imbdate = '$kios_imbdate', col_imbluas = '$kios_imbluas', col_njopyearbld = '$kios_njopyearbld', col_njopvalbld = '$kios_njopvalbld', col_keteranganbld = '$kios_keteranganbld', col_ppjb = '$kios_ppjb', col_devname = '$kios_devname'
				WHERE   _collateral_id = '$kios_colid'
				




                                
				UPDATE appraisal_land SET col_addr1 = '$lndcol_addr1', col_addr2 = '$lndcol_addr2', col_addr3 = '$lndcol_addr3', 
					col_kodepos = '$lndcol_kodepos'
					WHERE _collateral_id= '$kios_colid'
				";
        echo $tsql;
        $params = array(&$_POST['query']);

        $stmt = sqlsrv_prepare($conn, $tsql, $params);
        if ($stmt) {
            
        } else {
            echo "Error in preparing statement.\n";
            die(print_r(sqlsrv_errors(), true));
        }

        if (sqlsrv_execute($stmt)) {
            
        } else {
            echo "Error in executing statement.\n";
            die(print_r(sqlsrv_errors(), true));
        }
        sqlsrv_free_stmt($stmt);
    } else if ($type == "RUK") {
        $ruko_aplisregno = $_POST['ruko_aplisregno'];
        $ruko_colid = $_POST['ruko_colid'];
        $ruko_haktanggungan = $_POST['ruko_haktanggungan'];
        $ruko_haktanggungantgl = $_POST['ruko_haktanggungantgl'];
        $ruko_relcode = $_POST['ruko_relcode'];
        $ruko_njopyearlnd = $_POST['ruko_njopyearlnd'];
        $ruko_njopvallnd = $_POST['ruko_njopvallnd'];
        $ruko_keteranganlnd = $_POST['ruko_keteranganlnd'];
        $ruko_certno = $_POST['ruko_certno'];
        $ruko_certtype = $_POST['ruko_certtype'];
        $ruko_certluas = $_POST['ruko_certluas'];
        $ruko_certdate = $_POST['ruko_certdate'];
        $ruko_certdue = $_POST['ruko_certdue'];
        $ruko_certatasnama = $_POST['ruko_certatasnama'];
        $ruko_gssuno = $_POST['ruko_gssuno'];
        $ruko_gssutgl = $_POST['ruko_gssutgl'];
        $ruko_imbno = $_POST['ruko_imbno'];
        $ruko_imbdate = $_POST['ruko_imbdate'];
        $ruko_imbluas = $_POST['ruko_imbluas'];
        $ruko_njopyearbld = $_POST['ruko_njopyearbld'];
        $ruko_njopvalbld = $_POST['ruko_njopvalbld'];
        $ruko_keteranganbld = $_POST['ruko_keteranganbld'];
        $ruko_ppjb = $_POST['ruko_ppjb'];

        $lndcol_addr1 = $_POST["lndbldcol_addr1"];
        $lndcol_addr2 = $_POST["lndbldcol_addr2"];
        $lndcol_addr3 = $_POST["lndbldcol_addr3"];
        $lndcol_kodepos = $_POST["lndbldcol_kodepos"];

        $ruko_devname = "";
        if ($ruko_relcode == "DVL") {
            $ruko_devname = $_POST["ruko_devname"];
        }

        $ruko_njopvallnd = str_replace(",", "", $ruko_njopvallnd);
        $ruko_njopvalbld = str_replace(",", "", $ruko_njopvalbld);

        if ($ruko_haktanggungan == "") {
            $ruko_haktanggungan = "-";
        }
        if ($ruko_keteranganlnd == "") {
            $ruko_keteranganlnd = "-";
        }
        if ($ruko_certno == "") {
            $ruko_certno = "-";
        }
        if ($ruko_certtype == "") {
            $ruko_certtype = "-";
        }
        if ($ruko_certluas == "") {
            $ruko_certluas = 0;
        }
        if ($ruko_certatasnama == "") {
            $ruko_certatasnama = "-";
        }
        if ($ruko_gssuno == "") {
            $ruko_gssuno = "-";
        }
        if ($ruko_keteranganbld == "") {
            $ruko_keteranganbld = "-";
        }
        if ($ruko_ppjb == "") {
            $ruko_ppjb = "-";
        }

        $tsql = "UPDATE appraisal_ruko SET col_haktanggungan = '$ruko_haktanggungan', col_haktanggungantgl = '$ruko_haktanggungantgl', col_relcode = '$ruko_relcode', col_njopyearlnd = '$ruko_njopyearlnd', col_njopvallnd = '$ruko_njopvallnd', col_keteranganlnd = '$ruko_keteranganlnd', col_certno = '$ruko_certno', col_certtype = '$ruko_certtype', col_certluas = '$ruko_certluas', col_certdate = '$ruko_certdate', col_certdue = '$ruko_certdue', col_certatasnama = '$ruko_certatasnama', col_gssuno = '$ruko_gssuno', col_gssutgl = '$ruko_gssutgl', col_imbno = '$ruko_imbno', col_imbdate = '$ruko_imbdate', col_imbluas = '$ruko_imbluas', col_njopyearbld = '$ruko_njopyearbld', col_njopvalbld = '$ruko_njopvalbld', col_keteranganbld = '$ruko_keteranganbld', col_ppjb = '$ruko_ppjb', col_devname = '$ruko_devname'
				WHERE _collateral_id = '$ruko_colid'
				
				UPDATE appraisal_land SET col_addr1 = '$lndcol_addr1', col_addr2 = '$lndcol_addr2', col_addr3 = '$lndcol_addr3', 
					col_kodepos = '$lndcol_kodepos'
					WHERE  _collateral_id = '$ruko_colid'
				";
        $params = array(&$_POST['query']);

        $stmt = sqlsrv_prepare($conn, $tsql, $params);
        if ($stmt) {
            
        } else {
            echo "Error in preparing statement.\n";
            die(print_r(sqlsrv_errors(), true));
        }

        if (sqlsrv_execute($stmt)) {
            
        } else {
            echo "Error in executing statement.\n";
            die(print_r(sqlsrv_errors(), true));
        }
        sqlsrv_free_stmt($stmt);
    } else if ($type == "SK1") {
        $skType = $_POST['_sktype'];
        $skValue = $_POST['_skno'];
        $skCode = $_POST['_skcode'];
        $colid = $_POST['skcol_id'];
        $sk_custnomid = $_POST['sk_custnomid'];

        foreach ($skType as $key => $j) {

            if ($j == "") {
                $j = "-";
            }
            if ($skValue[$key] == "") {
                $skValue[$key] = "-";
            }

            $tsql = "UPDATE Tbl_COL_SK SET sk_type = '$j', sk_no = '" . $skValue[$key] . "' WHERE id = '" . $skCode[$key] . "'";
            //echo $tsql;
            $stmt = sqlsrv_prepare($conn, $tsql, $params);
            if ($stmt) {
                
            } else {
                echo "Error in preparing statement.\n";
                die(print_r(sqlsrv_errors(), true));
            }

            if (sqlsrv_execute($stmt)) {
                
            } else {
                echo "Error in executing statement.\n";
                die(print_r(sqlsrv_errors(), true));
            }
            sqlsrv_free_stmt($stmt);
        }
    } else {
        $lainnyaap_lisregno = $_POST['lainnyaap_lisregno'];
        $lainnyacol_id = $_POST['lainnyacol_id'];
        $lainnyacol_code = $type;
        $lainnyacol_nomordokumen = $_POST['lainnyacol_nomordokumen'];
        $lainnyacol_nilaijaminan = $_POST['lainnyacol_nilaijaminan'];

        $tsql = "UPDATE tbl_COL_Lainnya SET col_nomordokumen = '$lainnyacol_nomordokumen', col_nilaijaminan = '$lainnyacol_nilaijaminan'
				 WHERE ap_lisregno = '$lainnyaap_lisregno' AND col_id = '$lainnyacol_id'";

        $params = array(&$_POST['query']);

        $stmt = sqlsrv_prepare($conn, $tsql, $params);
        if ($stmt) {
            
        } else {
            echo "Error in preparing statement.\n";
            die(print_r(sqlsrv_errors(), true));
        }

        if (sqlsrv_execute($stmt)) {
            
        } else {
            echo "Error in executing statement.\n";
            die(print_r(sqlsrv_errors(), true));
        }
        sqlsrv_free_stmt($stmt);
    }

    $tsqlz = "UPDATE Tbl_Flow_Status SET txn_flow = 'COL', txn_action = 'I', txn_time = getdate(), txn_user_id = '$userid' WHERE txn_id = '$custnomid'";
    $az = sqlsrv_query($conn, $tsqlz);
}







/*
  |	=================================	|
  |     	Update Niko DAN erik 		|
  |	=================================	|
 */ else if ($cust_jeniscol == "BA1" || $cust_jeniscol == "RUK" || $cust_jeniscol == "KI2") {
    $tsql = "select * from appraisal_tnb where _collateral_id = '" . $_collateral_id . "'";
    $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $params = array(&$_POST['query']);
    $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
    $rowCount = sqlsrv_num_rows($sqlConn);
    $insert1rows = "";
    if ($rowCount == "0") {
        $insert1rows = "   INSERT INTO appraisal_tnb(_collateral_id) VALUES ('" . $_collateral_id . "')";
    }

    $_type_jaminan = str_replace("'", "||", $_REQUEST['_type_jaminan']);
    $_lokasi_rumah = str_replace("'", "||", $_REQUEST['_lokasi_rumah']);
    $_jumlah_lantai = str_replace("'", "||", $_REQUEST['_jumlah_lantai']);
    //$_panjang_bangunan=str_replace("'","||",$_REQUEST['_panjang_bangunan']);
    //$_lebar_bangunan=str_replace("'","||",$_REQUEST['_lebar_bangunan']);
    $_arah_bangunan = str_replace("'", "||", $_REQUEST['_arah_bangunan']);
    $_umur_bangunan = str_replace("'", "||", $_REQUEST['_umur_bangunan']);
    $_tahun_dibangun = str_replace("'", "||", $_REQUEST['_tahun_dibangun']);
    $_tahun_renovasi = str_replace("'", "||", $_REQUEST['_tahun_renovasi']);
    //$_panjang_tanah=str_replace("'","||",$_REQUEST['_panjang_tanah']);
    //$_lebar_tanah=str_replace("'","||",$_REQUEST['_lebar_tanah']);
    $_sisi_utara = str_replace("'", "||", $_REQUEST['_sisi_utara']);
    $_sisi_timur = str_replace("'", "||", $_REQUEST['_sisi_timur']);
    $_sisi_selatan = str_replace("'", "||", $_REQUEST['_sisi_selatan']);
    $_sisi_barat = str_replace("'", "||", $_REQUEST['_sisi_barat']);
    $_latitude = str_replace("'", "||", $_REQUEST['_latitude']);
    $_longitude = str_replace("'", "||", $_REQUEST['_longitude']);
    $_notes = str_replace("'", "||", $_REQUEST['_notes']);
    $_opini = str_replace("'", "||", $_REQUEST['_opini']);
    $_officer_code = str_replace("'", "||", $_REQUEST['_officer_code']);
    $_tanggal_kunjungan = str_replace("'", "||", $_REQUEST['_tanggal_kunjungan']);
    $_luas_bangunan = str_replace("'", "||", $_REQUEST['_luas_bangunan']);
    $_luas_tanah = str_replace("'", "||", $_REQUEST['_luas_tanah']);

    //$_luas_bangunan = $_panjang_bangunan*$_lebar_bangunan;
    //$_luas_tanah = $_panjang_tanah*$_lebar_tanah;
    $strsql = $insert1rows . "   UPDATE appraisal_tnb SET 
                _type_jaminan= '" . $_type_jaminan . "',
                _lokasi_rumah= '" . $_lokasi_rumah . "',
                _jumlah_lantai= '" . $_jumlah_lantai . "',
                _luas_bangunan= '" . $_luas_bangunan . "',
                _panjang_bangunan= '" . $_panjang_bangunan . "',
                _lebar_bangunan= '" . $_lebar_bangunan . "',
                _arah_bangunan= '" . $_arah_bangunan . "',
                _umur_bangunan= '" . $_umur_bangunan . "',
                _tahun_dibangun= '" . $_tahun_dibangun . "',
                _tahun_renovasi= '" . $_tahun_renovasi . "',
                _luas_tanah= '" . $_luas_tanah . "',
                _panjang_tanah= '" . $_panjang_tanah . "',
                _lebar_tanah= '" . $_lebar_tanah . "',
                _sisi_utara= '" . $_sisi_utara . "',
                _sisi_timur= '" . $_sisi_timur . "',
                _sisi_selatan= '" . $_sisi_selatan . "',
                _sisi_barat= '" . $_sisi_barat . "',
                _latitude= '" . $_latitude . "',
                _longitude= '" . $_longitude . "',
                _notes= '" . $_notes . "',
                _opini= '" . $_opini . "',
                _tanggal_kunjungan= '" . $_tanggal_kunjungan . "',
                _officer_code= '" . $_officer_code . "'
                WHERE _collateral_id= '" . $_collateral_id . "'";
    //echo $strsql;
    $stmt = sqlsrv_prepare($conn, $strsql);
    if (!$stmt) {
        echo "Error in preparing statement.\n";
        die(print_r(sqlsrv_errors(), true));
        return false;
    }
    if (!sqlsrv_execute($stmt)) {
        echo "Cannot insert table " . $strsql;
        die(print_r(sqlsrv_errors(), true));
        return false;
    }
    sqlsrv_free_stmt($stmt);


    /*
      echo "_collateral_id ==> ".$_collateral_id."</br>";
      echo "_type_jaminan ==> ".$_type_jaminan."</br>";
      echo "_lokasi_rumah ==> ".$_lokasi_rumah."</br>";
      echo "_jumlah_lantai ==> ".$_jumlah_lantai."</br>";
      echo "_luas_bangunan ==> ".$_luas_bangunan."</br>";
      echo "_panjang_bangunan ==> ".$_panjang_bangunan."</br>";
      echo "_lebar_bangunan ==> ".$_lebar_bangunan."</br>";
      echo "_arah_bangunan ==> ".$_arah_bangunan."</br>";
      echo "_umur_bangunan ==> ".$_umur_bangunan."</br>";
      echo "_tahun_dibangun ==> ".$_tahun_dibangun."</br>";
      echo "_tahun_renovasi ==> ".$_tahun_renovasi."</br>";
      echo "_luas_tanah ==> ".$_luas_tanah."</br>";
      echo "_panjang_tanah ==> ".$_panjang_tanah."</br>";
      echo "_lebar_tanah ==> ".$_lebar_tanah."</br>";
      echo "_sisi_utara ==> ".$_sisi_utara."</br>";
      echo "_sisi_timur ==> ".$_sisi_timur."</br>";
      echo "_sisi_selatan ==> ".$_sisi_selatan."</br>";
      echo "_sisi_barat ==> ".$_sisi_barat."</br>";
      echo "_latitude ==> ".$_latitude."</br>";
      echo "_longitude ==> ".$_longitude."</br>";
      echo "_notes ==> ".$_notes."</br>";
      echo "_opini ==> ".$_opini."</br>";
      echo "_officer_code ==> ".$_officer_code."</br>";
     */
} elseif ($cust_jeniscol == "TAN") {
    $tsql = "select * from appraisal_lnd where _collateral_id = '" . $_collateral_id . "'";
    $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $params = array(&$_POST['query']);
    $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
    $rowCount = sqlsrv_num_rows($sqlConn);
    $insert1rows = "";
    if ($rowCount == "0") {
        $insert1rows = "   INSERT INTO appraisal_lnd(_collateral_id) VALUES ('" . $_collateral_id . "')";
    }

    $_panjang_tanah = str_replace("'", "||", $_REQUEST['_panjang_tanah']);
    $_lebar_tanah = str_replace("'", "||", $_REQUEST['_lebar_tanah']);
    $_sisi_utara = str_replace("'", "||", $_REQUEST['_sisi_utara']);
    $_sisi_timur = str_replace("'", "||", $_REQUEST['_sisi_timur']);
    $_sisi_selatan = str_replace("'", "||", $_REQUEST['_sisi_selatan']);
    $_sisi_barat = str_replace("'", "||", $_REQUEST['_sisi_barat']);
    $_latitude = str_replace("'", "||", $_REQUEST['_latitude']);
    $_longitude = str_replace("'", "||", $_REQUEST['_longitude']);
    $_notes = str_replace("'", "||", $_REQUEST['_notes']);
    $_opini = str_replace("'", "||", $_REQUEST['_opini']);
    $_officer_code = str_replace("'", "||", $_REQUEST['_officer_code']);
    $_tanggal_kunjungan = str_replace("'", "||", $_REQUEST['_tanggal_kunjungan']);

    $_luas_tanah = $_panjang_tanah * $_lebar_tanah;
    $strsql = $insert1rows . "   UPDATE appraisal_lnd SET 
                _luas_tanah= '" . $_luas_tanah . "',
                _panjang_tanah= '" . $_panjang_tanah . "',
                _lebar_tanah= '" . $_lebar_tanah . "',
                _sisi_utara= '" . $_sisi_utara . "',
                _sisi_timur= '" . $_sisi_timur . "',
                _sisi_selatan= '" . $_sisi_selatan . "',
                _sisi_barat= '" . $_sisi_barat . "',
                _latitude= '" . $_latitude . "',
                _longitude= '" . $_longitude . "',
                _notes= '" . $_notes . "',
                _opini= '" . $_opini . "',
                _tanggal_kunjungan= '" . $_tanggal_kunjungan . "',
                _officer_code= '" . $_officer_code . "'
                WHERE _collateral_id= '" . $_collateral_id . "'";
    echo $strsql;
    $stmt = sqlsrv_prepare($conn, $strsql);
    if (!$stmt) {
        echo "Error in preparing statement.\n";
        die(print_r(sqlsrv_errors(), true));
        return false;
    }
    if (!sqlsrv_execute($stmt)) {
        echo "Cannot insert table " . $strsql;
        die(print_r(sqlsrv_errors(), true));
        return false;
    }
    sqlsrv_free_stmt($stmt);
} elseif ($cust_jeniscol == "V01") {
    $tsql = "select * from appraisal_vhc where _collateral_id = '" . $_collateral_id . "'";
    $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $params = array(&$_POST['query']);
    $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
    $rowCount = sqlsrv_num_rows($sqlConn);
    $insert1rows = "";
    if ($rowCount == "0") {
        $insert1rows = "   INSERT INTO appraisal_vhc(_collateral_id) VALUES ('" . $_collateral_id . "')";
    }


    $_cond_code = str_replace("'", "||", $_REQUEST['_cond_code']);
    $_type = str_replace("'", "||", $_REQUEST['_type']);
    $_merk = str_replace("'", "||", $_REQUEST['_merk']);
    $_model = str_replace("'", "||", $_REQUEST['_model']);
    $_jns_kendaraan = str_replace("'", "||", $_REQUEST['_jns_kendaraan']);
    $_thnpembuatan = str_replace("'", "||", $_REQUEST['_thnpembuatan']);
    $_silinder_isi = str_replace("'", "||", $_REQUEST['_silinder_isi']);
    $_silinder_wrn = str_replace("'", "||", $_REQUEST['_silinder_wrn']);
    $_norangka = str_replace("'", "||", $_REQUEST['_norangka']);
    $_nomesin = str_replace("'", "||", $_REQUEST['_nomesin']);
    $_bpkb_tgl = str_replace("'", "||", $_REQUEST['_bpkb_tgl']);
    $_stnk_exp = str_replace("'", "||", $_REQUEST['_stnk_exp']);
    $_faktur_tgl = str_replace("'", "||", $_REQUEST['_faktur_tgl']);
    $_bahanbakar = str_replace("'", "||", $_REQUEST['_bahanbakar']);
    $_bpkb_nama = str_replace("'", "||", $_REQUEST['_bpkb_nama']);
    $_bpkb_addr1 = str_replace("'", "||", $_REQUEST['_bpkb_addr1']);
    $_bpkb_addr2 = str_replace("'", "||", $_REQUEST['_bpkb_addr2']);
    $_bpkb_addr3 = str_replace("'", "||", $_REQUEST['_bpkb_addr3']);
    $_perlengkapan = str_replace("'", "||", $_REQUEST['_perlengkapan']);
    $_notes = str_replace("'", "||", $_REQUEST['_notes']);
    $_opini = str_replace("'", "||", $_REQUEST['_opini']);
    $_officer_code = str_replace("'", "||", $_REQUEST['_officer_code']);
    $_tanggal_kunjungan = str_replace("'", "||", $_REQUEST['_tanggal_kunjungan']);

    $strsql = $insert1rows . "   UPDATE appraisal_vhc SET 
                _cond_code= '" . $_cond_code . "',
                _type= '" . $_type . "',
                _merk= '" . $_merk . "',
                _model= '" . $_model . "',
                _jns_kendaraan= '" . $_jns_kendaraan . "',
                _thnpembuatan= '" . $_thnpembuatan . "',
                _silinder_isi= '" . $_silinder_isi . "',
                _silinder_wrn= '" . $_silinder_wrn . "',
                _norangka= '" . $_norangka . "',
                _nomesin= '" . $_nomesin . "',
                _bpkb_tgl= '" . $_bpkb_tgl . "',
                _stnk_exp= '" . $_stnk_exp . "',
                _faktur_tgl= '" . $_faktur_tgl . "',
                _bahanbakar= '" . $_bahanbakar . "',
                _bpkb_nama= '" . $_bpkb_nama . "',
                _bpkb_addr1= '" . $_bpkb_addr1 . "',
                _bpkb_addr2= '" . $_bpkb_addr2 . "',
                _bpkb_addr3= '" . $_bpkb_addr3 . "',
                _perlengkapan= '" . $_perlengkapan . "',
                _notes= '" . $_notes . "',
                _opini= '" . $_opini . "',
                _tanggal_kunjungan= '" . $_tanggal_kunjungan . "',
                _officer_code= '" . $_officer_code . "'
                WHERE _collateral_id= '" . $_collateral_id . "'";
    //echo $strsql;
    $stmt = sqlsrv_prepare($conn, $strsql);
    if (!$stmt) {
        echo "Error in preparing statement.\n";
        die(print_r(sqlsrv_errors(), true));
        return false;
    }
    if (!sqlsrv_execute($stmt)) {
        echo "Cannot insert table " . $strsql;
        die(print_r(sqlsrv_errors(), true));
        return false;
    }
    sqlsrv_free_stmt($stmt);
}



/*
  for($x=1;$x<=10;$x++)
  {
  $photos = "_photobefore".$x;
  $base64photo="";
  if(file_exists($_FILES[$photos]['tmp_name']) || is_uploaded_file($_FILES[$photos]['tmp_name'])) {
  echo "ada upload".$photos."</br>";

  $data = file_get_contents($_FILES[$photos]['tmp_name']);
  $base64photo = base64_encode($data);

  $strsql = "
  delete from appraisal_photo where _collateral_id='".$_collateral_id."' and _id='".$x."'
  insert into appraisal_photo (_collateral_id,_collateral_photo,_id)
  values('".$_collateral_id."','".$base64photo."','".$x."')

  ";
  echo "<br/>";
  echo "<br/>";
  echo "<br/>";
  //echo $strsql;
  echo "<br/>";
  echo "<br/>";
  echo "<br/>";
  echo "<br/>";
  $stmt = sqlsrv_prepare( $conn, $strsql);
  if(!$stmt)
  {
  echo "Error in preparing statement.\n";
  die( print_r( sqlsrv_errors(), true));
  return false;
  }
  if(!sqlsrv_execute( $stmt))
  {
  echo "Cannot insert table ". $strsql;
  die( print_r( sqlsrv_errors(), true));
  return false;
  }
  sqlsrv_free_stmt( $stmt);

  }


  }
 */


$status = "";
$tsql = "select case when count(ap_lisregno)=(select count(ap_lisregno) from Tbl_Cust_MasterCol where ap_lisregno='" . $custnomid . "')
        then 'done' else 'not yet' end as 'status'
        from (
        select a._collateral_id,b.ap_lisregno from appraisal_lnd a
        join Tbl_Cust_MasterCol b on b.col_id = a._collateral_id
        union
        select a._collateral_id,b.ap_lisregno from appraisal_vhc a
        join Tbl_Cust_MasterCol b on b.col_id = a._collateral_id
        union
        select a._collateral_id,b.ap_lisregno from appraisal_tnb a
        join Tbl_Cust_MasterCol b on b.col_id = a._collateral_id
        )tss
        where ap_lisregno='" . $custnomid . "'";
//echo $tsql;
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);
$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
$rowCount = sqlsrv_num_rows($sqlConn);
if ($sqlConn === false)
    die(FormatErrors(sqlsrv_errors()));
if (sqlsrv_has_rows($sqlConn)) {
    while ($row = sqlsrv_fetch_array($sqlConn, SQLSRV_FETCH_ASSOC)) {
        $status = $row['status'];
    }
}

//if($status=="done")
//require ("../../requirepage/do_saveflow.php");
//header("location:../flow.php?userid=$userid&userpwd=$userpwd&userbranch=$userbranch&userregion=$userregion&userwfid=$userwfid");
Header("Location:./apperik.php?custnomid=$custnomid&userwfid=$userwfid&userpermission=$userpermission&buttonaction=$buttonaction&userbranch=$userbranch&userregion=$userregion&userid=$userid&userpwd=$userpwd&col_id=" . $_collateral_id);

/*
  $data1 = file_get_contents($_FILES['_photo1']['tmp_name']);
  $_photo1 = base64_encode($data1);

  $data2 = file_get_contents($_FILES['_photo2']['tmp_name']);
  $_photo2 = base64_encode($data2);

  echo "Photo 1 dengan base 64 ==> ".$_photo1."</br>";
  echo "Photo 2 dengan base 64 ==> ".$_photo2."</br>";
 */
?>