<?
require “./fpdf/fpdf.php”;
$laporan=new FPDF(‘L’,'mm’,'A4');
$laporan->AddPage();
$laporan->SetFont(‘times’,'B’,12);
$laporan->Cell(280,10,’Pembuatan File PDF’,1,1,’R');
$laporan->Output();

?>
