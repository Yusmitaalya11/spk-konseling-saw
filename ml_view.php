<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ML Prediksi — SPK Konseling</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #0d1117; --bg2: #161b22; --bg3: #21262d;
            --border: #30363d; --accent: #3fb950; --accent2: #58a6ff;
            --accent3: #f78166; --warn: #d29922;
            --text: #e6edf3; --text2: #8b949e; --radius: 12px;
        }
        body { background: var(--bg); color: var(--text); font-family: 'Plus Jakarta Sans', sans-serif; font-size: 14px; min-height: 100vh; }

        .header { background: linear-gradient(135deg,#0d1117,#161b22); border-bottom: 1px solid var(--border); padding: 0 32px; }
        .header-inner { max-width: 1100px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; height: 64px; }
        .logo-text { font-weight: 800; font-size: 16px; }
        .logo-sub  { font-size: 11px; color: var(--text2); }
        .back-btn  { background: var(--bg3); border: 1px solid var(--border); color: var(--text2); padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 600; }
        .back-btn:hover { color: var(--text); }

        .container { max-width: 1100px; margin: 0 auto; padding: 32px; }

        .hero { background: linear-gradient(135deg,#161b22,#0d2137); border: 1px solid var(--border); border-radius: var(--radius); padding: 36px; margin-bottom: 28px; }
        .hero-title { font-size: 24px; font-weight: 800; margin-bottom: 6px; background: linear-gradient(90deg,#e6edf3,#3fb950); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .hero-sub { color: var(--text2); font-size: 13px; line-height: 1.7; max-width: 700px; }

        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px; }

        .panel { background: var(--bg2); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; }
        .panel-head { padding: 18px 24px; border-bottom: 1px solid var(--border); }
        .panel-title { font-weight: 700; font-size: 15px; }
        .panel-body { padding: 24px; }

        /* FORM */
        .form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 16px; }
        label { font-size: 11px; font-weight: 600; color: var(--text2); text-transform: uppercase; letter-spacing: .5px; }
        input { background: var(--bg3); border: 1px solid var(--border); border-radius: 8px; color: var(--text); padding: 10px 14px; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 14px; width: 100%; transition: border-color .2s; }
        input:focus { outline: none; border-color: var(--accent2); }
        .hint { font-size: 11px; color: var(--text2); margin-top: 2px; }

        /* BTN */
        .btn { padding: 12px 24px; border-radius: 8px; border: none; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 14px; font-weight: 700; cursor: pointer; transition: all .2s; width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .btn-green  { background: var(--accent); color: #0d1117; }
        .btn-green:hover { background: #4cca5e; }
        .btn:disabled { opacity: .5; cursor: not-allowed; }

        /* RESULT */
        .result-box { border-radius: 12px; padding: 24px; text-align: center; transition: all .3s; }
        .result-box.prioritas { background: rgba(247,129,102,.08); border: 2px solid rgba(247,129,102,.4); }
        .result-box.tidak     { background: rgba(63,185,80,.08);  border: 2px solid rgba(63,185,80,.3);  }
        .result-box.empty     { background: var(--bg3); border: 2px dashed var(--border); }
        .result-icon  { font-size: 48px; margin-bottom: 12px; }
        .result-label { font-size: 22px; font-weight: 800; margin-bottom: 8px; }
        .result-conf  { font-family: 'Space Mono', monospace; font-size: 13px; color: var(--text2); margin-bottom: 12px; }
        .result-ket   { font-size: 13px; line-height: 1.6; color: var(--text2); }
        .result-saran { margin-top: 12px; padding: 10px 14px; border-radius: 8px; font-size: 12px; font-weight: 600; }
        .saran-red  { background: rgba(247,129,102,.12); color: var(--accent3); }
        .saran-green{ background: rgba(63,185,80,.12);   color: var(--accent);  }

        /* PROBABILITY BAR */
        .prob-section { margin-top: 20px; }
        .prob-label { display: flex; justify-content: space-between; font-size: 12px; color: var(--text2); margin-bottom: 4px; }
        .prob-bar { height: 8px; background: var(--bg3); border-radius: 10px; overflow: hidden; margin-bottom: 10px; }
        .prob-fill { height: 100%; border-radius: 10px; transition: width .8s ease; }
        .fill-red   { background: linear-gradient(90deg, #f78166, #ff4444); }
        .fill-green { background: linear-gradient(90deg, #58a6ff, #3fb950); }

        /* FEATURE IMPORTANCE */
        .fi-row { display: flex; align-items: center; gap: 12px; margin-bottom: 12px; }
        .fi-label { font-size: 12px; min-width: 130px; color: var(--text2); }
        .fi-bar   { flex: 1; height: 8px; background: var(--bg3); border-radius: 10px; overflow: hidden; }
        .fi-fill  { height: 100%; background: linear-gradient(90deg, var(--accent2), var(--accent)); border-radius: 10px; transition: width .8s ease; }
        .fi-val   { font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text2); min-width: 50px; text-align: right; }

        /* ALGO INFO */
        .algo-box { background: var(--bg3); border-radius: 10px; padding: 16px; margin-bottom: 12px; }
        .algo-box h4 { font-size: 13px; margin-bottom: 6px; color: var(--accent2); }
        .algo-box p  { font-size: 12px; color: var(--text2); line-height: 1.6; }

        /* STATS */
        .stats-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 12px; margin-bottom: 24px; }
        .stat-card { background: var(--bg2); border: 1px solid var(--border); border-radius: var(--radius); padding: 16px; text-align: center; }
        .stat-num { font-size: 28px; font-weight: 800; font-family: 'Space Mono', monospace; }
        .stat-lbl { font-size: 11px; color: var(--text2); text-transform: uppercase; letter-spacing: 1px; }

        /* SPINNER */
        .spinner { width: 18px; height: 18px; border: 2px solid rgba(0,0,0,.3); border-top-color: #0d1117; border-radius: 50%; animation: spin .7s linear infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }

        @media (max-width: 800px) { .grid { grid-template-columns: 1fr; } .stats-grid { grid-template-columns: 1fr 1fr; } .container { padding: 16px; } }
    </style>
</head>
<body>

<header class="header">
    <div class="header-inner">
        <div>
            <div class="logo-text">🤖 ML Prediksi Konseling</div>
            <div class="logo-sub">Random Forest Classifier · Pertemuan 8</div>
        </div>
        <a href="index.php" class="back-btn">← Kembali ke SPK</a>
    </div>
</header>

<main class="container">

    <!-- HERO -->
    <div class="hero">
        <div class="hero-title">Pertemuan 8 — SPK dengan Algoritma Machine Learning</div>
        <p class="hero-sub">
            Halaman ini mengintegrasikan <strong>Random Forest Classifier</strong> (Python/scikit-learn)
            ke dalam aplikasi SPK berbasis web. Model dilatih menggunakan data 36 siswa dengan 3 fitur:
            Jumlah Nilai Akademik, Rata-rata Akademik, dan Poin Pelanggaran. Akurasi model: <strong>87.5%</strong>.
        </p>
    </div>

    <!-- STATS -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-num" style="color:var(--accent)">87.5%</div>
            <div class="stat-lbl">Akurasi Model</div>
        </div>
        <div class="stat-card">
            <div class="stat-num" style="color:var(--accent2)">100</div>
            <div class="stat-lbl">Decision Trees</div>
        </div>
        <div class="stat-card">
            <div class="stat-num" style="color:var(--warn)">36</div>
            <div class="stat-lbl">Data Training</div>
        </div>
    </div>

    <!-- FORM + RESULT -->
    <div class="grid">

        <!-- FORM INPUT -->
        <div class="panel">
            <div class="panel-head">
                <div class="panel-title">📝 Input Data Siswa</div>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Nama Siswa</label>
                    <input type="text" id="f-nama" placeholder="Contoh: Budi Santoso" value="Siswa Baru">
                </div>
                <div class="form-group">
                    <label>C1 — Jumlah Nilai Akademik</label>
                    <input type="number" id="f-nilai" placeholder="Contoh: 1050" step="0.01" min="0">
                    <div class="hint">Total akumulasi nilai semua mata pelajaran</div>
                </div>
                <div class="form-group">
                    <label>C2 — Nilai Rata-rata Akademik</label>
                    <input type="number" id="f-rata" placeholder="Contoh: 80.5" step="0.01" min="0" max="100">
                    <div class="hint">Rata-rata dari semua mata pelajaran (0–100)</div>
                </div>
                <div class="form-group">
                    <label>C3 — Poin Pelanggaran</label>
                    <input type="number" id="f-pelang" placeholder="Contoh: 45" min="0">
                    <div class="hint">Total poin pelanggaran siswa</div>
                </div>
                <button class="btn btn-green" onclick="prediksi()" id="btn-prediksi">
                    🤖 Prediksi dengan ML
                </button>
            </div>
        </div>

        <!-- HASIL PREDIKSI -->
        <div class="panel">
            <div class="panel-head">
                <div class="panel-title">📊 Hasil Prediksi Model</div>
            </div>
            <div class="panel-body">
                <div class="result-box empty" id="result-box">
                    <div class="result-icon">🤖</div>
                    <div class="result-label" style="color:var(--text2)">Menunggu Input</div>
                    <div class="result-ket">Isi data siswa di sebelah kiri, lalu klik tombol Prediksi.</div>
                </div>

                <!-- PROBABILITY BARS -->
                <div class="prob-section" id="prob-section" style="display:none">
                    <div style="font-size:12px;font-weight:700;color:var(--text2);margin-bottom:10px;text-transform:uppercase;letter-spacing:.5px">Probabilitas Prediksi</div>
                    <div class="prob-label">
                        <span>🔴 Prioritas Konseling</span>
                        <span id="prob-p-val">0%</span>
                    </div>
                    <div class="prob-bar"><div class="prob-fill fill-red" id="prob-p-bar" style="width:0%"></div></div>
                    <div class="prob-label">
                        <span>🟢 Tidak Prioritas</span>
                        <span id="prob-t-val">0%</span>
                    </div>
                    <div class="prob-bar"><div class="prob-fill fill-green" id="prob-t-bar" style="width:0%"></div></div>
                </div>
            </div>
        </div>
    </div>

    <!-- FEATURE IMPORTANCE + ALGO INFO -->
    <div class="grid">

        <!-- FEATURE IMPORTANCE -->
        <div class="panel">
            <div class="panel-head">
                <div class="panel-title">⚖️ Feature Importance Model</div>
            </div>
            <div class="panel-body" id="fi-section">
                <div style="color:var(--text2);font-size:13px">Jalankan prediksi untuk melihat feature importance.</div>
            </div>
        </div>

        <!-- PENJELASAN ALGORITMA -->
        <div class="panel">
            <div class="panel-head">
                <div class="panel-title">📖 Penjelasan Algoritma Random Forest</div>
            </div>
            <div class="panel-body">
                <div class="algo-box">
                    <h4>🌳 Decision Tree</h4>
                    <p>Tanya-jawab berantai sampai dapat jawaban: "Apakah siswa ini perlu konseling atau tidak?" berdasarkan nilai kriteria.</p>
                </div>
                <div class="algo-box">
                    <h4>🌲 Random Forest</h4>
                    <p>Jalankan 100 Decision Tree sekaligus, lalu voting — suara terbanyak menjadi keputusan akhir. Lebih akurat dari 1 pohon saja.</p>
                </div>
                <div class="algo-box">
                    <h4>📏 StandardScaler</h4>
                    <p>Menyamakan skala semua angka (jumlah nilai 700–1200 vs pelanggaran 6–183) agar model tidak salah fokus ke angka yang kebetulan lebih besar.</p>
                </div>
                <div class="algo-box">
                    <h4>🏷️ Label 1 / 0</h4>
                    <p>Hasil prediksi hanya dua: <strong style="color:var(--accent3)">1 = Prioritas Konseling</strong> atau <strong style="color:var(--accent)">0 = Tidak Prioritas</strong>.</p>
                </div>
            </div>
        </div>
    </div>

</main>

<script>
async function prediksi() {
    const nama    = document.getElementById('f-nama').value.trim()   || 'Siswa Baru';
    const nilai   = document.getElementById('f-nilai').value;
    const rata    = document.getElementById('f-rata').value;
    const pelang  = document.getElementById('f-pelang').value;

    if (!nilai || !rata || !pelang) {
        alert('Harap isi semua data terlebih dahulu!');
        return;
    }

    const btn = document.getElementById('btn-prediksi');
    btn.disabled = true;
    btn.innerHTML = '<div class="spinner"></div> Memproses Model ML...';

    const fd = new FormData();
    fd.append('nama',          nama);
    fd.append('jumlah_nilai',  nilai);
    fd.append('rata_rata',     rata);
    fd.append('pelanggaran',   pelang);

    try {
        const res  = await fetch('prediksi_ml.php', { method: 'POST', body: fd });
        const data = await res.json();

        btn.disabled = false;
        btn.innerHTML = '🤖 Prediksi dengan ML';

        if (data.status === 'error') {
            alert('Error: ' + data.message);
            return;
        }

        // Update result box
        const box = document.getElementById('result-box');
        const isPrio = data.prediksi === 1;

        box.className = 'result-box ' + (isPrio ? 'prioritas' : 'tidak');
        box.innerHTML = `
            <div class="result-icon">${isPrio ? '🚨' : '✅'}</div>
            <div class="result-label" style="color:${isPrio ? 'var(--accent3)' : 'var(--accent)'}">${data.label}</div>
            <div class="result-conf">Confidence: ${data.confidence}%</div>
            <div class="result-ket">${data.keterangan}</div>
            <div class="result-saran ${isPrio ? 'saran-red' : 'saran-green'}">💡 ${data.saran}</div>
        `;

        // Probability bars
        document.getElementById('prob-section').style.display = 'block';
        document.getElementById('prob-p-val').textContent = data.prob_prioritas + '%';
        document.getElementById('prob-t-val').textContent = data.prob_tidak     + '%';
        setTimeout(() => {
            document.getElementById('prob-p-bar').style.width = data.prob_prioritas + '%';
            document.getElementById('prob-t-bar').style.width = data.prob_tidak     + '%';
        }, 100);

        // Feature importance
        const fi = data.feature_importance;
        const fiSection = document.getElementById('fi-section');
        const fiItems = [
            ['Jumlah Nilai (C1)', fi.jumlah_nilai],
            ['Rata-rata (C2)',    fi.rata_rata],
            ['Pelanggaran (C3)', fi.pelanggaran],
        ];
        fiSection.innerHTML = '<div style="font-size:12px;color:var(--text2);margin-bottom:14px">Seberapa besar pengaruh tiap kriteria terhadap keputusan model:</div>';
        fiItems.forEach(([label, val]) => {
            const pct = Math.round(val * 100);
            fiSection.innerHTML += `
                <div class="fi-row">
                    <div class="fi-label">${label}</div>
                    <div class="fi-bar"><div class="fi-fill" style="width:${pct}%"></div></div>
                    <div class="fi-val">${(val * 100).toFixed(1)}%</div>
                </div>`;
        });

    } catch(e) {
        btn.disabled = false;
        btn.innerHTML = '🤖 Prediksi dengan ML';
        alert('Gagal terhubung ke server. Pastikan Python dan model sudah tersedia.');
        console.error(e);
    }
}
</script>
</body>
</html>
