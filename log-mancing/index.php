<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Pancing Pesisir Malam</title>
    <!-- Menambahkan FontAwesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            /* Gradasi laut dalam dan langit malam */
            background-color: #020617;
            background-image: radial-gradient(at 50% 0%, #0c4a6e 0px, transparent 60%), 
                              radial-gradient(at 100% 100%, #020617 0px, transparent 50%);
            color: #e2e8f0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh; margin: 0; padding: 2rem;
        }
        .dashboard-wrapper {
            max-width: 1000px; margin: auto;
        }
        .header-title {
            text-align: center; color: #38bdf8; margin-bottom: 5px;
            font-size: 2.5rem; text-transform: uppercase; letter-spacing: 2px;
            text-shadow: 0 0 15px rgba(56, 189, 248, 0.4);
        }
        p.subtitle { text-align: center; color: #94a3b8; margin-top: 0; margin-bottom: 30px; font-style: italic; }
        
        /* Glassmorphism Container */
        .glass-container {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(14, 165, 233, 0.2);
            border-radius: 16px; padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.8), inset 0 0 20px rgba(14, 165, 233, 0.05);
        }

        /* Dashboard Stats Cards */
        .stats-grid {
            display: flex; gap: 20px; margin-bottom: 25px;
        }
        .stat-card {
            flex: 1; background: linear-gradient(135deg, rgba(14, 165, 233, 0.1) 0%, rgba(2, 6, 23, 0.5) 100%);
            border: 1px solid rgba(14, 165, 233, 0.3); border-radius: 12px;
            padding: 20px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }
        .stat-card i { font-size: 2.5rem; color: #38bdf8; margin-bottom: 10px; }
        .stat-card h3 { margin: 0; font-size: 2rem; color: #f8fafc; }
        .stat-card p { margin: 5px 0 0 0; color: #94a3b8; font-size: 0.9rem; text-transform: uppercase; }

        /* Tombol & Tabel */
        .header-action { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
        a.btn-tambah {
            background: rgba(14, 165, 233, 0.2); border: 1px solid #0ea5e9;
            color: #38bdf8; padding: 12px 20px; text-decoration: none;
            border-radius: 8px; font-weight: bold; transition: 0.3s;
            box-shadow: 0 0 10px rgba(14, 165, 233, 0.2);
        }
        a.btn-tambah:hover { background: #0ea5e9; color: #fff; box-shadow: 0 0 20px rgba(14, 165, 233, 0.6); }
        
        table { width: 100%; border-collapse: collapse; background: rgba(0,0,0,0.2); border-radius: 8px; overflow: hidden; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid rgba(14, 165, 233, 0.1); }
        th { background: rgba(14, 165, 233, 0.15); color: #bae6fd; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px; }
        tr:hover { background: rgba(14, 165, 233, 0.05); }
        
        /* Badge & Text Styles */
        .ikan-target { color: #facc15; font-weight: bold; }
        .badge-umpan { background: rgba(245, 158, 11, 0.2); color: #fbbf24; padding: 4px 8px; border-radius: 4px; font-size: 0.85rem; border: 1px solid rgba(245, 158, 11, 0.3); }
        a.btn-hapus { color: #f87171; text-decoration: none; font-size: 1.1rem; transition: 0.2s; }
        a.btn-hapus:hover { color: #ef4444; text-shadow: 0 0 8px rgba(239, 68, 68, 0.5); }
    </style>
</head>
<body>

    <?php
    // Menghitung statistik untuk Dashboard Cards
    $res_trip = $conn->query("SELECT COUNT(*) as total_trip FROM tb_tangkapan");
    $trip = $res_trip->fetch_assoc()['total_trip'];

    $res_ikan = $conn->query("SELECT SUM(jumlah_ekor) as total_ikan FROM tb_tangkapan");
    $ikan = $res_ikan->fetch_assoc()['total_ikan'];
    if($ikan == null) $ikan = 0;
    ?>

    <div class="dashboard-wrapper">
        <h2 class="header-title"><i class="fa-solid fa-anchor"></i> Pesisir Strike Log</h2>
        <p class="subtitle">Sistem Informasi Pendataan Ekspedisi Mancing Malam</p>
        
        <!-- Kartu Statistik -->
        <div class="stats-grid">
            <div class="stat-card">
                <i class="fa-solid fa-ship"></i>
                <h3><?= $trip ?></h3>
                <p>Total Ekspedisi Mancing</p>
            </div>
            <div class="stat-card">
                <i class="fa-solid fa-fish-fins"></i>
                <h3><?= $ikan ?></h3>
                <p>Total Ekor Pendaratan</p>
            </div>
        </div>

        <div class="glass-container">
            <div class="header-action">
                <h3 style="margin:0; color:#fff;"><i class="fa-solid fa-book-journal-whills"></i> Riwayat Tangkapan</h3>
                <a href="tambah.php" class="btn-tambah"><i class="fa-solid fa-plus"></i> Catat Hasil Strike</a>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th><i class="fa-regular fa-calendar"></i> Tanggal</th>
                        <th><i class="fa-solid fa-map-location-dot"></i> Spot Lokasi</th>
                        <th><i class="fa-solid fa-cloud-moon-rain"></i> Cuaca</th>
                        <th><i class="fa-solid fa-bug"></i> Umpan</th>
                        <th><i class="fa-solid fa-fish"></i> Target Tangkapan</th>
                        <th><i class="fa-solid fa-scale-unbalanced"></i> Qty</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT tb_tangkapan.*, tb_lokasi.nama_pantai, tb_lokasi.karakteristik_air 
                            FROM tb_tangkapan 
                            JOIN tb_lokasi ON tb_tangkapan.id_lokasi = tb_lokasi.id_lokasi 
                            ORDER BY tb_tangkapan.tanggal DESC";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            // PERBAIKAN: Menggunakan kutip tunggal untuk class icon agar tidak error
                            echo "<tr>
                                <td>".date('d M Y', strtotime($row['tanggal']))."</td>
                                <td><strong>".$row['nama_pantai']."</strong> <br><small style='color:#94a3b8'>".$row['karakteristik_air']."</small></td>
                                <td>".$row['kondisi_cuaca']."</td>
                                <td><span class='badge-umpan'>".$row['jenis_umpan']."</span></td>
                                <td class='ikan-target'>".$row['ikan_target']."</td>
                                <td><strong>".$row['jumlah_ekor']."</strong> ekor</td>
                                <td style='text-align:center;'>
                                    <a href='hapus.php?id=".$row['id_tangkapan']."' class='btn-hapus' onclick='return confirm(\"Hapus log strike ini?\")' title='Hapus Data'>
                                        <i class='fa-solid fa-trash'></i>
                                    </a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' style='text-align:center; padding: 30px; color: #94a3b8;'>
                            <i class='fa-solid fa-fish' style='font-size: 3rem; opacity: 0.3; margin-bottom:10px; display:block;'></i>
                            Belum ada log tangkapan. Waktunya siapkan joran!
                        </td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>