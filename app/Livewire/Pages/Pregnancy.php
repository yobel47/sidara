<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Pregnancy as PregnancyModel;
use Carbon\Carbon;

class Pregnancy extends Component
{
    public ?array $ringkasan  = null;
    public array  $kunjungan  = [];

    public function mount(): void
    {
        $visits = PregnancyModel::where('id_user', auth()->id())
            ->orderBy('date_pregnancy')
            ->get();

        if ($visits->isEmpty()) {
            return;
        }

        $latest      = $visits->last();
        $today       = Carbon::today();
        $lastDate    = Carbon::parse($latest->date_pregnancy);
        $daysElapsed = $lastDate->diffInDays($today);

        $currentWeeks = $latest->gestational_age + intdiv($daysElapsed, 7);
        $currentDays  = $daysElapsed % 7;

        $dueDate = $lastDate->copy()->addWeeks(40 - $latest->gestational_age);

        $usiaKehamilan = $currentWeeks . ' minggu';
        if ($currentDays > 0) {
            $usiaKehamilan .= ' ' . $currentDays . ' hari';
        }

        $diag = $latest->diagnosis;

        $this->ringkasan = [
            'usiaKehamilan'      => $usiaKehamilan,
            'taksiranPersalinan' => $dueDate->translatedFormat('d F Y'),
            'jumlahKunjungan'    => $visits->count(),
            'hemoglobinTerakhir' => $latest->hemoglobin,
            'statusAnemia'       => $diag['kategori'],
            'warnaStatus'        => $diag['warna'],
        ];

        $this->kunjungan = $visits->sortByDesc('date_pregnancy')
            ->map(function ($v) {
                $d = $v->diagnosis;
                return [
                    'id'            => $v->id_pregnancy,
                    'tanggal'       => $v->date_pregnancy->translatedFormat('d F Y'),
                    'usiaKehamilan' => $v->gestational_age,
                    'hemoglobin'    => $v->hemoglobin,
                    'weight'        => $v->weight,
                    'statusAnemia'  => $d['kategori'],
                    'warnaStatus'   => $d['warna'],
                    'labelStatus'   => $d['label'],
                ];
            })->values()->toArray();
    }

    public function render()
    {
        return view('livewire.pages.pregnancy')
            ->layout('layouts.app', ['pageTitle' => 'Kehamilan']);
    }
}
