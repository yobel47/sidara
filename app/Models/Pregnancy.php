<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Concerns\ClassifiesAnemia;

class Pregnancy extends Model
{
    use ClassifiesAnemia;

    protected $table      = 'pregnancy';
    protected $primaryKey = 'id_pregnancy';

    protected $fillable = [
        'id_user',
        'date_pregnancy',
        'gestational_age',
        'hpht',
        'hemoglobin',
        'weight',
        'height',
        'systolic',
        'diastolic',
        'lila',
        'took_iron_supplement',
        'notes',
    ];

    protected $casts = [
        'date_pregnancy'       => 'date',
        'hpht'                 => 'date',
        'hemoglobin'           => 'float',
        'weight'               => 'float',
        'height'               => 'float',
        'gestational_age'      => 'integer',
        'systolic'             => 'integer',
        'diastolic'            => 'integer',
        'lila'                 => 'float',
        'took_iron_supplement' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Standar klasifikasi anemia ibu hamil per trimester (Kemenkes/WHO)
    public function getDiagnosisAttribute(): array
    {
        $hb        = $this->hemoglobin;
        $trimester = $this->trimesterFromWeeks($this->gestational_age);
        $base      = $this->classifyAnemia($hb, $trimester);

        $trimesterLabel = ['I', 'II', 'III'][$trimester - 1];

        $saran = match ($base['level']) {
            'normal' => [
                'Pertahankan pola makan bergizi seimbang.',
                'Konsumsi makanan kaya zat besi: daging, ikan, sayuran hijau.',
                'Lakukan kunjungan ANC rutin sesuai jadwal.',
            ],
            'ringan' => [
                'Perbanyak makanan tinggi zat besi: daging, hati ayam, sayuran hijau.',
                'Konsumsi tablet tambah darah (TTD) setiap hari sesuai anjuran.',
                'Istirahat cukup dan kelola stres dengan baik.',
            ],
            'sedang' => [
                'Segera konsultasikan ke dokter atau bidan untuk penanganan lebih lanjut.',
                'Konsumsi suplemen zat besi sesuai resep dokter.',
                'Hindari teh/kopi bersamaan dengan makan karena menghambat penyerapan zat besi.',
            ],
            'berat' => [
                'Segera ke fasilitas kesehatan terdekat.',
                'Kemungkinan diperlukan transfusi darah — ikuti saran dokter.',
                'Jangan tunda penanganan medis.',
            ],
        };

        $deskripsi = $base['level'] === 'normal'
            ? "Kadar Hb {$hb} g/dL, dalam batas normal untuk trimester {$trimesterLabel}."
            : "Kadar Hb {$hb} g/dL, menunjukkan " . strtolower($base['kategori']) . " (trimester {$trimesterLabel}).";

        return array_merge($base, [
            'deskripsi' => $deskripsi,
            'saran'     => $saran,
        ]);
    }
}
