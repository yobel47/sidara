<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Home extends Component
{
    public string $userName    = 'Aisyah';
    public int    $notifCount  = 2;

    // Data dummy — nanti diganti query dari database
    public ?string $pregnancyWeek = '28';
    public ?string $ancVisitCount = '4';
    public ?string $nextVisitDate = '12 Jul';
    public ?array  $lastAncVisit  = [
        'date'      => '15 Juni 2025',
        'bidan'     => 'Bidan Sari',
        'puskesmas' => 'Puskesmas Menanggal',
    ];
    public ?string $dailyTip = 'Konsumsi makanan kaya zat besi seperti bayam, kacang-kacangan, dan daging merah untuk mencegah anemia selama kehamilan.';

    public function navigate(string $route): void
    {
        $this->redirect(route($route), navigate: true);
    }

    public function goToNotifications(): void
    {
        $this->redirect(route('notifikasi'), navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.home')
            ->layout('layouts.app', ['pageTitle' => 'Beranda']);
    }
}