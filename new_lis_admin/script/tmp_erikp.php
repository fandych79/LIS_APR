<?	
$patch="C:/xampp/htdocs/lismega_DEVEL/PostScript/tmp_erik/";
	$ourFileName = $patch."peru.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
	$per[0]=".0 setgray /Arial findfont 8 scalefont setfont 85 730 moveto ($proc_name) show"; 
	$per[1]=".0 setgray /Arial findfont 8 scalefont setfont 500 730 moveto ($c_plafond) show"; 
	$per[2]=".0 setgray /Arial findfont 8 scalefont setfont 50 662 moveto ($custfullname) show";
	$per[3]=".0 setgray /Arial findfont 8 scalefont setfont 175 644 moveto ($nickname) show";
	$per[4]="%.0 setgray /Arial findfont 8 scalefont setfont 175 626 moveto (input Jabatan) show";
	$per[5]=".0 setgray /Arial findfont 8 scalefont setfont 175 608 moveto ($bnpwp) show";
	$per[6]="%.0 setgray /Arial findfont 8 scalefont setfont 175 590 moveto (Input no akta dan tanggal pendirian SIUO) show";
	$per[7]=".0 setgray /Arial findfont 8 scalefont setfont 2175 572 moveto ($bsiup) show";
	$per[8]=".0 setgray /Arial findfont 8 scalefont setfont 175 554 moveto ($btdp) show";
	$per[9]=".0 setgray /Arial findfont 8 scalefont setfont 175 536 moveto ($bn) show";
	$per[10]=".0 setgray /Arial findfont 8 scalefont setfont 175 518 moveto ($blong) show";
	$per[11]=".0 setgray /Arial findfont 8 scalefont setfont 175 500 moveto ($btelp) show";
	$per[12]="%.0 setgray /Arial findfont 8 scalefont setfont 235 500 moveto (2345678990123) show";
	$per[13]=".0 setgray /Arial findfont 8 scalefont setfont 50 444 moveto ($badd) show";
	$per[14]=".0 setgray /Arial findfont 8 scalefont setfont 175 426 moveto (aaaa$city1) show";
	$per[15]=".0 setgray /Arial findfont 8 scalefont setfont 225 426 moveto (bbbb$pro1) show";
	$per[16]="%.0 setgray /Arial findfont 8 scalefont setfont 175 408 moveto (input Kode Poss) show";
	$per[17]="%.0 setgray /Arial findfont 8 scalefont setfont 175 390 moveto (input No. Fax.) show";
	$per[18]=".0 setgray /Arial findfont 8 scalefont setfont 175 372 moveto (ccc$hs) show";
	$per[19]=".0 setgray /Arial findfont 8 scalefont setfont 175 354 moveto (ddd$lv) show";
	$per[20]=".0 setgray /Arial findfont 8 scalefont setfont 435 680 moveto (eeee$bus1) show";
	$per[21]=".0 setgray /Arial findfont 8 scalefont setfont 435 662 moveto (fff$bus2) show";
	$per[22]=".0 setgray /Arial findfont 8 scalefont setfont 525 662 moveto (ggg$bus3) show";
	$per[23]=".0 setgray /Arial findfont 8 scalefont setfont 435 644 moveto (hh$bus4) show";
	$per[24]=".0 setgray /Arial findfont 8 scalefont setfont 435 626 moveto ($bus5) show";
	$per[25]=".0 setgray /Arial findfont 8 scalefont setfont 435 608 moveto ($bus7) show";
	$per[26]=".0 setgray /Arial findfont 8 scalefont setfont 435 590 moveto ($bus8) show";
	$per[27]=".0 setgray /Arial findfont 8 scalefont setfont 525 590 moveto ($bus9) show";
	$per[28]=".0 setgray /Arial findfont 8 scalefont setfont 435 572 moveto ($bus10) show";
	$per[29]=".0 setgray /Arial findfont 8 scalefont setfont 435 554 moveto ($bus11) show";
	$per[30]=".0 setgray /Arial findfont 8 scalefont setfont 435 536 moveto ($bus13) show";
	$per[31]=".0 setgray /Arial findfont 8 scalefont setfont 435 518 moveto ($bus14) show";
	$per[32]=".0 setgray /Arial findfont 8 scalefont setfont 525 518 moveto ($bus15) show";
	$per[33]=".0 setgray /Arial findfont 8 scalefont setfont 435 500 moveto ($bus16) show";
	$per[34]=".0 setgray /Arial findfont 8 scalefont setfont 435 482 moveto ($bus17) show";
	$per[35]=".0 setgray /Arial findfont 8 scalefont setfont 435 464 moveto ($cn1) show";
	$per[36]=".0 setgray /Arial findfont 8 scalefont setfont 435 446 moveto ($cn1) show";
	$per[37]=".0 setgray /Arial findfont 8 scalefont setfont 435 428 moveto ($ct1) show";
	$per[38]=".0 setgray /Arial findfont 8 scalefont setfont 450 410 moveto ($cp1) show";
	$per[39]=".0 setgray /Arial findfont 8 scalefont setfont 435 392 moveto ($cl1) show";
	$per[40]=".0 setgray /Arial findfont 8 scalefont setfont 435 374 moveto ($cn2) show";
	$per[41]=".0 setgray /Arial findfont 8 scalefont setfont 435 356 moveto ($ct2) show";
	$per[42]=".0 setgray /Arial findfont 8 scalefont setfont 450 338 moveto ($cp2) show";
	$per[43]=".0 setgray /Arial findfont 8 scalefont setfont 435 320 moveto ($cl2) show";
	$per[44]=".0 setgray /Arial findfont 8 scalefont setfont 435 152 moveto (disetujui) show";
	$per[45]=".0 setgray /Arial findfont 8 scalefont setfont 420 241 moveto ($nickname) show";
	$per[46]=".0 setgray /Arial findfont 8 scalefont setfont 450 228 moveto ($datenow) show";
	$per[47]=".0 setgray /Arial findfont 8 scalefont setfont 400 208 moveto ($custnomperkenalan) show";
	$per[48]=".0 setgray /Arial findfont 8 scalefont setfont 175 188 moveto ($datenow) show";
	$per[49]="%.0 setgray /Arial findfont 8 scalefont setfont 175 170 moveto (input Number) show";
	$per[50]=".0 setgray /Arial findfont 8 scalefont setfont 175 152 moveto ($branch_name) show";
	$per[51]=".0 setgray /Arial findfont 8 scalefont setfont 175 134 moveto ($ao_name) show";
		for($i=0;$i<52;$i++)
	{
		
		//echo $a[$i]."<br/>";
		$line=$per[$i]."\n";
		fwrite($ourFileHandle,$line);
	}
		fclose($ourFileHandle);
		
		
		
		
			$ourFileName = $patch."02p.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
	$xp[0]=".0 setgray /Arial findfont 8 scalefont setfont 150 730 moveto ($lkcd1) show"; 
	$xp[1]=".0 setgray /Arial findfont 8 scalefont setfont 150 715 moveto ($branch_name) show"; 
	$xp[2]=".0 setgray /Arial findfont 8 scalefont setfont 150 700 moveto ($custfullname) show"; 
	$xp[3]=".0 setgray /Arial findfont 8 scalefont setfont 150 685 moveto () show %input nomor  lkcd"; 
	$xp[4]=".0 setgray /Arial findfont 8 scalefont setfont 150 670 moveto ($lkcd1) show"; 
	$xp[5]=".0 setgray /Arial findfont 8 scalefont setfont 445 685 moveto ($cn1 + $cn2) show"; 
	$xp[6]=".0 setgray /Arial findfont 8 scalefont setfont 150 635 moveto ($bt) show";
	$xp[7]=".0 setgray /Arial findfont 8 scalefont setfont 150 620 moveto ($bn) show";
	$xp[8]=".0 setgray /Arial findfont 8 scalefont setfont 150 605 moveto ($badd) show";
	$xp[9]=".0 setgray /Arial findfont 8 scalefont setfont 150 590 moveto ($btelp) show";
	$xp[10]=".0 setgray /Arial findfont 8 scalefont setfont 100 575 moveto ($blong) show";
	$xp[11]=".0 setgray /Arial findfont 8 scalefont setfont 100 560 moveto (Input Kepemilikan) show";
	$xp[12]=".0 setgray /Arial findfont 8 scalefont setfont 445 635 moveto ($lkcd30) show"; 
	$xp[13]=".0 setgray /Arial findfont 8 scalefont setfont 445 620 moveto ($lkcd29) show"; 
	$xp[14]=".0 setgray /Arial findfont 8 scalefont setfont 445 605 moveto ($lkcd3) show"; 
	$xp[15]=".0 setgray /Arial findfont 8 scalefont setfont 445 590 moveto ($lkcd2) show"; 
	$xp[16]=".0 setgray /Arial findfont 8 scalefont setfont 445 575 moveto ($lkcd6) show"; 
	$xp[17]=".0 setgray /Arial findfont 8 scalefont setfont 445 560 moveto (Input pembayaran) show"; 
	$xp[18]=".0 setgray /Arial findfont 8 scalefont setfont 190 525 moveto ($lkcd9) show";
	$xp[19]=".0 setgray /Arial findfont 8 scalefont setfont 445 525 moveto ($lkcd16) show";
	$xp[20]=".0 setgray /Arial findfont 8 scalefont setfont 190 510 moveto ($lkcd10) show";
	$xp[21]=".0 setgray /Arial findfont 8 scalefont setfont 445 510 moveto ($lkcd17) show";
	$xp[22]=".0 setgray /Arial findfont 8 scalefont setfont 190 495 moveto ($lkcd11) show";
	$xp[23]=".0 setgray /Arial findfont 8 scalefont setfont 445 495 moveto ($lkcd18) show";
	$xp[24]=".0 setgray /Arial findfont 8 scalefont setfont 190 480 moveto ($lkcd12) show";
	$xp[25]=".0 setgray /Arial findfont 8 scalefont setfont 445 480 moveto ($lkcd19) show";
	$xp[26]=".0 setgray /Arial findfont 8 scalefont setfont 190 465 moveto ($lkcd13) show";
	$xp[27]=".0 setgray /Arial findfont 8 scalefont setfont 445 465 moveto ($lkcd4) show";
	$xp[28]=".0 setgray /Arial findfont 8 scalefont setfont 190 450 moveto ($lkcd14) show";
	$xp[29]=".0 setgray /Arial findfont 8 scalefont setfont 445 450 moveto ($lkcd7) show";
	$xp[30]=".0 setgray /Arial findfont 8 scalefont setfont 190 435 moveto ($lkcd15) show";
	$xp[31]=".0 setgray /Arial findfont 8 scalefont setfont 50 385 moveto ($lkcd20) show";
	$xp[32]=".0 setgray /Arial findfont 8 scalefont setfont 50 370 moveto ($lkcd21) show";
	$xp[33]=".0 setgray /Arial findfont 8 scalefont setfont 50 355 moveto ($lkcd22) show";
	$xp[34]=".0 setgray /Arial findfont 8 scalefont setfont 50 325 moveto ($lkcd23) show";
	$xp[35]=".0 setgray /Arial findfont 8 scalefont setfont 50 310 moveto ($lkcd24) show";
	$xp[36]=".0 setgray /Arial findfont 8 scalefont setfont 50 295 moveto ($lkcd25) show";
	$xp[37]=".0 setgray /Arial findfont 8 scalefont setfont 50 265 moveto ($lkcd26) show";
	$xp[38]=".0 setgray /Arial findfont 8 scalefont setfont 50 250 moveto ($lkcd27) show";
	$xp[39]=".0 setgray /Arial findfont 8 scalefont setfont 50 235 moveto ($lkcd28) show";
	$xp[40]=".0 setgray /Arial findfont 8 scalefont setfont 50 220 moveto () show %bingung input";
	$xp[41]=".0 setgray /Arial findfont 8 scalefont setfont 50 205 moveto () show % bingung input";
	$xp[42]=".0 setgray /Arial findfont 8 scalefont setfont 50 190 moveto () show %bingung input";
	$xp[43]=".0 setgray /Arial findfont 8 scalefont setfont 50 175 moveto () show % bingung input";
	
	for($ix=0;$ix<44;$ix++)
	{
		
		//echo $a[$i]."<br/>";
		$line=$xp[$ix]."\n";
		fwrite($ourFileHandle,$line);
	}
		fclose($ourFileHandle);

		
	$ourFileName = $patch."03p.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
	$vp[0]=(".0 setgray /Arial findfont 6 scalefont setfont 170 730 moveto ($branch_name) show"); 
	$vp[1]=(".0 setgray /Arial findfont 6 scalefont setfont 170 720 moveto ($custfullname) show"); 
	$vp[2]=(".0 setgray /Arial findfont 6 scalefont setfont 170 710 moveto (Input No.) show");
	$vp[3]=(".0 setgray /Arial findfont 6 scalefont setfont 180 670 moveto ($cmtc2) show");
	$vp[4]=(".0 setgray /Arial findfont 6 scalefont setfont 460 670 moveto ($cmtc14) show");
	$vp[5]=(".0 setgray /Arial findfont 6 scalefont setfont 180 660 moveto ($cmtc3) show");
	$vp[6]=(".0 setgray /Arial findfont 6 scalefont setfont 460 660 moveto ($cmtc15) show");
	$vp[7]=(".0 setgray /Arial findfont 6 scalefont setfont 180 650 moveto ($cmtc4) show");
	$vp[8]=(".0 setgray /Arial findfont 6 scalefont setfont 460 650 moveto ($cmtc16) show");
	$vp[9]=(".0 setgray /Arial findfont 6 scalefont setfont 180 640 moveto ($cmtc5) show");
	$vp[10]=(".0 setgray /Arial findfont 6 scalefont setfont 460 640 moveto ($cmtc17) show");
	$vp[11]=(".0 setgray /Arial findfont 6 scalefont setfont 180 630 moveto ($cmtc6) show");
	$vp[12]=(".0 setgray /Arial findfont 6 scalefont setfont 460 630 moveto ($cmtc18) show");
	$vp[13]=(".0 setgray /Arial findfont 6 scalefont setfont 180 620 moveto ($cmtc7) show");
	$vp[14]=(".0 setgray /Arial findfont 6 scalefont setfont 460 620 moveto ($cmtc19) show");
	$vp[15]=(".0 setgray /Arial findfont 6 scalefont setfont 180 610 moveto ($cmtc8) show");
	$vp[16]=(".0 setgray /Arial findfont 6 scalefont setfont 460 610 moveto ($cmtc20) show");
	$vp[17]=(".0 setgray /Arial findfont 6 scalefont setfont 180 600 moveto ($cmtc9) show");
	$vp[18]=(".0 setgray /Arial findfont 6 scalefont setfont 460 600 moveto ($cmtc21) show");
	$vp[19]=(".0 setgray /Arial findfont 6 scalefont setfont 180 590 moveto ($cmtc10) show");
	$vp[20]=(".0 setgray /Arial findfont 6 scalefont setfont 460 590 moveto ($cmtc22) show");
	$vp[21]=(".0 setgray /Arial findfont 6 scalefont setfont 180 580 moveto ($cmtc11) show");
	$vp[22]=(".0 setgray /Arial findfont 6 scalefont setfont 460 580 moveto ($cmtc23) show");
	$vp[23]=(".0 setgray /Arial findfont 6 scalefont setfont 180 570 moveto ($cmtc12) show");
	$vp[24]=(".0 setgray /Arial findfont 6 scalefont setfont 460 570 moveto ($cmtc24) show");
	$vp[25]=(".0 setgray /Arial findfont 6 scalefont setfont 180 552 moveto ($cmtc13) show");
	$vp[26]=(".0 setgray /Arial findfont 6 scalefont setfont 460 552 moveto ($cmtc25) show");
	$vp[27]=(".0 setgray /Arial findfont 6 scalefont setfont 180 520 moveto ($cmtc26) show");
	$vp[28]=(".0 setgray /Arial findfont 6 scalefont setfont 460 520 moveto ($cmtc38) show");
	$vp[29]=(".0 setgray /Arial findfont 6 scalefont setfont 180 510 moveto ($cmtc27) show");
	$vp[30]=(".0 setgray /Arial findfont 6 scalefont setfont 460 510 moveto ($cmtc39) show");
	$vp[31]=(".0 setgray /Arial findfont 6 scalefont setfont 180 500 moveto ($cmtc28) show");
	$vp[32]=(".0 setgray /Arial findfont 6 scalefont setfont 460 500 moveto ($cmtc40) show");
	$vp[33]=(".0 setgray /Arial findfont 6 scalefont setfont 180 490 moveto ($cmtc29) show");
	$vp[34]=(".0 setgray /Arial findfont 6 scalefont setfont 460 490 moveto ($cmtc41) show");
	$vp[35]=(".0 setgray /Arial findfont 6 scalefont setfont 180 480 moveto ($cmtc30) show");
	$vp[36]=(".0 setgray /Arial findfont 6 scalefont setfont 460 480 moveto ($cmtc42) show");
	$vp[37]=(".0 setgray /Arial findfont 6 scalefont setfont 180 470 moveto ($cmtc31) show");
	$vp[38]=(".0 setgray /Arial findfont 6 scalefont setfont 460 470 moveto ($cmtc43) show");
	$vp[39]=(".0 setgray /Arial findfont 6 scalefont setfont 180 460 moveto ($cmtc32) show");
	$vp[40]=(".0 setgray /Arial findfont 6 scalefont setfont 460 460 moveto ($cmtc44) show");
	$vp[41]=(".0 setgray /Arial findfont 6 scalefont setfont 180 450 moveto ($cmtc33) show");
	$vp[42]=(".0 setgray /Arial findfont 6 scalefont setfont 460 450 moveto ($cmtc45) show");
	$vp[43]=(".0 setgray /Arial findfont 6 scalefont setfont 180 440 moveto ($cmtc34) show");
	$vp[44]=(".0 setgray /Arial findfont 6 scalefont setfont 460 440 moveto ($cmtc46) show");
	$vp[45]=(".0 setgray /Arial findfont 6 scalefont setfont 180 430 moveto ($cmtc35) show");
	$vp[46]=(".0 setgray /Arial findfont 6 scalefont setfont 460 430 moveto ($cmtc47) show");
	$vp[47]=(".0 setgray /Arial findfont 6 scalefont setfont 180 420 moveto ($cmtc36) show");
	$vp[48]=(".0 setgray /Arial findfont 6 scalefont setfont 460 420 moveto ($cmtc48) show");
	$vp[49]=(".0 setgray /Arial findfont 6 scalefont setfont 180 410 moveto ($cmtc37) show");
	$vp[50]=(".0 setgray /Arial findfont 6 scalefont setfont 460 410 moveto ($cmtc49) show");
	$vp[51]=(".0 setgray /Arial findfont 6 scalefont setfont 180 370 moveto ($cmtc50) show");
	$vp[52]=(".0 setgray /Arial findfont 6 scalefont setfont 460 370 moveto ($cmtc59) show");
	$vp[53]=(".0 setgray /Arial findfont 6 scalefont setfont 180 360 moveto ($cmtc51) show");
	$vp[54]=(".0 setgray /Arial findfont 6 scalefont setfont 460 360 moveto ($cmtc60) show");
	$vp[55]=(".0 setgray /Arial findfont 6 scalefont setfont 180 350 moveto ($cmtc52) show");
	$vp[56]=(".0 setgray /Arial findfont 6 scalefont setfont 460 350 moveto ($cmtc61) show");
	$vp[57]=(".0 setgray /Arial findfont 6 scalefont setfont 180 340 moveto ($cmtc53) show");
	$vp[58]=(".0 setgray /Arial findfont 6 scalefont setfont 460 340 moveto ($cmtc62) show");
	$vp[59]=(".0 setgray /Arial findfont 6 scalefont setfont 180 330 moveto ($cmtc54) show");
	$vp[60]=(".0 setgray /Arial findfont 6 scalefont setfont 460 330 moveto ($cmtc63) show");
	$vp[61]=(".0 setgray /Arial findfont 6 scalefont setfont 180 320 moveto ($cmtc55) show");
	$vp[62]=(".0 setgray /Arial findfont 6 scalefont setfont 460 320 moveto ($cmtc64) show");
	$vp[63]=(".0 setgray /Arial findfont 6 scalefont setfont 180 310 moveto ($cmtc56) show");
	$vp[64]=(".0 setgray /Arial findfont 6 scalefont setfont 460 310 moveto ($cmtc65) show");
	$vp[65]=(".0 setgray /Arial findfont 6 scalefont setfont 180 300 moveto ($cmtc58) show");
	$vp[66]=(".0 setgray /Arial findfont 6 scalefont setfont 460 300 moveto ($cmtc67) show");
	$vp[67]=(".0 setgray /Arial findfont 6 scalefont setfont 170 700 moveto ($cmtc1) show");
	$vp[68]=(".0 setgray /Arial findfont 7 scalefont setfont 550 215 moveto ($flagcmtc69) show");
	$vp[69]=(".0 setgray /Arial findfont 7 scalefont setfont 50 260 moveto ($cmtc68) show");

	for($as=0;$as<70;$as++)
	{
		$tmp_ltc=$vp[$as]."\n";
		fwrite($ourFileHandle,$tmp_ltc);
	}
		

		
		
			
	$ourFileName = $patch."04p.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");		
	$zxp[0]=(".0 setgray /Arial findfont 8 scalefont setfont 100 730 moveto ($branch_name) show");
	$zxp[1]=(".0 setgray /Arial findfont 8 scalefont setfont 100 715 moveto ($custfullname) show");
	$zxp[2]=(".0 setgray /Arial findfont 8 scalefont setfont 100 700 moveto () show %input number");
	$zxp[3]=(".0 setgray /Arial findfont 8 scalefont setfont 100 685 moveto ($lmau1) show");
	$zxp[4]=(".0 setgray /Arial findfont 8 scalefont setfont 55 300 moveto ($cmtc28) show");
	$zxp[5]=(".0 setgray /Arial findfont 8 scalefont setfont 55 290 moveto ($cmtc40) show");
	$zxp[6]=(".0 setgray /Arial findfont 8 scalefont setfont 175 300 moveto ($cmtc33) show");
	$zxp[7]=(".0 setgray /Arial findfont 8 scalefont setfont 175 290 moveto ($cmtc45) show");
	$zxp[8]=(".0 setgray /Arial findfont 8 scalefont setfont 265 300 moveto ($cmtc31) show");
	$zxp[9]=(".0 setgray /Arial findfont 8 scalefont setfont 265 290 moveto ($cmtc43) show");
	$zxp[10]=(".0 setgray /Arial findfont 8 scalefont setfont 370 300 moveto ($cmtc10) show");
	$zxp[11]=(".0 setgray /Arial findfont 8 scalefont setfont 370 290 moveto ($cmtc19) show");
	$zxp[12]=(".0 setgray /Arial findfont 8 scalefont setfont 475 300 moveto ($flagcmtc69) show");
	$zxp[13]=(".0 setgray /Arial findfont 8 scalefont setfont 475 290 moveto ($flagcmtc69) show");	
	$zxp[14]=(".0 setgray /Arial findfont 8 scalefont setfont 35 640 moveto ($lmau2) show");
	$zxp[15]=(".0 setgray /Arial findfont 8 scalefont setfont 35 630 moveto ($lmau3) show");
	$zxp[16]=(".0 setgray /Arial findfont 8 scalefont setfont 35 620 moveto ($lmau4) show");
	$zxp[17]=(".0 setgray /Arial findfont 8 scalefont setfont 35 610 moveto ($lmau5) show");
	$zxp[18]=(".0 setgray /Arial findfont 8 scalefont setfont 35 600 moveto ($lmau6) show");
	$zxp[19]=(".0 setgray /Arial findfont 8 scalefont setfont 35 590 moveto ($lmau7) show");
	$zxp[20]=(".0 setgray /Arial findfont 8 scalefont setfont 35 540 moveto ($lmau8) show");
	$zxp[21]=(".0 setgray /Arial findfont 8 scalefont setfont 35 530 moveto ($lmau9) show");
	$zxp[22]=(".0 setgray /Arial findfont 8 scalefont setfont 35 520 moveto ($lmau10) show");
	$zxp[23]=(".0 setgray /Arial findfont 8 scalefont setfont 35 510 moveto ($lmau11) show");
	$zxp[24]=(".0 setgray /Arial findfont 8 scalefont setfont 35 500 moveto ($lmau12) show");
	$zxp[25]=(".0 setgray /Arial findfont 8 scalefont setfont 35 490 moveto ($lmau13) show");
	$zxp[26]=(".0 setgray /Arial findfont 8 scalefont setfont 55 410 moveto ($cmtc4) show");
	$zxp[27]=(".0 setgray /Arial findfont 8 scalefont setfont 55 400 moveto ($cmtc16) show");
	$zxp[28]=(".0 setgray /Arial findfont 8 scalefont setfont 175 410 moveto ($cmtc9) show");
	$zxp[29]=(".0 setgray /Arial findfont 8 scalefont setfont 175 400 moveto ($cmtc21) show");
	$zxp[30]=(".0 setgray /Arial findfont 8 scalefont setfont 265 410 moveto ($cmtc7) show");
	$zxp[31]=(".0 setgray /Arial findfont 8 scalefont setfont 265 400 moveto ($cmtc19) show");
	$zxp[32]=(".0 setgray /Arial findfont 8 scalefont setfont 370 410 moveto ($cmtc34) show");
	$zxp[33]=(".0 setgray /Arial findfont 8 scalefont setfont 370 400 moveto ($cmtc46) show");
	$zxp[34]=(".0 setgray /Arial findfont 8 scalefont setfont 475 410 moveto ($flagcmtc69) show");
	$zxp[35]=(".0 setgray /Arial findfont 8 scalefont setfont 475 400 moveto ($flagcmtc69) show");		
	$zxp[36]=(".0 setgray /Arial findfont 8 scalefont setfont 135 205 moveto ($flaglmau20) show");		
	$zxp[37]=(".0 setgray /Arial findfont 8 scalefont setfont 135 195 moveto ($flaglmau21) show");		
	$zxp[38]=(".0 setgray /Arial findfont 8 scalefont setfont 135 185 moveto ($flaglmau22) show");		
	$zxp[39]=(".0 setgray /Arial findfont 8 scalefont setfont 135 175 moveto ($flaglmau23) show");		
	$zxp[40]=(".0 setgray /Arial findfont 8 scalefont setfont 200 220 moveto ($lmau24) show");		
	for($dfs=0;$dfs<41;$dfs++)
	{
		//echo $a[$i]."<br/>";
		$tmp_ltc=$zxp[$dfs]."\n";
		fwrite($ourFileHandle,$tmp_ltc);
	}
	
	
	

	
	


	$ourFileName = $patch."05p.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");	
	$hp[0]=(".0 setgray /Arial findfont 8 scalefont setfont 140 740 moveto ($branch_name) show");
	$hp[1]=(".0 setgray /Arial findfont 8 scalefont setfont 140 730 moveto ($custfullname) show");
	$hp[2]=(".0 setgray /Arial findfont 8 scalefont setfont 140 720 moveto (Input No.) show");
	$hp[3]=(".0 setgray /Arial findfont 8 scalefont setfont 140 710 moveto ($ak1) show");
	$hp[4]=(".0 setgray /Arial findfont 8 scalefont setfont 130 620 moveto ($ROS_HP) show");
	$hp[5]=(".0 setgray /Arial findfont 8 scalefont setfont 200 620 moveto ($ROS_PP) show");
	$hp[6]=(".0 setgray /Arial findfont 8 scalefont setfont 130 610 moveto ($NETSALES_HP) show");
	$hp[7]=(".0 setgray /Arial findfont 8 scalefont setfont 200 610 moveto ($NET_SALES_PP) show");
	$hp[8]=(".0 setgray /Arial findfont 8 scalefont setfont 130 600 moveto ($COGS_HP) show");
	$hp[9]=(".0 setgray /Arial findfont 8 scalefont setfont 200 600 moveto ($COGS_PP) show");
	$hp[10]=(".0 setgray /Arial findfont 8 scalefont setfont 130 590 moveto ($SGA_HP) show");
	$hp[11]=(".0 setgray /Arial findfont 8 scalefont setfont 200 590 moveto ($SGA_PP) show");
	$hp[12]=(".0 setgray /Arial findfont 8 scalefont setfont 130 580 moveto ($EBITDA_HP) show");
	$hp[13]=(".0 setgray /Arial findfont 8 scalefont setfont 200 580 moveto ($EBITA_PP) show");
	$hp[14]=(".0 setgray /Arial-BoldMT findfont 8 scalefont setfont 130 570 moveto ($NOPAT_HP) show");
	$hp[15]=(".0 setgray /Arial-BoldMT findfont 8 scalefont setfont 200 570 moveto ($NOPAT_PP) show");
	$hp[16]=(".0 setgray /Arial findfont 8 scalefont setfont 130 480 moveto ($WI_HE) show");
	$hp[17]=(".0 setgray /Arial findfont 8 scalefont setfont 200 480 moveto ($WI_PE) show");
	$hp[18]=(".0 setgray /Arial findfont 8 scalefont setfont 130 470 moveto ($ARDOH_HE) show");
	$hp[19]=(".0 setgray /Arial findfont 8 scalefont setfont 200 470 moveto ($ARDOH_PE) show");
	$hp[20]=(".0 setgray /Arial findfont 8 scalefont setfont 130 460 moveto ($INVDOH_HE) show");
	$hp[21]=(".0 setgray /Arial findfont 8 scalefont setfont 200 460 moveto ($INVDOH_PE) show");
	$hp[22]=(".0 setgray /Arial findfont 8 scalefont setfont 130 450 moveto ($AEDOH_HE) show");
	$hp[23]=(".0 setgray /Arial findfont 8 scalefont setfont 200 450 moveto ($AEDOH_PE) show");
	$hp[24]=(".0 setgray /Arial findfont 8 scalefont setfont 130 440 moveto ($ushio9) show");
	$hp[25]=(".0 setgray /Arial findfont 8 scalefont setfont 200 440 moveto ($TA_PNP) show");
	$hp[26]=(".0 setgray /Arial-BoldMT findfont 8 scalefont setfont 130 430 moveto (-) show");
	$hp[27]=(".0 setgray /Arial-BoldMT findfont 8 scalefont setfont 200 430 moveto ($BANKFIN_PL) show");
	$hp[28]=(".0 setgray /Arial findfont 8 scalefont setfont 285 505  moveto ($ak17) show");
	$hp[29]=(".0 setgray /Arial findfont 8 scalefont setfont 285 495  moveto ($ak18) show");
	$hp[30]=(".0 setgray /Arial findfont 8 scalefont setfont 130 340 moveto ($CR_HL) show");
	$hp[31]=(".0 setgray /Arial findfont 8 scalefont setfont 200 340 moveto ($CR_PL) show");
	$hp[32]=(".0 setgray /Arial findfont 8 scalefont setfont 200 330 moveto ($QR_PL) show");
	$hp[33]=(".0 setgray /Arial findfont 8 scalefont setfont 130 320 moveto ($LEV_HL) show");
	$hp[34]=(".0 setgray /Arial findfont 8 scalefont setfont 200 320 moveto ($LEV_PL) show");
	$hp[35]=(".0 setgray /Arial findfont 8 scalefont setfont 285 368  moveto ($ak23)show");
	$hp[36]=(".0 setgray /Arial findfont 8 scalefont setfont 285 358  moveto ($ak24)show");
	$hp[37]=(".0 setgray /Arial findfont 8 scalefont setfont 285 343  moveto ($ak25)show");
	$hp[38]=(".0 setgray /Arial findfont 8 scalefont setfont 285 333  moveto ($ak26)show");
	$hp[67]=(".0 setgray /Arial findfont 8 scalefont setfont 285 318  moveto ($ak27)show");
	$hp[68]=(".0 setgray /Arial findfont 8 scalefont setfont 285 308  moveto ($ak28)show");
	$hp[39]=(".0 setgray /Arial findfont 8 scalefont setfont 130 170 moveto (Mutasi) show");
	$hp[40]=(".0 setgray /Arial findfont 8 scalefont setfont 200 170 moveto (Mutasi) show");

		
		
	$hp[41]=(".0 setgray /Arial findfont 8 scalefont setfont 130 155 moveto ($ak2) show");
	$hp[43]=(".0 setgray /Arial findfont 8 scalefont setfont 130 140 moveto ($ak5) show");
	$hp[45]=(".0 setgray /Arial findfont 8 scalefont setfont 130 125 moveto ($ak8) show");
	$hp[47]=(".0 setgray /Arial findfont 8 scalefont setfont 130 110 moveto ($totalmutasi) show");
	$hp[49]=(".0 setgray /Arial findfont 8 scalefont setfont 130 95 moveto ($totalmutasiavg) show");

	$hp[42]=(".0 setgray /Arial findfont 8 scalefont setfont 200 155 moveto ($ak3) show");
	$hp[44]=(".0 setgray /Arial findfont 8 scalefont setfont 200 140 moveto ($ak6) show");
	$hp[46]=(".0 setgray /Arial findfont 8 scalefont setfont 200 125 moveto ($ak9) show");
	$hp[48]=(".0 setgray /Arial findfont 8 scalefont setfont 200 110 moveto ($totalkredit) show");
	$hp[50]=(".0 setgray /Arial findfont 8 scalefont setfont 200 95 moveto ($totalkreditavg) show");
	
	
	$hp[51]=(".0 setgray /Arial findfont 8 scalefont setfont 405 155 moveto ($ak4) show");
	$hp[52]=(".0 setgray /Arial findfont 8 scalefont setfont 405 140 moveto ($ak7) show");
	$hp[53]=(".0 setgray /Arial findfont 8 scalefont setfont 405 125 moveto ($ak10) show");
	$hp[54]=(".0 setgray /Arial findfont 8 scalefont setfont 405 110 moveto ($totalpenjualan) show");
	$hp[55]=(".0 setgray /Arial findfont 8 scalefont setfont 405 95 moveto ($totalpenjualanavg) show");
	$hp[56]=(".0 setgray /Arial findfont 8 scalefont setfont 130 330 moveto ($QR_HL) show");
	$hp[57]=(".0 setgray /Arial findfont 8 scalefont setfont 285 480  moveto ($ak19) show");
	$hp[58]=(".0 setgray /Arial findfont 8 scalefont setfont 285 470  moveto ($ak20) show");
	$hp[59]=(".0 setgray /Arial findfont 8 scalefont setfont 285 455  moveto ($ak21) show");
	$hp[60]=(".0 setgray /Arial findfont 8 scalefont setfont 285 445  moveto ($ak22) show");
	
	$hp[61]=(".0 setgray /Arial findfont 8 scalefont setfont 285 640  moveto ($ak11) show");
	$hp[62]=(".0 setgray /Arial findfont 8 scalefont setfont 285 630  moveto ($ak12) show");
	$hp[63]=(".0 setgray /Arial findfont 8 scalefont setfont 285 615 moveto ($ak13) show");
	$hp[64]=(".0 setgray /Arial findfont 8 scalefont setfont 285 605  moveto ($ak14) show");
	$hp[65]=(".0 setgray /Arial findfont 8 scalefont setfont 285 590  moveto ($ak15) show");
	$hp[66]=(".0 setgray /Arial findfont 8 scalefont setfont 285 580  moveto ($ak16) show");
	for($a=0;$a<69;$a++)
	{
		//echo $a[$i]."<br/>";
		$line=$hp[$a]."\n";
		fwrite($ourFileHandle,$line);
	}

	$ourFileName = $patch."06p.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");	
	$jp[0]=(".0 setgray /Arial findfont 8 scalefont setfont 125 730 moveto ($branch_name) show"); 
	$jp[1]=(".0 setgray /Arial findfont 8 scalefont setfont 125 720 moveto ($custfullname) show");
	$jp[2]=(".0 setgray /Arial findfont 8 scalefont setfont 125 710 moveto ($bt) show");
	$jp[3]=(".0 setgray /Arial findfont 8 scalefont setfont 125 700 moveto ($bn) show");
	$jp[4]=(".0 setgray /Arial findfont 8 scalefont setfont 125 670 moveto () show %input number"); 
	$jp[5]=(".0 setgray /Arial findfont 8 scalefont setfont 125 660 moveto ($admin2) show");
	$jp[6]=(".0 setgray /Arial findfont 8 scalefont setfont 120 650 moveto (:) show");
	$jp[7]=(".0 setgray /Arial findfont 8 scalefont setfont 125 650 moveto (Input) show %data dari sana");
	$jp[8]=(".0 setgray /Arial findfont 8 scalefont setfont 125 640 moveto ($admin9) show");
	$jp[9]=(".0 setgray /Arial findfont 8 scalefont setfont 125 630 moveto ($admin6) show");
	$jp[10]=("%.0 setgray /Arial findfont 6 scalefont setfont 360 662 moveto (input1) show");
	$jp[11]=("%.0 setgray /Arial findfont 6 scalefont setfont 460 662 moveto (1 input 1) show");
	$jp[12]=("%.0 setgray /Arial findfont 6 scalefont setfont 360 652 moveto (input1) show");
	$jp[13]=("%.0 setgray /Arial findfont 6 scalefont setfont 460 652 moveto (1 input 1) show");
	$jp[14]=("%.0 setgray /Arial findfont 6 scalefont setfont 360 642 moveto (input1) show");
	$jp[15]=("%.0 setgray /Arial findfont 6 scalefont setfont 460 642 moveto (1 input 1) show");
	$jp[16]=("%.0 setgray /Arial findfont 6 scalefont setfont 360 632 moveto (input1) show");
	$jp[17]=("%.0 setgray /Arial findfont 6 scalefont setfont 460 632 moveto (1 input 1) show");
	$jp[18]=("%.0 setgray /Arial findfont 6 scalefont setfont 360 622 moveto (input1) show");
	$jp[19]=("%.0 setgray /Arial findfont 6 scalefont setfont 460 622 moveto (1 input 1) show");
	$jp[20]=("%.0 setgray /Arial findfont 8 scalefont setfont 120 590 moveto (perjanjian kredit lainnya) show");
	$jp[21]=("%.0 setgray /Arial findfont 8 scalefont setfont 120 580 moveto (Pembelian dan pengumpulan) show");
	$jp[22]=(".0 setgray /Arial findfont 8 scalefont setfont 120 570 moveto ($branch_name) show");
	$jp[23]=("%.0 setgray /Arial findfont 8 scalefont setfont 120 560 moveto (Lancar) show");
	$jp[24]=("%.0 setgray /Arial findfont 8 scalefont setfont 250 590 moveto (79) show");
	$jp[25]=("%.0 setgray /Arial findfont 8 scalefont setfont 250 580 moveto (6000) show");
	$jp[26]=("%.0 setgray /Arial findfont 8 scalefont setfont 250 570 moveto (92) show");
	$jp[27]=("%.0 setgray /Arial findfont 8 scalefont setfont 250 560 moveto (1) show");
	$jp[28]=(".0 setgray /Arial findfont 8 scalefont setfont 300 580 moveto (Penjamin) show");
	$jp[29]=(".0 setgray /Arial findfont 8 scalefont setfont 300 570 moveto (Lokasi) show");
	$jp[30]=(".0 setgray /Arial findfont 8 scalefont setfont 300 560 moveto () show");
	$jp[31]=(".0 setgray /Arial findfont 8 scalefont setfont 300 550 moveto () show");
	$jp[32]=(".0 setgray /Arial findfont 8 scalefont setfont 370 590 moveto ($cn1 - $cn2) show");
	$jp[33]=(".0 setgray /Arial findfont 8 scalefont setfont 370 580 moveto (Perseorangan) show");
	$jp[34]=(".0 setgray /Arial findfont 8 scalefont setfont 370 570 moveto () show");
	$jp[35]=(".0 setgray /Arial findfont 8 scalefont setfont 370 560 moveto () show");
	$jp[36]=("%.0 setgray /Arial findfont 8 scalefont setfont 500 590 moveto (20) show");
	$jp[37]=("%.0 setgray /Arial findfont 8 scalefont setfont 500 580 moveto (13) show");
	$jp[38]=("%.0 setgray /Arial findfont 8 scalefont setfont 500 570 moveto (34) show");
	$jp[39]=("%.0 setgray /Arial findfont 8 scalefont setfont 500 560 moveto (958) show");
	$jp[40]=("%.0 setgray /Arial findfont 8 scalefont setfont 50 520 moveto ($ct1) show");
	$jp[41]=("%.0 setgray /Arial findfont 8 scalefont setfont 50 510 moveto ($ct2) show");
	$jp[42]=("%.0 setgray /Arial findfont 8 scalefont setfont 100 520 moveto (input) show");
	$jp[43]=("%.0 setgray /Arial findfont 8 scalefont setfont 100 510 moveto (input) show");
	$jp[44]=("%.0 setgray /Arial findfont 8 scalefont setfont 100 495 moveto (Input) show");
	$jp[45]=("%.0 setgray /Arial findfont 8 scalefont setfont 175 520 moveto (Input) show");
	$jp[46]=("%.0 setgray /Arial findfont 8 scalefont setfont 175 510 moveto (Input) show");
	$jp[47]=("%.0 setgray /Arial findfont 8 scalefont setfont 175 495 moveto (input) show");
	$jp[48]=("%.0 setgray /Arial findfont 8 scalefont setfont 230 520 moveto (input) show");
	$jp[49]=("%.0 setgray /Arial findfont 8 scalefont setfont 230 510 moveto (input) show");
	$jp[50]=("%.0 setgray /Arial findfont 8 scalefont setfont 290 520 moveto (Input) show");
	$jp[51]=("%.0 setgray /Arial findfont 8 scalefont setfont 290 510 moveto (INput) show");
	$jp[52]=("%.0 setgray /Arial findfont 8 scalefont setfont 375 520 moveto (88) show");
	$jp[53]=("%.0 setgray /Arial findfont 8 scalefont setfont 375 510 moveto (44) show");
	$jp[54]=("%.0 setgray /Arial findfont 8 scalefont setfont 425 520 moveto (1111) show");
	$jp[55]=("%.0 setgray /Arial findfont 8 scalefont setfont 425 510 moveto (1111) show");
	$jp[56]=("%.0 setgray /Arial findfont 8 scalefont setfont 475 520 moveto (8748374837) show");
	$jp[57]=("%.0 setgray /Arial findfont 8 scalefont setfont 475 510 moveto (i764273642) show");
	$jp[58]=("%.0 setgray /Arial findfont 8 scalefont setfont 475 495 moveto (jahsjahjhsak) show");
	$jp[59]=(".0 setgray /Arial findfont 8 scalefont setfont 50 460 moveto ($cn1) show");
	$jp[60]=(".0 setgray /Arial findfont 8 scalefont setfont 50 450 moveto ($cn2) show");
	$jp[61]=(".0 setgray /Arial findfont 8 scalefont setfont 100 460 moveto ($cp1) show");
	$jp[62]=(".0 setgray /Arial findfont 8 scalefont setfont 100 450 moveto ($cp2) show");
	$jp[63]=(".0 setgray /Arial findfont 8 scalefont setfont 100 435 moveto (Input) show");
	$jp[64]=(".0 setgray /Arial findfont 8 scalefont setfont 175 460 moveto ($mkk20% p.a) show");
	$jp[65]=(".0 setgray /Arial findfont 8 scalefont setfont 175 450 moveto ($mkk29% p.a) show");
	$jp[66]=(".0 setgray /Arial findfont 8 scalefont setfont 175 435 moveto () show");
	$jp[67]=(".0 setgray /Arial findfont 8 scalefont setfont 230 460 moveto ($mkk21) show");
	$jp[68]=(".0 setgray /Arial findfont 8 scalefont setfont 230 450 moveto ($mkk30) show");
	$jp[69]=(".0 setgray /Arial findfont 8 scalefont setfont 290 460 moveto ($cn1) show");
	$jp[70]=(".0 setgray /Arial findfont 8 scalefont setfont 290 450 moveto ($cn2) show");
	$jp[71]=(".0 setgray /Arial findfont 8 scalefont setfont 375 460 moveto ($cl2) show");
	$jp[72]=(".0 setgray /Arial findfont 8 scalefont setfont 375 450 moveto ($cl2) show");
	$jp[73]=(".0 setgray /Arial findfont 8 scalefont setfont 425 460 moveto ($mkk22) show");
	$jp[74]=(".0 setgray /Arial findfont 8 scalefont setfont 425 450 moveto ($mkk31) show");
	$jp[75]=(".0 setgray /Arial findfont 8 scalefont setfont 475 460 moveto ($mkk23) show");
	$jp[76]=(".0 setgray /Arial findfont 8 scalefont setfont 475 450 moveto ($mkk32) show");
	$jp[77]=(".0 setgray /Arial findfont 8 scalefont setfont 475 435 moveto ($totalkewajibanbank) show");
	$jp[78]=(".0 setgray /Arial findfont 8 scalefont setfont 50 390 moveto ($cn1) show");
	$jp[79]=(".0 setgray /Arial findfont 8 scalefont setfont 50 380 moveto ($cn2) show");
	$jp[80]=(".0 setgray /Arial findfont 8 scalefont setfont 50 370 moveto () show");
	$jp[81]=(".0 setgray /Arial findfont 8 scalefont setfont 50 360 moveto () show");
	$jp[82]=(".0 setgray /Arial findfont 8 scalefont setfont 100 390 moveto ($cp1) show");
	$jp[83]=(".0 setgray /Arial findfont 8 scalefont setfont 100 380 moveto ($cp2) show");
	$jp[84]=(".0 setgray /Arial findfont 8 scalefont setfont 100 370 moveto () show");
	$jp[85]=(".0 setgray /Arial findfont 8 scalefont setfont 100 360 moveto () show");
	$jp[86]=(".0 setgray /Arial findfont 8 scalefont setfont 100 345 moveto ($totalcp) show");
	$jp[87]=(".0 setgray /Arial findfont 8 scalefont setfont 175 390 moveto ($mkk20% p.a) show%os");
	$jp[88]=(".0 setgray /Arial findfont 8 scalefont setfont 175 380 moveto ($mkk29% p.a) show");
	$jp[89]=(".0 setgray /Arial findfont 8 scalefont setfont 175 370 moveto () show");
	$jp[90]=(".0 setgray /Arial findfont 8 scalefont setfont 175 360 moveto () show");
	$jp[91]=(".0 setgray /Arial findfont 8 scalefont setfont 175 345 moveto () show");
	$jp[92]=(".0 setgray /Arial findfont 8 scalefont setfont 230 390 moveto ($mkk21) show%suku bunga");
	$jp[93]=(".0 setgray /Arial findfont 8 scalefont setfont 230 380 moveto ($mkk30) show");
	$jp[94]=(".0 setgray /Arial findfont 8 scalefont setfont 230 370 moveto () show");
	$jp[95]=(".0 setgray /Arial findfont 8 scalefont setfont 230 360 moveto () show");
	$jp[96]=(".0 setgray /Arial findfont 8 scalefont setfont 290 390 moveto ($cn1) show");
	$jp[97]=(".0 setgray /Arial findfont 8 scalefont setfont 290 380 moveto ($cn2) show");
	$jp[98]=(".0 setgray /Arial findfont 8 scalefont setfont 290 370 moveto () show");
	$jp[99]=(".0 setgray /Arial findfont 8 scalefont setfont 290 360 moveto () show");
	$jp[100]=(".0 setgray /Arial findfont 8 scalefont setfont 375 390 moveto ($cl1) show");
	$jp[101]=(".0 setgray /Arial findfont 8 scalefont setfont 375 380 moveto ($cl2) show");
	$jp[102]=(".0 setgray /Arial findfont 8 scalefont setfont 375 370 moveto () show");
	$jp[103]=(".0 setgray /Arial findfont 8 scalefont setfont 375 360 moveto () show");
	$jp[104]=(".0 setgray /Arial findfont 8 scalefont setfont 425 390 moveto ($mkk22) show");
	$jp[105]=(".0 setgray /Arial findfont 8 scalefont setfont 425 380 moveto ($mkk31) show");
	$jp[106]=("%.0 setgray /Arial findfont 8 scalefont setfont 425 370 moveto (1111) show");
	$jp[107]=("%.0 setgray /Arial findfont 8 scalefont setfont 425 360 moveto (1111) show");
	$jp[108]=(".0 setgray /Arial findfont 8 scalefont setfont 475 390 moveto ($mkk23) show");
	$jp[109]=(".0 setgray /Arial findfont 8 scalefont setfont 475 380 moveto ($mkk32) show");
	$jp[110]=(".0 setgray /Arial findfont 8 scalefont setfont 475 370 moveto () show");
	$jp[111]=(".0 setgray /Arial findfont 8 scalefont setfont 475 360 moveto () show");
	$jp[112]=(".0 setgray /Arial findfont 8 scalefont setfont 475 345 moveto ($totalkewajibanbank) show");
	$jp[113]=(".0 setgray /Arial findfont 8 scalefont setfont 55 300 moveto (land) show");
	$jp[114]=(".0 setgray /Arial findfont 8 scalefont setfont 155 300 moveto ($badd) show");
	$jp[115]=(".0 setgray /Arial findfont 8 scalefont setfont 280 300 moveto (c) show");
	$jp[116]=(".0 setgray /Arial findfont 8 scalefont setfont 350 300 moveto ($custfullname) show");
	$jp[117]=("%.0 setgray /Arial findfont 8 scalefont setfont 425 300 moveto (e) show");
	$jp[118]=("%.0 setgray /Arial findfont 8 scalefont setfont 425 250 moveto (f) show");
	$jp[119]=("%.0 setgray /Arial findfont 8 scalefont setfont 495 300 moveto (g) show");
	$jp[120]=("%.0 setgray /Arial findfont 8 scalefont setfont 495 250 moveto (h) show");
	$jp[121]=("%.0 setgray /Arial findfont 8 scalefont setfont 155 250 moveto (i) show");
	$jp[122]=("%.0 setgray /Arial findfont 8 scalefont setfont 155 240 moveto (k) show");
	$jp[123]=("%.0 setgray /Arial findfont 8 scalefont setfont 155 228 moveto (l) show");
	$jp[124]=("%.0 setgray /Arial findfont 8 scalefont setfont 227 165 moveto (Y) show");
	$jp[125]=("%.0 setgray /Arial findfont 8 scalefont setfont 227 150 moveto (Y) show");
	$jp[126]=("%.0 setgray /Arial findfont 8 scalefont setfont 227 135 moveto (Y) show");

	for($p=0;$p<127;$p++)
	{
		//echo $a[$i]."<br/>";
		$line=$jp[$p]."\n";
		fwrite($ourFileHandle,$line);
	}

	
	
	
	
	$ourFileName = $patch."07p.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");	
	$mp[0]=(".0 setgray /Arial findfont 9 scalefont setfont 282 740 moveto ($custfullname) show");
	
	$mp[1]=(".0 setgray /Arial findfont 9 scalefont setfont 170 697 moveto ($ushio1) show");
	$mp[3]=(".0 setgray /Arial findfont 9 scalefont setfont 170 680 moveto ($ushio2) show");
	$mp[5]=(".0 setgray /Arial findfont 9 scalefont setfont 170 663 moveto ($ushio3) show");
	$mp[7]=(".0 setgray /Arial findfont 9 scalefont setfont 170 646 moveto ($ushio4) show");
	$mp[9]=(".0 setgray /Arial findfont 9 scalefont setfont 170 629 moveto ($ushio5) show");
	$mp[13]=(".0 setgray /Arial findfont 9 scalefont setfont 170 578 moveto ($ushio6) show");
	$mp[14]=(".0 setgray /Arial findfont 9 scalefont setfont 170 561 moveto ($ushio7) show");
	$mp[16]=(".0 setgray /Arial findfont 9 scalefont setfont 170 544 moveto ($ushio8) show");
	$mp[17]=(".0 setgray /Arial findfont 9 scalefont setfont 170 527 moveto ($ushio9) show");
	
	
	$mp[2]=(".0 setgray /Arial findfont 9 scalefont setfont 440 697 moveto ($ushio10) show");
	$mp[4]=(".0 setgray /Arial findfont 9 scalefont setfont 440 680 moveto ($ushio11) show");
	$mp[6]=(".0 setgray /Arial findfont 9 scalefont setfont 440 663 moveto ($ushio12) show");
	$mp[8]=(".0 setgray /Arial findfont 9 scalefont setfont 440 646 moveto ($ushio13) show");
	$mp[10]=(".0 setgray /Arial findfont 9 scalefont setfont 440 629 moveto ($ushio14) show");
	$mp[11]=(".0 setgray /Arial findfont 9 scalefont setfont 440 612 moveto ($ushio15) show");
	$mp[12]=(".0 setgray /Arial findfont 9 scalefont setfont 440 595 moveto ($ushio16) show");
	$mp[15]=(".0 setgray /Arial findfont 9 scalefont setfont 440 561 moveto ($ushio17) show");
	$mp[18]=(".0 setgray /Arial findfont 9 scalefont setfont 440 527 moveto ($ushio18) show");
	
	$mp[19]=(".0 setgray /Arial findfont 9 scalefont setfont 282 480 moveto ($custfullname) show");
	$mp[20]=(".0 setgray /Arial findfont 9 scalefont setfont 285 470 moveto ($datenow) show");
	$mp[21]=(".0 setgray /Arial findfont 9 scalefont setfont 400 443 moveto ($ushio19) show");
	$mp[22]=(".0 setgray /Arial findfont 9 scalefont setfont 400 426 moveto (($ushio20)) show");
	$mp[23]=(".0 setgray /Arial findfont 9 scalefont setfont 400 409 moveto ($ushio21) show");
	$mp[24]=(".0 setgray /Arial findfont 9 scalefont setfont 400 383 moveto ($ushio22) show");
	$mp[25]=(".0 setgray /Arial findfont 9 scalefont setfont 400 357 moveto (($ushio23)) show");
	$mp[26]=(".0 setgray /Arial findfont 9 scalefont setfont 400 340 moveto ($ushio24) show");
	$mp[27]=(".0 setgray /Arial findfont 9 scalefont setfont 400 323 moveto (($ushio25)) show");
	$mp[28]=(".0 setgray /Arial findfont 9 scalefont setfont 400 289 moveto ($ushio26) show");
	for($jkl=0;$jkl<29;$jkl++)
	{
		//echo $a[$i]."<br/>";
		$line=$mp[$jkl]."\n";
		fwrite($ourFileHandle,$line);
	}
	
	
	
	
	
	
	$ourFileName = $patch."08p.erik";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");	
	
