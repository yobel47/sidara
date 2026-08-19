<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Concerns\ClassifiesAnemia;

class Screening extends Model
{
    use ClassifiesAnemia;

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
    public function getDiagnosisAttribute(): array
    {
        $hb        = $this->hemoglobin;
        $trimester = $this->trimesterFromChUser();
        $base      = $this->classifyAnemia($hb, $trimester);

        $konseling = match ($base['level']) {
            'normal' => [
                'Pertahankan pola makan bergizi seimbang.',
                'Konsumsi makanan kaya zat besi seperti daging, ikan, dan sayuran hijau.',
                'Lakukan pemeriksaan rutin sesuai jadwal.',
                'Tetap aktif bergerak sesuai anjuran tenaga kesehatan.',
            ],
            'ringan' => [
                'Perbanyak konsumsi makanan tinggi zat besi seperti daging, hati ayam/sapi, ikan, telur, dan sayuran hijau.',
                'Konsumsi buah yang mengandung vitamin C (jeruk, jambu, tomat) untuk membantu penyerapan zat besi.',
                'Minum tablet tambah darah (TTD) secara rutin sesuai anjuran.',
                'Istirahat yang cukup dan kelola stres dengan baik.',
            ],
            'sedang' => [
                'Segera konsultasikan ke dokter atau bidan untuk penanganan lebih lanjut.',
                'Konsumsi suplemen zat besi sesuai resep dokter.',
                'Perbanyak asupan makanan bergizi tinggi zat besi.',
                'Hindari minum teh/kopi bersamaan dengan makanan karena menghambat penyerapan zat besi.',
                'Istirahat cukup dan hindari aktivitas berat.',
            ],
            'berat' => [
                'Segera ke IGD rumah sakit atau fasilitas kesehatan terdekat.',
                'Kemungkinan diperlukan transfusi darah — ikuti saran dokter.',
                'Jangan tunda penanganan medis.',
                'Hubungi keluarga atau pendamping untuk menemani.',
            ],
        };

        $anjuran = match ($base['level']) {
            'normal' => 'Lanjutkan pemeriksaan rutin sesuai jadwal yang dianjurkan.',
            'ringan' => 'Disarankan untuk melakukan pemeriksaan ulang Hb dalam 1 bulan atau sesuai anjuran tenaga kesehatan.',
            'sedang' => 'Segera periksakan diri ke tenaga kesehatan untuk mendapatkan penanganan yang tepat.',
            'berat'  => 'SEGERA cari pertolongan medis. Kondisi ini memerlukan penanganan segera.',
        };

        $deskripsi = $base['level'] === 'normal'
            ? "Kadar hemoglobin (Hb) Anda {$hb} g/dL, dalam batas normal."
            : "Kadar hemoglobin (Hb) Anda {$hb} g/dL, menunjukkan " . strtolower($base['kategori']) . '.';

        return array_merge($base, [
            'deskripsi' => $deskripsi,
            'konseling' => $konseling,
            'anjuran'   => $anjuran,
        ]);
    }

    /**
     * Trimester kehamilan berdasarkan data identitas (ch_user) user terkait.
     * Skrining ini hanya dilakukan sekali di awal, jadi belum tentu ada
     * riwayat kunjungan ANC — trimester diperkirakan dari rentang
     * gestationalAge yang diisi user di form Identitas.
     * Return null kalau user tidak sedang hamil.
     */
    private function trimesterFromChUser(): ?int
    {
        $chUser = $this->user?->chUser;

        if (!$chUser || $chUser->statusPregnant !== 'hamil') {
            return null;
        }

        $range = $chUser->gestationalAge;

        if (!$range || !str_contains($range, '-')) {
            return 1; // data tidak lengkap, anggap trimester awal
        }

        [$start, $end] = array_map('intval', explode('-', $range));

        return $this->trimesterFromWeeks((int) round(($start + $end) / 2));
    }
}