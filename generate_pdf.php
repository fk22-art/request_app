<?php
require('fpdf/fpdf.php');
$conn = new mysqli("localhost","root","","requestdb");
$id = $_GET['id'];
$h = $conn->query("SELECT * FROM requests WHERE id=$id")->fetch_assoc();
$d = $conn->query("SELECT * FROM request_items WHERE request_id=$id");

$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->SetTextColor(0,64,128);
$pdf->Cell(0,10,'Laporan Request Tagihan',0,1,'C');
$pdf->Ln(5);

$pdf->SetFont('Arial','',12);
$pdf->Cell(0,8,'Nama: '.$h['nama'],0,1);
$pdf->Cell(0,8,'Departemen: '.$h['departemen'],0,1);
$pdf->Cell(0,8,'Tanggal: '.$h['tanggal'],0,1);
$pdf->Ln(5);

$pdf->SetFillColor(0,64,128);
$pdf->SetTextColor(255);
$pdf->Cell(90,10,'Barang',1,0,'C',true);
$pdf->Cell(30,10,'Qty',1,0,'C',true);
$pdf->Cell(40,10,'Harga',1,0,'C',true);
$pdf->Cell(40,10,'Total',1,1,'C',true);

$pdf->SetTextColor(0);
while($r=$d->fetch_assoc()){
    $pdf->Cell(90,10,$r['barang'],1);
    $pdf->Cell(30,10,$r['qty'],1);
    $pdf->Cell(40,10,$r['harga'],1);
    $pdf->Cell(40,10,$r['total'],1,1);
}

$pdf->Ln(10);
$pdf->Cell(40,8,'Tanda Tangan:',0,1);

$img = $h['tanda_tangan'];
$img = str_replace('data:image/png;base64,','',$img);
$img = base64_decode($img);
file_put_contents('ttd_tmp.png',$img);
$pdf->Image('ttd_tmp.png',10,140,40,20);

$pdf->Output();
?>