$op[0]=(".0 setgray /Arial-BoldMT findfont 12 scalefont setfont 120 575 moveto  ($custfullname) show");
$op[1]=(".0 setgray /Arial findfont 8 scalefont setfont 130 565 moveto  (Input Nama) show");
$op[36]=(".0 setgray /Arial-BoldMT findfont 12 scalefont setfont 120 385 moveto  (Input Nama) show");
$op[37]=(".0 setgray /Arial findfont 8 scalefont setfont 130 375 moveto  (Input Nama) show");


$op[46]=(".0 setgray /Arial-BoldMT findfont 12 scalefont setfont 390 375 moveto  (Input Nama) show");
///////////////neraca performa column 1
$op[2]=(".0 setgray /Arial findfont 6 scalefont setfont 110 543 moveto  ($ushio1) show");//kas and bank NP 
$op[4]=(".0 setgray /Arial findfont 6 scalefont setfont 110 533 moveto  ($ushio2) show");//Piutang usaha NP
$op[6]=(".0 setgray /Arial findfont 6 scalefont setfont 110 523 moveto  ($ushio3) show");//persediaan NP
$op[8]=(".0 setgray /Arial findfont 6 scalefont setfont 110 513 moveto  ($ushio4) show");//piutang lain NP
$op[9]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 110 503 moveto  ($ushio5) show");//total aktiva lancar NP
$op[13]=(".0 setgray /Arial findfont 6 scalefont setfont 110 473 moveto  ($ushio6) show");//aktiva tetap NP
$op[14]=(".0 setgray /Arial findfont 6 scalefont setfont 110 463 moveto  ($ushio7) show");//aktiva lain-lain NP
$op[16]=(".0 setgray /Arial findfont 6 scalefont setfont 110 453 moveto  ($ushio8) show");//total aktiva tetap NP
$op[17]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 110 443 moveto  ($ushio9) show");//total aktiva NP
////////////neraca performa column 2
$op[3]=(".0 setgray /Arial findfont 6 scalefont setfont 245 543 moveto  ($ushio10) show");//s/t bank NP
$op[5]=(".0 setgray /Arial findfont 6 scalefont setfont 245 533 moveto  ($ushio11) show");//hutang usaha  NP
$op[7]=(".0 setgray /Arial findfont 6 scalefont setfont 245 523 moveto  ($ushio12) show");//hutang lain NP
$op[10]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 245 503 moveto  ($ushio14) show");// total kewajiban lancar NP
$op[11]=(".0 setgray /Arial findfont 6 scalefont setfont 245 493 moveto  ($ushio15) show");// hutang jangka panjang NP
$op[12]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 245 483 moveto  ($ushio16) show");// total kewajiban NP
$op[15]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 245 463 moveto  ($ushio17) show");//laba di tahan/modal NP
$op[18]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 245 443 moveto  ($ushio18) show");// total pasiva NP

