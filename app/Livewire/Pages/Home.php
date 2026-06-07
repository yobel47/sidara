<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Pregnancy;
use App\Models\Childbirth;
use App\Models\Baby;

class Home extends Component
{
    public string $userName       = '';
    public string $pregnancyStatus = 'tidak hamil'; // 'hamil' | 'melahirkan' | 'tidak hamil'

    public ?array $lastAncVisit   = null;
    public string $dailyTip       = '';

    private const TIPS = [
        'Konsumsi makanan kaya zat besi seperti bayam, kacang-kacangan, dan daging merah untuk mencegah anemia.',
        'Minum tablet tambah darah (TTD) setiap hari, terutama malam hari sebelum tidur agar tidak mual.',
        'Perbanyak konsumsi vitamin C (jeruk, tomat) untuk membantu penyerapan zat besi.',
        'Istirahat cukup 7–8 jam per malam sangat penting untuk ibu hamil.',
        'Hindari minum teh atau kopi bersamaan dengan makanan karena menghambat penyerapan zat besi.',
        'Lakukan kunjungan ANC rutin minimal 6 kali selama kehamilan.',
        'Konsumsi asam folat sejak awal kehamilan untuk mencegah cacat tabung saraf.',
    ];

    public function mount(): void
    {
        $user   = auth()->user();
        $chUser = $user->chUser;

        $this->userName = $chUser->fullname ?? $user->name ?? 'Bunda';

        // Tentukan status kehamilan
        $userId    = $user->id;
        $hasBirth  = Childbirth::where('id_user', $userId)->exists();
        $hasBaby   = Baby::where('id_user', $userId)->exists();

        if ($hasBirth && $hasBaby) {
            $this->pregnancyStatus = 'melahirkan';
        } elseif ($chUser && $chUser->statusPregnant === 'hamil') {
            $this->pregnancyStatus = 'hamil';
        } else {
            $this->pregnancyStatus = 'tidak hamil';
        }

        // Data ANC terakhir
        $latestAnc = Pregnancy::where('id_user', $userId)
            ->latest('created_at')
            ->first();

        if ($latestAnc) {
            $diag    = $latestAnc->diagnosis;
            $daysAgo = (int) $latestAnc->date_pregnancy->diffInDays(now());
            $visitNo = Pregnancy::where('id_user', $userId)->count();

            $this->lastAncVisit = [
                'date'           => $latestAnc->date_pregnancy->translatedFormat('d F Y'),
                'gestationalAge' => $latestAnc->gestational_age,
                'hemoglobin'     => $latestAnc->hemoglobin,
                'diagKategori'   => $diag['kategori'],
                'diagWarna'      => $diag['warna'],
                'visitNumber'    => $visitNo,
                'daysAgo'        => $daysAgo,
            ];
        }

        $this->dailyTip = self::TIPS[date('N') % count(self::TIPS)];
    }

    public function render()
    {
        return view('livewire.pages.home')
            ->layout('layouts.app', ['pageTitle' => 'Beranda']);
    }
}
