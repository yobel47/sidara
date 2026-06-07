<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Screening extends Model
{
    protected $table      = 'screening';
    protected $primaryKey = 'id_screening';

    protected $fillable = [
        'id_user',
        'date_screening',
        'weight',
        'height',
        'hemoglobin',
        'complaint',
    ];

    protected $casts = [
        'date_screening' => 'date',
        'weight'         => 'float',
        'height'         => 'float',
        'hemoglobin'     => 'float',
    ];

    // ── RELASI ──────────────────────────────────────
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // ── DIAGNOSIS ANEMIA ────────────────────────────
    // Standar WHO untuk ibu hamil:
    // Normal  : Hb >= 11 g/dL
    // Ringan  : Hb  8 - 10.9 g/dL
    // Sedang  : Hb  5 -  7.9 g/dL
    // Berat   : Hb  < 5 g/dL
    public function getDiagnosisAttribute(): array
    {
        $hb = $this->hemoglobin;

        if ($hb >= 11) {
            return [
                'kategori'    => 'Normal',
                'label'       => 'Normal',
                'warna'       => 'green',
                'batasNormal' => '≥ 11 g/dL',
                'deskripsi'   => "Kadar hemoglobin (Hb) Anda {$hb} g/dL, dalam batas normal.",
                'konseling'   => [
                    'Pertahankan pola makan bergizi seimbang.',
                    'Konsumsi makanan kaya zat besi seperti daging, ikan, dan sayuran hijau.',
                    'Lakukan pemeriksaan rutin sesuai jadwal.',
                    'Tetap aktif bergerak sesuai anjuran tenaga kesehatan.',
                ],
                'anjuran' => 'Lanjutkan pemeriksaan rutin sesuai jadwal yang dianjurkan.',
            ];
        } elseif ($hb >= 8) {
            return [
                'kategori'    => 'Anemia Ringan',
                'label'       => 'Ringan',
                'warna'       => 'yellow',
                'batasNormal' => '12 – 15 g/dL',
                'deskripsi'   => "Kadar hemoglobin (Hb) Anda {$hb} g/dL, menunjukkan anemia ringan.",
                'konseling'   => [
                    'Perbanyak konsumsi makanan tinggi zat besi seperti daging, hati ayam/sapi, ikan, telur, dan sayuran hijau.',
                    'Konsumsi buah yang mengandung vitamin C (jeruk, jambu, tomat) untuk membantu penyerapan zat besi.',
                    'Minum tablet tambah darah (TTD) secara rutin sesuai anjuran.',
                    'Istirahat yang cukup dan kelola stres dengan baik.',
                ],
                'anjuran' => 'Disarankan untuk melakukan pemeriksaan ulang Hb dalam 1 bulan atau sesuai anjuran tenaga kesehatan.',
            ];
        } elseif ($hb >= 5) {
            return [
                'kategori'    => 'Anemia Sedang',
                'label'       => 'Sedang',
                'warna'       => 'orange',
                'batasNormal' => '12 – 15 g/dL',
                'deskripsi'   => "Kadar hemoglobin (Hb) Anda {$hb} g/dL, menunjukkan anemia sedang.",
                'konseling'   => [
                    'Segera konsultasikan ke dokter atau bidan untuk penanganan lebih lanjut.',
                    'Konsumsi suplemen zat besi sesuai resep dokter.',
                    'Perbanyak asupan makanan bergizi tinggi zat besi.',
                    'Hindari minum teh/kopi bersamaan dengan makanan karena menghambat penyerapan zat besi.',
                    'Istirahat cukup dan hindari aktivitas berat.',
                ],
                'anjuran' => 'Segera periksakan diri ke tenaga kesehatan untuk mendapatkan penanganan yang tepat.',
            ];
        } else {
            return [
                'kategori'    => 'Anemia Berat',
                'label'       => 'Berat',
                'warna'       => 'red',
                'batasNormal' => '12 – 15 g/dL',
                'deskripsi'   => "Kadar hemoglobin (Hb) Anda {$hb} g/dL, menunjukkan anemia berat.",
                'konseling'   => [
                    'Segera ke IGD rumah sakit atau fasilitas kesehatan terdekat.',
                    'Kemungkinan diperlukan transfusi darah — ikuti saran dokter.',
                    'Jangan tunda penanganan medis.',
                    'Hubungi keluarga atau pendamping untuk menemani.',
                ],
                'anjuran' => 'SEGERA cari pertolongan medis. Kondisi ini memerlukan penanganan segera.',
            ];
        }
    }
}