/////rugi laba performa
$op[38]=(".0 setgray /Arial findfont 6 scalefont setfont 245 353 moveto  ($ushio19) show");//penjualan 
$op[39]=(".0 setgray /Arial findfont 6 scalefont setfont 245 343 moveto  (($ushio20)) show");//harga pokok penjualan 
$op[40]=(".0 setgray /Arial-BOldMT findfont 6 scalefont setfont 245 333 moveto  ($ushio21) show");//laba kotor
$op[41]=(".0 setgray /Arial findfont 6 scalefont setfont 245 318 moveto  (($ushio22)) show"); // penjualan, administrasi dan umum
$op[42]=(".0 setgray /Arial findfont 6 scalefont setfont 245 303 moveto  (($ushio23)) show"); //pendapatan /pengeluaran lain2
$op[43]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 245 293 moveto  ($ushio24) show"); // laba usaha sebelum bunga san pajak
$op[44]=(".0 setgray /Arial findfont 6 scalefont setfont 245 283 moveto  (($ushio25)) show"); // bunga dan angsuran
$op[45]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 245 263 moveto  ($ushio26) show"); //laba usaha seblum pajak



////asumsi proyek
$op[64]=(".0 setgray /Arial findfont 8 scalefont setfont 415 222 moveto  ($SC_AP) show"); 
$op[66]=(".0 setgray /Arial findfont 8 scalefont setfont 415 212 moveto  ($COGS_AP) show"); 
$op[68]=(".0 setgray /Arial findfont 8 scalefont setfont 415 202 moveto  ($SGA_AP) show"); 
$op[70]=(".0 setgray /Arial findfont 8 scalefont setfont 415 192 moveto  ($BNA_AP) show"); 
$op[72]=(".0 setgray /Arial findfont 8 scalefont setfont 415 182 moveto  ($CorS_AP) show"); 
$op[74]=(".0 setgray /Arial findfont 8 scalefont setfont 415 172 moveto  ($AT_AP) show"); 
$op[76]=(".0 setgray /Arial findfont 8 scalefont setfont 415 162 moveto  ($ALL_AP) show"); 
$op[65]=(".0 setgray /Arial findfont 8 scalefont setfont 550 222 moveto  ($ARDOH_AP) show"); 
$op[67]=(".0 setgray /Arial findfont 8 scalefont setfont 550 212 moveto  ($INVDOH_AP) show");
$op[69]=(".0 setgray /Arial findfont 8 scalefont setfont 550 202 moveto  ($APDOH_AP) show"); 
$op[71]=(".0 setgray /Arial findfont 8 scalefont setfont 550 192 moveto  ($AEDOH_AP) show"); 
$op[73]=(".0 setgray /Arial findfont 8 scalefont setfont 550 182 moveto  ($SorT_AP) show"); 
$op[75]=(".0 setgray /Arial findfont 8 scalefont setfont 550 172 moveto  ($LorT_AP) show"); 

