<?php

namespace App\Models\Concerns;

trait ClassifiesAnemia
{
    /**
     * Klasifikasi kadar Hb menjadi kategori anemia sesuai kelompok.
     * $trimester: 1/2/3 untuk ibu hamil, null untuk wanita tidak hamil.
     */
    protected function classifyAnemia(float $hb, ?int $trimester): array
    {
        $tiers = match ($trimester) {
            1, 3 => [
                ['min' => 11.0, 'label' => 'Normal', 'level' => 'normal', 'warna' => 'green',  'batasNormal' => '≥ 11,0 g/dL'],
                ['min' => 10.0, 'label' => 'Ringan',  'level' => 'ringan', 'warna' => 'yellow', 'batasNormal' => '10,0–10,9 g/dL'],
                ['min' => 7.0,  'label' => 'Sedang',  'level' => 'sedang', 'warna' => 'orange', 'batasNormal' => '7,0–9,9 g/dL'],
                ['min' => 0,    'label' => 'Berat',   'level' => 'berat',  'warna' => 'red',    'batasNormal' => '< 7,0 g/dL'],
            ],
            2 => [
                ['min' => 10.5, 'label' => 'Normal', 'level' => 'normal', 'warna' => 'green',  'batasNormal' => '≥ 10,5 g/dL'],
                ['min' => 9.5,  'label' => 'Ringan',  'level' => 'ringan', 'warna' => 'yellow', 'batasNormal' => '9,5–10,4 g/dL'],
                ['min' => 7.0,  'label' => 'Sedang',  'level' => 'sedang', 'warna' => 'orange', 'batasNormal' => '7,0–9,4 g/dL'],
                ['min' => 0,    'label' => 'Berat',   'level' => 'berat',  'warna' => 'red',    'batasNormal' => '< 7,0 g/dL'],
            ],
            default => [ // Wanita tidak hamil (≥ 15 tahun)
                ['min' => 12.0, 'label' => 'Normal', 'level' => 'normal', 'warna' => 'green',  'batasNormal' => '≥ 12,0 g/dL'],
                ['min' => 11.0, 'label' => 'Ringan',  'level' => 'ringan', 'warna' => 'yellow', 'batasNormal' => '11,0–11,9 g/dL'],
                ['min' => 8.0,  'label' => 'Sedang',  'level' => 'sedang', 'warna' => 'orange', 'batasNormal' => '8,0–10,9 g/dL'],
                ['min' => 0,    'label' => 'Berat',   'level' => 'berat',  'warna' => 'red',    'batasNormal' => '< 8,0 g/dL'],
            ],
        };

        $tier = collect($tiers)->first(fn ($t) => $hb >= $t['min']);

        return [
            'kategori'    => $tier['level'] === 'normal' ? 'Normal' : 'Anemia ' . $tier['label'],
            'label'       => $tier['label'],
            'level'       => $tier['level'],
            'warna'       => $tier['warna'],
            'batasNormal' => $tier['batasNormal'],
        ];
    }

    /**
     * Trimester dari usia kehamilan dalam minggu.
     * Trimester I: 0-12, II: 13-27, III: 28-39.
     */
    protected function trimesterFromWeeks(?int $weeks): int
    {
        $weeks ??= 0;

        return match (true) {
            $weeks <= 12 => 1,
            $weeks <= 27 => 2,
            default      => 3,
        };
    }
}
