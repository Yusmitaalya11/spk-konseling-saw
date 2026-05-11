<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integrasi Hybrid SPK — Konseling</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #0d1117; --bg2: #161b22; --bg3: #21262d;
            --border: #30363d; --accent: #3fb950; --accent2: #58a6ff;
            --accent3: #f78166; --warn: #d29922; --purple: #bc8cff;
            --text: #e6edf3; --text2: #8b949e; --radius: 12px;
        }
        body { background: var(--bg); color: var(--text); font-family: 'Plus Jakarta Sans', sans-serif; font-size: 14px; min-height: 100vh; }

        .header { background: linear-gradient(135deg,#0d1117,#161b22); border-bottom: 1px solid var(--border); padding: 0 32px; }
        .header-inner { max-width: 1300px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; height: 64px; }
        .logo-text { font-weight: 800; font-size: 16px; }
        .logo-sub  { font-size: 11px; color: var(--text2); }
        .back-btn  { background: var(--bg3); border: 1px solid var(--border); color: var(--text2); padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 600; }

        .container { max-width: 1300px; margin: 0 auto; padding: 32px; }

        .hero { background: linear-gradient(135deg,#161b22,#1a0d37); border: 1px solid var(--border); border-radius: var(--radius); padding: 36px; margin-bottom: 28px; position: relative; overflow: hidden; }
        .hero::before { content:''; position:absolute; top:-50px; right:-50px; width:200px; height:200px; background: radial-gradient(circle, rgba(188,140,255,.12) 0%, transparent 70%); border-radius: 50%; }
        .hero-title { font-size: 24px; font-weight: 800; margin-bottom: 6px; background: linear-gradient(90deg,#e6edf3,#bc8cff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .hero-sub { color: var(--text2); font-size: 13px; line-height: 1.7; max-width: 750px; }

        .stats { display: grid; grid-template-columns: repeat(4,1fr); gap: 16px; margin-bottom: 28px; }
        .stat-card { background: var(--bg2); border: 1px solid var(--border); border-radius: var(--radius); padding: 18px; text-align: center; }
        .stat-num { font-size: 28px; font-weight: 800; font-family: 'Space Mono', monospace; line-height: 1; margin-bottom: 4px; }
        .stat-lbl { font-size: 11px; color: var(--text2); text-transform: uppercase; letter-spacing: 1px; }

        .arch-box { background: var(--bg2); border: 1px solid var(--border); border-radius: var(--radius); padding: 24px; margin-bottom: 28px; }
        .arch-title { font-weight: 700; margin-bottom: 16px; font-size: 15px; }
        .arch-flow { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
        .arch-step { background: var(--bg3); border: 1px solid var(--border); border-radius: 10px; padding: 12px 16px; text-align: center; min-width: 120px; }
        .arch-step-icon { font-size: 24px; margin-bottom: 4px; }
        .arch-step-label { font-size: 11px; font-weight: 700; color: var(--text2); text-transform: uppercase; letter-spacing: .5px; }
        .arch-step-sub { font-size: 10px; color: var(--text3, #484f58); margin-top: 2px; }
        .arch-arrow { font-size: 20px; color: var(--text2); }

        .panel { background: var(--bg2); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; margin-bottom: 24px; }
        .panel-head { padding: 18px 24px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; }
        .panel-title { font-weight: 700; font-size: 15px; }

        .btn { padding: 9px 18px; border-radius: 8px; border: none; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 13px; font-weight: 700; cursor: pointer; transition: all .2s; display: inline-flex; align-items: center; gap: 6px; }
        .btn-purple { background: var(--purple); color: #0d1117; }
        .btn-purple:hover { background: #c9a0ff; }
        .btn:disabled { opacity: .5; cursor: not-allowed; }

        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 13px; }
        th { background: var(--bg3); color: var(--text2); font-weight: 600; text-transform: uppercase; letter-spacing: .5px; font-size: 11px; padding: 12px 16px; text-align: left; border-bottom: 1px solid var(--border); white-space: nowrap; }
        td { padding: 11px 16px; border-bottom: 1px solid rgba(48,54,61,.5); vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(255,255,255,.02); }
        .mono { font-family: 'Space Mono', monospace; font-size: 12px; }

        .rank-badge { width: 28px; height: 28px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-weight: 700; font-size: 12px; font-family: 'Space Mono', monospace; }
        .rank-1 { background: linear-gradient(135deg,#ffd700,#ff8c00); color:#000; }
        .rank-2 { background: linear-gradient(135deg,#c0c0c0,#909090); color:#000; }
        .rank-3 { background: linear-gradient(135deg,#cd7f32,#8b4513); color:#fff; }
        .rank-n { background: var(--bg3); color: var(--text2); }

        .badge { padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; }
        .badge-red   { background: rgba(247,129,102,.15); color: var(--accent3); border: 1px solid rgba(247,129,102,.3); }
        .badge-warn  { background: rgba(210,153,34,.15);  color: var(--warn);    border: 1px solid rgba(210,153,34,.3);  }
        .badge-green { background: rgba(63,185,80,.12);   color: var(--accent);  border: 1px solid rgba(63,185,80,.25); }
        .badge-blue  { background: rgba(88,166,255,.12);  color: var(--accent2); border: 1px solid rgba(88,166,255,.25); }
        .badge-purple{ background: rgba(188,140,255,.12); color: var(--purple);  border: 1px solid rgba(188,140,255,.25); }

        .skor-bar-wrap { display: flex; align-items: center; gap: 8px; min-width: 110px; }
        .skor-bar { flex:1; height:6px; background: var(--bg3); border-radius:10px; overflow:hidden; }
        .skor-bar-fill { height:100%; border-radius:10px; transition: width .8s ease; }
        .fill-saw    { background: linear-gradient(90deg, var(--accent2), var(--accent)); }
        .fill-hybrid { background: linear-gradient(90deg, var(--purple), var(--accent3)); }

        .empty-state { text-align: center; padding: 60px 24px; color: var(--text2); }
        .empty-icon  { font-size: 48px; margin-bottom: 12px; }

        .spinner { width: 18px; height: 18px; border: 2px solid rgba(0,0,0,.3); border-top-color: #0d1117; border-radius: 50%; animation: spin .7s linear infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }

        .api-status { display: flex; align-items: center; gap: 8px; padding: 10px 16px; border-radius: 8px; font-size: 12px; font-weight: 600; margin-bottom: 20px; }
        .api-status.on  { background: rgba(63,185,80,.1);  border: 1px solid rgba(63,185,80,.3);  color: var(--accent); }
        .api-status.off { background: rgba(247,129,102,.1);border: 1px solid rgba(247,129,102,.3);color: var(--accent3); }
        .dot { width: 8px; height: 8px; border-radius: 50%; }
        .dot-green { background: var(--accent); }
        .dot-red   { background: var(--accent3); }

        .rumus-box { background: var(--bg3); border-radius: 10px; padding: 20px; font-family: 'Space Mono', monospace; font-size: 12px; line-height: 2; margin-bottom: 20px; }

        @media (max-width: 900px) { .stats { grid-template-columns: repeat(2,1fr); } .container { padding: 16px; } .arch-flow { flex-direction: column; } }
    </style>
</head>
<body>

<header class="header">
    <div class="header-inner">
        <div>
            <div class="logo-text">🔗 Integrasi Hybrid SPK</div>
            <div class="logo-sub">FastAPI + PHP/MySQL + Random Forest · Pertemuan 9</div>
        </div>
        <a href="index.php" class="back-btn">← Kembali ke SPK</a>
    </div>
</header>

<main class="container">

    <!-- HERO -->
    <div class="hero">
        <div class="hero-title">Pertemuan 9 — Integrasi Web PHP/MySQL dengan Machine Learning</div>
        <p class="hero-sub">
            Halaman ini menggabungkan semua komponen: <strong>PHP/MySQL</strong> untuk data,
            <strong>FastAPI</strong> sebagai REST API Machine Learning, dan <strong>algoritma SAW</strong>
            untuk menghasilkan <strong>skor hybrid</strong> yang lebih akurat.
            Rumus: <strong>Skor Hybrid = (0,7 × SAW) + (0,3 × Probabilitas ML)</strong>
        </p>
    </div>

    <!-- ARSITEKTUR -->
    <div class="arch-box">
        <div class="arch-title">🏗️ Arsitektur Sistem</div>
        <div class="arch-flow">
            <div class="arch-step">
                <div class="arch-step-icon">🗄️</div>
                <div class="arch-step-label">MySQL</div>
                <div class="arch-step-sub">Data 36 Siswa</div>
            </div>
            <div class="arch-arrow">→</div>
            <div class="arch-step">
                <div class="arch-step-icon">🐘</div>
                <div class="arch-step-label">PHP</div>
                <div class="arch-step-sub">integrasi.php</div>
            </div>
            <div class="arch-arrow">→</div>
            <div class="arch-step" style="border-color:rgba(188,140,255,.4)">
                <div class="arch-step-icon">⚡</div>
                <div class="arch-step-label" style="color:var(--purple)">FastAPI</div>
                <div class="arch-step-sub">:8000/prediksi-batch</div>
            </div>
            <div class="arch-arrow">→</div>
            <div class="arch-step">
                <div class="arch-step-icon">🤖</div>
                <div class="arch-step-label">Random Forest</div>
                <div class="arch-step-sub">model_konseling.pkl</div>
            </div>
            <div class="arch-arrow">→</div>
            <div class="arch-step" style="border-color:rgba(63,185,80,.4)">
                <div class="arch-step-icon">📊</div>
                <div class="arch-step-label" style="color:var(--accent)">Hybrid Score</div>
                <div class="arch-step-sub">SAW + ML</div>
            </div>
        </div>
    </div>

    <!-- STATS -->
    <div class="stats">
        <div class="stat-card">
            <div class="stat-num" style="color:var(--accent2)">36</div>
            <div class="stat-lbl">Total Siswa</div>
        </div>
        <div class="stat-card">
            <div class="stat-num" style="color:var(--accent)">70%</div>
            <div class="stat-lbl">Bobot SAW</div>
        </div>
        <div class="stat-card">
            <div class="stat-num" style="color:var(--purple)">30%</div>
            <div class="stat-lbl">Bobot ML</div>
        </div>
        <div class="stat-card">
            <div class="stat-num" style="color:var(--warn)" id="stat-api">—</div>
            <div class="stat-lbl">Status API</div>
        </div>
    </div>

    <!-- PANEL HASIL -->
    <div class="panel">
        <div class="panel-head">
            <div class="panel-title">🏆 Ranking Hybrid SPK + ML</div>
            <button class="btn btn-purple" onclick="loadHybrid()" id="btn-load">
                🔗 Jalankan Integrasi Hybrid
            </button>
        </div>

        <!-- RUMUS -->
        <div style="padding: 20px 24px; border-bottom: 1px solid var(--border)">
            <div class="rumus-box">
                <div style="color:var(--text2)">// Rumus Skor Hybrid</div>
                <div style="color:var(--purple)">Skor Hybrid = (0,7 × Skor SAW) + (0,3 × Probabilitas ML)</div>
                <br>
                <div style="color:var(--text2)">// Skor SAW = (0,4×R1) + (0,4×R2) + (0,2×R3)</div>
                <div style="color:var(--text2)">// Probabilitas ML = keyakinan model bahwa siswa = Prioritas</div>
            </div>
            <div id="api-status-box" class="api-status off">
                <div class="dot dot-red"></div>
                FastAPI belum terdeteksi — klik tombol untuk mencoba koneksi
            </div>
        </div>

        <!-- TABEL HASIL -->
        <div id="hasil-container">
            <div class="empty-state">
                <div class="empty-icon">🔗</div>
                <div>Klik tombol <strong>"Jalankan Integrasi Hybrid"</strong> untuk memulai.</div>
                <div style="font-size:12px;margin-top:8px;color:var(--text3,#484f58)">
                    Pastikan FastAPI sudah berjalan: <code>uvicorn api_ml:app --reload --port 8000</code>
                </div>
            </div>
        </div>
    </div>

</main>

<script>
async function loadHybrid() {
    const btn = document.getElementById('btn-load');
    btn.disabled = true;
    btn.innerHTML = '<div class="spinner"></div> Menghubungkan...';

    try {
        const res  = await fetch('integrasi.php');
        const data = await res.json();

        btn.disabled = false;
        btn.innerHTML = '🔗 Jalankan Integrasi Hybrid';

        if (data.status !== 'ok') {
            document.getElementById('hasil-container').innerHTML = `
                <div class="empty-state">
                    <div class="empty-icon">❌</div>
                    <div style="color:var(--accent3);font-weight:700">${data.message}</div>
                    <div style="font-size:12px;margin-top:12px;color:var(--text2)">${data.cara || ''}</div>
                    <div style="font-size:12px;margin-top:8px;color:var(--text2)">
                        Buka terminal VS Code di folder spk_konseling, lalu ketik:<br>
                        <code style="color:var(--accent)">uvicorn api_ml:app --reload --port 8000</code>
                    </div>
                </div>`;
            document.getElementById('stat-api').textContent = 'OFF';
            document.getElementById('stat-api').style.color = 'var(--accent3)';
            return;
        }

        // Update status
        document.getElementById('api-status-box').className = 'api-status on';
        document.getElementById('api-status-box').innerHTML = '<div class="dot dot-green"></div> FastAPI terhubung — prediksi ML berhasil dijalankan';
        document.getElementById('stat-api').textContent = 'ON';
        document.getElementById('stat-api').style.color = 'var(--accent)';

        // Render tabel
        renderTabel(data.ranking);

    } catch(e) {
        btn.disabled = false;
        btn.innerHTML = '🔗 Jalankan Integrasi Hybrid';
        console.error(e);
    }
}

function renderTabel(ranking) {
    const rankClass = r => r==1?'rank-1':r==2?'rank-2':r==3?'rank-3':'rank-n';
    const prioClass = p => p==='Tinggi'?'badge-red':p==='Sedang'?'badge-warn':'badge-green';
    const mlClass   = m => m==='Prioritas'?'badge-red':'badge-green';

    let html = `<div class="table-wrap"><table>
        <thead><tr>
            <th>Rank</th>
            <th>Nama Siswa</th>
            <th>Skor SAW</th>
            <th>Prediksi ML</th>
            <th>Probabilitas ML</th>
            <th>Skor Hybrid</th>
            <th>Prioritas</th>
        </tr></thead><tbody>`;

    ranking.forEach(row => {
        const sawPct    = Math.round(row.skor_saw    * 100);
        const hybridPct = Math.round(row.skor_hybrid * 100);
        html += `<tr>
            <td><span class="rank-badge ${rankClass(row.peringkat)}">${row.peringkat}</span></td>
            <td><strong>${row.nama}</strong></td>
            <td>
                <div class="skor-bar-wrap">
                    <div class="skor-bar"><div class="skor-bar-fill fill-saw" style="width:${sawPct}%"></div></div>
                    <span class="mono">${row.skor_saw}</span>
                </div>
            </td>
            <td><span class="badge ${mlClass(row.prediksi_ml)}">${row.prediksi_ml}</span></td>
            <td class="mono">${(row.proba_ml * 100).toFixed(1)}%</td>
            <td>
                <div class="skor-bar-wrap">
                    <div class="skor-bar"><div class="skor-bar-fill fill-hybrid" style="width:${hybridPct}%"></div></div>
                    <span class="mono" style="color:var(--purple)">${row.skor_hybrid}</span>
                </div>
            </td>
            <td><span class="badge ${prioClass(row.prioritas)}">${row.prioritas}</span></td>
        </tr>`;
    });

    html += '</tbody></table></div>';
    document.getElementById('hasil-container').innerHTML = html;
}
</script>
</body>
</html>
