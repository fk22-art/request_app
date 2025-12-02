<?php
$conn = new mysqli("localhost","root","","requestdb");
$id = $_GET['id'];
$h = $conn->query("SELECT * FROM requests WHERE id=$id")->fetch_assoc();
$d = $conn->query("SELECT * FROM request_items WHERE request_id=$id");
?>
<!DOCTYPE html>
<html>
<head>
<title>Report</title>
<style>
 body{ font-family:Arial; background:#e8f1ff; padding:20px; }
 .wrap{ background:white; padding:20px; width:1000px; margin:auto; }
 h2{ color:#003f66; }
 table{ width:100%; border-collapse:collapse; margin-top:10px; }
 th,td{ border:1px solid #003f66; padding:8px; }
 .ttd-img{ width:200px; border:1px solid #003f66; }
</style>
</head>
<body>
<div class="wrap">
<h2>Laporan Request Tagihan</h2>
<b>Nama:</b> <?= $h['nama'] ?><br>
<b>Departemen:</b> <?= $h['departemen'] ?><br>
<b>Tanggal:</b> <?= $h['tanggal'] ?><br>

<table>
<tr><th>Barang</th><th>Qty</th><th>Harga</th><th>Total</th></tr>
<?php while($r=$d->fetch_assoc()): ?>
<tr>
<td><?= $r['barang'] ?></td>
<td><?= $r['qty'] ?></td>
<td><?= $r['harga'] ?></td>
<td><?= $r['total'] ?></td>
</tr>
<?php endwhile; ?>
</table>

<br>
<h3>Tanda Tangan</h3>
<img class="ttd-img" src="<?= $h['tanda_tangan'] ?>">

<br><br>
<a href="generate_pdf.php?id=<?= $id ?>">Download PDF</a>
</div>
</body>
</html>
