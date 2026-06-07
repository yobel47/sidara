<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pregnancy extends Model
{
    protected $table      = 'pregnancy';
    protected $primaryKey = 'id_pregnancy';

    protected $fillable = [
        'id_user',
        'date_pregnancy',
        'gestational_age',
        'hemoglobin',
        'weight',
        'notes',
    ];

    protected $casts = [
        'date_pregnancy'  => 'date',
        'hemoglobin'      => 'float',
        'weight'          => 'float',
        'gestational_age' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Standar WHO untuk ibu hamil: Normal ≥ 11 g/dL
    public function getDiagnosisAttribute(): array
    {
        $hb = $this->hemoglobin;

        if ($hb >= 11) {
            return [
                'kategori'    => 'Normal',
                'label'       => 'Normal',
                'warna'       => 'green',
                'batasNormal' => '≥ 11 g/dL',
                'deskripsi'   => "Kadar Hb {$hb} g/dL, dalam batas normal.",
                'saran'       => [
                    'Pertahankan pola makan bergizi seimbang.',
                    'Konsumsi makanan kaya zat besi: daging, ikan, sayuran hijau.',
                    'Lakukan kunjungan ANC rutin sesuai jadwal.',
                ],
            ];
        } elseif ($hb >= 8) {
            return [
                'kategori'    => 'Anemia Ringan',
                'label'       => 'Ringan',
                'warna'       => 'yellow',
                'batasNormal' => '11 – 14 g/dL',
                'deskripsi'   => "Kadar Hb {$hb} g/dL, menunjukkan anemia ringan.",
                'saran'       => [
                    'Perbanyak makanan tinggi zat besi: daging, hati ayam, sayuran hijau.',
                    'Konsumsi tablet tambah darah (TTD) setiap hari sesuai anjuran.',
                    'Istirahat cukup dan kelola stres dengan baik.',
                ],
            ];
        } elseif ($hb >= 5) {
            return [
                'kategori'    => 'Anemia Sedang',
                'label'       => 'Sedang',
                'warna'       => 'orange',
                'batasNormal' => '11 – 14 g/dL',
                'deskripsi'   => "Kadar Hb {$hb} g/dL, menunjukkan anemia sedang.",
                'saran'       => [
                    'Segera konsultasikan ke dokter atau bidan untuk penanganan lebih lanjut.',
                    'Konsumsi suplemen zat besi sesuai resep dokter.',
                    'Hindari teh/kopi bersamaan dengan makan karena menghambat penyerapan zat besi.',
                ],
            ];
        } else {
            return [
                'kategori'    => 'Anemia Berat',
                'label'       => 'Berat',
                'warna'       => 'red',
                'batasNormal' => '11 – 14 g/dL',
                'deskripsi'   => "Kadar Hb {$hb} g/dL, menunjukkan anemia berat.",
                'saran'       => [
                    'Segera ke fasilitas kesehatan terdekat.',
                    'Kemungkinan diperlukan transfusi darah — ikuti saran dokter.',
                    'Jangan tunda penanganan medis.',
                ],
            ];
        }
    }
}