///asumsi proyeksi pembiayaan
$op[62]=(".0 setgray /Arial findfont 8 scalefont setfont 260 162 moveto  ($PMK_APP) show"); 
$op[63]=(".0 setgray /Arial findfont 8 scalefont setfont 260 152 moveto  ($PI_APP) show"); 




//kondisi historical
$op[54]=(".0 setgray /Arial findfont 8 scalefont setfont 125 222 moveto  ($COGS_KH) show"); 
$op[56]=(".0 setgray /Arial findfont 8 scalefont setfont 125 212 moveto  ($SGA_KH) show"); 
$op[58]=(".0 setgray /Arial findfont 8 scalefont setfont 125 202 moveto  ($BNA_KH) show"); 
$op[60]=(".0 setgray /Arial findfont 8 scalefont setfont 125 192 moveto  ($CorS_KH) show"); 
$op[55]=(".0 setgray /Arial findfont 8 scalefont setfont 270 222 moveto  ($ARDOH_KH ) show"); 
$op[57]=(".0 setgray /Arial findfont 8 scalefont setfont 270 212 moveto  ($INVDOH_KH ) show"); 
$op[59]=(".0 setgray /Arial findfont 8 scalefont setfont 270 202 moveto  ($APDOH_KH) show"); 
$op[61]=(".0 setgray /Arial findfont 8 scalefont setfont 270 192 moveto  ($AEDOH_KH ) show"); 



