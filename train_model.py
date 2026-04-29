import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestClassifier
from sklearn.metrics import accuracy_score, classification_report
from sklearn.preprocessing import StandardScaler
import joblib

print("=" * 55)
print("  SPK PRIORITAS KONSELING SISWA — MACHINE LEARNING")
print("  Yusmita Alya Melanie | 235150601111027")
print("=" * 55)

# -----------------------------------------------
# LANGKAH 1: Load dataset
# -----------------------------------------------
data = pd.read_csv("data_konseling.csv")
print(f"\n[1] Dataset berhasil dimuat: {len(data)} data siswa")
print(data[['nama','jumlah_nilai','rata_rata','pelanggaran','label']].to_string(index=False))

# -----------------------------------------------
# LANGKAH 2: Pisahkan fitur (X) dan label (y)
# X = input ke model: jumlah_nilai, rata_rata, pelanggaran
# y = output yang diprediksi: 1 (prioritas) atau 0 (tidak)
# -----------------------------------------------
X = data[['jumlah_nilai', 'rata_rata', 'pelanggaran']]
y = data['label']

print(f"\n[2] Fitur (X): jumlah_nilai, rata_rata, pelanggaran")
print(f"    Label (y): 1=Prioritas Konseling, 0=Tidak Prioritas")
print(f"    Jumlah label 1 (prioritas)   : {sum(y == 1)}")
print(f"    Jumlah label 0 (tdk prioritas): {sum(y == 0)}")

# -----------------------------------------------
# LANGKAH 3: Scaling fitur agar skala seragam
# jumlah_nilai (700-1200) vs pelanggaran (6-183) beda skala
# StandardScaler: ubah semua ke mean=0, std=1
# -----------------------------------------------
scaler = StandardScaler()
X_scaled = scaler.fit_transform(X)
print(f"\n[3] Scaling fitur dengan StandardScaler selesai")

# -----------------------------------------------
# LANGKAH 4: Split data 80% training, 20% testing
# -----------------------------------------------
X_train, X_test, y_train, y_test = train_test_split(
    X_scaled, y, test_size=0.2, random_state=42
)
print(f"\n[4] Split data:")
print(f"    Training : {len(X_train)} data (80%)")
print(f"    Testing  : {len(X_test)} data (20%)")

# -----------------------------------------------
# LANGKAH 5: Inisialisasi dan latih model Random Forest
# n_estimators=100: pakai 100 pohon keputusan
# Setiap pohon voting → suara terbanyak = keputusan akhir
# -----------------------------------------------
model = RandomForestClassifier(n_estimators=100, random_state=42)
model.fit(X_train, y_train)
print(f"\n[5] Model Random Forest berhasil dilatih!")
print(f"    Jumlah pohon keputusan (estimators): 100")

# -----------------------------------------------
# LANGKAH 6: Evaluasi model
# -----------------------------------------------
y_pred = model.predict(X_test)
akurasi = accuracy_score(y_test, y_pred)

print(f"\n[6] Hasil Evaluasi Model:")
print(f"    Akurasi Model: {akurasi * 100:.1f}%")
print(f"\n    Classification Report:")
print(classification_report(y_test, y_pred,
      target_names=['Tidak Prioritas (0)', 'Prioritas (1)']))

# -----------------------------------------------
# LANGKAH 7: Feature Importance
# Cek fitur mana yang paling berpengaruh ke keputusan
# -----------------------------------------------
importances = model.feature_importances_
fitur = ['jumlah_nilai', 'rata_rata', 'pelanggaran']

print(f"[7] Feature Importance (pengaruh tiap kriteria):")
for i, nama in enumerate(fitur):
    bar = "█" * int(importances[i] * 50)
    print(f"    {nama:<20}: {importances[i]:.4f}  {bar}")

paling_penting = fitur[importances.argmax()]
print(f"\n    Kriteria paling berpengaruh: {paling_penting.upper()}")

# -----------------------------------------------
# LANGKAH 8: Simpan model dan scaler
# -----------------------------------------------
joblib.dump(model,  'model_konseling.pkl')
joblib.dump(scaler, 'scaler_konseling.pkl')
print(f"\n[8] Model disimpan ke  : model_konseling.pkl")
print(f"    Scaler disimpan ke : scaler_konseling.pkl")

# -----------------------------------------------
# LANGKAH 9: Demo prediksi siswa baru
# -----------------------------------------------
print(f"\n[9] Demo Prediksi Siswa Baru:")
print(f"    {'Nama':<35} {'Nilai':>6} {'Rata':>6} {'Pelang':>7} {'Hasil'}")
print(f"    {'-'*65}")

siswa_baru = [
    ("Siswa A (akademik tinggi, pelanggaran rendah)", 1100, 85.0, 20),
    ("Siswa B (akademik rendah, pelanggaran tinggi)", 800,  65.0, 200),
    ("Siswa C (akademik sedang, pelanggaran sedang)", 1000, 77.0, 90),
]

for nama, nilai, rata, pelanggaran in siswa_baru:
    input_data = scaler.transform([[nilai, rata, pelanggaran]])
    prediksi   = model.predict(input_data)[0]
    proba      = model.predict_proba(input_data)[0]
    hasil      = "✓ PRIORITAS KONSELING" if prediksi == 1 else "✗ Tidak Prioritas"
    print(f"    {nama:<45} → {hasil} (confidence: {max(proba)*100:.1f}%)")

print(f"\n{'='*55}")
print(f"  Proses Machine Learning selesai!")
print(f"{'='*55}")
