<?php
?>

<table width="100%" border="1" cellpadding="5" cellspacing="0">
<tr>
	<td width="250px" rowspan="5"><?=$deskripsi;?></td>
	<td width="250px">Harga 1</td>
	<td width="250px"><?=number_format($harga1);?></td>
</tr>

<tr>
	<td>Harga 2</td>
	<td><?=number_format($harga2);?></td>
</tr>

<tr>
	<td>Tanggal Kunjungan</td>
	<td><?=$tglkunjungan;?></td>
</tr>

<tr>
	<td>Officer</td>
	<td><?=$officer;?></td>
</tr>

<tr>
	<td>Keterangan</td>
	<td><?=$keterangan;?></td>
</tr>

</table>