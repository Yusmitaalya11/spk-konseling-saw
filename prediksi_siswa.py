import sys
import json
import joblib
import numpy as np
import pandas as pd
import warnings
warnings.filterwarnings('ignore')

# -----------------------------------------------
# prediksi_siswa.py
# Dipanggil oleh prediksi_ml.php via shell_exec
# Menerima argumen: jumlah_nilai rata_rata pelanggaran
# Mengembalikan: JSON hasil prediksi
# -----------------------------------------------

try:
    # Terima input dari PHP
    jumlah_nilai = float(sys.argv[1])
    rata_rata    = float(sys.argv[2])
    pelanggaran  = int(sys.argv[3])

    # Load model dan scaler yang sudah dilatih
    model  = joblib.load('model_konseling.pkl')
    scaler = joblib.load('scaler_konseling.pkl')

    # Buat dataframe agar nama fitur sesuai
    input_df = pd.DataFrame([[jumlah_nilai, rata_rata, pelanggaran]],
                             columns=['jumlah_nilai', 'rata_rata', 'pelanggaran'])

    # Scaling input
    input_scaled = scaler.transform(input_df)

    # Prediksi
    prediksi = int(model.predict(input_scaled)[0])
    proba    = model.predict_proba(input_scaled)[0]

    # Tentukan label dan prioritas
    if prediksi == 1:
        label      = "Prioritas Konseling"
        keterangan = "Siswa ini diprediksi perlu mendapatkan layanan konseling."
        saran      = "Segera jadwalkan sesi konseling dengan Guru BK."
    else:
        label      = "Tidak Prioritas"
        keterangan = "Siswa ini diprediksi tidak memerlukan konseling segera."
        saran      = "Pantau perkembangan siswa secara berkala."

    # Feature importance dari model
    importances = model.feature_importances_

    result = {
        "prediksi"       : prediksi,
        "label"          : label,
        "keterangan"     : keterangan,
        "saran"          : saran,
        "confidence"     : round(float(max(proba)) * 100, 1),
        "prob_prioritas" : round(float(proba[1]) * 100, 1),
        "prob_tidak"     : round(float(proba[0]) * 100, 1),
        "feature_importance": {
            "jumlah_nilai": round(float(importances[0]), 4),
            "rata_rata"   : round(float(importances[1]), 4),
            "pelanggaran" : round(float(importances[2]), 4),
        }
    }

    print(json.dumps(result))

except Exception as e:
    print(json.dumps({"status": "error", "message": str(e)}))
