<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?
 
require ("../lib/open_con.php");

$text0=$_POST['text0'];
$text1=$_POST['text1'];
$text2=$_POST['text2'];
$text3=$_POST['text3'];
$text4=$_POST['text4'];
$text5=$_POST['text5'];
$text6=$_POST['text6'];
$text7=$_POST['text7'];
$text8=$_POST['text8'];
$text9=$_POST['text9'];
$text10=$_POST['text10'];
$text11=$_POST['text11'];
$text12=$_POST['text12'];
$text13=$_POST['text13'];
$text14=$_POST['text14'];
$text15=$_POST['text15'];
$text16=$_POST['text16'];
$text17=$_POST['text17'];
$text18=$_POST['text18'];
$text19=$_POST['text19'];
$text20=$_POST['text20'];
$text21=$_POST['text21'];
$text22=$_POST['text22'];
$text23=$_POST['text23'];
$text24=$_POST['text24'];
$text25=$_POST['text25'];
$text26=$_POST['text26'];
$text27=$_POST['text27'];
$text28=$_POST['text28'];
$text29=$_POST['text29'];
$text30=$_POST['text30'];
$text31=$_POST['text31'];
$text32=$_POST['text32'];
$text33=$_POST['text33'];
$text34=$_POST['text34'];
$text35=$_POST['text35'];
$text36=$_POST['text36'];
$text37=$_POST['text37'];
$text38=$_POST['text38'];



$patch="C:/xampp/htdocs/lismega_DEVEL/PostScript/tmp_erik/";
$ourFileName = $patch."sppk01.erik";
$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
$kura[0]=".0 setgray /Arial-MT findfont 10 scalefont setfont 50 730 moveto ($text0) show% input tempat";
$kura[1]=".0 setgray /Arial-MT findfont 10 scalefont setfont 125 730 moveto (,$text1) show% input tanggal";
$kura[2]=".0 setgray /Arial-MT findfont 10 scalefont setfont 105 710 moveto ($text2) show%input nomor";
$kura[3]=".0 setgray /Arial-MT-BoldMT findfont 10 scalefont setfont 50 660 moveto ($text3) show% input nama";
$kura[4]=".0 setgray /Arial-MT findfont 10 scalefont setfont 50 650 moveto ($text4) show%input alamat";
$kura[5]=".0 setgray /Arial-MT findfont 10 scalefont setfont 220 620 moveto ($text5) show%input tanggal";
$kura[6]=".0 setgray /Arial-MT findfont 10 scalefont setfont 180 580 moveto ($text6) show% input debitur";
$kura[7]=".0 setgray /Arial findfont 10 scalefont setfont ($text7) 330 545 CC% input term load 1";
$kura[8]=".0 setgray /Arial findfont 10 scalefont setfont ($text8) 330 535 CC %input term loan 2";
$kura[9]=".0 setgray /Arial findfont 10 scalefont setfont ($text9) 330 525 CC % input total";
$kura[10]=".0 setgray /Arial findfont 10 scalefont setfont 180 510 moveto ($text10) show%input jenis fasilitas kredit";
$kura[11]=".0 setgray /Arial findfont 10 scalefont setfont 180 500 moveto ($text11) show%input sifat kredit";
$kura[12]=".0 setgray /Arial findfont 10 scalefont setfont 180 490 moveto ($text12) show%input tujuan kredit";
$kura[13]=".0 setgray /Arial findfont 10 scalefont setfont 180 480 moveto () show%input tujuan kredit";
$kura[14]=".0 setgray /Arial findfont 10 scalefont setfont 180 470 moveto ($text13) show%input Jangka Waktu";
$kura[15]=".0 setgray /Arial findfont 10 scalefont setfont 180 460 moveto ($text14) show%input Suku Bunga";
$kura[16]=".0 setgray /Arial findfont 10 scalefont setfont 180 450 moveto ($text15) show%input Angsuran Perbulan";
$kura[17]=".0 setgray /Arial findfont 10 scalefont setfont 180 440 moveto ($text16) show%input Angsuran Perbulan";
$kura[25]=".0 setgray /Arial findfont 10 scalefont setfont 330 430 moveto ($text17) show%DDProvisi 1% Flat) show%";
$kura[26]=".0 setgray /Arial findfont 10 scalefont setfont 330 420 moveto ($text18) show%DD Administrasi Kredit";
$kura[27]=".0 setgray /Arial findfont 10 scalefont setfont 330 410 moveto ($text19) show%DD Asuransi Kerugian";
$kura[28]=".0 setgray /Arial findfont 10 scalefont setfont 330 400 moveto ($text20) show%DD Notaris";
$kura[18]=".0 setgray /Arial findfont 10 scalefont setfont 180 300 moveto ($text22) show% input penjanjian kredit";
$kura[19]=".0 setgray /Arial findfont 10 scalefont setfont 180 290 moveto ($text23) show%input penjanjian kredit";
$kura[20]=".0 setgray /Arial findfont 10 scalefont setfont 180 280 moveto ($text24) show%input denda";
$kura[21]=".0 setgray /Arial findfont 10 scalefont setfont 180 220 moveto ($text25) show%input pelunasan";
$kura[22]=".0 setgray /Arial findfont 10 scalefont setfont 180 160 moveto ($text26) show%input pelunasan";
$kura[23]=".0 setgray /Arial-MT findfont 10 scalefont setfont 50 70 moveto ($text27) show%";
$kura[24]=".0 setgray /Arial-MT findfont 10 scalefont setfont 50 60 moveto ($text28) show%";

	for($i=0;$i<29;$i++)
	{
		$line=$kura[$i]."\n";
		fwrite($ourFileHandle,$line);
	}
