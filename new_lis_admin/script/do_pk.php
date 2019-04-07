<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?  
require ("../lib/open_con.php");
	
	$text0=$_GET['text0'];
	$text1=$_GET['text1'];
	$text2=$_GET['text2'];
	$text3=$_GET['text3'];
	$text4=$_GET['text4'];
	$text5=$_GET['text5'];
	$text6=$_GET['text6'];
	$text7=$_GET['text7'];
	$text8=$_GET['text8'];
	$text9=$_GET['text9'];
	$text10=$_GET['text10'];
	$text11=$_GET['text11'];
	$text12=$_GET['text12'];
	$text13=$_GET['text13'];
	$text14=$_GET['text14'];
	$text15=$_GET['text15'];
	$text16=$_GET['text16'];
	$text17=$_GET['text17'];
	$text18=$_GET['text18'];
	$text19=$_GET['text19'];
	$text20=$_GET['text20'];
	$text21=$_GET['text21'];
	$text22=$_GET['text22'];
	$text23=$_GET['text23'];
	$text24=$_GET['text24'];
	$text25=$_GET['text25'];
	$text26=$_GET['text26'];
	$text27=$_GET['text27'];
	$text28=$_GET['text28'];
	$text29=$_GET['text29'];
	$text30=$_GET['text29'];
	$text31=$_GET['text31'];
	$text32=$_GET['text32'];
	$text33=$_GET['text33'];

	//echo "0----".$text0."</br>";
	//echo "1----".$text1."</br>";
	//echo "2----".$text2."</br>";
	//echo "3----".$text3."</br>";
	//echo "4----".$text4."</br>";
	//echo "5----".$text5."</br>";
	//echo "6----".$text6."</br>";
	//echo "7----".$text7."</br>";
	//echo "8----".$text8."</br>";
	//echo "9----".$text9."</br>";
	//echo "10----".$text10."</br>";
	//echo "11----".$text11."</br>";
	//echo "12----".$text12."</br>";
	//echo "13----".$text13."</br>";
	//echo "14----".$text14."</br>";
	//echo "15----".$text15."</br>";
	//echo "16----".$text16."</br>";
	//echo "17----".$text17."</br>";
	//echo "18----".$text18."</br>";
	//echo "19----".$text19."</br>";
	//echo "20----".$text20."</br>";
	//echo "21----".$text21."</br>";
	//echo "22----".$text22."</br>";
	//echo "23----".$text23."</br>";
	//echo "24----".$text24."</br>";
	//echo "25----".$text25."</br>";
	//echo "26----".$text26."</br>";
	//echo "27----".$text27."</br>";
	//echo "28----".$text28."</br>";
	//echo "29----".$text29."</br>";
	//echo "30----".$text30."</br>";
	//echo "31----".$text31."</br>";
	//echo "32----".$text32."</br>";
	//echo "33----".$text33."</br>";
	$patch="C:/xampp/htdocs/lismega_devel/PostScript/tmp_erik/";
	$ourFileName = $patch."tpk1.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
	
	$pk1[0]=".0 setgray /Arial-BoldMT findfont 10 scalefont setfont (NOMOR        : $text0) 315 720 CC ";
	$pk1[1]=".0 setgray /Arial-MT findfont 10 scalefont setfont 50 690 moveto ($text1) show";
	$pk1[2]=".0 setgray /Arial-MT findfont 10 scalefont setfont 125 690 moveto ($text2) show";
	$pk1[3]=".0 setgray /Arial-MT findfont 10 scalefont setfont 50 650 moveto ($text3) show";
	$pk1[4]=".0 setgray /Arial-MT findfont 10 scalefont setfont 80 640 moveto ($text4) show";
	$pk1[5]=".0 setgray /Arial-MT findfont 10 scalefont setfont 80 630 moveto ($text5) show";
	$pk1[6]=".0 setgray /Arial-MT findfont 10 scalefont setfont 170 600 moveto ($text6) show";
	$pk1[7]=".0 setgray /Arial-MT findfont 10 scalefont setfont 330 600 moveto ($text7) show";
	$pk1[8]=".0 setgray /Arial-MT findfont 10 scalefont setfont 65 590 moveto ($text8) show";
	$pk1[9]=".0 setgray /Arial-MT findfont 10 scalefont setfont 220 590 moveto ($text9) show";
	$pk1[10]=".0 setgray /Arial-MT findfont 8 scalefont setfont 205 390 moveto ($text11) show";
	$pk1[11]=".0 setgray /Arial-MT findfont 8 scalefont setfont 205 380 moveto ($text12) show";
	$pk1[12]=".0 setgray /Arial-MT findfont 8 scalefont setfont 205 370 moveto ($text13) show";
	$pk1[13]=".0 setgray /Arial-MT findfont 8 scalefont setfont 205 360 moveto () show";
	$pk1[14]=".0 setgray /Arial-MT findfont 8 scalefont setfont 205 270 moveto ($text15) show";
	$pk1[15]=".0 setgray /Arial-MT findfont 8 scalefont setfont 205 250 moveto () show";
	$pk1[16]=".0 setgray /Arial-MT findfont 8 scalefont setfont 205 160 moveto ($text17) show";
	$pk1[17]=".0 setgray /Arial-MT findfont 8 scalefont setfont 205 150 moveto ($text18) show";
	$pk1[18]=".0 setgray /Arial-MT findfont 10 scalefont setfont 205 140 moveto () show";
	$pk1[19]=".0 setgray /Arial-MT findfont 10 scalefont setfont 205 120 moveto () show";
	for($i=0;$i<20;$i++)
	{
		$line=$pk1[$i]."\n";
		fwrite($ourFileHandle,$line);
	}
		fclose($ourFileHandle);

		///////////////////////// pirnt text area 10//////////////////
	//$plus_y=0;//variable dummy untuk menambahkan kor_y sebanyak 15
	$tmp_len10="";
	$kor_y10=560;//<< mengeset kordinat yang pertama 
	$count10=0;//<< hitung jumlah modulus 
	$set=90;//<< set panjang yang di inginkan 
	$len_txt10=strlen($text10);
	
	for($t=0;$t<=$len_txt10;$t++)
	{
		if($t%$set==0)
		{
		$count10=$count10+count($t);
		$tmp_len10=$tmp_len10.substr($text10,$t,$set)."</br>";
		}
	}
 
 
	$ourFileName = $patch."text10.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
	
	$split10=explode("</br>",$tmp_len10);
	for($i10=0;$i10<$count10;$i10++)
	{
		$arr_h=$split10[$i10];
		$tmp_pk10=".0 setgray /Arial-MT findfont 8 scalefont setfont 65 $kor_y10 moveto ($arr_h) show";
		$kor_y10-=10;
		$tmp_arr=$tmp_pk10;
		//echo $tmp_arr."</br>";
		fwrite($ourFileHandle,$tmp_arr."\n");
	}
			fclose($ourFileHandle);

		//echo "</br>";
		
		
		
	$tmp_len14="";
	$kor_y14=360;//<< mengeset kordinat yang pertama 
	$count14=0;//<< hitung jumlah modulus 
	$set14=90;//<< set panjang yang di inginkan 
	$len_txt14=strlen($text14);
	
	for($t=0;$t<=$len_txt14;$t++)
	{
		if($t%$set14==0)
		{
		$count14=$count14+count($t);
		$tmp_len14=$tmp_len14.substr($text14,$t,$set14)."</br>";
		}
	}
 
 
	$ourFileName = $patch."text14.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
	
	$split14=explode("</br>",$tmp_len14);
	for($i14=0;$i14<$count14;$i14++)
	{
		$arr_h=$split14[$i14];
		$tmp_pk14=".0 setgray /Arial-MT findfont 8 scalefont setfont 205 $kor_y14 moveto ($arr_h) show";
		$kor_y14-=10;
		$tmp_arr=$tmp_pk14;
		//echo $tmp_arr."</br>";
		fwrite($ourFileHandle,$tmp_arr."\n");
	}
			fclose($ourFileHandle);

	
