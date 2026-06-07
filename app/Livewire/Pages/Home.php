<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Pregnancy;

class Home extends Component
{
    public string  $userName    = '';
    public ?array  $lastAncVisit = null;
    public string  $dailyTip    = '';

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
        $user = auth()->user();
        $this->userName = $user->chUser->fullname ?? $user->name ?? 'Bunda';

        $latestAnc = Pregnancy::where('id_user', $user->id)
            ->latest('created_at')
            ->first();

        if ($latestAnc) {
            $this->lastAncVisit = [
                'date'           => $latestAnc->date_pregnancy->translatedFormat('d F Y'),
                'gestationalAge' => $latestAnc->gestational_age,
                'hemoglobin'     => $latestAnc->hemoglobin,
            ];
        }

        $this->dailyTip = self::TIPS[date('N') % count(self::TIPS)];
    }

    public function navigate(string $route): void
    {
        $this->redirect(route($route), navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.home')
            ->layout('layouts.app', ['pageTitle' => 'Beranda']);
    }
}
