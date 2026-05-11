from fastapi import FastAPI
from pydantic import BaseModel
import joblib, numpy as np, pandas as pd

# ============================================
# api_ml.py
# PERTEMUAN 9: REST API dengan FastAPI
# Tujuan: Menyediakan endpoint prediksi ML
#         yang bisa dipanggil oleh PHP via cURL
# ============================================

# Inisialisasi aplikasi FastAPI
app = FastAPI(
    title="SPK Prioritas Konseling Siswa — ML API",
    description="REST API untuk prediksi prioritas konseling siswa menggunakan Random Forest",
    version="1.0.0"
)

# Load model dan scaler yang sudah dilatih (dari Pertemuan 8)
model  = joblib.load("model_konseling.pkl")
scaler = joblib.load("scaler_konseling.pkl")

# -----------------------------------------------
# Schema INPUT: struktur data yang diterima API
# -----------------------------------------------
class SiswaInput(BaseModel):
    nama         : str
    jumlah_nilai : float   # total nilai akademik
    rata_rata    : float   # rata-rata akademik
    pelanggaran  : int     # poin pelanggaran

# -----------------------------------------------
# Schema OUTPUT: struktur data yang dikembalikan API
# -----------------------------------------------
class PrediksiOutput(BaseModel):
    nama         : str
    label        : int     # 1=prioritas, 0=tidak
    probabilitas : float   # tingkat keyakinan model
    keterangan   : str

# -----------------------------------------------
# ENDPOINT: GET / — cek status API
# -----------------------------------------------
@app.get("/")
def root():
    return {
        "message"    : "SPK Konseling ML API aktif",
        "versi"      : "1.0.0",
        "endpoints"  : ["/prediksi", "/prediksi-batch", "/docs"]
    }

# -----------------------------------------------
# ENDPOINT: POST /prediksi — prediksi 1 siswa
# -----------------------------------------------
@app.post("/prediksi", response_model=PrediksiOutput)
def prediksi(data: SiswaInput):
    # 1. Bentuk dataframe input
    X = pd.DataFrame([[data.jumlah_nilai, data.rata_rata, data.pelanggaran]],
                     columns=['jumlah_nilai', 'rata_rata', 'pelanggaran'])

    # 2. Scaling menggunakan scaler yang sama saat training
    X_scaled = scaler.transform(X)

    # 3. Prediksi label (0 atau 1)
    label = int(model.predict(X_scaled)[0])

    # 4. Probabilitas prediksi
    proba      = float(model.predict_proba(X_scaled)[0][label])
    keterangan = "Prioritas Konseling" if label == 1 else "Tidak Prioritas"

    return {
        "nama"         : data.nama,
        "label"        : label,
        "probabilitas" : round(proba, 4),
        "keterangan"   : keterangan,
    }

# -----------------------------------------------
# ENDPOINT: POST /prediksi-batch — prediksi banyak siswa sekaligus
# -----------------------------------------------
@app.post("/prediksi-batch")
def prediksi_batch(items: list[SiswaInput]):
    hasil = []
    for item in items:
        X = pd.DataFrame([[item.jumlah_nilai, item.rata_rata, item.pelanggaran]],
                         columns=['jumlah_nilai', 'rata_rata', 'pelanggaran'])
        X_scaled   = scaler.transform(X)
        label      = int(model.predict(X_scaled)[0])
        proba_arr  = model.predict_proba(X_scaled)[0]
        proba      = float(proba_arr[label])
        proba_prio = float(proba_arr[1])   # prob untuk label=1

        hasil.append({
            "nama"         : item.nama,
            "label"        : label,
            "proba"        : round(proba, 4),
            "proba_prio"   : round(proba_prio, 4),
            "keterangan"   : "Prioritas" if label == 1 else "Tidak"
        })

    return {"total": len(hasil), "hasil": hasil}

# -----------------------------------------------
# ENDPOINT: GET /status — info model
# -----------------------------------------------
@app.get("/status")
def status():
    return {
        "model"           : "Random Forest Classifier",
        "n_estimators"    : int(model.n_estimators),
        "n_features"      : int(model.n_features_in_),
        "feature_names"   : ["jumlah_nilai", "rata_rata", "pelanggaran"],
        "feature_importance": {
            "jumlah_nilai": round(float(model.feature_importances_[0]), 4),
            "rata_rata"   : round(float(model.feature_importances_[1]), 4),
            "pelanggaran" : round(float(model.feature_importances_[2]), 4),
        },
        "status": "Model aktif dan siap digunakan"
    }