fclose($ourFileHandle);
	$tmp_len21="";
	$kor_y21=390;//<< mengeset kordinat yang pertama 
	$count21=0;//<< hitung jumlah modulus 
	$set21=80;//<< set panjang yang di inginkan 
	$len_txt21=strlen($text21);
	
	for($t=0;$t<=$len_txt21;$t++)
	{
		if($t%$set21==0)
		{
		$count21=$count21+count($t);
		$tmp_len21=$tmp_len21.substr($text21,$t,$set21)."</br>";
		}
	}
 
 
	$ourFileName = $patch."agunan.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
	
	$split21=explode("</br>",$tmp_len21);
	for($i21=0;$i21<$count21;$i21++)
	{
		$arr_h=$split21[$i21];
		$tmp_pk21=".0 setgray /Arial-MT findfont 8 scalefont setfont 180 $kor_y21 moveto ($arr_h) show";
		$kor_y21-=10;
		$tmp_arr=$tmp_pk21;
		//echo $tmp_arr."</br>";
		fwrite($ourFileHandle,$tmp_arr."\n");
	}
	fclose($ourFileHandle);
	
	//Echo $text29;
$ourFileName = $patch."sppk02.erik";
$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");	
$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
$rumah[0]=".0 setgray /Arial findfont 10 scalefont setfont ($text30) 85 670 CC % input nama pinca";
$rumah[1]=".0 setgray /Arial findfont 10 scalefont setfont ($text31) 223 670 CC % input nama ao";
$rumah[2]=".0 setgray /Arial findfont 10 scalefont setfont ($text32) 323 670 CC % input nama debitur";
$rumah[3]=".0 setgray /Arial findfont 10 scalefont setfont ($text33) 488 670 CC % input nama menyetujui";
$rumah[4]=".0 setgray /Arial-boldmt findfont 10 scalefont setfont ($text34) 315 600 CC % input debitur ";
$rumah[5]=".0 setgray /Arial findfont 10 scalefont setfont 100 530 moveto ($text35) show% bisa dari database coi";
$rumah[6]=".0 setgray /Arial findfont 10 scalefont setfont 100 520 moveto ($text36) show% bisa dari data base";
$rumah[7]=".0 setgray /Arial findfont 10 scalefont setfont 100 500 moveto ($text37) show % bisa di ambil dari database";
$rumah[8]=".0 setgray /Arial findfont 10 scalefont setfont 100 490 moveto ($text38) show %bisa di ambil dari database";
$rumah[9]=".0 setgray /Arial-BoldMT findfont 10 scalefont setfont 50 740 moveto ($text29) show% input nama cabang";
	for($i=0;$i<10;$i++)
	{
		$line=$rumah[$i]."\n";
		fwrite($ourFileHandle,$line);
	}
fclose($ourFileHandle);
	
echo exec("sppk");
?>

<body>

<table align="center" width="960" border="0">
  <tr>
    <td align="center"><a style="text-decoration:none;" href="../postscript/sppk.pdf">Downlaod SPPK</a></td>
  </tr>
</table>
</body>
</html>
<? require ("../lib/close_con.php"); ?>