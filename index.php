<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK — Prioritas Konseling Siswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* ===================== RESET & VARIABLES ===================== */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #0d1117;
            --bg2:       #161b22;
            --bg3:       #21262d;
            --border:    #30363d;
            --accent:    #3fb950;
            --accent2:   #58a6ff;
            --accent3:   #f78166;
            --warn:      #d29922;
            --text:      #e6edf3;
            --text2:     #8b949e;
            --text3:     #484f58;
            --radius:    12px;
            --shadow:    0 8px 32px rgba(0,0,0,.4);
        }

        html { scroll-behavior: smooth; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px;
            min-height: 100vh;
        }

        /* ===================== HEADER ===================== */
        .header {
            background: linear-gradient(135deg, #0d1117 0%, #161b22 100%);
            border-bottom: 1px solid var(--border);
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(12px);
        }
        .header-inner {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .logo-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
        }
        .logo-text { font-weight: 800; font-size: 16px; }
        .logo-sub  { font-size: 11px; color: var(--text2); font-weight: 400; }
        .badge {
            background: rgba(63,185,80,.15);
            border: 1px solid rgba(63,185,80,.3);
            color: var(--accent);
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            font-family: 'Space Mono', monospace;
        }

        /* ===================== MAIN LAYOUT ===================== */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 32px;
        }

        /* ===================== HERO SECTION ===================== */
        .hero {
            background: linear-gradient(135deg, #161b22 0%, #0d2137 100%);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 40px;
            margin-bottom: 32px;
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 200px; height: 200px;
            background: radial-gradient(circle, rgba(63,185,80,.15) 0%, transparent 70%);
            border-radius: 50%;
        }
        .hero-title {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 8px;
            background: linear-gradient(90deg, #e6edf3, #58a6ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero-sub { color: var(--text2); font-size: 14px; line-height: 1.6; max-width: 600px; }
        .hero-meta {
            display: flex;
            gap: 24px;
            margin-top: 20px;
            flex-wrap: wrap;
        }
        .hero-meta-item { display: flex; align-items: center; gap: 8px; color: var(--text2); font-size: 13px; }
        .hero-meta-item span { color: var(--accent); font-family: 'Space Mono', monospace; font-size: 12px; }

        /* ===================== STATS CARDS ===================== */
        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 32px;
        }
        .stat-card {
            background: var(--bg2);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            transition: border-color .2s, transform .2s;
        }
        .stat-card:hover { border-color: var(--accent2); transform: translateY(-2px); }
        .stat-num {
            font-size: 32px;
            font-weight: 800;
            font-family: 'Space Mono', monospace;
            line-height: 1;
            margin-bottom: 4px;
        }
        .stat-label { color: var(--text2); font-size: 12px; text-transform: uppercase; letter-spacing: 1px; }
        .c-green { color: var(--accent); }
        .c-blue  { color: var(--accent2); }
        .c-red   { color: var(--accent3); }
        .c-warn  { color: var(--warn); }

        /* ===================== TABS ===================== */
        .tabs {
            display: flex;
            gap: 4px;
            background: var(--bg2);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 6px;
            margin-bottom: 24px;
            width: fit-content;
        }
        .tab-btn {
            padding: 8px 20px;
            border-radius: 8px;
            border: none;
            background: transparent;
            color: var(--text2);
            cursor: pointer;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            transition: all .2s;
        }
        .tab-btn.active {
            background: var(--accent);
            color: #0d1117;
        }
        .tab-btn:hover:not(.active) { background: var(--bg3); color: var(--text); }

        /* ===================== PANEL ===================== */
        .panel {
            background: var(--bg2);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
        }
        .panel-head {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }
        .panel-title { font-weight: 700; font-size: 15px; }
        .panel-body { padding: 24px; }

        /* ===================== BUTTONS ===================== */
        .btn {
            padding: 9px 18px;
            border-radius: 8px;
            border: none;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-primary { background: var(--accent); color: #0d1117; }
        .btn-primary:hover { background: #4cca5e; transform: translateY(-1px); }
        .btn-blue { background: var(--accent2); color: #0d1117; }
        .btn-blue:hover { background: #79b8ff; }
        .btn-danger { background: rgba(247,129,102,.15); color: var(--accent3); border: 1px solid rgba(247,129,102,.3); }
        .btn-danger:hover { background: rgba(247,129,102,.25); }
        .btn-ghost { background: var(--bg3); color: var(--text2); border: 1px solid var(--border); }
        .btn-ghost:hover { color: var(--text); border-color: var(--text2); }
        .btn:disabled { opacity: .5; cursor: not-allowed; transform: none !important; }

        /* ===================== TABLE ===================== */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 13px; }
        th {
            background: var(--bg3);
            color: var(--text2);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
            font-size: 11px;
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            white-space: nowrap;
        }
        td {
            padding: 12px 16px;
            border-bottom: 1px solid rgba(48,54,61,.5);
            vertical-align: middle;
        }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(255,255,255,.02); }
        .mono { font-family: 'Space Mono', monospace; font-size: 12px; }

        /* ===================== RANK BADGE ===================== */
        .rank-badge {
            width: 28px; height: 28px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 12px;
            font-family: 'Space Mono', monospace;
        }
        .rank-1 { background: linear-gradient(135deg,#ffd700,#ff8c00); color: #000; }
        .rank-2 { background: linear-gradient(135deg,#c0c0c0,#909090); color: #000; }
        .rank-3 { background: linear-gradient(135deg,#cd7f32,#8b4513); color: #fff; }
        .rank-n { background: var(--bg3); color: var(--text2); }

        /* ===================== PRIORITY BADGE ===================== */
        .prio {
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .5px;
        }
        .prio-tinggi { background: rgba(247,129,102,.15); color: var(--accent3); border: 1px solid rgba(247,129,102,.3); }
        .prio-sedang { background: rgba(210,153,34,.15);  color: var(--warn);    border: 1px solid rgba(210,153,34,.3);  }
        .prio-rendah { background: rgba(63,185,80,.12);   color: var(--accent);  border: 1px solid rgba(63,185,80,.25); }

        /* ===================== FORM ===================== */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .form-group { display: flex; flex-direction: column; gap: 6px; }
        .form-group.full { grid-column: 1 / -1; }
        label { font-size: 12px; font-weight: 600; color: var(--text2); text-transform: uppercase; letter-spacing: .5px; }
        input, select {
            background: var(--bg3);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text);
            padding: 10px 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px;
            transition: border-color .2s;
            width: 100%;
        }
        input:focus, select:focus { outline: none; border-color: var(--accent2); }
        .form-hint { font-size: 11px; color: var(--text3); }

        /* ===================== TOAST ===================== */
        .toast-container {
            position: fixed;
            bottom: 24px;
            right: 24px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            z-index: 999;
        }
        .toast {
            background: var(--bg2);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 14px 18px;
            min-width: 260px;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn .3s ease;
            font-size: 13px;
        }
        .toast.ok     { border-left: 3px solid var(--accent); }
        .toast.err    { border-left: 3px solid var(--accent3); }
        .toast.info   { border-left: 3px solid var(--accent2); }
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to   { transform: translateX(0);    opacity: 1; }
        }

        /* ===================== LOADING ===================== */
        .spinner {
            width: 18px; height: 18px;
            border: 2px solid var(--border);
            border-top-color: var(--accent);
            border-radius: 50%;
            animation: spin .7s linear infinite;
            display: inline-block;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        .empty-state {
            text-align: center;
            padding: 60px 24px;
            color: var(--text2);
        }
        .empty-icon { font-size: 48px; margin-bottom: 12px; }

        /* ===================== SKOR BAR ===================== */
        .skor-bar-wrap { display: flex; align-items: center; gap: 10px; min-width: 120px; }
        .skor-bar {
            flex: 1;
            height: 6px;
            background: var(--bg3);
            border-radius: 10px;
            overflow: hidden;
        }
        .skor-bar-fill {
            height: 100%;
            border-radius: 10px;
            background: linear-gradient(90deg, var(--accent2), var(--accent));
            transition: width .8s ease;
        }

        /* ===================== RESPONSIVE ===================== */
        @media (max-width: 900px) {
            .stats { grid-template-columns: repeat(2, 1fr); }
            .container { padding: 16px; }
            .form-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 600px) {
            .stats { grid-template-columns: 1fr 1fr; }
        }
    </style>
</head>
<body>

<?php include 'koneksi.php'; ?>

<!-- ================== HEADER ================== -->
<header class="header">
    <div class="header-inner">
        <div class="logo">
            <div class="logo-icon">🎓</div>
            <div>
                <div class="logo-text">SPK Konseling</div>
                <div class="logo-sub">Sistem Pendukung Keputusan · Metode SAW</div>
            </div>
        </div>
        <div class="badge">SAW · 2026/2027</div>
    </div>
</header>

<!-- ================== MAIN ================== -->
<main class="container">

    <!-- HERO -->
    <div class="hero">
        <div class="hero-title">Analisis Siswa Prioritas Konseling</div>
        <p class="hero-sub">
            Sistem pendukung keputusan menggunakan metode <strong>Simple Additive Weighting (SAW)</strong>
            untuk menentukan siswa yang perlu mendapat layanan konseling berdasarkan data akademik dan pelanggaran.
        </p>
        <div class="hero-meta">
            <div class="hero-meta-item">👤 <span>Yusmita Alya Melanie</span></div>
            <div class="hero-meta-item">🏫 <span>235150601111027</span></div>
            <div class="hero-meta-item">📚 <span>Pendidikan Teknologi Informasi · Universitas Brawijaya</span></div>
        </div>
    </div>

    <!-- STATS -->
    <?php
    $total_siswa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as n FROM siswa"))['n'];
    $tinggi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as n FROM hasil_saw WHERE prioritas='Tinggi'"))['n'];
    $sedang = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as n FROM hasil_saw WHERE prioritas='Sedang'"))['n'];
    $sudah_hitung = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as n FROM hasil_saw"))['n'];
    ?>
    <div class="stats">
        <div class="stat-card">
            <div class="stat-num c-blue"><?= $total_siswa ?></div>
            <div class="stat-label">Total Siswa</div>
        </div>
        <div class="stat-card">
            <div class="stat-num c-red"><?= $tinggi ?></div>
            <div class="stat-label">Prioritas Tinggi</div>
        </div>
        <div class="stat-card">
            <div class="stat-num c-warn"><?= $sedang ?></div>
            <div class="stat-label">Prioritas Sedang</div>
        </div>
        <div class="stat-card">
            <div class="stat-num c-green"><?= $sudah_hitung > 0 ? 'Selesai' : 'Belum' ?></div>
            <div class="stat-label">Status Kalkulasi</div>
        </div>
    </div>

    <!-- TABS -->
    <div class="tabs">
        <button class="tab-btn active" onclick="switchTab('data')">📊 Data Siswa</button>
        <button class="tab-btn" onclick="switchTab('hasil')">🏆 Hasil Ranking SAW</button>
        <button class="tab-btn" onclick="switchTab('tambah')">➕ Tambah Siswa</button>
        <button class="tab-btn" onclick="switchTab('kriteria')">⚖️ Kriteria & Bobot</button>
    </div>

    <!-- ============ TAB: DATA SISWA ============ -->
    <div id="tab-data" class="tab-content">
        <div class="panel">
            <div class="panel-head">
                <div class="panel-title">📊 Data Alternatif Siswa</div>
                <div style="display:flex;gap:8px;">
                    <button class="btn btn-primary" onclick="hitungSAW()">
                        ⚡ Hitung SAW & Ranking
                    </button>
                </div>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th title="Jumlah Nilai Akademik (Benefit)">C1 – Jml Nilai</th>
                            <th title="Rata-rata Akademik (Benefit)">C2 – Rata-rata</th>
                            <th title="Poin Pelanggaran (Cost)">C3 – Pelanggaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q = "SELECT s.id, s.nama, s.kelas,
                                     n.c1_jumlah_nilai, n.c2_rata_rata, n.c3_pelanggaran
                              FROM siswa s
                              JOIN nilai_siswa n ON s.id = n.siswa_id
                              ORDER BY s.id";
                        $res = mysqli_query($conn, $q);
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($res)):
                        ?>
                        <tr>
                            <td class="mono" style="color:var(--text3)"><?= $no++ ?></td>
                            <td><strong><?= htmlspecialchars($row['nama']) ?></strong></td>
                            <td><span style="color:var(--text2)"><?= htmlspecialchars($row['kelas']) ?></span></td>
                            <td class="mono c-blue"><?= number_format($row['c1_jumlah_nilai'],2) ?></td>
                            <td class="mono c-green"><?= number_format($row['c2_rata_rata'],2) ?></td>
                            <td class="mono <?= $row['c3_pelanggaran'] > 100 ? 'c-red' : 'c-warn' ?>">
                                <?= $row['c3_pelanggaran'] ?>
                            </td>
                            <td>
                                <button class="btn btn-danger" onclick="hapusSiswa(<?= $row['id'] ?>, '<?= htmlspecialchars($row['nama'], ENT_QUOTES) ?>')">
                                    🗑
                                </button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ============ TAB: HASIL RANKING ============ -->
    <div id="tab-hasil" class="tab-content" style="display:none;">
        <div class="panel">
            <div class="panel-head">
                <div class="panel-title">🏆 Hasil Ranking SAW — Prioritas Konseling</div>
                <button class="btn btn-primary" onclick="hitungSAW()">⚡ Hitung Ulang SAW</button>
            </div>
            <div id="hasil-container">
                <?php
                $q_hasil = "SELECT h.peringkat, h.r1, h.r2, h.r3, h.skor_akhir, h.prioritas,
                                   s.nama, s.kelas
                            FROM hasil_saw h
                            JOIN siswa s ON h.siswa_id = s.id
                            ORDER BY h.peringkat ASC";
                $res_h = mysqli_query($conn, $q_hasil);
                $rows_h = mysqli_fetch_all($res_h, MYSQLI_ASSOC);
                ?>
                <?php if (empty($rows_h)): ?>
                <div class="empty-state">
                    <div class="empty-icon">📭</div>
                    <div>Belum ada hasil perhitungan.</div>
                    <div style="font-size:12px;margin-top:8px;color:var(--text3)">Klik tombol "Hitung SAW & Ranking" pada tab Data Siswa.</div>
                </div>
                <?php else: renderHasilTable($rows_h); endif; ?>
            </div>
        </div>
    </div>

    <!-- ============ TAB: TAMBAH SISWA ============ -->
    <div id="tab-tambah" class="tab-content" style="display:none;">
        <div class="panel">
            <div class="panel-head">
                <div class="panel-title">➕ Tambah Data Siswa Baru</div>
            </div>
            <div class="panel-body">
                <div class="form-grid">
                    <div class="form-group full">
                        <label>Nama Lengkap Siswa</label>
                        <input type="text" id="f-nama" placeholder="Contoh: Budi Santoso">
                    </div>
                    <div class="form-group">
                        <label>Kelas</label>
                        <input type="text" id="f-kelas" placeholder="Contoh: X-TI" value="X-TI">
                    </div>
                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <input type="text" id="f-tahun" value="2025/2026">
                    </div>
                    <div class="form-group">
                        <label>C1 — Jumlah Nilai Akademik <span style="color:var(--accent);font-size:10px">(BENEFIT)</span></label>
                        <input type="number" id="f-c1" placeholder="Contoh: 1050.5" step="0.01" min="0">
                        <div class="form-hint">Total akumulasi nilai semua mata pelajaran</div>
                    </div>
                    <div class="form-group">
                        <label>C2 — Rata-rata Akademik <span style="color:var(--accent);font-size:10px">(BENEFIT)</span></label>
                        <input type="number" id="f-c2" placeholder="Contoh: 80.75" step="0.01" min="0" max="100">
                        <div class="form-hint">Nilai rata-rata dari semua mata pelajaran</div>
                    </div>
                    <div class="form-group">
                        <label>C3 — Poin Pelanggaran <span style="color:var(--accent3);font-size:10px">(COST)</span></label>
                        <input type="number" id="f-c3" placeholder="Contoh: 45" min="0">
                        <div class="form-hint">Total poin pelanggaran siswa (semakin kecil semakin baik)</div>
                    </div>
                    <div class="form-group full" style="margin-top:8px;">
                        <button class="btn btn-primary" onclick="tambahSiswa()" style="width:fit-content">
                            ✅ Simpan Data Siswa
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ============ TAB: KRITERIA ============ -->
    <div id="tab-kriteria" class="tab-content" style="display:none;">
        <div class="panel">
            <div class="panel-head">
                <div class="panel-title">⚖️ Kriteria & Bobot Penilaian</div>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Kriteria</th>
                            <th>Bobot</th>
                            <th>Tipe</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $res_k = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id");
                        while ($k = mysqli_fetch_assoc($res_k)):
                        ?>
                        <tr>
                            <td><strong class="mono c-blue"><?= $k['kode'] ?></strong></td>
                            <td><?= htmlspecialchars($k['nama']) ?></td>
                            <td>
                                <div class="skor-bar-wrap">
                                    <div class="skor-bar">
                                        <div class="skor-bar-fill" style="width:<?= ($k['bobot']*100) ?>%"></div>
                                    </div>
                                    <span class="mono"><?= $k['bobot'] ?></span>
                                </div>
                            </td>
                            <td>
                                <?php if ($k['tipe'] === 'benefit'): ?>
                                <span class="prio prio-rendah">BENEFIT ↑</span>
                                <?php else: ?>
                                <span class="prio prio-tinggi">COST ↓</span>
                                <?php endif; ?>
                            </td>
                            <td style="color:var(--text2);font-size:12px">
                                <?php if ($k['tipe'] === 'benefit'): ?>
                                Nilai lebih besar = lebih baik → R = Xij / max(Xj)
                                <?php else: ?>
                                Nilai lebih kecil = lebih baik → R = min(Xj) / Xij
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div class="panel-body" style="border-top:1px solid var(--border)">
                <div style="background:var(--bg3);border-radius:10px;padding:20px;font-family:'Space Mono',monospace;font-size:12px;line-height:1.8;">
                    <div style="color:var(--text2);margin-bottom:8px;">// Rumus SAW</div>
                    <div style="color:var(--accent)">V<sub>i</sub> = Σ (W<sub>j</sub> × R<sub>ij</sub>)</div>
                    <br>
                    <div style="color:var(--text2)">// Dimana:</div>
                    <div>V = (0.4 × R1) + (0.4 × R2) + (0.2 × R3)</div>
                    <br>
                    <div style="color:var(--text2)">// Prioritas berdasarkan V:</div>
                    <div><span style="color:var(--accent3)">TINGGI</span>  → V ≥ 0.85</div>
                    <div><span style="color:var(--warn)">SEDANG</span>  → 0.75 ≤ V < 0.85</div>
                    <div><span style="color:var(--accent)">RENDAH</span>  → V < 0.75</div>
                </div>
            </div>
        </div>
    </div>

</main>

<!-- TOAST CONTAINER -->
<div class="toast-container" id="toastContainer"></div>

<?php
function renderHasilTable($rows) {
    echo '<div class="table-wrap"><table>';
    echo '<thead><tr>
        <th>Rank</th>
        <th>Nama Siswa</th>
        <th>R1 (C1)</th>
        <th>R2 (C2)</th>
        <th>R3 (C3)</th>
        <th>Skor SAW</th>
        <th>Prioritas</th>
    </tr></thead><tbody>';
    foreach ($rows as $r) {
        $rank = $r['peringkat'];
        $rankClass = $rank == 1 ? 'rank-1' : ($rank == 2 ? 'rank-2' : ($rank == 3 ? 'rank-3' : 'rank-n'));
        $prioClass = $r['prioritas'] == 'Tinggi' ? 'prio-tinggi' : ($r['prioritas'] == 'Sedang' ? 'prio-sedang' : 'prio-rendah');
        $pct = round($r['skor_akhir'] * 100);
        echo "<tr>
            <td><span class='rank-badge $rankClass'>$rank</span></td>
            <td><strong>" . htmlspecialchars($r['nama']) . "</strong></td>
            <td class='mono'>" . number_format($r['r1'],4) . "</td>
            <td class='mono'>" . number_format($r['r2'],4) . "</td>
            <td class='mono'>" . number_format($r['r3'],4) . "</td>
            <td>
                <div class='skor-bar-wrap'>
                    <div class='skor-bar'><div class='skor-bar-fill' style='width:{$pct}%'></div></div>
                    <span class='mono'>" . number_format($r['skor_akhir'],4) . "</span>
                </div>
            </td>
            <td><span class='prio $prioClass'>{$r['prioritas']}</span></td>
        </tr>";
    }
    echo '</tbody></table></div>';
}
?>

<script>
// ===================== TABS =====================
function switchTab(name) {
    document.querySelectorAll('.tab-content').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
    document.getElementById('tab-' + name).style.display = 'block';
    event.target.classList.add('active');
}

// ===================== TOAST =====================
function showToast(msg, type = 'ok') {
    const container = document.getElementById('toastContainer');
    const icons = { ok: '✅', err: '❌', info: 'ℹ️' };
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.innerHTML = `<span style="font-size:18px">${icons[type]}</span> <span>${msg}</span>`;
    container.appendChild(toast);
    setTimeout(() => toast.remove(), 4000);
}

// ===================== HITUNG SAW =====================
async function hitungSAW() {
    showToast('Menghitung SAW...', 'info');

    const btn = event.target;
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner"></span> Menghitung...';

    try {
        const res  = await fetch('hitung_saw.php');
        const data = await res.json();

        btn.disabled = false;
        btn.innerHTML = '⚡ Hitung SAW & Ranking';

        if (data.status !== 'ok') {
            showToast('Error: ' + data.message, 'err');
            return;
        }

        // Render hasil ke tab hasil
        renderHasil(data.data);
        showToast(`✔ Berhasil! ${data.total_data} siswa dirangking.`, 'ok');

        // Update stats
        let tinggi = 0, sedang = 0;
        data.data.forEach(d => {
            if (d.prioritas === 'Tinggi') tinggi++;
            if (d.prioritas === 'Sedang') sedang++;
        });
        document.querySelector('.stats').children[1].querySelector('.stat-num').textContent = tinggi;
        document.querySelector('.stats').children[2].querySelector('.stat-num').textContent = sedang;
        document.querySelector('.stats').children[3].querySelector('.stat-num').textContent = 'Selesai';

        // Pindah ke tab hasil
        setTimeout(() => {
            document.querySelector('.tab-btn:nth-child(2)').click();
        }, 600);

    } catch(e) {
        btn.disabled = false;
        btn.innerHTML = '⚡ Hitung SAW & Ranking';
        showToast('Gagal koneksi ke server PHP.', 'err');
    }
}

function renderHasil(data) {
    const container = document.getElementById('hasil-container');
    const rankClass = r => r == 1 ? 'rank-1' : r == 2 ? 'rank-2' : r == 3 ? 'rank-3' : 'rank-n';
    const prioClass = p => p === 'Tinggi' ? 'prio-tinggi' : p === 'Sedang' ? 'prio-sedang' : 'prio-rendah';

    let html = `<div class="table-wrap"><table>
        <thead><tr>
            <th>Rank</th>
            <th>Nama Siswa</th>
            <th>R1 (C1)</th>
            <th>R2 (C2)</th>
            <th>R3 (C3)</th>
            <th>Skor SAW</th>
            <th>Prioritas</th>
        </tr></thead><tbody>`;

    data.forEach(d => {
        const pct = Math.round(d.skor_akhir * 100);
        html += `<tr>
            <td><span class="rank-badge ${rankClass(d.peringkat)}">${d.peringkat}</span></td>
            <td><strong>${d.nama}</strong></td>
            <td class="mono">${d.r1.toFixed(4)}</td>
            <td class="mono">${d.r2.toFixed(4)}</td>
            <td class="mono">${d.r3.toFixed(4)}</td>
            <td>
                <div class="skor-bar-wrap">
                    <div class="skor-bar"><div class="skor-bar-fill" style="width:${pct}%"></div></div>
                    <span class="mono">${d.skor_akhir.toFixed(4)}</span>
                </div>
            </td>
            <td><span class="prio ${prioClass(d.prioritas)}">${d.prioritas}</span></td>
        </tr>`;
    });

    html += '</tbody></table></div>';
    container.innerHTML = html;
}

// ===================== TAMBAH SISWA =====================
async function tambahSiswa() {
    const nama  = document.getElementById('f-nama').value.trim();
    const kelas = document.getElementById('f-kelas').value.trim();
    const tahun = document.getElementById('f-tahun').value.trim();
    const c1    = document.getElementById('f-c1').value;
    const c2    = document.getElementById('f-c2').value;
    const c3    = document.getElementById('f-c3').value;

    if (!nama || !c1 || !c2 || !c3) {
        showToast('Harap isi semua field!', 'err');
        return;
    }

    const fd = new FormData();
    fd.append('nama', nama);
    fd.append('kelas', kelas);
    fd.append('tahun_ajaran', tahun);
    fd.append('c1_jumlah_nilai', c1);
    fd.append('c2_rata_rata', c2);
    fd.append('c3_pelanggaran', c3);

    try {
        const res  = await fetch('tambah_siswa.php', { method: 'POST', body: fd });
        const data = await res.json();

        if (data.status === 'ok') {
            showToast(data.message, 'ok');
            // Reset form
            ['f-nama','f-c1','f-c2','f-c3'].forEach(id => document.getElementById(id).value = '');
            // Reload halaman setelah 1.5 detik
            setTimeout(() => location.reload(), 1500);
        } else {
            showToast(data.message, 'err');
        }
    } catch(e) {
        showToast('Gagal koneksi ke server.', 'err');
    }
}

// ===================== HAPUS SISWA =====================
async function hapusSiswa(id, nama) {
    if (!confirm(`Hapus data siswa "${nama}"?`)) return;

    const fd = new FormData();
    fd.append('id', id);

    try {
        const res  = await fetch('hapus_siswa.php', { method: 'POST', body: fd });
        const data = await res.json();
        if (data.status === 'ok') {
            showToast(data.message, 'ok');
            setTimeout(() => location.reload(), 1000);
        } else {
            showToast(data.message, 'err');
        }
    } catch(e) {
        showToast('Gagal menghapus.', 'err');
    }
}
</script>
</body>
</html>