//proyeksi - nearaca performa column1
$op[19]=(".0 setgray /Arial findfont 6 scalefont setfont 390 543 moveto  ($KnB_PNP) show");// kas n bank p-np
$op[21]=(".0 setgray /Arial findfont 6 scalefont setfont 390 533 moveto  ($PU_PNP) show");// piutang usaha  p-np
$op[23]=(".0 setgray /Arial findfont 6 scalefont setfont 390 523 moveto  ($PERSEDIAN_PNP) show");// persediaan  p-np
$op[25]=(".0 setgray /Arial findfont 6 scalefont setfont 390 513 moveto  ($PIUTANG_PNP) show");// piutan lain  p-np
$op[26]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 390 503 moveto  ($TAL_PNP) show");
$op[30]=(".0 setgray /Arial findfont 6 scalefont setfont 390 473 moveto  ($AT_PNP) show");// aktiva tetap  p-np
$op[31]=(".0 setgray /Arial findfont 6 scalefont setfont 390 463 moveto  ($ALL_PNP) show");// aktiva lain  p-np
$op[33]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 390 453 moveto  ($TAT_PNP) show");// total aktiva lain  p-np
$op[34]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 390 443 moveto  ($TA_PNP) show");// total aktiva  p-np


//proyeksi - nrecara performa column 2
$op[20]=(".0 setgray /Arial findfont 6 scalefont setfont 520 543 moveto  ($SorT_PNP) show");// s/t  p-np
$op[22]=(".0 setgray /Arial findfont 6 scalefont setfont 520 533 moveto  ($HT_PNP) show");// hutang usaha 2  p-np
$op[24]=(".0 setgray /Arial findfont 6 scalefont setfont 520 523 moveto  ($HLL_PNP) show");// hutang lain 2  p-np
$op[27]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 520 503 moveto  ($TKL_PNP) show");// total kewajiban lancar  p-np
$op[28]=(".0 setgray /Arial findfont 6 scalefont setfont 520 493 moveto  ($HJP_PNP) show"); // hutang jangka panjang  p-np
$op[29]=(".0 setgray /Arial findfont 6 scalefont setfont 520 483 moveto  ($TK_PNP) show"); // total kewajiban  p-np
$op[32]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 520 463 moveto  ($LDM_PNP) show");// lana ditahan/modal  p-np
$op[35]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 520 443 moveto  ($TP_PNP) show");// total pasiva  p-np




