<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Form Request Tagihan</title>
<style>
 body { font-family: Arial; background:#f5f8ff; padding:20px; }
 .container{ max-width:900px; margin:auto; background:white; padding:20px; border-radius:10px; }
 .blue{ color:#004d80; }
 table{ width:100%; border-collapse:collapse; margin-top:10px; }
 table th,td{ border:1px solid #ccc; padding:8px; }
 .btn{ padding:10px 14px; background:#004d80; color:white; border:none; border-radius:6px; cursor:pointer; }
 canvas{ border:1px solid #004d80; border-radius:6px; }
</style>
</head>
<body>
<div class="container">
<h2 class="blue">Form Request Tagihan</h2>
<form action="save_request.php" method="POST" enctype="multipart/form-data">
<label>Nama Requestor:</label><br>
<input type="text" name="nama" required><br><br>
<label>Departemen:</label><br>
<input type="text" name="departemen" required><br><br>

<h3 class="blue">Detail Barang</h3>
<table id="itemsTable">
<tr>
<th>Nama Barang</th><th>Qty</th><th>Harga</th><th>Total</th><th></th>
</tr>
</table>
<button type="button" class="btn" onclick="addRow()">+ Tambah</button>

<br><br>
<h3 class="blue">Tanda Tangan</h3>
<canvas id="ttd" width="400" height="200"></canvas><br>
<button type="button" class="btn" onclick="clearCanvas()">Clear</button>
<input type="hidden" name="ttd_image" id="ttd_image">
<br><br>
<button class="btn">Simpan</button>
</form>
</div>

<script>
function addRow(){
    let t = document.getElementById('itemsTable');
    let r = t.insertRow(-1);
    r.innerHTML = `
        <td><input name="barang[]" required></td>
        <td><input name="qty[]" type="number" required></td>
        <td><input name="harga[]" type="number" required></td>
        <td><input name="total[]" type="number" required></td>
        <td><button type="button" onclick="this.parentNode.parentNode.remove()">X</button></td>`;
}

// Canvas TTD
const canvas = document.getElementById('ttd');
const ctx = canvas.getContext('2d');
let drawing = false;
canvas.addEventListener('mousedown',()=>drawing=true);
canvas.addEventListener('mouseup',()=>{drawing=false;saveTTD();});
canvas.addEventListener('mousemove',draw);
function draw(e){ if(!drawing) return; ctx.lineWidth=2; ctx.lineCap='round'; ctx.strokeStyle='#004d80'; ctx.lineTo(e.offsetX,e.offsetY); ctx.stroke(); ctx.beginPath(); ctx.moveTo(e.offsetX,e.offsetY);} 
function clearCanvas(){ ctx.clearRect(0,0,canvas.width,canvas.height); saveTTD(); }
function saveTTD(){ document.getElementById('ttd_image').value = canvas.toDataURL(); }
</script>
</body>
</html>