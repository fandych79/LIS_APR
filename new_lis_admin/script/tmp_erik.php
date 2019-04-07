   <?	$patch="C:/xampp/htdocs/lismega_DEVEL/PostScript/tmp_erik/";
	$ourFileName = $patch."01.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
	
	$a[0]=".0 setgray /Arial findfont 8 scalefont setfont 85 730 moveto ($proc_name) show"; 
	$a[1]=".0 setgray /Arial findfont 8 scalefont setfont 500 730 moveto ($c_plafond) show"; 
	$a[2]=".0 setgray /Arial findfont 8 scalefont setfont 175 680 moveto ($custfullname) show ";
	$a[3]=".0 setgray /Arial findfont 8 scalefont setfont 175 662 moveto ($nickname) show";
	$a[4]=".0 setgray /Arial findfont 8 scalefont setfont 175 644 moveto ($gender) show";
	$a[5]=".0 setgray /Arial findfont 8 scalefont setfont 175 626 moveto ($ktpno) show";
	$a[6]=".0 setgray /Arial findfont 8 scalefont setfont 175 608 moveto ($expktp) show";
	$a[7]=".0 setgray /Arial findfont 8 scalefont setfont 175 590 moveto ($bplace) show";
	$a[8]=".0 setgray /Arial findfont 8 scalefont setfont 230 590 moveto ($badd) show";
	$a[9]=".0 setgray /Arial findfont 8 scalefont setfont 175 572 moveto ($mothername) show";
	$a[10]=".0 setgray /Arial findfont 8 scalefont setfont 175 554 moveto ($edu) show";
	$a[11]=".0 setgray /Arial findfont 8 scalefont setfont 175 536 moveto ($marry) show";
	$a[12]=".0 setgray /Arial findfont 8 scalefont setfont 175 518 moveto ($marname) show";
	$a[13]=".0 setgray /Arial findfont 8 scalefont setfont 175 500 moveto ($anak) show";
	$a[14]=".0 setgray /Arial findfont 8 scalefont setfont 50 444 moveto ($add1) show";
	$a[15]=".0 setgray /Arial findfont 8 scalefont setfont 175 426 moveto ($rt1) show";
	$a[16]=".0 setgray /Arial findfont 8 scalefont setfont 225 426 moveto ($rw1) show";
	$a[17]=".0 setgray /Arial findfont 8 scalefont setfont 175 408 moveto (kel1) show";
	$a[18]=".0 setgray /Arial findfont 8 scalefont setfont 175 390 moveto ($kec1) show";
	$a[19]=".0 setgray /Arial findfont 8 scalefont setfont 175 372 moveto ($telp1) show";
	$a[20]=".0 setgray /Arial findfont 8 scalefont setfont 175 354 moveto ($hp1) show";
	$a[21]=".0 setgray /Arial findfont 8 scalefont setfont 175 336 moveto ($hs) show";
	$a[22]=".0 setgray /Arial findfont 8 scalefont setfont 175 318 moveto ($lv) show";
	$a[23]=".0 setgray /Arial findfont 8 scalefont setfont 50 282 moveto ($add2) show";
	$a[24]=".0 setgray /Arial findfont 8 scalefont setfont 175 264 moveto ($rt2) show";
	$a[25]=".0 setgray /Arial findfont 8 scalefont setfont 225 264 moveto ($rw2) show";
	$a[26]=".0 setgray /Arial findfont 8 scalefont setfont 175 246 moveto ($kel2) show";
	$a[27]=".0 setgray /Arial findfont 8 scalefont setfont 175 228 moveto ($kec2) show";
	$a[28]=".0 setgray /Arial findfont 8 scalefont setfont 435 680 moveto ($bt) show";
	$a[29]=".0 setgray /Arial findfont 8 scalefont setfont 435 662 moveto ($bn) show";
	$a[30]=".0 setgray /Arial findfont 8 scalefont setfont 435 644 moveto ($badd) show";
	$a[31]=".0 setgray /Arial findfont 8 scalefont setfont 435 626 moveto ($btelp) show";
	$a[32]=".0 setgray /Arial findfont 8 scalefont setfont 435 608 moveto ($bnpwp) show";
	$a[33]=".0 setgray /Arial findfont 8 scalefont setfont 435 590 moveto ($bsiup) show";
	$a[34]=".0 setgray /Arial findfont 8 scalefont setfont 435 572 moveto ($btdp) show";
	$a[35]=".0 setgray /Arial findfont 8 scalefont setfont 435 554 moveto ($blong) show";
	$a[36]=".0 setgray /Arial findfont 8 scalefont setfont 435 536 moveto ($cs) show";
	$a[37]=".0 setgray /Arial findfont 8 scalefont setfont 435 518 moveto ($cn1) show";
	$a[38]=".0 setgray /Arial findfont 8 scalefont setfont 435 500 moveto ($ct1) show";
	$a[39]=".0 setgray /Arial findfont 8 scalefont setfont 435 482 moveto ($cp1) show";
	$a[40]=".0 setgray /Arial findfont 8 scalefont setfont 435 464 moveto ($cl1) show";
	$a[41]=".0 setgray /Arial findfont 8 scalefont setfont 435 446 moveto ($cn2) show";
	$a[42]=".0 setgray /Arial findfont 8 scalefont setfont 435 428 moveto ($ct2) show";
	$a[43]=".0 setgray /Arial findfont 8 scalefont setfont 435 410 moveto ($cp2) show";
	$a[44]=".0 setgray /Arial findfont 8 scalefont setfont 435 392 moveto ($cl2) show";
	$a[45]=".0  setgray /Arial findfont 8 scalefont setfont 315 241 moveto ($custfullname) show";
	$a[46]=".0  setgray /Arial findfont 8 scalefont setfont 110 228 moveto ($datenow) show";
	$a[47]=".0  setgray /Arial findfont 8 scalefont setfont 400 208 moveto ($custnomperkenalan) show";
	$a[48]=".0  setgray /Arial findfont 8 scalefont setfont 110 188 moveto ($datenow) show";
	$a[49]=".0  setgray /Arial findfont 8 scalefont setfont 110 170 moveto (input Number) show";
	$a[50]=".0  setgray /Arial findfont 8 scalefont setfont 110 152 moveto ($branch_name) show";
	$a[51]=".0  setgray /Arial findfont 8 scalefont setfont 110 134 moveto ($ao_name) show";
	$a[52]=".0 setgray /Arial findfont 8 scalefont setfont 480 102 moveto ($c_ao) show";
	$a[53]=".0 setgray /Arial findfont 8 scalefont setfont 330 223 moveto ($datenow) show";
	//echo $a44;

	for($i=0;$i<54;$i++)
	{
		
		//echo $a[$i]."<br/>";
		$line=$a[$i]."\n";
		fwrite($ourFileHandle,$line);
	}
		fclose($ourFileHandle);

	
		
	$ourFileName = $patch."02.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
	$x[0]=".0 setgray /Arial findfont 8 scalefont setfont 150 730 moveto ($lkcd1) show"; 
	$x[1]=".0 setgray /Arial findfont 8 scalefont setfont 150 715 moveto ($branch_name) show"; 
	$x[2]=".0 setgray /Arial findfont 8 scalefont setfont 150 700 moveto ($custfullname) show"; 
	$x[3]=".0 setgray /Arial findfont 8 scalefont setfont 150 685 moveto () show %input nomor  lkcd"; 
	$x[4]=".0 setgray /Arial findfont 8 scalefont setfont 150 670 moveto ($lkcd1) show"; 
	$x[5]=".0 setgray /Arial findfont 8 scalefont setfont 445 685 moveto ($cn1 + $cn2) show"; 
	$x[6]=".0 setgray /Arial findfont 8 scalefont setfont 150 635 moveto ($bt) show";
	$x[7]=".0 setgray /Arial findfont 8 scalefont setfont 150 620 moveto ($bn) show";
	$x[8]=".0 setgray /Arial findfont 8 scalefont setfont 150 605 moveto ($badd) show";
	$x[9]=".0 setgray /Arial findfont 8 scalefont setfont 150 590 moveto ($btelp) show";
	$x[10]=".0 setgray /Arial findfont 8 scalefont setfont 100 575 moveto ($blong) show";
	$x[11]=".0 setgray /Arial findfont 8 scalefont setfont 100 560 moveto (Input Kepemilikan) show";
	$x[12]=".0 setgray /Arial findfont 8 scalefont setfont 445 635 moveto ($lkcd30) show"; 
	$x[13]=".0 setgray /Arial findfont 8 scalefont setfont 445 620 moveto ($lkcd29) show"; 
	$x[14]=".0 setgray /Arial findfont 8 scalefont setfont 445 605 moveto ($lkcd3) show"; 
	$x[15]=".0 setgray /Arial findfont 8 scalefont setfont 445 590 moveto ($lkcd2) show"; 
	$x[16]=".0 setgray /Arial findfont 8 scalefont setfont 445 575 moveto ($lkcd6) show"; 
	$x[17]=".0 setgray /Arial findfont 8 scalefont setfont 445 560 moveto (Input pembayaran) show"; 
	$x[18]=".0 setgray /Arial findfont 8 scalefont setfont 190 525 moveto ($lkcd9) show";
	$x[19]=".0 setgray /Arial findfont 8 scalefont setfont 445 525 moveto ($lkcd16) show";
	$x[20]=".0 setgray /Arial findfont 8 scalefont setfont 190 510 moveto ($lkcd10) show";
	$x[21]=".0 setgray /Arial findfont 8 scalefont setfont 445 510 moveto ($lkcd17) show";
	$x[22]=".0 setgray /Arial findfont 8 scalefont setfont 190 495 moveto ($lkcd11) show";
	$x[23]=".0 setgray /Arial findfont 8 scalefont setfont 445 495 moveto ($lkcd18) show";
	$x[24]=".0 setgray /Arial findfont 8 scalefont setfont 190 480 moveto ($lkcd12) show";
	$x[25]=".0 setgray /Arial findfont 8 scalefont setfont 445 480 moveto ($lkcd19) show";
	$x[26]=".0 setgray /Arial findfont 8 scalefont setfont 190 465 moveto ($lkcd13) show";
	$x[27]=".0 setgray /Arial findfont 8 scalefont setfont 445 465 moveto ($lkcd4) show";
	$x[28]=".0 setgray /Arial findfont 8 scalefont setfont 190 450 moveto ($lkcd14) show";
	$x[29]=".0 setgray /Arial findfont 8 scalefont setfont 445 450 moveto ($lkcd7) show";
	$x[30]=".0 setgray /Arial findfont 8 scalefont setfont 190 435 moveto ($lkcd15) show";
	$x[31]=".0 setgray /Arial findfont 8 scalefont setfont 50 385 moveto ($lkcd20) show";
	$x[32]=".0 setgray /Arial findfont 8 scalefont setfont 50 370 moveto ($lkcd21) show";
	$x[33]=".0 setgray /Arial findfont 8 scalefont setfont 50 355 moveto ($lkcd22) show";
	$x[34]=".0 setgray /Arial findfont 8 scalefont setfont 50 325 moveto ($lkcd23) show";
	$x[35]=".0 setgray /Arial findfont 8 scalefont setfont 50 310 moveto ($lkcd24) show";
	$x[36]=".0 setgray /Arial findfont 8 scalefont setfont 50 295 moveto ($lkcd25) show";
	$x[37]=".0 setgray /Arial findfont 8 scalefont setfont 50 265 moveto ($lkcd26) show";
	$x[38]=".0 setgray /Arial findfont 8 scalefont setfont 50 250 moveto ($lkcd27) show";
	$x[39]=".0 setgray /Arial findfont 8 scalefont setfont 50 235 moveto ($lkcd28) show";
	$x[40]=".0 setgray /Arial findfont 8 scalefont setfont 50 220 moveto () show %bingung input";
	$x[41]=".0 setgray /Arial findfont 8 scalefont setfont 50 205 moveto () show % bingung input";
	$x[42]=".0 setgray /Arial findfont 8 scalefont setfont 50 190 moveto () show %bingung input";
	$x[43]=".0 setgray /Arial findfont 8 scalefont setfont 50 175 moveto () show % bingung input";
	
	for($ix=0;$ix<44;$ix++)
	{
		
		//echo $a[$i]."<br/>";
		$line=$x[$ix]."\n";
		fwrite($ourFileHandle,$line);
	}
		fclose($ourFileHandle);

		
	$ourFileName = $patch."03.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
	$v[0]=(".0 setgray /Arial findfont 6 scalefont setfont 170 730 moveto ($branch_name) show"); 
	$v[1]=(".0 setgray /Arial findfont 6 scalefont setfont 170 720 moveto ($custfullname) show"); 
	$v[2]=(".0 setgray /Arial findfont 6 scalefont setfont 170 710 moveto (Input No.) show");
	$v[3]=(".0 setgray /Arial findfont 6 scalefont setfont 180 670 moveto ($cmtc2) show");
	$v[4]=(".0 setgray /Arial findfont 6 scalefont setfont 460 670 moveto ($cmtc14) show");
	$v[5]=(".0 setgray /Arial findfont 6 scalefont setfont 180 660 moveto ($cmtc3) show");
	$v[6]=(".0 setgray /Arial findfont 6 scalefont setfont 460 660 moveto ($cmtc15) show");
	$v[7]=(".0 setgray /Arial findfont 6 scalefont setfont 180 650 moveto ($cmtc4) show");
	$v[8]=(".0 setgray /Arial findfont 6 scalefont setfont 460 650 moveto ($cmtc16) show");
	$v[9]=(".0 setgray /Arial findfont 6 scalefont setfont 180 640 moveto ($cmtc5) show");
	$v[10]=(".0 setgray /Arial findfont 6 scalefont setfont 460 640 moveto ($cmtc17) show");
	$v[11]=(".0 setgray /Arial findfont 6 scalefont setfont 180 630 moveto ($cmtc6) show");
	$v[12]=(".0 setgray /Arial findfont 6 scalefont setfont 460 630 moveto ($cmtc18) show");
	$v[13]=(".0 setgray /Arial findfont 6 scalefont setfont 180 620 moveto ($cmtc7) show");
	$v[14]=(".0 setgray /Arial findfont 6 scalefont setfont 460 620 moveto ($cmtc19) show");
	$v[15]=(".0 setgray /Arial findfont 6 scalefont setfont 180 610 moveto ($cmtc8) show");
	$v[16]=(".0 setgray /Arial findfont 6 scalefont setfont 460 610 moveto ($cmtc20) show");
	$v[17]=(".0 setgray /Arial findfont 6 scalefont setfont 180 600 moveto ($cmtc9) show");
	$v[18]=(".0 setgray /Arial findfont 6 scalefont setfont 460 600 moveto ($cmtc21) show");
	$v[19]=(".0 setgray /Arial findfont 6 scalefont setfont 180 590 moveto ($cmtc10) show");
	$v[20]=(".0 setgray /Arial findfont 6 scalefont setfont 460 590 moveto ($cmtc22) show");
	$v[21]=(".0 setgray /Arial findfont 6 scalefont setfont 180 580 moveto ($cmtc11) show");
	$v[22]=(".0 setgray /Arial findfont 6 scalefont setfont 460 580 moveto ($cmtc23) show");
	$v[23]=(".0 setgray /Arial findfont 6 scalefont setfont 180 570 moveto ($cmtc12) show");
	$v[24]=(".0 setgray /Arial findfont 6 scalefont setfont 460 570 moveto ($cmtc24) show");
	$v[25]=(".0 setgray /Arial findfont 6 scalefont setfont 180 552 moveto ($cmtc13) show");
	$v[26]=(".0 setgray /Arial findfont 6 scalefont setfont 460 552 moveto ($cmtc25) show");
	$v[27]=(".0 setgray /Arial findfont 6 scalefont setfont 180 520 moveto ($cmtc26) show");
	$v[28]=(".0 setgray /Arial findfont 6 scalefont setfont 460 520 moveto ($cmtc38) show");
	$v[29]=(".0 setgray /Arial findfont 6 scalefont setfont 180 510 moveto ($cmtc27) show");
	$v[30]=(".0 setgray /Arial findfont 6 scalefont setfont 460 510 moveto ($cmtc39) show");
	$v[31]=(".0 setgray /Arial findfont 6 scalefont setfont 180 500 moveto ($cmtc28) show");
	$v[32]=(".0 setgray /Arial findfont 6 scalefont setfont 460 500 moveto ($cmtc40) show");
	$v[33]=(".0 setgray /Arial findfont 6 scalefont setfont 180 490 moveto ($cmtc29) show");
	$v[34]=(".0 setgray /Arial findfont 6 scalefont setfont 460 490 moveto ($cmtc41) show");
	$v[35]=(".0 setgray /Arial findfont 6 scalefont setfont 180 480 moveto ($cmtc30) show");
	$v[36]=(".0 setgray /Arial findfont 6 scalefont setfont 460 480 moveto ($cmtc42) show");
	$v[37]=(".0 setgray /Arial findfont 6 scalefont setfont 180 470 moveto ($cmtc31) show");
	$v[38]=(".0 setgray /Arial findfont 6 scalefont setfont 460 470 moveto ($cmtc43) show");
	$v[39]=(".0 setgray /Arial findfont 6 scalefont setfont 180 460 moveto ($cmtc32) show");
	$v[40]=(".0 setgray /Arial findfont 6 scalefont setfont 460 460 moveto ($cmtc44) show");
	$v[41]=(".0 setgray /Arial findfont 6 scalefont setfont 180 450 moveto ($cmtc33) show");
	$v[42]=(".0 setgray /Arial findfont 6 scalefont setfont 460 450 moveto ($cmtc45) show");
	$v[43]=(".0 setgray /Arial findfont 6 scalefont setfont 180 440 moveto ($cmtc34) show");
	$v[44]=(".0 setgray /Arial findfont 6 scalefont setfont 460 440 moveto ($cmtc46) show");
	$v[45]=(".0 setgray /Arial findfont 6 scalefont setfont 180 430 moveto ($cmtc35) show");
	$v[46]=(".0 setgray /Arial findfont 6 scalefont setfont 460 430 moveto ($cmtc47) show");
	$v[47]=(".0 setgray /Arial findfont 6 scalefont setfont 180 420 moveto ($cmtc36) show");
	$v[48]=(".0 setgray /Arial findfont 6 scalefont setfont 460 420 moveto ($cmtc48) show");
	$v[49]=(".0 setgray /Arial findfont 6 scalefont setfont 180 410 moveto ($cmtc37) show");
	$v[50]=(".0 setgray /Arial findfont 6 scalefont setfont 460 410 moveto ($cmtc49) show");
	$v[51]=(".0 setgray /Arial findfont 6 scalefont setfont 180 370 moveto ($cmtc50) show");
	$v[52]=(".0 setgray /Arial findfont 6 scalefont setfont 460 370 moveto ($cmtc59) show");
	$v[53]=(".0 setgray /Arial findfont 6 scalefont setfont 180 360 moveto ($cmtc51) show");
	$v[54]=(".0 setgray /Arial findfont 6 scalefont setfont 460 360 moveto ($cmtc60) show");
	$v[55]=(".0 setgray /Arial findfont 6 scalefont setfont 180 350 moveto ($cmtc52) show");
	$v[56]=(".0 setgray /Arial findfont 6 scalefont setfont 460 350 moveto ($cmtc61) show");
	$v[57]=(".0 setgray /Arial findfont 6 scalefont setfont 180 340 moveto ($cmtc53) show");
	$v[58]=(".0 setgray /Arial findfont 6 scalefont setfont 460 340 moveto ($cmtc62) show");
	$v[59]=(".0 setgray /Arial findfont 6 scalefont setfont 180 330 moveto ($cmtc54) show");
	$v[60]=(".0 setgray /Arial findfont 6 scalefont setfont 460 330 moveto ($cmtc63) show");
	$v[61]=(".0 setgray /Arial findfont 6 scalefont setfont 180 320 moveto ($cmtc55) show");
	$v[62]=(".0 setgray /Arial findfont 6 scalefont setfont 460 320 moveto ($cmtc64) show");
	$v[63]=(".0 setgray /Arial findfont 6 scalefont setfont 180 310 moveto ($cmtc56) show");
	$v[64]=(".0 setgray /Arial findfont 6 scalefont setfont 460 310 moveto ($cmtc65) show");
	$v[65]=(".0 setgray /Arial findfont 6 scalefont setfont 180 300 moveto ($cmtc58) show");
	$v[66]=(".0 setgray /Arial findfont 6 scalefont setfont 460 300 moveto ($cmtc67) show");
	$v[67]=(".0 setgray /Arial findfont 6 scalefont setfont 170 700 moveto ($cmtc1) show");
	$v[68]=(".0 setgray /Arial findfont 7 scalefont setfont 550 215 moveto ($flagcmtc69) show");
	$v[69]=(".0 setgray /Arial findfont 7 scalefont setfont 50 260 moveto ($cmtc68) show");

	for($as=0;$as<70;$as++)
	{
		$tmp_ltc=$v[$as]."\n";
		fwrite($ourFileHandle,$tmp_ltc);
	}
		

		
		
			
	$ourFileName = $patch."04.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");		
	$zx[0]=(".0 setgray /Arial findfont 8 scalefont setfont 100 730 moveto ($branch_name) show");
	$zx[1]=(".0 setgray /Arial findfont 8 scalefont setfont 100 715 moveto ($custfullname) show");
	$zx[2]=(".0 setgray /Arial findfont 8 scalefont setfont 100 700 moveto () show %input number");
	$zx[3]=(".0 setgray /Arial findfont 8 scalefont setfont 100 685 moveto ($lmau1) show");
	$zx[4]=(".0 setgray /Arial findfont 8 scalefont setfont 55 300 moveto ($cmtc28) show");
	$zx[5]=(".0 setgray /Arial findfont 8 scalefont setfont 55 290 moveto ($cmtc40) show");
	$zx[6]=(".0 setgray /Arial findfont 8 scalefont setfont 175 300 moveto ($cmtc33) show");
	$zx[7]=(".0 setgray /Arial findfont 8 scalefont setfont 175 290 moveto ($cmtc45) show");
	$zx[8]=(".0 setgray /Arial findfont 8 scalefont setfont 265 300 moveto ($cmtc31) show");
	$zx[9]=(".0 setgray /Arial findfont 8 scalefont setfont 265 290 moveto ($cmtc43) show");
	$zx[10]=(".0 setgray /Arial findfont 8 scalefont setfont 370 300 moveto ($cmtc10) show");
	$zx[11]=(".0 setgray /Arial findfont 8 scalefont setfont 370 290 moveto ($cmtc19) show");
	$zx[12]=(".0 setgray /Arial findfont 8 scalefont setfont 475 300 moveto ($flagcmtc69) show");
	$zx[13]=(".0 setgray /Arial findfont 8 scalefont setfont 475 290 moveto ($flagcmtc69) show");	
	$zx[14]=(".0 setgray /Arial findfont 8 scalefont setfont 35 640 moveto ($lmau2) show");
	$zx[15]=(".0 setgray /Arial findfont 8 scalefont setfont 35 630 moveto ($lmau3) show");
	$zx[16]=(".0 setgray /Arial findfont 8 scalefont setfont 35 620 moveto ($lmau4) show");
	$zx[17]=(".0 setgray /Arial findfont 8 scalefont setfont 35 610 moveto ($lmau5) show");
	$zx[18]=(".0 setgray /Arial findfont 8 scalefont setfont 35 600 moveto ($lmau6) show");
	$zx[19]=(".0 setgray /Arial findfont 8 scalefont setfont 35 590 moveto ($lmau7) show");
	$zx[20]=(".0 setgray /Arial findfont 8 scalefont setfont 35 540 moveto ($lmau8) show");
	$zx[21]=(".0 setgray /Arial findfont 8 scalefont setfont 35 530 moveto ($lmau9) show");
	$zx[22]=(".0 setgray /Arial findfont 8 scalefont setfont 35 520 moveto ($lmau10) show");
	$zx[23]=(".0 setgray /Arial findfont 8 scalefont setfont 35 510 moveto ($lmau11) show");
	$zx[24]=(".0 setgray /Arial findfont 8 scalefont setfont 35 500 moveto ($lmau12) show");
	$zx[25]=(".0 setgray /Arial findfont 8 scalefont setfont 35 490 moveto ($lmau13) show");
	$zx[26]=(".0 setgray /Arial findfont 8 scalefont setfont 55 410 moveto ($cmtc4) show");
	$zx[27]=(".0 setgray /Arial findfont 8 scalefont setfont 55 400 moveto ($cmtc16) show");
	$zx[28]=(".0 setgray /Arial findfont 8 scalefont setfont 175 410 moveto ($cmtc9) show");
	$zx[29]=(".0 setgray /Arial findfont 8 scalefont setfont 175 400 moveto ($cmtc21) show");
	$zx[30]=(".0 setgray /Arial findfont 8 scalefont setfont 265 410 moveto ($cmtc7) show");
	$zx[31]=(".0 setgray /Arial findfont 8 scalefont setfont 265 400 moveto ($cmtc19) show");
	$zx[32]=(".0 setgray /Arial findfont 8 scalefont setfont 370 410 moveto ($cmtc34) show");
	$zx[33]=(".0 setgray /Arial findfont 8 scalefont setfont 370 400 moveto ($cmtc46) show");
	$zx[34]=(".0 setgray /Arial findfont 8 scalefont setfont 475 410 moveto ($flagcmtc69) show");
	$zx[35]=(".0 setgray /Arial findfont 8 scalefont setfont 475 400 moveto ($flagcmtc69) show");		
	$zx[36]=(".0 setgray /Arial findfont 8 scalefont setfont 135 205 moveto ($flaglmau20) show");		
	$zx[37]=(".0 setgray /Arial findfont 8 scalefont setfont 135 195 moveto ($flaglmau21) show");		
	$zx[38]=(".0 setgray /Arial findfont 8 scalefont setfont 135 185 moveto ($flaglmau22) show");		
	$zx[39]=(".0 setgray /Arial findfont 8 scalefont setfont 135 175 moveto ($flaglmau23) show");		
	$zx[40]=(".0 setgray /Arial findfont 8 scalefont setfont 200 220 moveto ($lmau24) show");		
	for($dfs=0;$dfs<41;$dfs++)
	{
		//echo $a[$i]."<br/>";
		$tmp_ltc=$zx[$dfs]."\n";
		fwrite($ourFileHandle,$tmp_ltc);
	}
	
	
	
	
	




	


	$ourFileName = $patch."05.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");	
	$h[0]=(".0 setgray /Arial findfont 8 scalefont setfont 140 740 moveto ($branch_name) show");
	$h[1]=(".0 setgray /Arial findfont 8 scalefont setfont 140 730 moveto ($custfullname) show");
	$h[2]=(".0 setgray /Arial findfont 8 scalefont setfont 140 720 moveto (Input No.) show");
	$h[3]=(".0 setgray /Arial findfont 8 scalefont setfont 140 710 moveto ($ak1) show");
	$h[4]=(".0 setgray /Arial findfont 8 scalefont setfont 130 620 moveto ($ROS_HP) show");
	$h[5]=(".0 setgray /Arial findfont 8 scalefont setfont 200 620 moveto ($ROS_PP) show");
	$h[6]=(".0 setgray /Arial findfont 8 scalefont setfont 130 610 moveto ($NETSALES_HP) show");
	$h[7]=(".0 setgray /Arial findfont 8 scalefont setfont 200 610 moveto ($NET_SALES_PP) show");
	$h[8]=(".0 setgray /Arial findfont 8 scalefont setfont 130 600 moveto ($COGS_HP) show");
	$h[9]=(".0 setgray /Arial findfont 8 scalefont setfont 200 600 moveto ($COGS_PP) show");
	$h[10]=(".0 setgray /Arial findfont 8 scalefont setfont 130 590 moveto ($SGA_HP) show");
	$h[11]=(".0 setgray /Arial findfont 8 scalefont setfont 200 590 moveto ($SGA_PP) show");
	$h[12]=(".0 setgray /Arial findfont 8 scalefont setfont 130 580 moveto ($EBITDA_HP) show");
	$h[13]=(".0 setgray /Arial findfont 8 scalefont setfont 200 580 moveto ($EBITA_PP) show");
	$h[14]=(".0 setgray /Arial-BoldMT findfont 8 scalefont setfont 130 570 moveto ($NOPAT_HP) show");
	$h[15]=(".0 setgray /Arial-BoldMT findfont 8 scalefont setfont 200 570 moveto ($NOPAT_PP) show");
	$h[16]=(".0 setgray /Arial findfont 8 scalefont setfont 130 480 moveto ($WI_HE) show");
	$h[17]=(".0 setgray /Arial findfont 8 scalefont setfont 200 480 moveto ($WI_PE) show");
	$h[18]=(".0 setgray /Arial findfont 8 scalefont setfont 130 470 moveto ($ARDOH_HE) show");
	$h[19]=(".0 setgray /Arial findfont 8 scalefont setfont 200 470 moveto ($ARDOH_PE) show");
	$h[20]=(".0 setgray /Arial findfont 8 scalefont setfont 130 460 moveto ($INVDOH_HE) show");
	$h[21]=(".0 setgray /Arial findfont 8 scalefont setfont 200 460 moveto ($INVDOH_PE) show");
	$h[22]=(".0 setgray /Arial findfont 8 scalefont setfont 130 450 moveto ($AEDOH_HE) show");
	$h[23]=(".0 setgray /Arial findfont 8 scalefont setfont 200 450 moveto ($AEDOH_PE) show");
	$h[24]=(".0 setgray /Arial findfont 8 scalefont setfont 130 440 moveto ($ushio9) show");
	$h[25]=(".0 setgray /Arial findfont 8 scalefont setfont 200 440 moveto ($TA_PNP) show");
	$h[26]=(".0 setgray /Arial-BoldMT findfont 8 scalefont setfont 130 430 moveto (-) show");
	$h[27]=(".0 setgray /Arial-BoldMT findfont 8 scalefont setfont 200 430 moveto ($BANKFIN_PL) show");
	$h[28]=(".0 setgray /Arial findfont 8 scalefont setfont 285 505  moveto ($ak17) show");
	$h[29]=(".0 setgray /Arial findfont 8 scalefont setfont 285 495  moveto ($ak18) show");
	$h[30]=(".0 setgray /Arial findfont 8 scalefont setfont 130 340 moveto ($CR_HL) show");
	$h[31]=(".0 setgray /Arial findfont 8 scalefont setfont 200 340 moveto ($CR_PL) show");
	$h[32]=(".0 setgray /Arial findfont 8 scalefont setfont 200 330 moveto ($QR_PL) show");
	$h[33]=(".0 setgray /Arial findfont 8 scalefont setfont 130 320 moveto ($LEV_HL) show");
	$h[34]=(".0 setgray /Arial findfont 8 scalefont setfont 200 320 moveto ($LEV_PL) show");
	$h[35]=(".0 setgray /Arial findfont 8 scalefont setfont 285 368  moveto ($ak23)show");
	$h[36]=(".0 setgray /Arial findfont 8 scalefont setfont 285 358  moveto ($ak24)show");
	$h[37]=(".0 setgray /Arial findfont 8 scalefont setfont 285 343  moveto ($ak25)show");
	$h[38]=(".0 setgray /Arial findfont 8 scalefont setfont 285 333  moveto ($ak26)show");
	$h[67]=(".0 setgray /Arial findfont 8 scalefont setfont 285 318  moveto ($ak27)show");
	$h[68]=(".0 setgray /Arial findfont 8 scalefont setfont 285 308  moveto ($ak28)show");
	$h[39]=(".0 setgray /Arial findfont 8 scalefont setfont 130 170 moveto (Mutasi) show");
	$h[40]=(".0 setgray /Arial findfont 8 scalefont setfont 200 170 moveto (Mutasi) show");

		
		
	$h[41]=(".0 setgray /Arial findfont 8 scalefont setfont 130 155 moveto ($ak2) show");
	$h[43]=(".0 setgray /Arial findfont 8 scalefont setfont 130 140 moveto ($ak5) show");
	$h[45]=(".0 setgray /Arial findfont 8 scalefont setfont 130 125 moveto ($ak8) show");
	$h[47]=(".0 setgray /Arial findfont 8 scalefont setfont 130 110 moveto ($totalmutasi) show");
	$h[49]=(".0 setgray /Arial findfont 8 scalefont setfont 130 95 moveto ($totalmutasiavg) show");

	$h[42]=(".0 setgray /Arial findfont 8 scalefont setfont 200 155 moveto ($ak3) show");
	$h[44]=(".0 setgray /Arial findfont 8 scalefont setfont 200 140 moveto ($ak6) show");
	$h[46]=(".0 setgray /Arial findfont 8 scalefont setfont 200 125 moveto ($ak9) show");
	$h[48]=(".0 setgray /Arial findfont 8 scalefont setfont 200 110 moveto ($totalkredit) show");
	$h[50]=(".0 setgray /Arial findfont 8 scalefont setfont 200 95 moveto ($totalkreditavg) show");
	
	
	$h[51]=(".0 setgray /Arial findfont 8 scalefont setfont 405 155 moveto ($ak4) show");
	$h[52]=(".0 setgray /Arial findfont 8 scalefont setfont 405 140 moveto ($ak7) show");
	$h[53]=(".0 setgray /Arial findfont 8 scalefont setfont 405 125 moveto ($ak10) show");
	$h[54]=(".0 setgray /Arial findfont 8 scalefont setfont 405 110 moveto ($totalpenjualan) show");
	$h[55]=(".0 setgray /Arial findfont 8 scalefont setfont 405 95 moveto ($totalpenjualanavg) show");
	$h[56]=(".0 setgray /Arial findfont 8 scalefont setfont 130 330 moveto ($QR_HL) show");
	$h[57]=(".0 setgray /Arial findfont 8 scalefont setfont 285 480  moveto ($ak19) show");
	$h[58]=(".0 setgray /Arial findfont 8 scalefont setfont 285 470  moveto ($ak20) show");
	$h[59]=(".0 setgray /Arial findfont 8 scalefont setfont 285 455  moveto ($ak21) show");
	$h[60]=(".0 setgray /Arial findfont 8 scalefont setfont 285 445  moveto ($ak22) show");
	
	$h[61]=(".0 setgray /Arial findfont 8 scalefont setfont 285 640  moveto ($ak11) show");
	$h[62]=(".0 setgray /Arial findfont 8 scalefont setfont 285 630  moveto ($ak12) show");
	$h[63]=(".0 setgray /Arial findfont 8 scalefont setfont 285 615 moveto ($ak13) show");
	$h[64]=(".0 setgray /Arial findfont 8 scalefont setfont 285 605  moveto ($ak14) show");
	$h[65]=(".0 setgray /Arial findfont 8 scalefont setfont 285 590  moveto ($ak15) show");
	$h[66]=(".0 setgray /Arial findfont 8 scalefont setfont 285 580  moveto ($ak16) show");
	for($a=0;$a<69;$a++)
	{
		//echo $a[$i]."<br/>";
		$line=$h[$a]."\n";
		fwrite($ourFileHandle,$line);
	}

	$ourFileName = $patch."06.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");	
	$J[0]=(".0 setgray /Arial findfont 8 scalefont setfont 125 730 moveto ($branch_name) show"); 
	$J[1]=(".0 setgray /Arial findfont 8 scalefont setfont 125 720 moveto ($custfullname) show");
	$J[2]=(".0 setgray /Arial findfont 8 scalefont setfont 125 710 moveto ($bt) show");
	$J[3]=(".0 setgray /Arial findfont 8 scalefont setfont 125 700 moveto ($bn) show");
	$J[4]=(".0 setgray /Arial findfont 8 scalefont setfont 125 670 moveto () show %input number"); 
	$J[5]=(".0 setgray /Arial findfont 8 scalefont setfont 125 660 moveto ($admin2) show");
	$J[6]=(".0 setgray /Arial findfont 8 scalefont setfont 120 650 moveto (:) show");
	$J[7]=(".0 setgray /Arial findfont 8 scalefont setfont 125 650 moveto (Input) show %data dari sana");
	$J[8]=(".0 setgray /Arial findfont 8 scalefont setfont 125 640 moveto ($admin9) show");
	$J[9]=(".0 setgray /Arial findfont 8 scalefont setfont 125 630 moveto ($admin6) show");
	$J[10]=("%.0 setgray /Arial findfont 6 scalefont setfont 360 662 moveto (input1) show");
	$J[11]=("%.0 setgray /Arial findfont 6 scalefont setfont 460 662 moveto (1 input 1) show");
	$J[12]=("%.0 setgray /Arial findfont 6 scalefont setfont 360 652 moveto (input1) show");
	$J[13]=("%.0 setgray /Arial findfont 6 scalefont setfont 460 652 moveto (1 input 1) show");
	$J[14]=("%.0 setgray /Arial findfont 6 scalefont setfont 360 642 moveto (input1) show");
	$J[15]=("%.0 setgray /Arial findfont 6 scalefont setfont 460 642 moveto (1 input 1) show");
	$J[16]=("%.0 setgray /Arial findfont 6 scalefont setfont 360 632 moveto (input1) show");
	$J[17]=("%.0 setgray /Arial findfont 6 scalefont setfont 460 632 moveto (1 input 1) show");
	$J[18]=("%.0 setgray /Arial findfont 6 scalefont setfont 360 622 moveto (input1) show");
	$J[19]=("%.0 setgray /Arial findfont 6 scalefont setfont 460 622 moveto (1 input 1) show");
	$J[20]=("%.0 setgray /Arial findfont 8 scalefont setfont 120 590 moveto (perjanjian kredit lainnya) show");
	$J[21]=("%.0 setgray /Arial findfont 8 scalefont setfont 120 580 moveto (Pembelian dan pengumpulan) show");
	$J[22]=(".0 setgray /Arial findfont 8 scalefont setfont 120 570 moveto ($branch_name) show");
	$J[23]=("%.0 setgray /Arial findfont 8 scalefont setfont 120 560 moveto (Lancar) show");
	$J[24]=("%.0 setgray /Arial findfont 8 scalefont setfont 250 590 moveto (79) show");
	$J[25]=("%.0 setgray /Arial findfont 8 scalefont setfont 250 580 moveto (6000) show");
	$J[26]=("%.0 setgray /Arial findfont 8 scalefont setfont 250 570 moveto (92) show");
	$J[27]=("%.0 setgray /Arial findfont 8 scalefont setfont 250 560 moveto (1) show");
	$J[28]=(".0 setgray /Arial findfont 8 scalefont setfont 300 580 moveto (Penjamin) show");
	$J[29]=(".0 setgray /Arial findfont 8 scalefont setfont 300 570 moveto (Lokasi) show");
	$J[30]=(".0 setgray /Arial findfont 8 scalefont setfont 300 560 moveto () show");
	$J[31]=(".0 setgray /Arial findfont 8 scalefont setfont 300 550 moveto () show");
	$J[32]=(".0 setgray /Arial findfont 8 scalefont setfont 370 590 moveto ($cn1 - $cn2) show");
	$J[33]=(".0 setgray /Arial findfont 8 scalefont setfont 370 580 moveto (Perseorangan) show");
	$J[34]=(".0 setgray /Arial findfont 8 scalefont setfont 370 570 moveto () show");
	$J[35]=(".0 setgray /Arial findfont 8 scalefont setfont 370 560 moveto () show");
	$J[36]=("%.0 setgray /Arial findfont 8 scalefont setfont 500 590 moveto (20) show");
	$J[37]=("%.0 setgray /Arial findfont 8 scalefont setfont 500 580 moveto (13) show");
	$J[38]=("%.0 setgray /Arial findfont 8 scalefont setfont 500 570 moveto (34) show");
	$J[39]=("%.0 setgray /Arial findfont 8 scalefont setfont 500 560 moveto (958) show");
	$J[40]=("%.0 setgray /Arial findfont 8 scalefont setfont 50 520 moveto ($ct1) show");
	$J[41]=("%.0 setgray /Arial findfont 8 scalefont setfont 50 510 moveto ($ct2) show");
	$J[42]=("%.0 setgray /Arial findfont 8 scalefont setfont 100 520 moveto (input) show");
	$J[43]=("%.0 setgray /Arial findfont 8 scalefont setfont 100 510 moveto (input) show");
	$J[44]=("%.0 setgray /Arial findfont 8 scalefont setfont 100 495 moveto (Input) show");
	$J[45]=("%.0 setgray /Arial findfont 8 scalefont setfont 175 520 moveto (Input) show");
	$J[46]=("%.0 setgray /Arial findfont 8 scalefont setfont 175 510 moveto (Input) show");
	$J[47]=("%.0 setgray /Arial findfont 8 scalefont setfont 175 495 moveto (input) show");
	$J[48]=("%.0 setgray /Arial findfont 8 scalefont setfont 230 520 moveto (input) show");
	$J[49]=("%.0 setgray /Arial findfont 8 scalefont setfont 230 510 moveto (input) show");
	$J[50]=("%.0 setgray /Arial findfont 8 scalefont setfont 290 520 moveto (Input) show");
	$J[51]=("%.0 setgray /Arial findfont 8 scalefont setfont 290 510 moveto (INput) show");
	$J[52]=("%.0 setgray /Arial findfont 8 scalefont setfont 375 520 moveto (88) show");
	$J[53]=("%.0 setgray /Arial findfont 8 scalefont setfont 375 510 moveto (44) show");
	$J[54]=("%.0 setgray /Arial findfont 8 scalefont setfont 425 520 moveto (1111) show");
	$J[55]=("%.0 setgray /Arial findfont 8 scalefont setfont 425 510 moveto (1111) show");
	$J[56]=("%.0 setgray /Arial findfont 8 scalefont setfont 475 520 moveto (8748374837) show");
	$J[57]=("%.0 setgray /Arial findfont 8 scalefont setfont 475 510 moveto (i764273642) show");
	$J[58]=("%.0 setgray /Arial findfont 8 scalefont setfont 475 495 moveto (jahsjahjhsak) show");
	$J[59]=(".0 setgray /Arial findfont 8 scalefont setfont 50 460 moveto ($cn1) show");
	$J[60]=(".0 setgray /Arial findfont 8 scalefont setfont 50 450 moveto ($cn2) show");
	$J[61]=(".0 setgray /Arial findfont 8 scalefont setfont 100 460 moveto ($cp1) show");
	$J[62]=(".0 setgray /Arial findfont 8 scalefont setfont 100 450 moveto ($cp2) show");
	$J[63]=(".0 setgray /Arial findfont 8 scalefont setfont 100 435 moveto (Input) show");
	$J[64]=(".0 setgray /Arial findfont 8 scalefont setfont 175 460 moveto ($mkk20% p.a) show");
	$J[65]=(".0 setgray /Arial findfont 8 scalefont setfont 175 450 moveto ($mkk29% p.a) show");
	$J[66]=(".0 setgray /Arial findfont 8 scalefont setfont 175 435 moveto () show");
	$J[67]=(".0 setgray /Arial findfont 8 scalefont setfont 230 460 moveto ($mkk21) show");
	$J[68]=(".0 setgray /Arial findfont 8 scalefont setfont 230 450 moveto ($mkk30) show");
	$J[69]=(".0 setgray /Arial findfont 8 scalefont setfont 290 460 moveto ($cn1) show");
	$J[70]=(".0 setgray /Arial findfont 8 scalefont setfont 290 450 moveto ($cn2) show");
	$J[71]=(".0 setgray /Arial findfont 8 scalefont setfont 375 460 moveto ($cl2) show");
	$J[72]=(".0 setgray /Arial findfont 8 scalefont setfont 375 450 moveto ($cl2) show");
	$J[73]=(".0 setgray /Arial findfont 8 scalefont setfont 425 460 moveto ($mkk22) show");
	$J[74]=(".0 setgray /Arial findfont 8 scalefont setfont 425 450 moveto ($mkk31) show");
	$J[75]=(".0 setgray /Arial findfont 8 scalefont setfont 475 460 moveto ($mkk23) show");
	$J[76]=(".0 setgray /Arial findfont 8 scalefont setfont 475 450 moveto ($mkk32) show");
	$J[77]=(".0 setgray /Arial findfont 8 scalefont setfont 475 435 moveto ($totalkewajibanbank) show");
	$J[78]=(".0 setgray /Arial findfont 8 scalefont setfont 50 390 moveto ($cn1) show");
	$J[79]=(".0 setgray /Arial findfont 8 scalefont setfont 50 380 moveto ($cn2) show");
	$J[80]=(".0 setgray /Arial findfont 8 scalefont setfont 50 370 moveto () show");
	$J[81]=(".0 setgray /Arial findfont 8 scalefont setfont 50 360 moveto () show");
	$J[82]=(".0 setgray /Arial findfont 8 scalefont setfont 100 390 moveto ($cp1) show");
	$J[83]=(".0 setgray /Arial findfont 8 scalefont setfont 100 380 moveto ($cp2) show");
	$J[84]=(".0 setgray /Arial findfont 8 scalefont setfont 100 370 moveto () show");
	$J[85]=(".0 setgray /Arial findfont 8 scalefont setfont 100 360 moveto () show");
	$J[86]=(".0 setgray /Arial findfont 8 scalefont setfont 100 345 moveto ($totalcp) show");
	$J[87]=(".0 setgray /Arial findfont 8 scalefont setfont 175 390 moveto ($mkk20% p.a) show%os");
	$J[88]=(".0 setgray /Arial findfont 8 scalefont setfont 175 380 moveto ($mkk29% p.a) show");
	$J[89]=(".0 setgray /Arial findfont 8 scalefont setfont 175 370 moveto () show");
	$J[90]=(".0 setgray /Arial findfont 8 scalefont setfont 175 360 moveto () show");
	$J[91]=(".0 setgray /Arial findfont 8 scalefont setfont 175 345 moveto () show");
	$J[92]=(".0 setgray /Arial findfont 8 scalefont setfont 230 390 moveto ($mkk21) show%suku bunga");
	$J[93]=(".0 setgray /Arial findfont 8 scalefont setfont 230 380 moveto ($mkk30) show");
	$J[94]=(".0 setgray /Arial findfont 8 scalefont setfont 230 370 moveto () show");
	$J[95]=(".0 setgray /Arial findfont 8 scalefont setfont 230 360 moveto () show");
	$J[96]=(".0 setgray /Arial findfont 8 scalefont setfont 290 390 moveto ($cn1) show");
	$J[97]=(".0 setgray /Arial findfont 8 scalefont setfont 290 380 moveto ($cn2) show");
	$J[98]=(".0 setgray /Arial findfont 8 scalefont setfont 290 370 moveto () show");
	$J[99]=(".0 setgray /Arial findfont 8 scalefont setfont 290 360 moveto () show");
	$J[100]=(".0 setgray /Arial findfont 8 scalefont setfont 375 390 moveto ($cl1) show");
	$J[101]=(".0 setgray /Arial findfont 8 scalefont setfont 375 380 moveto ($cl2) show");
	$J[102]=(".0 setgray /Arial findfont 8 scalefont setfont 375 370 moveto () show");
	$J[103]=(".0 setgray /Arial findfont 8 scalefont setfont 375 360 moveto () show");
	$J[104]=(".0 setgray /Arial findfont 8 scalefont setfont 425 390 moveto ($mkk22) show");
	$J[105]=(".0 setgray /Arial findfont 8 scalefont setfont 425 380 moveto ($mkk31) show");
	$J[106]=("%.0 setgray /Arial findfont 8 scalefont setfont 425 370 moveto (1111) show");
	$J[107]=("%.0 setgray /Arial findfont 8 scalefont setfont 425 360 moveto (1111) show");
	$J[108]=(".0 setgray /Arial findfont 8 scalefont setfont 475 390 moveto ($mkk23) show");
	$J[109]=(".0 setgray /Arial findfont 8 scalefont setfont 475 380 moveto ($mkk32) show");
	$J[110]=(".0 setgray /Arial findfont 8 scalefont setfont 475 370 moveto () show");
	$J[111]=(".0 setgray /Arial findfont 8 scalefont setfont 475 360 moveto () show");
	$J[112]=(".0 setgray /Arial findfont 8 scalefont setfont 475 345 moveto ($totalkewajibanbank) show");
	$J[113]=(".0 setgray /Arial findfont 8 scalefont setfont 55 300 moveto (land) show");
	$J[114]=(".0 setgray /Arial findfont 8 scalefont setfont 155 300 moveto ($badd) show");
	$J[115]=(".0 setgray /Arial findfont 8 scalefont setfont 280 300 moveto (c) show");
	$J[116]=(".0 setgray /Arial findfont 8 scalefont setfont 350 300 moveto ($custfullname) show");
	$J[117]=("%.0 setgray /Arial findfont 8 scalefont setfont 425 300 moveto (e) show");
	$J[118]=("%.0 setgray /Arial findfont 8 scalefont setfont 425 250 moveto (f) show");
	$J[119]=("%.0 setgray /Arial findfont 8 scalefont setfont 495 300 moveto (g) show");
	$J[120]=("%.0 setgray /Arial findfont 8 scalefont setfont 495 250 moveto (h) show");
	$J[121]=("%.0 setgray /Arial findfont 8 scalefont setfont 155 250 moveto (i) show");
	$J[122]=("%.0 setgray /Arial findfont 8 scalefont setfont 155 240 moveto (k) show");
	$J[123]=("%.0 setgray /Arial findfont 8 scalefont setfont 155 228 moveto (l) show");
	$J[124]=("%.0 setgray /Arial findfont 8 scalefont setfont 227 165 moveto (Y) show");
	$J[125]=("%.0 setgray /Arial findfont 8 scalefont setfont 227 150 moveto (Y) show");
	$J[126]=("%.0 setgray /Arial findfont 8 scalefont setfont 227 135 moveto (Y) show");

	for($p=0;$p<127;$p++)
	{
		//echo $a[$i]."<br/>";
		$line=$J[$p]."\n";
		fwrite($ourFileHandle,$line);
	}

	
	
	
	
	$ourFileName = $patch."07.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");	
	$m[0]=(".0 setgray /Arial findfont 9 scalefont setfont 282 740 moveto ($custfullname) show");
	
	$m[1]=(".0 setgray /Arial findfont 9 scalefont setfont 170 697 moveto ($ushio1) show");
	$m[3]=(".0 setgray /Arial findfont 9 scalefont setfont 170 680 moveto ($ushio2) show");
	$m[5]=(".0 setgray /Arial findfont 9 scalefont setfont 170 663 moveto ($ushio3) show");
	$m[7]=(".0 setgray /Arial findfont 9 scalefont setfont 170 646 moveto ($ushio4) show");
	$m[9]=(".0 setgray /Arial findfont 9 scalefont setfont 170 629 moveto ($ushio5) show");
	$m[13]=(".0 setgray /Arial findfont 9 scalefont setfont 170 578 moveto ($ushio6) show");
	$m[14]=(".0 setgray /Arial findfont 9 scalefont setfont 170 561 moveto ($ushio7) show");
	$m[16]=(".0 setgray /Arial findfont 9 scalefont setfont 170 544 moveto ($ushio8) show");
	$m[17]=(".0 setgray /Arial findfont 9 scalefont setfont 170 527 moveto ($ushio9) show");
	
	
	$m[2]=(".0 setgray /Arial findfont 9 scalefont setfont 440 697 moveto ($ushio10) show");
	$m[4]=(".0 setgray /Arial findfont 9 scalefont setfont 440 680 moveto ($ushio11) show");
	$m[6]=(".0 setgray /Arial findfont 9 scalefont setfont 440 663 moveto ($ushio12) show");
	$m[8]=(".0 setgray /Arial findfont 9 scalefont setfont 440 646 moveto ($ushio13) show");
	$m[10]=(".0 setgray /Arial findfont 9 scalefont setfont 440 629 moveto ($ushio14) show");
	$m[11]=(".0 setgray /Arial findfont 9 scalefont setfont 440 612 moveto ($ushio15) show");
	$m[12]=(".0 setgray /Arial findfont 9 scalefont setfont 440 595 moveto ($ushio16) show");
	$m[15]=(".0 setgray /Arial findfont 9 scalefont setfont 440 561 moveto ($ushio17) show");
	$m[18]=(".0 setgray /Arial findfont 9 scalefont setfont 440 527 moveto ($ushio18) show");
	
	$m[19]=(".0 setgray /Arial findfont 9 scalefont setfont 282 480 moveto ($custfullname) show");
	$m[20]=(".0 setgray /Arial findfont 9 scalefont setfont 285 470 moveto ($datenow) show");
	$m[21]=(".0 setgray /Arial findfont 9 scalefont setfont 400 443 moveto ($ushio19) show");
	$m[22]=(".0 setgray /Arial findfont 9 scalefont setfont 400 426 moveto (($ushio20)) show");
	$m[23]=(".0 setgray /Arial findfont 9 scalefont setfont 400 409 moveto ($ushio21) show");
	$m[24]=(".0 setgray /Arial findfont 9 scalefont setfont 400 383 moveto ($ushio22) show");
	$m[25]=(".0 setgray /Arial findfont 9 scalefont setfont 400 357 moveto (($ushio23)) show");
	$m[26]=(".0 setgray /Arial findfont 9 scalefont setfont 400 340 moveto ($ushio24) show");
	$m[27]=(".0 setgray /Arial findfont 9 scalefont setfont 400 323 moveto (($ushio25)) show");
	$m[28]=(".0 setgray /Arial findfont 9 scalefont setfont 400 289 moveto ($ushio26) show");
	for($jkl=0;$jkl<29;$jkl++)
	{
		//echo $a[$i]."<br/>";
		$line=$m[$jkl]."\n";
		fwrite($ourFileHandle,$line);
	}
	
	
	
	
	
	
	$ourFileName = $patch."08.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");	
	
