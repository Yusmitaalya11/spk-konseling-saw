<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluasi SPK — Prioritas Konseling</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #0d1117; --bg2: #161b22; --bg3: #21262d;
            --border: #30363d; --accent: #3fb950; --accent2: #58a6ff;
            --accent3: #f78166; --warn: #d29922;
            --text: #e6edf3; --text2: #8b949e; --text3: #484f58;
            --radius: 12px; --shadow: 0 8px 32px rgba(0,0,0,.4);
        }
        body { background: var(--bg); color: var(--text); font-family: 'Plus Jakarta Sans', sans-serif; font-size: 14px; }

        /* HEADER */
        .header { background: linear-gradient(135deg,#0d1117,#161b22); border-bottom: 1px solid var(--border); padding: 0 32px; }
        .header-inner { max-width: 1200px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; height: 64px; }
        .logo-text { font-weight: 800; font-size: 16px; }
        .logo-sub  { font-size: 11px; color: var(--text2); }
        .back-btn  { background: var(--bg3); border: 1px solid var(--border); color: var(--text2); padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 600; transition: all .2s; }
        .back-btn:hover { color: var(--text); border-color: var(--text2); }

        /* LAYOUT */
        .container { max-width: 1200px; margin: 0 auto; padding: 32px; }

        /* HERO */
        .hero { background: linear-gradient(135deg,#161b22,#0d2137); border: 1px solid var(--border); border-radius: var(--radius); padding: 36px; margin-bottom: 28px; }
        .hero-title { font-size: 24px; font-weight: 800; margin-bottom: 6px; background: linear-gradient(90deg,#e6edf3,#58a6ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .hero-sub { color: var(--text2); font-size: 13px; line-height: 1.7; max-width: 700px; }

        /* METRIC CARDS */
        .metrics { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 28px; }
        .metric-card { background: var(--bg2); border: 1px solid var(--border); border-radius: var(--radius); padding: 20px; text-align: center; transition: border-color .2s, transform .2s; }
        .metric-card:hover { transform: translateY(-2px); }
        .metric-num { font-size: 36px; font-weight: 800; font-family: 'Space Mono', monospace; line-height: 1; margin-bottom: 6px; }
        .metric-label { color: var(--text2); font-size: 11px; text-transform: uppercase; letter-spacing: 1px; }
        .metric-sub { color: var(--text3); font-size: 11px; margin-top: 4px; }
        .c-green { color: var(--accent); } .c-blue { color: var(--accent2); }
        .c-red { color: var(--accent3); } .c-warn { color: var(--warn); }

        /* PANEL */
        .panel { background: var(--bg2); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; margin-bottom: 24px; }
        .panel-head { padding: 18px 24px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
        .panel-title { font-weight: 700; font-size: 15px; }
        .panel-body { padding: 24px; }

        /* TABLE */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 13px; }
        th { background: var(--bg3); color: var(--text2); font-weight: 600; text-transform: uppercase; letter-spacing: .5px; font-size: 11px; padding: 12px 16px; text-align: left; border-bottom: 1px solid var(--border); white-space: nowrap; }
        td { padding: 11px 16px; border-bottom: 1px solid rgba(48,54,61,.5); vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(255,255,255,.02); }
        .mono { font-family: 'Space Mono', monospace; font-size: 12px; }

        /* BADGE */
        .badge { padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; }
        .badge-green  { background: rgba(63,185,80,.12);  color: var(--accent);  border: 1px solid rgba(63,185,80,.25); }
        .badge-blue   { background: rgba(88,166,255,.12); color: var(--accent2); border: 1px solid rgba(88,166,255,.25); }
        .badge-red    { background: rgba(247,129,102,.12);color: var(--accent3); border: 1px solid rgba(247,129,102,.25); }
        .badge-warn   { background: rgba(210,153,34,.12); color: var(--warn);    border: 1px solid rgba(210,153,34,.25); }

        /* RUMUS BOX */
        .rumus-box { background: var(--bg3); border-radius: 10px; padding: 20px; font-family: 'Space Mono', monospace; font-size: 12px; line-height: 2; }
        .rumus-box .comment { color: var(--text3); }
        .rumus-box .formula { color: var(--accent2); font-size: 13px; }
        .rumus-box .result  { color: var(--accent); font-weight: 700; }

        /* INTERPRETASI BOX */
        .interpretasi-box { border-radius: 10px; padding: 20px 24px; display: flex; align-items: flex-start; gap: 16px; }
        .interpretasi-box.great { background: rgba(63,185,80,.08);  border: 1px solid rgba(63,185,80,.25); }
        .interpretasi-box.good  { background: rgba(88,166,255,.08); border: 1px solid rgba(88,166,255,.25); }
        .interpretasi-box.warn  { background: rgba(210,153,34,.08); border: 1px solid rgba(210,153,34,.25); }
        .interpretasi-box.bad   { background: rgba(247,129,102,.08);border: 1px solid rgba(247,129,102,.25); }
        .interpretasi-icon { font-size: 32px; }
        .interpretasi-title { font-weight: 800; font-size: 16px; margin-bottom: 4px; }
        .interpretasi-desc  { color: var(--text2); font-size: 13px; line-height: 1.6; }

        /* REKOMENDASI */
        .rekomendasi-item { display: flex; gap: 12px; padding: 14px 18px; background: var(--bg3); border-radius: 10px; margin-bottom: 10px; border-left: 3px solid var(--accent2); }
        .rekomendasi-item:last-child { margin-bottom: 0; }

        /* LOADING */
        .loading { text-align: center; padding: 60px; color: var(--text2); }
        .spinner { width: 36px; height: 36px; border: 3px solid var(--border); border-top-color: var(--accent); border-radius: 50%; animation: spin .7s linear infinite; margin: 0 auto 16px; }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* BTN */
        .btn { padding: 9px 18px; border-radius: 8px; border: none; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 13px; font-weight: 600; cursor: pointer; transition: all .2s; display: inline-flex; align-items: center; gap: 6px; }
        .btn-primary { background: var(--accent); color: #0d1117; }
        .btn-primary:hover { background: #4cca5e; }

        /* D VALUE COLOR */
        .d-pos { color: var(--accent3); }
        .d-neg { color: var(--accent2); }
        .d-zero { color: var(--accent); }

        @media (max-width: 900px) {
            .metrics { grid-template-columns: repeat(2,1fr); }
            .container { padding: 16px; }
        }
    </style>
</head>
<body>

<!-- HEADER -->
<header class="header">
    <div class="header-inner">
        <div>
            <div class="logo-text">📊 Evaluasi Kinerja SPK</div>
            <div class="logo-sub">Spearman Rank Correlation · Akurasi Top-N · Rekomendasi</div>
        </div>
        <a href="index.php" class="back-btn">← Kembali ke SPK</a>
    </div>
</header>

<main class="container">

    <!-- HERO -->
    <div class="hero">
        <div class="hero-title">Pertemuan 7 — Evaluasi & Peningkatan Kinerja SPK</div>
        <p class="hero-sub">
            Halaman ini mengevaluasi seberapa akurat hasil keputusan SPK dibandingkan dengan
            rekomendasi pakar (Guru BK) menggunakan metrik <strong>Spearman Rank Correlation</strong>
            dan <strong>Akurasi Top-N</strong>. Hasil evaluasi digunakan sebagai dasar rekomendasi
            perbaikan bobot kriteria dan model SPK.
        </p>
    </div>

    <!-- LOADING STATE -->
    <div id="loading" class="loading">
        <div class="spinner"></div>
        <div>Menjalankan evaluasi...</div>
    </div>

    <!-- HASIL EVALUASI (hidden until loaded) -->
    <div id="hasil-evaluasi" style="display:none">

        <!-- METRIC CARDS -->
        <div class="metrics">
            <div class="metric-card">
                <div class="metric-num" id="val-rs" style="color:var(--accent)">—</div>
                <div class="metric-label">Spearman rs</div>
                <div class="metric-sub" id="val-rs-level">—</div>
            </div>
            <div class="metric-card">
                <div class="metric-num c-blue" id="val-top1">—</div>
                <div class="metric-label">Akurasi Top-1</div>
                <div class="metric-sub">Ranking 1 SPK vs Pakar</div>
            </div>
            <div class="metric-card">
                <div class="metric-num c-warn" id="val-top3">—</div>
                <div class="metric-label">Akurasi Top-3</div>
                <div class="metric-sub">3 Besar SPK vs Pakar</div>
            </div>
            <div class="metric-card">
                <div class="metric-num c-green" id="val-top5">—</div>
                <div class="metric-label">Akurasi Top-5</div>
                <div class="metric-sub">5 Besar SPK vs Pakar</div>
            </div>
        </div>

        <!-- INTERPRETASI -->
        <div id="interpretasi-box" class="interpretasi-box great" style="margin-bottom:24px">
            <div class="interpretasi-icon" id="interpretasi-icon">⭐</div>
            <div>
                <div class="interpretasi-title" id="interpretasi-title">—</div>
                <div class="interpretasi-desc" id="interpretasi-desc">—</div>
            </div>
        </div>

        <!-- RUMUS SPEARMAN -->
        <div class="panel">
            <div class="panel-head">
                <div class="panel-title">📐 Rumus & Perhitungan Spearman Rank Correlation</div>
            </div>
            <div class="panel-body">
                <div class="rumus-box">
                    <div class="comment">// Rumus Spearman Rank Correlation</div>
                    <div class="formula">rs = 1 - (6 × Σd²) / (n × (n² - 1))</div>
                    <br>
                    <div class="comment">// Keterangan:</div>
                    <div>d  = selisih ranking SPK dengan ranking pakar</div>
                    <div>d² = kuadrat selisih</div>
                    <div>n  = jumlah data siswa</div>
                    <br>
                    <div class="comment">// Hasil perhitungan:</div>
                    <div>Σd²  = <span id="val-sumd2" class="result">—</span></div>
                    <div>n    = <span id="val-n" class="result">—</span></div>
                    <div>rs   = 1 - (6 × <span id="calc-sumd2">—</span>) / (<span id="calc-n">—</span> × (<span id="calc-n2">—</span> - 1))</div>
                    <div>rs   = <span id="val-rs-formula" class="result" style="color:var(--accent);font-size:14px">—</span></div>
                </div>
                <br>
                <div style="font-size:12px;color:var(--text2);line-height:2">
                    <strong>Interpretasi nilai rs:</strong><br>
                    <span style="color:var(--accent)">rs ≥ 0.90</span> → Sangat Kuat &nbsp;|&nbsp;
                    <span style="color:var(--accent2)">rs ≥ 0.70</span> → Kuat &nbsp;|&nbsp;
                    <span style="color:var(--warn)">rs ≥ 0.50</span> → Sedang &nbsp;|&nbsp;
                    <span style="color:var(--accent3)">rs &lt; 0.50</span> → Lemah
                </div>
            </div>
        </div>

        <!-- REKOMENDASI -->
        <div class="panel">
            <div class="panel-head">
                <div class="panel-title">💡 Rekomendasi Peningkatan Kinerja SPK</div>
            </div>
            <div class="panel-body">
                <div id="rekomendasi-container"></div>
            </div>
        </div>

        <!-- TABEL DETAIL PERHITUNGAN -->
        <div class="panel">
            <div class="panel-head">
                <div class="panel-title">📋 Detail Perhitungan Spearman per Siswa</div>
                <span id="badge-total" class="badge badge-blue">— data</span>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Rank SPK</th>
                            <th>Rank Pakar</th>
                            <th>d (Selisih)</th>
                            <th>d² (Kuadrat)</th>
                            <th>Skor SAW</th>
                            <th>Prioritas</th>
                            <th>Kesesuaian</th>
                        </tr>
                    </thead>
                    <tbody id="tabel-detail"></tbody>
                </table>
            </div>
        </div>

    </div><!-- end #hasil-evaluasi -->

</main>

<script>
// ===================== LOAD EVALUASI =====================
async function loadEvaluasi() {
    try {
        const res  = await fetch('evaluasi.php');
        const data = await res.json();

        document.getElementById('loading').style.display = 'none';
        document.getElementById('hasil-evaluasi').style.display = 'block';

        if (data.status !== 'ok') {
            alert('Error: ' + data.message);
            return;
        }

        const rs = parseFloat(data.spearman_rs);

        // === METRIC CARDS ===
        document.getElementById('val-rs').textContent    = data.spearman_rs;
        document.getElementById('val-top1').textContent  = data.akurasi.top1;
        document.getElementById('val-top3').textContent  = data.akurasi.top3;
        document.getElementById('val-top5').textContent  = data.akurasi.top5;

        // rs color
        const rsEl = document.getElementById('val-rs');
        if      (rs >= 0.90) { rsEl.style.color = 'var(--accent)';  document.getElementById('val-rs-level').textContent = 'Sangat Kuat'; }
        else if (rs >= 0.70) { rsEl.style.color = 'var(--accent2)'; document.getElementById('val-rs-level').textContent = 'Kuat'; }
        else if (rs >= 0.50) { rsEl.style.color = 'var(--warn)';    document.getElementById('val-rs-level').textContent = 'Sedang'; }
        else                 { rsEl.style.color = 'var(--accent3)'; document.getElementById('val-rs-level').textContent = 'Lemah'; }

        // === INTERPRETASI BOX ===
        const box = document.getElementById('interpretasi-box');
        box.className = 'interpretasi-box';
        let icon = '⭐', title = '', desc = '';

        if (rs >= 0.90) {
            box.classList.add('great'); icon = '🏆';
            title = 'Korelasi Sangat Kuat (rs = ' + data.spearman_rs + ')';
            desc  = 'Hasil ranking SPK sangat mendekati penilaian pakar (Guru BK). Model SPK sudah efektif digunakan untuk menentukan prioritas konseling siswa. Tidak diperlukan perubahan bobot dalam waktu dekat.';
        } else if (rs >= 0.70) {
            box.classList.add('good'); icon = '✅';
            title = 'Korelasi Kuat (rs = ' + data.spearman_rs + ')';
            desc  = 'Hasil ranking SPK cukup sesuai dengan penilaian pakar. Beberapa perbedaan kecil masih dapat ditoleransi. Pertimbangkan penambahan data atau kriteria untuk meningkatkan akurasi.';
        } else if (rs >= 0.50) {
            box.classList.add('warn'); icon = '⚠️';
            title = 'Korelasi Sedang (rs = ' + data.spearman_rs + ')';
            desc  = 'Terdapat perbedaan yang cukup signifikan antara ranking SPK dan penilaian pakar. Bobot kriteria perlu dievaluasi dan didiskusikan kembali bersama Guru BK.';
        } else {
            box.classList.add('bad'); icon = '🔴';
            title = 'Korelasi Lemah (rs = ' + data.spearman_rs + ')';
            desc  = 'Hasil SPK tidak sesuai dengan penilaian pakar. Bobot kriteria harus direvisi ulang secara menyeluruh. Pertimbangkan penggunaan metode pembobotan seperti AHP untuk menentukan bobot yang lebih tepat.';
        }

        document.getElementById('interpretasi-icon').textContent = icon;
        document.getElementById('interpretasi-title').textContent = title;
        document.getElementById('interpretasi-desc').textContent = desc;

        // === RUMUS ===
        const n  = data.total_data;
        const n2 = n * n;
        document.getElementById('val-sumd2').textContent   = data.sum_d2;
        document.getElementById('val-n').textContent       = n;
        document.getElementById('calc-sumd2').textContent  = data.sum_d2;
        document.getElementById('calc-n').textContent      = n;
        document.getElementById('calc-n2').textContent     = n2;
        document.getElementById('val-rs-formula').textContent = data.spearman_rs;

        // === REKOMENDASI ===
        const rekContainer = document.getElementById('rekomendasi-container');
        data.rekomendasi.forEach((rek, i) => {
            rekContainer.innerHTML += `
                <div class="rekomendasi-item">
                    <span style="font-size:18px;min-width:24px">${i === 0 ? '🎯' : i === 1 ? '📊' : '🔧'}</span>
                    <span style="line-height:1.6">${rek}</span>
                </div>`;
        });

        // === TABEL DETAIL ===
        document.getElementById('badge-total').textContent = n + ' data';
        const tbody = document.getElementById('tabel-detail');
        data.detail.forEach((row, i) => {
            const d    = row.d;
            const dClass = d > 0 ? 'c-red d-pos' : d < 0 ? 'c-blue d-neg' : 'c-green d-zero';
            const dSign  = d > 0 ? '+' + d : d;
            const pct    = Math.round(row.skor * 100);
            const prioClass = row.prioritas === 'Tinggi' ? 'badge-red' : row.prioritas === 'Sedang' ? 'badge-warn' : 'badge-green';
            const sesuai = Math.abs(d) === 0 ? '<span class="badge badge-green">✓ Sama</span>'
                         : Math.abs(d) <= 3   ? '<span class="badge badge-blue">~ Dekat</span>'
                         :                      '<span class="badge badge-red">✗ Jauh</span>';

            tbody.innerHTML += `<tr>
                <td class="mono" style="color:var(--text3)">${i + 1}</td>
                <td><strong>${row.nama}</strong></td>
                <td class="mono" style="color:var(--accent2)">${row.rank_spk}</td>
                <td class="mono" style="color:var(--warn)">${row.rank_pakar}</td>
                <td class="mono ${dClass}">${dSign}</td>
                <td class="mono">${row.d2}</td>
                <td>
                    <div style="display:flex;align-items:center;gap:8px;min-width:110px">
                        <div style="flex:1;height:5px;background:var(--bg3);border-radius:5px;overflow:hidden">
                            <div style="width:${pct}%;height:100%;background:linear-gradient(90deg,var(--accent2),var(--accent));border-radius:5px"></div>
                        </div>
                        <span class="mono">${parseFloat(row.skor).toFixed(4)}</span>
                    </div>
                </td>
                <td><span class="badge ${prioClass}">${row.prioritas}</span></td>
                <td>${sesuai}</td>
            </tr>`;
        });

        // Tampilkan Σd² total di footer
        tbody.innerHTML += `<tr style="background:var(--bg3)">
            <td colspan="5" style="text-align:right;font-weight:700;padding:12px 16px">Total Σd²</td>
            <td class="mono" style="font-weight:700;color:var(--accent)">${data.sum_d2}</td>
            <td colspan="3"></td>
        </tr>`;

    } catch(e) {
        document.getElementById('loading').innerHTML =
            '<div style="color:var(--accent3);text-align:center;padding:60px">❌ Gagal memuat evaluasi. Pastikan evaluasi.php ada dan hitung_saw.php sudah dijalankan.</div>';
        console.error(e);
    }
}

loadEvaluasi();
</script>
</body>
</html>