//proyeksi - rugi laba performa
$op[47]=(".0 setgray /Arial findfont 6 scalefont setfont 530 353 moveto  ($PENJUALAN_PRLP) show");
$op[48]=(".0 setgray /Arial findfont 6 scalefont setfont 530 343 moveto  (($HPP_PRLP)) show");
$op[49]=(".0 setgray /Arial-BOldMT findfont 6 scalefont setfont 530 333 moveto  ($LK_PRLP) show");
$op[50]=(".0 setgray /Arial findfont 6 scalefont setfont 530 313 moveto  (($PAnU_PRLP)) show"); 
$op[51]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 530 293 moveto  ($LUSBP_PRLP)  show"); 
$op[52]=(".0 setgray /Arial findfont 6 scalefont setfont 530 283 moveto  (($BnA_PRLP)) show"); 
$op[53]=(".0 setgray /Arial-BoldMT findfont 6 scalefont setfont 530 263 moveto  ($LUSP_PRLP) show"); 




//historicay profitability
$op[77]=(".0 setgray /Arial findfont 8 scalefont setfont 740 582 moveto  ($ROS_HP) show"); 
$op[78]=(".0 setgray /Arial findfont 8 scalefont setfont 740 572 moveto  ($NETSALES_HP) show"); 
$op[79]=(".0 setgray /Arial findfont 8 scalefont setfont 740 562 moveto  (-) show"); 
$op[80]=(".0 setgray /Arial findfont 8 scalefont setfont 740 552 moveto  ($COGS_HP) show"); 
$op[81]=(".0 setgray /Arial findfont 8 scalefont setfont 740 542 moveto  ($SGA_HP) show"); 
$op[82]=(".0 setgray /Arial findfont 8 scalefont setfont 740 532 moveto  ($EBITDA_HP) show"); 
$op[83]=(".0 setgray /Arial findfont 8 scalefont setfont 740 512 moveto  ($NAPUI_HP) show"); 
$op[84]=(".0 setgray /Arial findfont 8 scalefont setfont 740 502 moveto  ($NOPAT_HP) show"); 
//historicay eficiency
$op[85]=(".0 setgray /Arial findfont 8 scalefont setfont 740 482 moveto  ($WI_HE) show"); 
$op[86]=(".0 setgray /Arial findfont 8 scalefont setfont 740 472 moveto  ($ARDOH_HE) show"); 
$op[87]=(".0 setgray /Arial findfont 8 scalefont setfont 740 462 moveto  ($INVDOH_HE) show"); 
$op[88]=(".0 setgray /Arial findfont 8 scalefont setfont 740 452 moveto  ($AEDOH_HE) show"); 
// historicay leverage
$op[89]=(".0 setgray /Arial findfont 8 scalefont setfont 740 432 moveto  ($CR_HL) show"); 
$op[90]=(".0 setgray /Arial findfont 8 scalefont setfont 740 422 moveto  ($QR_HL) show"); 
$op[91]=(".0 setgray /Arial findfont 8 scalefont setfont 740 412 moveto  ($LEV_HL) show"); 