$o[0]=(".0 setgray /Arial-BoldMT findfont 12 scalefont setfont 120 575 moveto  ($custfullname) show");
$o[1]=(".0 setgray /Arial findfont 8 scalefont setfont 130 565 moveto  (Input Nama) show");
$o[36]=(".0 setgray /Arial-BoldMT findfont 12 scalefont setfont 120 385 moveto  (Input Nama) show");
$o[37]=(".0 setgray /Arial findfont 8 scalefont setfont 130 375 moveto  (Input Nama) show");


$o[46]=(".0 setgray /Arial-BoldMT findfont 12 scalefont setfont 390 375 moveto  (Input Nama) show");
///////////////neraca performa column 1
$o[2]=(".0 setgray /Arial findfont 6 scalefont setfont 110 543 moveto  ($ushio1) show");//kas and bank NP 
$o[4]=(".0 setgray /Arial findfont 6 scalefont setfont 110 533 moveto  ($ushio2) show");//Piutang usaha NP
$o[6]=(".0 setgray /Arial findfont 6 scalefont setfont 110 523 moveto  ($ushio3) show");//persediaan NP
$o[8]=(".0 setgray /Arial findfont 6 scalefont setfont 110 513 moveto  ($ushio4) show");//piutang lain NP
$o[9]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 110 503 moveto  ($ushio5) show");//total aktiva lancar NP
$o[13]=(".0 setgray /Arial findfont 6 scalefont setfont 110 473 moveto  ($ushio6) show");//aktiva tetap NP
$o[14]=(".0 setgray /Arial findfont 6 scalefont setfont 110 463 moveto  ($ushio7) show");//aktiva lain-lain NP
$o[16]=(".0 setgray /Arial findfont 6 scalefont setfont 110 453 moveto  ($ushio8) show");//total aktiva tetap NP
$o[17]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 110 443 moveto  ($ushio9) show");//total aktiva NP
////////////neraca performa column 2
$o[3]=(".0 setgray /Arial findfont 6 scalefont setfont 245 543 moveto  ($ushio10) show");//s/t bank NP
$o[5]=(".0 setgray /Arial findfont 6 scalefont setfont 245 533 moveto  ($ushio11) show");//hutang usaha  NP
$o[7]=(".0 setgray /Arial findfont 6 scalefont setfont 245 523 moveto  ($ushio12) show");//hutang lain NP
$o[10]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 245 503 moveto  ($ushio14) show");// total kewajiban lancar NP
$o[11]=(".0 setgray /Arial findfont 6 scalefont setfont 245 493 moveto  ($ushio15) show");// hutang jangka panjang NP
$o[12]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 245 483 moveto  ($ushio16) show");// total kewajiban NP
$o[15]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 245 463 moveto  ($ushio17) show");//laba di tahan/modal NP
$o[18]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 245 443 moveto  ($ushio18) show");// total pasiva NP