//echo "</br>";
		
		
		
	$tmp_len16="";
	$kor_y16=250;//<< mengeset kordinat yang pertama 
	$count16=0;//<< hitung jumlah modulus 
	$set16=90;//<< set panjang yang di inginkan 
	$len_txt16=strlen($text16);
	
	for($t=0;$t<=$len_txt16;$t++)
	{
		if($t%$set16==0)
		{
		$count16=$count16+count($t);
		$tmp_len16=$tmp_len16.substr($text16,$t,$set16)."</br>";
		}
	}
 
 
	$ourFileName = $patch."text16.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
	
	$split16=explode("</br>",$tmp_len16);
	for($i16=0;$i16<$count16;$i16++)
	{
		$arr_h=$split16[$i16];
		$tmp_pk16=".0 setgray /Arial-MT findfont 8 scalefont setfont 205 $kor_y16 moveto ($arr_h) show";
		$kor_y16-=10;
		$tmp_arr=$tmp_pk16;
		//echo $tmp_arr."</br>";
		fwrite($ourFileHandle,$tmp_arr."\n");
	}
	//echo strlen($split16[0])."</br>";
	//echo strlen($split16[1])."</br>";
	//echo strlen($split16[2])."</br>";
	//echo strlen($split16[3])."</br>";

			fclose($ourFileHandle);
			
			//echo "</br>";
		
		
		
	$tmp_len19="";
	$kor_y19=140;//<< mengeset kordinat yang pertama 
	$count19=0;//<< hitung jumlah modulus 
	$set19=90;//<< set panjang yang di inginkan 
	$len_txt19=strlen($text19);
	
	for($t=0;$t<=$len_txt19;$t++)
	{
		if($t%$set19==0)
		{
		$count19=$count19+count($t);
		$tmp_len19=$tmp_len19.substr($text19,$t,$set19)."</br>";
		}
	}
 //echo $count19."</br>";
 
	$ourFileName = $patch."text19.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
	
	$split19=explode("</br>",$tmp_len19);
	//echo $tmp_len19."</br>";
	for($i19=0;$i19<$count19;$i19++)
	{
		$arr_h=$split19[$i19];
		$tmp_pk19=".0 setgray /Arial-MT findfont 8 scalefont setfont 205 $kor_y19 moveto ($arr_h) show";
		$kor_y19-=10;
		$tmp_arr=$tmp_pk19;
		//echo $tmp_arr."</br>";
		fwrite($ourFileHandle,$tmp_arr."\n");
	}
	//echo strlen($split19[1])."</br>";
	//echo strlen($split19[2]);
			fclose($ourFileHandle);
			
			
			
			
			
			
			
			
			
			
			
			
			//echo "</br>";
		
		
		
	$tmp_len20="";
	$kor_y20=120;//<< mengeset kordinat yang pertama 
	$count20=0;//<< hitung jumlah modulus 
	$set20=90;//<< set panjang yang di inginkan 
	$len_txt20=strlen($text20);
	
	for($t=0;$t<=$len_txt20;$t++)
	{
		if($t%$set20==0)
		{
		$count20=$count20+count($t);
		$tmp_len20=$tmp_len20.substr($text20,$t,$set20)."</br>";
		}
	}
 
 
	$ourFileName = $patch."text20.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
	
	$split20=explode("</br>",$tmp_len20);
	for($i20=0;$i20<$count20;$i20++)
	{
		$arr_h=$split20[$i20];
		$tmp_pk20=".0 setgray /Arial-MT findfont 8 scalefont setfont 205 $kor_y20 moveto ($arr_h) show";
		$kor_y20-=10;
		$tmp_arr=$tmp_pk20;
		//echo $tmp_arr."</br>";
		fwrite($ourFileHandle,$tmp_arr."\n");
	}
	//echo strlen($split20[0])."</br>";
	//echo strlen($split20[1])."</br>";
	//echo strlen($split20[2])."</br>";
	//echo strlen($split20[3])."</br>";
	//echo strlen($split20[4])."</br>";
			fclose($ourFileHandle);
			
			
			
						//echo "</br>";
		
		
		
	$tmp_len21="";
	$kor_y21=680;//<< mengeset kordinat yang pertama 
	$count21=0;//<< hitung jumlah modulus 
	$set21=120;//<< set panjang yang di inginkan 
	$len_txt21=strlen($text21);
	
	for($t=0;$t<=$len_txt21;$t++)
	{
		if($t%$set21==0)
		{
		$count21=$count21+count($t);
		$tmp_len21=$tmp_len21.substr($text21,$t,$set21)."</br>";
		}
	}
 
 
	$ourFileName = $patch."text21.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
	
	$split21=explode("</br>",$tmp_len21);
	for($i21=0;$i21<$count21;$i21++)
	{
		$arr_h=$split21[$i21];
		$tmp_pk21=".0 setgray /Arial-MT findfont 8 scalefont setfont 85 $kor_y21 moveto ($arr_h) show";
		$kor_y21-=10;
		$tmp_arr=$tmp_pk21;
		//echo $tmp_arr."</br>";
		fwrite($ourFileHandle,$tmp_arr."\n");
	}
	//echo strlen($split21[0])."</br>";
	//echo strlen($split21[1])."</br>";
	//echo strlen($split21[2])."</br>";
	//echo strlen($split21[3])."</br>";
	//echo strlen($split21[4])."</br>";
			fclose($ourFileHandle);
			
						//echo "</br>";
		
		
		
	$tmp_len22="";
	$kor_y22=590;//<< mengeset kordinat yang pertama 
	$count22=0;//<< hitung jumlah modulus 
	$set22=120;//<< set panjang yang di inginkan 
	$len_txt22=strlen($text22);
	
	for($t=0;$t<=$len_txt22;$t++)
	{
		if($t%$set22==0)
		{
		$count22=$count22+count($t);
		$tmp_len22=$tmp_len22.substr($text22,$t,$set22)."</br>";
		}
	}
 
 
	$ourFileName = $patch."text22.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
	
	$split22=explode("</br>",$tmp_len22);
	for($i22=0;$i22<$count22;$i22++)
	{
		$arr_h=$split22[$i22];
		$tmp_pk22=".0 setgray /Arial-MT findfont 8 scalefont setfont 85 $kor_y22 moveto ($arr_h) show";
		$kor_y22-=10;
		$tmp_arr=$tmp_pk22;
		//echo $tmp_arr."</br>";
		fwrite($ourFileHandle,$tmp_arr."\n");
	}
	//echo strlen($split22[0])."</br>";
	//echo strlen($split22[1])."</br>";
	//echo strlen($split22[2])."</br>";
	//echo strlen($split22[3])."</br>";
	//echo strlen($split22[4])."</br>";
			fclose($ourFileHandle);
			
			
			
			
						//echo "</br>";
		
		
		
	$tmp_len23="";
	$kor_y23=500;//<< mengeset kordinat yang pertama 
	$count23=0;//<< hitung jumlah modulus 
	$set23=120;//<< set panjang yang di inginkan 
	$len_txt23=strlen($text23);

	for($t=0;$t<=$len_txt23;$t++)
	{
		if($t%$set23==0)
		{
		$count23=$count23+count($t);
		$tmp_len23=$tmp_len23.substr($text23,$t,$set23)."</br>";
		}
	}
 
 
	$ourFileName = $patch."text23.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
	
	$split23=explode("</br>",$tmp_len23);
	for($i23=0;$i23<$count23;$i23++)
	{
		$arr_h=$split23[$i23];
		$tmp_pk23=".0 setgray /Arial-MT findfont 8 scalefont setfont 85 $kor_y23 moveto ($arr_h) show";
		$kor_y23-=10;
		$tmp_arr=$tmp_pk23;
		//echo $tmp_arr."</br>";
		fwrite($ourFileHandle,$tmp_arr."\n");
	}
	//echo strlen($split23[0])."</br>";
	//echo strlen($split23[1])."</br>";
	//echo strlen($split23[2])."</br>";
	//echo strlen($split23[3])."</br>";
	//echo strlen($split23[4])."</br>";
		//echo $len_txt23;
			fclose($ourFileHandle);
			
			
			
						//echo "</br>";
		
		
		
	$tmp_len24="";
	$kor_y24=200;//<< mengeset kordinat yang pertama 
	$count24=0;//<< hitung jumlah modulus 
	$set24=120;//<< set panjang yang di inginkan 
	$len_txt24=strlen($text24);
	
	for($t=0;$t<=$len_txt24;$t++)
	{
		if($t%$set24==0)
		{
		$count24=$count24+count($t);
		$tmp_len24=$tmp_len24.substr($text24,$t,$set24)."</br>";
		}
	}
 
 
	$ourFileName = $patch."text24.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
	
	$split24=explode("</br>",$tmp_len24);
	for($i24=0;$i24<$count24;$i24++)
	{
		$arr_h=$split24[$i24];
		$tmp_pk24=".0 setgray /Arial-MT findfont 8 scalefont setfont 50 $kor_y24 moveto ($arr_h) show";
		$kor_y24-=10;
		$tmp_arr=$tmp_pk24;
		//echo $tmp_arr."</br>";
		fwrite($ourFileHandle,$tmp_arr."\n");
	}
	//echo strlen($split24[0])."</br>";
	//echo strlen($split24[1])."</br>";
	//echo strlen($split24[2])."</br>";
	//echo strlen($split24[3])."</br>";
	//echo strlen($split24[4])."</br>";
			fclose($ourFileHandle);
			
			
			
			
			
			
			
			
			
			
						//echo "</br>";
		
		
		
	$tmp_len25="";
	$kor_y25=680;//<< mengeset kordinat yang pertama 
	$count25=0;//<< hitung jumlah modulus 
	$set25=120;//<< set panjang yang di inginkan 
	$len_txt25=strlen($text25);
	
	for($t=0;$t<=$len_txt25;$t++)
	{
		if($t%$set25==0)
		{
		$count25=$count25+count($t);
		$tmp_len25=$tmp_len25.substr($text25,$t,$set25)."</br>";
		}
	}
 
 
	$ourFileName = $patch."text25.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
	
	$split25=explode("</br>",$tmp_len25);
	for($i25=0;$i25<$count25;$i25++)
	{
		$arr_h=$split25[$i25];
		$tmp_pk25=".0 setgray /Arial-MT findfont 8 scalefont setfont 65 $kor_y25 moveto ($arr_h) show";
		$kor_y25-=10;
		$tmp_arr=$tmp_pk25;
		//echo $tmp_arr."</br>";
		fwrite($ourFileHandle,$tmp_arr."\n");
	}
	//echo strlen($split25[0])."</br>";
	//echo strlen($split25[1])."</br>";
	//echo strlen($split25[2])."</br>";
	//echo strlen($split25[3])."</br>";
	//echo strlen($split25[4])."</br>";
			fclose($ourFileHandle);
			
			
			
			
			
			
			
						//echo "</br>";
		
		
		
	$tmp_len26="";
	$kor_y26=580;//<< mengeset kordinat yang pertama 
	$count26=0;//<< hitung jumlah modulus 
	$set26=120;//<< set panjang yang di inginkan 
	$len_txt26=strlen($text26);
	
	for($t=0;$t<=$len_txt26;$t++)
	{
		if($t%$set26==0)
		{
		$count26=$count26+count($t);
		$tmp_len26=$tmp_len26.substr($text26,$t,$set26)."</br>";
		}
	}
 
 
	$ourFileName = $patch."text26.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
	
	$split26=explode("</br>",$tmp_len26);
	for($i26=0;$i26<$count26;$i26++)
	{
		$arr_h=$split26[$i26];
		$tmp_pk26=".0 setgray /Arial-MT findfont 8 scalefont setfont 65 $kor_y26 moveto ($arr_h) show";
		$kor_y26-=10;
		$tmp_arr=$tmp_pk26;
		//echo $tmp_arr."</br>";
		fwrite($ourFileHandle,$tmp_arr."\n");
	}
	//echo strlen($split26[0])."</br>";
	//echo strlen($split26[1])."</br>";
	//echo strlen($split26[2])."</br>";
	//echo strlen($split26[3])."</br>";
	//echo strlen($split26[4])."</br>";
			fclose($ourFileHandle);
			
			
			
			
			
	$ourFileName = $patch."tpk3.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
	$qkl[0]=".0 setgray /Arial-MT findfont 10 scalefont setfont 370 420 moveto ($text27) show";
	$qkl[1]=".0 setgray /Arial-MT findfont 10 scalefont setfont ($text32) 350 250 CC"; 
	$qkl[2]=".0 setgray /Arial-MT findfont 10 scalefont setfont ($text33) 500 250 CC"; 
	$qkl[3]=".0 setgray /Arial-MT findfont 10 scalefont setfont ($text28) 100 250 CC"; 
	$qkl[4]=".0 setgray /Arial-MT findfont 10 scalefont setfont ($text30) 100 240 CC"; 
	$qkl[5]=".0 setgray /Arial-MT findfont 10 scalefont setfont ($text29) 220 250 CC"; 
	$qkl[6]=".0 setgray /Arial-MT findfont 10 scalefont setfont ($text31) 220 240 CC"; 
	for($i=0;$i<7;$i++)
	{
		$line=$qkl[$i]."\n";
		fwrite($ourFileHandle,$line);
	}
		fclose($ourFileHandle);
			
	
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
echo exec('pk');
			
			
			
			
			
			
?>

<body>
<table align="center" width="960" border="0">
  <tr>
    <td align="center"><a style="text-decoration:none;" href="../postscript/pk.pdf">Download Perjanjian Kredit</a></td>
  </tr>
</table>

</body>
</html>
<?	require ("../lib/close_con.php"); ?>