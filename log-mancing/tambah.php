<?php 
include 'koneksi.php'; 

if(isset($_POST['simpan'])) {
    $id_lokasi = $_POST['id_lokasi'];
    $tanggal = $_POST['tanggal'];
    $cuaca = $_POST['kondisi_cuaca'];
    $umpan = $_POST['jenis_umpan'];
    $target = $_POST['ikan_target'];
    $jumlah = $_POST['jumlah_ekor'];

    $sql = "INSERT INTO tb_tangkapan (id_lokasi, tanggal, kondisi_cuaca, jenis_umpan, ikan_target, jumlah_ekor) 
            VALUES ('$id_lokasi', '$tanggal', '$cuaca', '$umpan', '$target', '$jumlah')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Log Pancing</title>
    <style>
        body {
            background-color: #020617;
            background-image: radial-gradient(at 0% 100%, #0f172a 0px, transparent 50%), radial-gradient(at 100% 0%, #1e3a8a 0px, transparent 50%);
            color: #e2e8f0; font-family: 'Segoe UI', sans-serif;
            min-height: 100vh; display: flex; align-items: center; justify-content: center; margin: 0;
        }
        .glass-container {
            background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px; padding: 2.5rem; box-shadow: 0 4px 30px rgba(0, 0, 0, 0.8); width: 400px;
        }
        h3 { margin-top: 0; text-align: center; color: #38bdf8; }
        label { display: block; margin: 12px 0 5px; font-size: 0.9rem; color: #cbd5e1; }
        input, select {
            width: 100%; padding: 10px; border-radius: 8px;
            background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.2);
            color: white; box-sizing: border-box; outline: none;
        }
        input:focus, select:focus { border-color: #38bdf8; }
        option { background: #0f172a; }
        button {
            width: 100%; padding: 12px; margin-top: 25px; border-radius: 8px;
            background: rgba(56, 189, 248, 0.3); border: 1px solid rgba(56, 189, 248, 0.5);
            color: white; font-weight: bold; cursor: pointer; transition: 0.3s;
        }
        button:hover { background: rgba(56, 189, 248, 0.6); }
        a { color: #94a3b8; display: block; text-align: center; margin-top: 15px; text-decoration: none; }
    </style>
</head>
<body>
    <div class="glass-container">
        <h3>Catat Hasil Ekspedisi</h3>
        <form method="POST" action="">
            <label>Tanggal Mancing</label>
            <input type="date" name="tanggal" required>

            <label>Lokasi Spot</label>
            <select name="id_lokasi" required>
                <?php
                $lokasi = $conn->query("SELECT * FROM tb_lokasi");
                while($l = $lokasi->fetch_assoc()) {
                    echo "<option value='".$l['id_lokasi']."'>".$l['nama_pantai']."</option>";
                }
                ?>
            </select>

            <label>Kondisi Cuaca</label>
            <input type="text" name="kondisi_cuaca" placeholder="Misal: Cerah sehabis hujan" required>

            <label>Jenis Umpan</label>
            <input type="text" name="jenis_umpan" placeholder="Misal: Laron, Cacing Laut" required>

            <label>Ikan Target / Dominan</label>
            <input type="text" name="ikan_target" placeholder="Misal: Ikan Wader Laut" required>

            <label>Jumlah Tangkapan (Ekor)</label>
            <input type="number" name="jumlah_ekor" required min="0">

            <button type="submit" name="simpan">Simpan Log</button>
            <a href="index.php">Kembali ke Dashboard</a>
        </form>
    </div>
</body>
</html>