/////rugi laba performa
$o[38]=(".0 setgray /Arial findfont 6 scalefont setfont 245 353 moveto  ($ushio19) show");//penjualan 
$o[39]=(".0 setgray /Arial findfont 6 scalefont setfont 245 343 moveto  (($ushio20)) show");//harga pokok penjualan 
$o[40]=(".0 setgray /Arial-BOldMT findfont 6 scalefont setfont 245 333 moveto  ($ushio21) show");//laba kotor
$o[41]=(".0 setgray /Arial findfont 6 scalefont setfont 245 318 moveto  (($ushio22)) show"); // penjualan, administrasi dan umum
$o[42]=(".0 setgray /Arial findfont 6 scalefont setfont 245 303 moveto  (($ushio23)) show"); //pendapatan /pengeluaran lain2
$o[43]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 245 293 moveto  ($ushio24) show"); // laba usaha sebelum bunga san pajak
$o[44]=(".0 setgray /Arial findfont 6 scalefont setfont 245 283 moveto  (($ushio25)) show"); // bunga dan angsuran
$o[45]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 245 263 moveto  ($ushio26) show"); //laba usaha seblum pajak



////asumsi proyek
$o[64]=(".0 setgray /Arial findfont 8 scalefont setfont 415 222 moveto  ($SC_AP) show"); 
$o[66]=(".0 setgray /Arial findfont 8 scalefont setfont 415 212 moveto  ($COGS_AP) show"); 
$o[68]=(".0 setgray /Arial findfont 8 scalefont setfont 415 202 moveto  ($SGA_AP) show"); 
$o[70]=(".0 setgray /Arial findfont 8 scalefont setfont 415 192 moveto  ($BNA_AP) show"); 
$o[72]=(".0 setgray /Arial findfont 8 scalefont setfont 415 182 moveto  ($CorS_AP) show"); 
$o[74]=(".0 setgray /Arial findfont 8 scalefont setfont 415 172 moveto  ($AT_AP) show"); 
$o[76]=(".0 setgray /Arial findfont 8 scalefont setfont 415 162 moveto  ($ALL_AP) show"); 
$o[65]=(".0 setgray /Arial findfont 8 scalefont setfont 550 222 moveto  ($ARDOH_AP) show"); 
$o[67]=(".0 setgray /Arial findfont 8 scalefont setfont 550 212 moveto  ($INVDOH_AP) show");
$o[69]=(".0 setgray /Arial findfont 8 scalefont setfont 550 202 moveto  ($APDOH_AP) show"); 
$o[71]=(".0 setgray /Arial findfont 8 scalefont setfont 550 192 moveto  ($AEDOH_AP) show"); 
$o[73]=(".0 setgray /Arial findfont 8 scalefont setfont 550 182 moveto  ($SorT_AP) show"); 
$o[75]=(".0 setgray /Arial findfont 8 scalefont setfont 550 172 moveto  ($LorT_AP) show"); 

