<?php
require_once('./tcpdf/config/lang/eng.php');
require_once('./tcpdf/tcpdf.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('CHATO');
$pdf->SetTitle('TES PDF');
$pdf->SetSubject('TES');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->setLanguageArray($l);

//$pdf->setFontSubsetting(true);

$pdf->SetFont('helvetica', '', 5);

$pdf->AddPage();

$tbl_header = '
<style type="text/css">
.tes {
	font-family: "Times New Roman", Times, serif;
	font-size: 20px;
	font-weight: bold;
}
</style>
<table border="0.5"  cellpadding="0" cellspacing="0">
			<tr>
	        <td style="border-right:none; border-left:none;border-color:#000000;">&nbsp;</td>
    	    <td style="border-right:none; border-left:none;border-color:#000000;">&nbsp;</td>
        	<td style="border-right:none; border-left:none;border-color:#000000;">&nbsp;</td>
	        <td style="border-right:none; border-left:none;border-color:#000000;"><span class = "tes">RAHASIA</span></td>
			</tr>
			<tr>
				<td style="border-right:none; border-left:none;border-color:#000000;"><strong>No Laporan: </strong>13/34499282/DPIP/PIK </td>
				<td style="border-right:none; border-left:none;border-color:#000000;"><strong>Tgl. Laporan: </strong>19/09/2011</td>
				<td style="border-right:none; border-left:none;border-color:#000000;"><strong>Posisi Data Terakhir : </strong>31/08/2011</td>
				<td style="border-right:none; border-left:none;border-color:#000000;"><strong>Laporan untuk: </strong>Bank</td>
			</tr>
			<tr>
				<td style="border-right:none; border-left:none;border-color:#000000;"><strong>Debitur: </strong>ERNAWATI -</td>
				<td style="border-right:none; border-left:none;border-color:#000000;">&nbsp;</td>
		        <td colspan="2" style="border-right:none; border-left:none;border-color:#000000;"><strong>User : </strong>nurina febriyanti - 001426048</td>
			</tr>
			<tr>
				<td height="" colspan="4" valign="top" bordercolor="#000000"><div align="center"><br>
			   	Informasi Debitur ini didasarkan pada Laporan Debitur yang disampaikan Pelapor melalui Sistem Informasi Debitur kepada Bank Indonesia. Kebenaran dan keakuratan data merupakan tanggung jawab Pelapor.Bank Indonesia tidak bertanggung jawab terhadap segala akibat yang timbul sehubungan dengan ketidakbenaran dan ketidakakuratan data serta penggunaan Informasi Debitur ini di kemudian hari.<br>
        	  </div></td>
			</tr>
</table>
';

$tbl_data_permintaan = '
<style type="text/css">
.tes {
	font-family: "Times New Roman", Times, serif;
	font-size: 24px;
}
</style>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan = "4" style="border-bottom-color:#000000;border-bottom-style:solid;border-bottom-width:0px;"><span class = "tes">DATA PERMINTAAN</span></td>
	</tr>
	<tr>
		<td><strong>Tanggal</strong><br>19/09/2011</td>
		<td><strong>Nomor</strong><br>0074-A/CANJF/9/2011</td>
		<td><strong>User</strong><br>nurina febriyanti - 001426048</td>
	</tr>
	<tr>
		<td><strong>Nama Debitur</strong><br>ERNAWATI</td>
		<td><strong>No KTP/Passpor</strong><br>3276025011660001</td>
		<td><strong>Tanggal Lahir</strong><br>10-11-1966</td>
		<td><strong>NPWP</strong><br>34.563.876.1.412.000</td>
	</tr>
	<tr>
		<td style="border-bottom-color:#000000;border-bottom-style:solid;border-bottom-width:0px;"><strong>Alamat</strong><br>KP SINDANGKARSA</td>
		<td style="border-bottom-color:#000000;border-bottom-style:solid;border-bottom-width:0px;"><strong>Dati II</strong><br>0197</td>
		<td style="border-bottom-color:#000000;border-bottom-style:solid;border-bottom-width:0px;"><strong>Kode Pos</strong><br>16415</td>
		<td style="border-bottom-color:#000000;border-bottom-style:solid;border-bottom-width:0px;">&nbsp;</td>
	</tr>
</table>
';

$tbl_alamat ='
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
	<tr><td>Alamat</td></tr>
	<tr>
		<td bgcolor = "#5D92F8" width = "2%"><div align="center">No</div></td>
		<td bgcolor = "#5D92F8" width = "42%"><div align="center">Alamat</div></td>
		<td bgcolor = "#5D92F8" width = "8%"><div align="center">Kelurahan</div></td>
		<td bgcolor = "#5D92F8" width = "8%"><div align="center">Kecamatan</div></td>
		<td bgcolor = "#5D92F8" width = "8%"><div align="center">Dati II</div></td>
		<td bgcolor = "#5D92F8" width = "8%"><div align="center">Kode Pos</div></td>
		<td bgcolor = "#5D92F8" width = "8%"><div align="center">Negara</div></td>
		<td bgcolor = "#5D92F8" width = "8%"><div align="center">Update</div></td>
		<td bgcolor = "#5D92F8" width = "8%"><div align="center">Pelapor</div></td>
	</tr>
	<tr>
		<td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;border-left-style:solid;"><div align="center">1</div></td>
        <td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;">JL. BAKTI ABRI KP. SINDANGKARSA RT. 003 RW. 009 SUKAMAJU BARU, KOTA DEPOK 16418</td>
        <td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;"><div align="center">SUKAMAJU BARU</div></td>
        <td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;"><div align="center">TAPOS</div></td>
        <td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;"><div align="center">Depok, Kota.</div></td>
        <td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;"><div align="center">16418</div></td>
        <td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;"><div align="center">INDONESIA</div></td>
        <td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;"><div align="center">08/09/2011</div></td>
		<td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;"><div align="center">001028002</div></td>
	</tr>
	<tr>
        <td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;border-left-style:solid;"><div align="center">2</div></td>
          <td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;">KP SINDANGKARSA</td>
          <td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;"><div align="center">CIMANGGIS</div></td>
          <td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;"><div align="center">SUKAMAJU BARU</div></td>
          <td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;"><div align="center">Depok, Kota.</div></td>
          <td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;"><div align="center">16415</div></td>
          <td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;"><div align="center">INDONESIA</div></td>
          <td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;"><div align="center">08/08/2011</div></td>
		  <td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;"><div align="center">001213037</div></td>
        </tr>
</table>
';

$tbl_pekerjaan = '
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#5D92F8">
	<tr>
		<td>Pekerjaan</td>
	</tr>
	<tr>
		<td bgcolor = "#5D92F8" width = "4%"><div align="center">No</div></td>
		<td bgcolor = "#5D92F8" width = "15%"><div align="center">Pekerjaan</div></td>
		<td bgcolor = "#5D92F8" width = "40%"><div align="center">Tempat Bekerja </div></td>
		<td bgcolor = "#5D92F8" width = "25%"><div align="center">Bd. Usaha </div></td>
		<td bgcolor = "#5D92F8" width = "8%"><div align="center">Update</div></td>
		<td bgcolor = "#5D92F8" width = "8%"><div align="center">Pelapor</div></td>
    </tr>
	<tr>
		<td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;border-left-style:solid;"><div align="center">1</div></td>
		<td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;">Wiraswasta</td>
		<td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;">n/a</td>
		<td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;">Lain-lain, Lainnya</td>
		<td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;"><div align="center">08/09/2011</div></td>
		<td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;"><div align="center">001028002</div></td>
    </tr>
	<tr>
		<td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;border-left-style:solid;"><div align="center">2</div></td>
        <td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;">Wiraswasta</td>
		<td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;">Perdagangan Barang spesifik</td>
		<td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;">Perdagangan Eceran</td>
		<td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;"><div align="center">08/08/2011</div></td>
		<td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;"><div align="center">001213037</div></td>
    </tr>
</table>
';

$tbl_telepon = '
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#5D92F8">
	<tr><td>Telepon</td></tr>
	<tr>
		<td bgcolor = "#5D92F8" width = "4%"><div align="center">No</div></td>
        <td bgcolor = "#5D92F8" width = "30%"><div align="center">Telepon</div></td>
        <td bgcolor = "#5D92F8" width = "15%"><div align="center">Update</div></td>
		<td bgcolor = "#5D92F8" width = "15%"><div align="center">Pelapor</div></td>
    </tr>
	<tr>
		<td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;border-left-style:solid;"><div align="center">1</div></td>
        <td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;">0021-8746787</td>
        <td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;"><div align="center">08/08/2011</div></td>
		<td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;"><div align="center">001213037</div></td>
    </tr>
</table>
';

$tbl_informasi_debitur = '
<style type="text/css">
.tes {
	font-family: "Times New Roman", Times, serif;
	font-size: 24px;
}
</style>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan = "3" width = "100%" style="border-bottom-color:#000000;border-bottom-style:solid;border-bottom-width:px;"><span class = "tes">INFORMASI DEBITUR</span></td>
	</tr>
	<tr>
		<td width="49,5%" style="border-bottom-color:#000000;border-bottom-style:solid;border-bottom-width:0px;"><strong>Nama Debitur/Pelapor :</strong><br>ERNAWATI-</td>
		<td width="1%">&nbsp;</td>
		<td width="49,5%" style="border-bottom-color:#000000;border-bottom-style:solid;border-bottom-width:0px;"><strong>Nama Alias/Pelapor :</strong><br>ERNAWATI-001213037<br>null-001028002</td>
	</tr>
	<tr>
		<td style="border-bottom-color:#000000;border-bottom-style:solid;border-bottom-width:0px;"><strong>Jenis Kelamin/Pelapor :</strong><br>Wanita-<br><strong>Tempat Lahir/Pelapor : </strong><br>AMBARAWA-<br><strong>Hit Counter :</strong><br>0</td>
		<td>&nbsp;</td>
		<td style="border-bottom-color:#000000;border-bottom-style:solid;border-bottom-width:0px;"><strong>Tanggal Lahir/Pelapor :</strong><br>10/11/1966-</td>
	</tr>
	<tr>
		<td style="border-bottom-color:#000000;border-bottom-style:solid;border-bottom-width:0px;"><strong>DIN :</strong><br>06966111016415000197</td>
		<td>&nbsp;</td>
		<td style="border-bottom-color:#000000;border-bottom-style:solid;border-bottom-width:0px;"><strong>NPWP :</strong><br>34.563.876.1.412.000-001213037<br>89.780.753.3.412.000-001028002</td>
	</tr>
	<tr>
		<td style="border-bottom-color:#000000;border-bottom-style:solid;border-bottom-width:0px;"><strong>Nomor KTP/Pelapor :</strong><br>3276025011660001-001213037<br>3276105011660001-001028002</td>
		<td>&nbsp;</td>
		<td style="border-bottom-color:#000000;border-bottom-style:solid;border-bottom-width:0px;"><strong>Nomor Paspor/Pelapor:</strong><br>&nbsp;</td>
	</tr>
	<tr><td colspan = "3">'.$tbl_alamat.'</td></tr>
	<tr><td colspan = "3">'.$tbl_pekerjaan.'</td></tr>
	<tr><td colspan = "3">'.$tbl_telepon.'</td></tr>
</table>
';

$tbl_surat_berharga = '
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#5D92F8">
	<tr>
		<td><strong>Surat Berharga</strong></td>
	</tr>
	<tr>
		<td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;border-left-style:solid;border-top-style:solid;"><div align = "center">Data Tidak Tersedia</div></td>
	</tr>
</table>
';

$tbl_penyertaan = '
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#5D92F8">
	<tr>
		<td><strong>Penyertaan</strong></td>
	</tr>
	<tr>
		<td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;border-left-style:solid;border-top-style:solid;"><div align = "center">Data Tidak Tersedia</div></td>
	</tr>
</table>
';

$tbl_kerdit = '
<table width="100%" border="0.1" cellpadding="0" cellspacing="0" bordercolor="#5D92F8">
	<tr>
		<td rowspan = "3" bgcolor = "#5D92F8"><div align="center">No</div></td>
		<td rowspan = "3" bgcolor = "#5D92F8"><div align="center">Pelapor<br>Sifat<br>No Rekening<br>update<br>Golongan Kerdit<br>Ket.Kondisi<br>Ket.Fasilitas</div></td>
		<td colspan = "4" bgcolor = "#5D92F8"><div align="center">Nilai</div></td>
        <td colspan = "2" bgcolor = "#5D92F8"><div align="center">Tunggakan</div></td>
        <td bgcolor = "#5D92F8"><div align="center">Penggunaan</div></td>
        <td bgcolor = "#5D92F8"colspan = "2"><div align="center">Status</div></td>
        <td bgcolor = "#5D92F8"><div align="center">Jangka</div></td>
	</tr>
	<tr>
		<td colspan = "3" bgcolor = "#5D92F8"><div align="center">Valuta</div></td>
		<td bgcolor = "#5D92F8"><div align="center">Plafon</div></td>
		<td bgcolor = "#5D92F8"><div align="center">Pokok</div></td>
		<td bgcolor = "#5D92F8"><div align="center">Bunga ON </div></td>
		<td bgcolor = "#5D92F8"><div align="center">Kel.Tarik<br>Sek. Ek.</div></td>
		<td bgcolor = "#5D92F8"><div align="center">Kondisi</div></td>
		<td bgcolor = "#5D92F8"><div align="center">Tgl Kondisi</div></td>
		<td bgcolor = "#5D92F8"><div align="center">Tgl Mulai<br>Akad Awal</div></td>
	</tr>
	<tr>
		<td colspan="3" bgcolor = "#5D92F8"><div align="center">% Bunga</div></td>
		<td bgcolor = "#5D92F8"><div align="center">BD Tertinggi<br>Baki Debet </div></td>
		<td bgcolor = "#5D92F8"><div align="center">Frek. (P/B)</div></td>
		<td bgcolor = "#5D92F8"><div align="center">Bunga OFF</div></td>
		<td bgcolor = "#5D92F8"><div align="center">Jenis</div></td>
		<td bgcolor = "#5D92F8"><div align="center">Sbb Macet</div></td>
		<td bgcolor = "#5D92F8"><div align="center">Tgl Macet</div></td>
		<td bgcolor = "#5D92F8"><div align="center">Jatuh Tempo</div></td>
	</tr>
</table>
';

$tbl_tagihan_lainnya = '
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#5D92F8">
	<tr>
		<td><strong>Tagihan Lainnya</strong></td>
	</tr>
	<tr>
		<td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;border-left-style:solid;border-top-style:solid;"><div align = "center">Data Tidak Tersedia</div></td>
	</tr>
</table>
';

$tbl_irrevocable_l = '
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#5D92F8">
	<tr>
		<td><strong>Irrevocable L/c</strong></td>
	</tr>
	<tr>
		<td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;border-left-style:solid;border-top-style:solid;"><div align = "center">Data Tidak Tersedia</div></td>
	</tr>
</table>
';

$tbl_garansi_bank= '
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#5D92F8">
	<tr>
		<td><strong>Garansi Bank</strong></td>
	</tr>
	<tr>
		<td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;border-left-style:solid;border-top-style:solid;"><div align = "center">Data Tidak Tersedia</div></td>
	</tr>
</table>
';

$tbl_penyediaan_dana = '
<style type="text/css">
.tes {
	font-family: "Times New Roman", Times, serif;
	font-size: 24px;
}
</style>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width = "100%" style="border-bottom-color:#000000;border-bottom-style:solid;border-bottom-width:px;"><span class = "tes">PENYEDIAAN DANA</span></td>
	</tr>
	<tr><td>'.$tbl_surat_berharga.'</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>'.$tbl_penyertaan.'</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td><strong>Kredit</strong></td></tr>
	<tr><td>'.$tbl_kerdit.'</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>'.$tbl_tagihan_lainnya.'</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>'.$tbl_irrevocable_l.'</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>'.$tbl_garansi_bank.'</td></tr>
</table>
';

$tbl_agunan = '
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#5D92F8">
	<tr>
		<td><strong>Agunan</strong></td>
	</tr>
	<tr>
		<td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;border-left-style:solid;border-top-style:solid;"><div align = "center">Data Tidak Tersedia</div></td>
	</tr>
</table>
';

$tbl_penjamin = '
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#5D92F8">
	<tr>
		<td><strong>Penjamin</strong></td>
	</tr>
	<tr>
		<td style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;border-left-style:solid;border-top-style:solid;"><div align = "center">Data Tidak Tersedia</div></td>
	</tr>
</table>
';

$tbl_rangkuman = '
<table width="100%" border="0.1" cellpadding="0" cellspacing="0">
	<tr>
		<td rowspan="2" bgcolor = "#5D92F8"><div align = "center">Pelapor</div></td>
		<td colspan="2" bgcolor = "#5D92F8"><div align = "center">Surat Berharga</div></td>
		<td colspan="2" bgcolor = "#5D92F8"><div align = "center">Kredit</div></td>
		<td colspan="2" bgcolor = "#5D92F8"><div align = "center">Tagihan Lainnya</div></td>
		<td colspan="2" bgcolor = "#5D92F8"><div align = "center">Penyertaan</div></td>
		<td colspan="2" bgcolor = "#5D92F8"><div align = "center">Irrevocable L/c</div></td>
		<td colspan="2" bgcolor = "#5D92F8"><div align = "center">Garansi Bank</div></td>
		<td colspan="2" bgcolor = "#5D92F8"><div align = "center">Kredit Kelolaan</div></td>
		<td colspan="2" bgcolor = "#5D92F8"><div align = "center">Total</div></td>		  
		<td rowspan="2" bgcolor = "#5D92F8"><div align = "center">Kolektibilitas<br>Terendah</div></td>
	</tr>
	<tr>
		<td bgcolor = "#5D92F8"><div align = "center">Plafon<br>(Rp)</div></td>
		<td bgcolor = "#5D92F8"><div align = "center">Baki<br>Debet<br>(Rp)</div></td>
		<td bgcolor = "#5D92F8"><div align = "center">Plafon<br>(Rp)</div></td>
        <td bgcolor = "#5D92F8"><div align = "center">Baki<br>Debet<br>(Rp)</div></td>
		<td bgcolor = "#5D92F8"><div align = "center">Plafon<br>(Rp)</div></td>
        <td bgcolor = "#5D92F8"><div align = "center">Baki<br>Debet<br>(Rp)</div></td>
		<td bgcolor = "#5D92F8"><div align = "center">Plafon<br>(Rp)</div></td>
        <td bgcolor = "#5D92F8"><div align = "center">Baki<br>Debet<br>(Rp)</div></td>
		<td bgcolor = "#5D92F8"><div align = "center">Plafon<br>(Rp)</div></td>
        <td bgcolor = "#5D92F8"><div align = "center">Baki<br>Debet<br>(Rp)</div></td>
		<td bgcolor = "#5D92F8"><div align = "center">Plafon<br>(Rp)</div></td>
        <td bgcolor = "#5D92F8"><div align = "center">Baki<br>Debet<br>(Rp)</div></td>
		<td bgcolor = "#5D92F8"><div align = "center">Plafon<br>(Rp)</div></td>
        <td bgcolor = "#5D92F8"><div align = "center">Baki<br>Debet<br>(Rp)</div></td>
		<td bgcolor = "#5D92F8"><div align = "center">Plafon<br>(Rp)</div></td>
        <td bgcolor = "#5D92F8"><div align = "center">Baki<br>Debet<br>(Rp)</div></td>		 
	</tr>
	<tr>
		<td><div align="center">001213037</div></td>
        <td>0</td>
        <td><div align="center">0</div></td>
        <td><div align="center">145,209,888</div></td>
        <td><div align="center">95,209,888</div>            </td>
        <td><div align="center">0</div></td>
        <td><div align="center">0</div></td>
		<td><div align="center">0</div></td>
        <td><div align="center">0</div></td>
		<td><div align="center">0</div></td>
        <td><div align="center">0</div></td>
		<td><div align="center">0</div></td>
        <td><div align="center">0</div></td>
		<td><div align="center">0</div></td>
        <td><div align="center">0</div></td>
		<td><div align="center">145,209,888</div></td>
        <td><div align="center">95,209,888</div></td>
        <td><div align="center">5</div></td>
	</tr>
	<tr>
		<td><div align="center">001028002</div></td>
        <td>0</td>
        <td><div align="center">0</div></td>
        <td><div align="center">28,595,019</div></td>
        <td><div align="center">28,595,019</div>            </td>
        <td><div align="center">0</div></td>
        <td><div align="center">0</div></td>
		<td><div align="center">0</div></td>
        <td><div align="center">0</div></td>
		<td><div align="center">0</div></td>
        <td><div align="center">0</div></td>
		<td><div align="center">0</div></td>
        <td><div align="center">0</div></td>
		<td><div align="center">0</div></td>
        <td><div align="center">0</div></td>
		<td><div align="center">28,595,019</div></td>
        <td><div align="center">28,595,019</div></td>
        <td><div align="center">4</div></td>
	</tr>
	<tr>
		<td><div align="center">TOTAL</div></td>
        <td>0</td>
        <td><div align="center">0</div></td>
        <td><div align="center">173,804,907</div></td>
        <td><div align="center">123,804,907</div>            </td>
        <td><div align="center">0</div></td>
        <td><div align="center">0</div></td>
		<td><div align="center">0</div></td>
        <td><div align="center">0</div></td>
		<td><div align="center">0</div></td>
        <td><div align="center">0</div></td>
		<td><div align="center">0</div></td>
        <td><div align="center">0</div></td>
		<td><div align="center">0</div></td>
        <td><div align="center">0</div></td>
		<td><div align="center">173,804,907</div></td>
        <td><div align="center">123,804,907</div></td>
        <td><div align="center">5</div></td>
	</tr>
</table>
';

$tbl_agunan_penjamin = '
<style type="text/css">
.tes {
	font-family: "Times New Roman", Times, serif;
	font-size: 24px;
}
</style>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width = "100%" style="border-bottom-color:#000000;border-bottom-style:solid;border-bottom-width:px;"><span class = "tes">AGUNAN DAN PENJAMIN</span></td>
	</tr>
	<tr><td>'.$tbl_agunan.'</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>'.$tbl_penjamin.'</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td><strong>Rangkuman Informasi Fasilitas</strong></td></tr>
	<tr><td>'.$tbl_rangkuman.'</td></tr>
	<tr><td>&nbsp;</td></tr>
</table>
';

$tbl_sumber_data = '
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="2" style = "border-bottom-style:solid;">Sumber Data </td>
	</tr>
    <tr>
		<td>001028002</td>
        <td>- PT. BANK OCBC NISP, Tbk CABANG JKT KP</td>
	</tr>
    <tr>
		<td>001213037</td>
        <td>- PT BANK BTPN TBK CABANG JAKARTA PETOGOGAN</td>
    </tr>
	<tr>
		<td>Dicetak oleh: sid/ Tanggal cetak: 30-09-2011 06:54:04</td>
	</tr>
    <tr>
        <td colspan = "2" style="border-color: #5D92F8;border-bottom-style:solid;border-right-style:solid;border-left-style:solid;border-top-style:solid;"><div align = "center">Informasi Debitur ini tercetak secara otomatis oleh sistem sehingga tidak memerlukan tandatangan Pejabat yang berwenang.</div></td>
	</tr>
</table>
';

$pdf->writeHTML($tbl_header, true , false , true , false , '');
$pdf->writeHTML($tbl_data_permintaan, true , false , true , false , '');
$pdf->writeHTML($tbl_informasi_debitur, true , false , true , false , '');
$pdf->writeHTML($tbl_penyediaan_dana, true , false , true , false , '');
$pdf->writeHTML($tbl_agunan_penjamin, true , false , true, false , '');
$pdf->writeHTML($tbl_sumber_data, true , false , true , false , '');

$pdf->Output('BIC_Respon.pdf', 'I');
?>