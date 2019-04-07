<div align=center>
		<TABLE cellPadding=5 width="700" border=1>
			<TR>
				<?
					$vhccol_addr1 = "";
					$vhccol_addr2 = "";
					$vhccol_addr3 = "";
					$vhccol_kodepos = "";
					$vhccol_nopol = "";
					$vhccol_stnk_no = "";
					$vhccol_stnkexp = "";
					$vhccol_fakturno = "";
					$vhccol_fakturtgl = "";
					$vhccol_bpkbno = "";
					$vhccol_bpkbtgl = "";
					$vhccol_type = "";
					$vhccol_model = "";
					$vhccol_merk = "";
					$vhccol_tahunpembuatan = "";
					$vhccol_jeniskendaran = "";
					$vhccol_silinder = "";
					$vhccol_warna = "";
					$vhccol_norangka = "";
					$vhccol_nomesin = "";
					$vhccol_MK_CODE = "";
					$vhccol_condition = "";
					$vhccol_bpkbnama = "";
					$vhccol_bpkbaddr1 = "";
					$vhccol_bpkbaddr2 = "";
					$vhccol_bpkbaddr3 = "";
					$vhccol_desc = "";
					
					$tsqlvehicle = "SELECT * FROM tbl_COL_Vehicle where ap_lisregno = '$ap_lisregno' AND col_id = '$col_id'";

					$avehicle = sqlsrv_query($conn, $tsqlvehicle);

					if ( $avehicle === false)
						die( FormatErrors( sqlsrv_errors() ) );

					if(sqlsrv_has_rows($avehicle))
					{  
						if($rowvehicle = sqlsrv_fetch_array($avehicle, SQLSRV_FETCH_ASSOC))
						{ 
							$vhccol_addr1 = $rowvehicle['col_addr1'];
							$vhccol_addr2 = $rowvehicle['col_addr2'];
							$vhccol_addr3 = $rowvehicle['col_addr3'];
							$vhccol_kodepos = $rowvehicle['col_kodepos'];
							$vhccol_nopol = $rowvehicle['col_nopol'];
							$vhccol_stnk_no = $rowvehicle['col_stnk_no'];
							$vhccol_stnkexp = $rowvehicle['col_stnkexp']->format('Y/m/d');
							$vhccol_fakturno = $rowvehicle['col_fakturno'];
							$vhccol_fakturtgl = $rowvehicle['col_fakturtgl']->format('Y/m/d');
							$vhccol_bpkbno = $rowvehicle['col_bpkbno'];
							$vhccol_bpkbtgl = $rowvehicle['col_bpkbtgl']->format('Y/m/d');
							$vhccol_type = $rowvehicle['col_type'];
							$vhccol_model = $rowvehicle['col_model'];
							$vhccol_merk = $rowvehicle['col_merk'];
							$vhccol_tahunpembuatan = $rowvehicle['col_tahunpembuatan'];
							$vhccol_jeniskendaran = $rowvehicle['col_jeniskendaran'];
							$vhccol_silinder = $rowvehicle['col_silinder'];
							$vhccol_warna = $rowvehicle['col_warna'];
							$vhccol_norangka = $rowvehicle['col_norangka'];
							$vhccol_nomesin = $rowvehicle['col_nomesin'];
							$vhccol_MK_CODE = $rowvehicle['col_MK_CODE'];
							$vhccol_condition = $rowvehicle['col_condition'];
							$vhccol_bpkbnama = $rowvehicle['col_bpkbnama'];
							$vhccol_bpkbaddr1 = $rowvehicle['col_bpkbaddr1'];
							$vhccol_bpkbaddr2 = $rowvehicle['col_bpkbaddr2'];
							$vhccol_bpkbaddr3 = $rowvehicle['col_bpkbaddr3'];
							$vhccol_desc = $rowvehicle['col_desc'];
						}
					}
				?>
				<TD align=left valign=top>
					<TABLE WIDTH=90% CELLPADDING=1 CELLSPACING=1 border=0 align="center">                  	   	
   	                    <tr>
   	                       <td width=100% align=center valign=top>
   	                          <font face=Arial size=2><b><?=$type_name;?></b></font>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=100% align=center valign=top>
   	                         &nbsp;
   	                       </td>
   	                    </tr>
                  	 </TABLE>
                  	 <TABLE WIDTH=90% CELLPADDING=1 CELLSPACING=1 border=0 align="center">                  	   	
   	                    <tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Application Number &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhcap_lisregno name=vhcap_lisregno size=20 maxlength=20 value='<? echo $ap_lisregno; ?>' readonly=readonly style="background:#FF0">
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Collateral ID &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_id name=vhccol_id size=20 maxlength=20 value=<? echo $col_id; ?> readonly=readonly style="background:#FF0">
   	                       </td>
   	                    </tr>
   	                    <!--<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Alamat &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_addr1 name=vhccol_addr1 size=50 maxlength=50 value='<? echo $vhccol_addr1; ?>' nai="ALAMAT KENDARAAN " style="background:#FF0">
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2> &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_addr2 name=vhccol_addr2 size=50 maxlength=50 value='<? echo $vhccol_addr2; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>&nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_addr3 name=vhccol_addr3 size=50 maxlength=50 value='<? echo $vhccol_addr3; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Kodepos &nbsp</font>
							</td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_kodepos name=vhccol_kodepos size=20 maxlength=5 value='<? echo $vhccol_kodepos; ?>' nai="KODE POS KENDARAAN " style="background:#FF0" onKeyPress="return isNumberKey(event)">
   	                        </td>
   	                    </tr>-->
						
						<input type="hidden" naizip="naizip" id="in_zipcodevehicle" name="Kode Pos Vehicle " value="vhccol_kodepos|vhccol_kelurahan|tarkecamatan"/>

   	                    <tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Nomor Polisi &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_nopol name=vhccol_nopol size=20 maxlength=10 value='<? echo $vhccol_nopol; ?>' nai="NOMOR POLISI KENDARAAN " style="background:#FF0">
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Nomor STNK &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_stnk_no name=vhccol_stnk_no size=20 maxlength=30 value='<? echo $vhccol_stnk_no; ?>' nai="NOMOR STNK KENDARAAN " style="background:#FF0">
   	                       </td>
   	                    </tr>
   	                    <!--<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>STNK Exp &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_stnkexp name=vhccol_stnkexp size=20 maxlength=10 value='<? echo $vhccol_stnkexp; ?>' readonly=readonly nai="TANGGAL JATUH TEMPO STNK KENDARAAN " style="background:#FF0">
		   		    							  <a href="javascript:NewCssCal('vhccol_stnkexp','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue></font>
   	                       </td>
   	                    </tr>-->
   	                    <tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Nomor Faktur &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_fakturno name=vhccol_fakturno size=20 maxlength=30 value='<? echo $vhccol_fakturno; ?>' nai="NOMOR FAKTUR KENDARAAN ">
   	                       </td>
   	                    </tr>
   	                    <!--<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Faktur Tgl &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_fakturtgl name=vhccol_fakturtgl size=20 maxlength=10 value='<? echo $vhccol_fakturtgl; ?>' readonly=readonly nai="TANGGAL FAKTUR KENDARAAN " style="background:#FF0">
		   		    							  <a href="javascript:NewCssCal('vhccol_fakturtgl','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue></font>
   	                       </td>
   	                    </tr>-->
   	                    <tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Nomor BPKB &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_bpkbno name=vhccol_bpkbno size=20 maxlength=30 value='<? echo $vhccol_bpkbno; ?>' nai="NOMOR BPKB KENDARAAN " style="background:#FF0" onBlur="fujievhcbpkbno()">  <span  id="reinavhcbpkbno"></span>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>BPKB Tgl &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_bpkbtgl name=vhccol_bpkbtgl size=20 maxlength=10 value='<? echo $vhccol_bpkbtgl; ?>' readonly=readonly nai="TANGGAL BPKB KENDARAAN " style="background:#FF0">
		   		    							  <a href="javascript:NewCssCal('vhccol_bpkbtgl','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue></font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Type &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_type name=vhccol_type size=20 maxlength=10 value='<? echo $vhccol_type; ?>' nai="TIPE KENDARAAN " style="background:#FF0">
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Model &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_model name=vhccol_model size=20 maxlength=10 value='<? echo $vhccol_model; ?>' nai="MODEL KENDARAAN " style="background:#FF0">
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Merk &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_merk name=vhccol_merk size=20 maxlength=10 value='<? echo $vhccol_merk; ?>' nai="MERK KENDARAAN " style="background:#FF0">
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Jenis Kendaraan &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_jeniskendaran name=vhccol_jeniskendaran size=20 maxlength=10 value='<? echo $vhccol_jeniskendaran; ?>' nai="JENIS KENDARAAN " style="background:#FF0">
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Tahun Pembuatan &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_tahunpembuatan name=vhccol_tahunpembuatan size=20 maxlength=4 value='<? echo $vhccol_tahunpembuatan; ?>' nai="TAHUN PEMBUATAN KENDARAAN " style="background:#FF0" onKeyPress="return isNumberKey(event)">
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Umur Kendaraan &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_condition name=vhccol_condition size=4 maxlength=4 value='<? echo $vhccol_condition; ?>' nai="UMUR KENDARAAN KENDARAAN " style="background:#FF0" onKeyPress="return isNumberKey(event)" readonly onFocus="getUmurKendaraan()">
   	                          tahun
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Silinder &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_silinder name=vhccol_silinder size=4 maxlength=4 value='<? echo $vhccol_silinder; ?>' nai="SILINDER KENDARAAN " style="background:#FF0" onKeyPress="return isNumberKey(event)"> cc
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Warna &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_warna name=vhccol_warna size=50 maxlength=50 value='<? echo $vhccol_warna; ?>' nai="WARNA KENDARAAN " style="background:#FF0">
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Nomor Rangka &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_norangka name=vhccol_norangka size=20 maxlength=30 value='<? echo $vhccol_norangka; ?>' nai="NOMOR RANGKA KENDARAAN " style="background:#FF0">
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Nomor Mesin &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_nomesin name=vhccol_nomesin size=20 maxlength=30 value='<? echo $vhccol_nomesin; ?>' nai="NOMOR MESIN KENDARAAN " style="background:#FF0" >
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Nilai Pajak &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_MK_CODE name=vhccol_MK_CODE size=20 maxlength=20 value='<? echo $vhccol_MK_CODE; ?>' nai="NILAI PAJAK " onKeyPress="return isNumberKey(event)" style="background:#FF0" >
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>BPKB Nama &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_bpkbnama name=vhccol_bpkbnama size=20 maxlength=30 value='<? echo $vhccol_bpkbnama; ?>' nai="BPKB NAMA KENDARAAN " style="background:#FF0">
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Alamat BPKB &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_bpkbaddr1 name=vhccol_bpkbaddr1 size=50 maxlength=50 value='<? echo $vhccol_bpkbaddr1; ?>' nai="ALAMAT BPKB KENDARAAN " style="background:#FF0">
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2> &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_bpkbaddr2 name=vhccol_bpkbaddr2 size=50 maxlength=50 value='<? echo $vhccol_bpkbaddr2; ?>' >
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2> &nbsp</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_bpkbaddr3 name=vhccol_bpkbaddr3 size=50 maxlength=50 value='<? echo $vhccol_bpkbaddr3; ?>' >
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Deskripsi</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=vhccol_desc name=vhccol_desc size=50 maxlength=50 value='<? echo $vhccol_desc; ?>' nai="DESKRIPSI KENDARAAN " style="background:#FF0">
   	                       </td>
   	                    </tr>
   	                </TABLE>
                  	 <BR>
				
				</TD>
			</TR>
		</TABLE>
     </div>