///asumsi proyeksi pembiayaan
$o[62]=(".0 setgray /Arial findfont 8 scalefont setfont 260 162 moveto  ($PMK_APP) show"); 
$o[63]=(".0 setgray /Arial findfont 8 scalefont setfont 260 152 moveto  ($PI_APP) show"); 




//kondisi historical
$o[54]=(".0 setgray /Arial findfont 8 scalefont setfont 125 222 moveto  ($COGS_KH) show"); 
$o[56]=(".0 setgray /Arial findfont 8 scalefont setfont 125 212 moveto  ($SGA_KH) show"); 
$o[58]=(".0 setgray /Arial findfont 8 scalefont setfont 125 202 moveto  ($BNA_KH) show"); 
$o[60]=(".0 setgray /Arial findfont 8 scalefont setfont 125 192 moveto  ($CorS_KH) show"); 
$o[55]=(".0 setgray /Arial findfont 8 scalefont setfont 270 222 moveto  ($ARDOH_KH ) show"); 
$o[57]=(".0 setgray /Arial findfont 8 scalefont setfont 270 212 moveto  ($INVDOH_KH ) show"); 
$o[59]=(".0 setgray /Arial findfont 8 scalefont setfont 270 202 moveto  ($APDOH_KH) show"); 
$o[61]=(".0 setgray /Arial findfont 8 scalefont setfont 270 192 moveto  ($AEDOH_KH ) show"); 



