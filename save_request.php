<?php
$conn = new mysqli("localhost","root","","requestdb");

$nama = $_POST['nama'];
$dep = $_POST['departemen'];
$ttd = $_POST['ttd_image'];
$date_now = date("Y-m-d H:i:s");

$conn->query("INSERT INTO requests(nama,departemen,tanda_tangan,tanggal) VALUES('$nama','$dep','$ttd','$date_now')");
$id = $conn->insert_id;

foreach($_POST['barang'] as $i=>$b){
    $q = $_POST['qty'][$i];
    $h = $_POST['harga'][$i];
    $t = $_POST['total'][$i];
    $conn->query("INSERT INTO request_items(request_id,barang,qty,harga,total) VALUES($id,'$b',$q,$h,$t)");
}

echo "<script>window.location='report.php?id=$id'</script>";
?>