//projection  profitability
$op[92]=(".0 setgray /Arial findfont 8 scalefont setfont 740 342 moveto  ($ROS_PP) show");
$op[93]=(".0 setgray /Arial findfont 8 scalefont setfont 740 332 moveto  ($NET_SALES_PP) show"); 
$op[94]=(".0 setgray /Arial findfont 8 scalefont setfont 740 322 moveto  ($SALES_CHG_PP) show"); 
$op[95]=(".0 setgray /Arial findfont 8 scalefont setfont 740 312 moveto  ($COGS_PP) show"); 
$op[96]=(".0 setgray /Arial findfont 8 scalefont setfont 740 302 moveto  ($SGA_PP) show"); 
$op[97]=(".0 setgray /Arial findfont 8 scalefont setfont 740 292 moveto  ($EBITA_PP) show"); 
$op[98]=(".0 setgray /Arial findfont 8 scalefont setfont 740 282 moveto  ($NPAUI_PP) show"); 
$op[99]=(".0 setgray /Arial findfont 8 scalefont setfont 740 272 moveto  ($NOPAT_PP) show"); 
 
//projection  efficiency
$op[100]=(".0 setgray /Arial findfont 8 scalefont setfont 740 252 moveto  ($WI_PE) show"); 
$op[101]=(".0 setgray /Arial findfont 8 scalefont setfont 740 242 moveto  ($ARDOH_PE) show"); 
$op[102]=(".0 setgray /Arial findfont 8 scalefont setfont 740 232 moveto  ($INVDOH_PE) show"); 
$op[103]=(".0 setgray /Arial findfont 8 scalefont setfont 740 222 moveto  ($AEDOH_PE) show"); 
 
//projection  leverage
$op[104]=(".0 setgray /Arial findfont 8 scalefont setfont 740 202 moveto  ($CR_PL) show"); 
$op[105]=(".0 setgray /Arial findfont 8 scalefont setfont 740 192 moveto  ($QR_PL) show"); 
$op[106]=(".0 setgray /Arial findfont 8 scalefont setfont 740 182 moveto  ($LEV_PL) show"); 
$op[107]=(".0 setgray /Arial findfont 8 scalefont setfont 740 172 moveto  ($dWI_PL) show"); 
$op[108]=(".0 setgray /Arial findfont 8 scalefont setfont 740 162 moveto  ($BANKFIN_PL) show"); 
$op[109]=(".0 setgray /Arial findfont 8 scalefont setfont 740 152 moveto  ($TBF_PL) show"); 
		for($po=0;$po<110;$po++)
	{
		//echo $a[$i]."<br/>";
		$line=$op[$po]."\n";
		fwrite($ourFileHandle,$line);
	}
		fclose($ourFileHandle);
		
		?>