//proyeksi - nearaca performa column1
$o[19]=(".0 setgray /Arial findfont 6 scalefont setfont 390 543 moveto  ($KnB_PNP) show");// kas n bank p-np
$o[21]=(".0 setgray /Arial findfont 6 scalefont setfont 390 533 moveto  ($PU_PNP) show");// piutang usaha  p-np
$o[23]=(".0 setgray /Arial findfont 6 scalefont setfont 390 523 moveto  ($PERSEDIAN_PNP) show");// persediaan  p-np
$o[25]=(".0 setgray /Arial findfont 6 scalefont setfont 390 513 moveto  ($PIUTANG_PNP) show");// piutan lain  p-np
$o[26]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 390 503 moveto  ($TAL_PNP) show");
$o[30]=(".0 setgray /Arial findfont 6 scalefont setfont 390 473 moveto  ($AT_PNP) show");// aktiva tetap  p-np
$o[31]=(".0 setgray /Arial findfont 6 scalefont setfont 390 463 moveto  ($ALL_PNP) show");// aktiva lain  p-np
$o[33]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 390 453 moveto  ($TAT_PNP) show");// total aktiva lain  p-np
$o[34]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 390 443 moveto  ($TA_PNP) show");// total aktiva  p-np


//proyeksi - nrecara performa column 2
$o[20]=(".0 setgray /Arial findfont 6 scalefont setfont 520 543 moveto  ($SorT_PNP) show");// s/t  p-np
$o[22]=(".0 setgray /Arial findfont 6 scalefont setfont 520 533 moveto  ($HT_PNP) show");// hutang usaha 2  p-np
$o[24]=(".0 setgray /Arial findfont 6 scalefont setfont 520 523 moveto  ($HLL_PNP) show");// hutang lain 2  p-np
$o[27]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 520 503 moveto  ($TKL_PNP) show");// total kewajiban lancar  p-np
$o[28]=(".0 setgray /Arial findfont 6 scalefont setfont 520 493 moveto  ($HJP_PNP) show"); // hutang jangka panjang  p-np
$o[29]=(".0 setgray /Arial findfont 6 scalefont setfont 520 483 moveto  ($TK_PNP) show"); // total kewajiban  p-np
$o[32]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 520 463 moveto  ($LDM_PNP) show");// lana ditahan/modal  p-np
$o[35]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 520 443 moveto  ($TP_PNP) show");// total pasiva  p-np




//proyeksi - rugi laba performa
$o[47]=(".0 setgray /Arial findfont 6 scalefont setfont 530 353 moveto  ($PENJUALAN_PRLP) show");
$o[48]=(".0 setgray /Arial findfont 6 scalefont setfont 530 343 moveto  (($HPP_PRLP)) show");
$o[49]=(".0 setgray /Arial-BOldMT findfont 6 scalefont setfont 530 333 moveto  ($LK_PRLP) show");
$o[50]=(".0 setgray /Arial findfont 6 scalefont setfont 530 313 moveto  (($PAnU_PRLP)) show"); 
$o[51]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 530 293 moveto  ($LUSBP_PRLP)  show"); 
$o[52]=(".0 setgray /Arial findfont 6 scalefont setfont 530 283 moveto  (($BnA_PRLP)) show"); 
$o[53]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 530 263 moveto  ($LUSP_PRLP) show"); 




//historicay profitability
$o[77]=(".0 setgray /Arial findfont 8 scalefont setfont 740 582 moveto  ($ROS_HP) show"); 
$o[78]=(".0 setgray /Arial findfont 8 scalefont setfont 740 572 moveto  ($NETSALES_HP) show"); 
$o[79]=(".0 setgray /Arial findfont 8 scalefont setfont 740 562 moveto  (-) show"); 
$o[80]=(".0 setgray /Arial findfont 8 scalefont setfont 740 552 moveto  ($COGS_HP) show"); 
$o[81]=(".0 setgray /Arial findfont 8 scalefont setfont 740 542 moveto  ($SGA_HP) show"); 
$o[82]=(".0 setgray /Arial findfont 8 scalefont setfont 740 532 moveto  ($EBITDA_HP) show"); 
$o[83]=(".0 setgray /Arial findfont 8 scalefont setfont 740 512 moveto  ($NAPUI_HP) show"); 
$o[84]=(".0 setgray /Arial findfont 8 scalefont setfont 740 502 moveto  ($NOPAT_HP) show"); 
//historicay eficiency
$o[85]=(".0 setgray /Arial findfont 8 scalefont setfont 740 482 moveto  ($WI_HE) show"); 
$o[86]=(".0 setgray /Arial findfont 8 scalefont setfont 740 472 moveto  ($ARDOH_HE) show"); 
$o[87]=(".0 setgray /Arial findfont 8 scalefont setfont 740 462 moveto  ($INVDOH_HE) show"); 
$o[88]=(".0 setgray /Arial findfont 8 scalefont setfont 740 452 moveto  ($AEDOH_HE) show"); 
// historicay leverage
$o[89]=(".0 setgray /Arial findfont 8 scalefont setfont 740 432 moveto  ($CR_HL) show"); 
$o[90]=(".0 setgray /Arial findfont 8 scalefont setfont 740 422 moveto  ($QR_HL) show"); 
$o[91]=(".0 setgray /Arial findfont 8 scalefont setfont 740 412 moveto  ($LEV_HL) show"); 




//projection  profitability
$o[92]=(".0 setgray /Arial findfont 8 scalefont setfont 740 342 moveto  ($ROS_PP) show");
$o[93]=(".0 setgray /Arial findfont 8 scalefont setfont 740 332 moveto  ($NET_SALES_PP) show"); 
$o[94]=(".0 setgray /Arial findfont 8 scalefont setfont 740 322 moveto  ($SALES_CHG_PP) show"); 
$o[95]=(".0 setgray /Arial findfont 8 scalefont setfont 740 312 moveto  ($COGS_PP) show"); 
$o[96]=(".0 setgray /Arial findfont 8 scalefont setfont 740 302 moveto  ($SGA_PP) show"); 
$o[97]=(".0 setgray /Arial findfont 8 scalefont setfont 740 292 moveto  ($EBITA_PP) show"); 
$o[98]=(".0 setgray /Arial findfont 8 scalefont setfont 740 282 moveto  ($NPAUI_PP) show"); 
$o[99]=(".0 setgray /Arial findfont 8 scalefont setfont 740 272 moveto  ($NOPAT_PP) show"); 
 
//projection  efficiency
$o[100]=(".0 setgray /Arial findfont 8 scalefont setfont 740 252 moveto  ($WI_PE) show"); 
$o[101]=(".0 setgray /Arial findfont 8 scalefont setfont 740 242 moveto  ($ARDOH_PE) show"); 
$o[102]=(".0 setgray /Arial findfont 8 scalefont setfont 740 232 moveto  ($INVDOH_PE) show"); 
$o[103]=(".0 setgray /Arial findfont 8 scalefont setfont 740 222 moveto  ($AEDOH_PE) show"); 
 
//projection  leverage
$o[104]=(".0 setgray /Arial findfont 8 scalefont setfont 740 202 moveto  ($CR_PL) show"); 
$o[105]=(".0 setgray /Arial findfont 8 scalefont setfont 740 192 moveto  ($QR_PL) show"); 
$o[106]=(".0 setgray /Arial findfont 8 scalefont setfont 740 182 moveto  ($LEV_PL) show"); 
$o[107]=(".0 setgray /Arial findfont 8 scalefont setfont 740 172 moveto  ($dWI_PL) show"); 
$o[108]=(".0 setgray /Arial findfont 8 scalefont setfont 740 162 moveto  ($BANKFIN_PL) show"); 
$o[109]=(".0 setgray /Arial findfont 8 scalefont setfont 740 152 moveto  ($TBF_PL) show"); 
		for($po=0;$po<110;$po++)
	{
		//echo $a[$i]."<br/>";
		$line=$o[$po]."\n";
		fwrite($ourFileHandle,$line);
	}
		fclose($ourFileHandle);
	
		?>