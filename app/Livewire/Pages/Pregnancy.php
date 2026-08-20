<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Pregnancy as PregnancyModel;
use App\Models\Childbirth;
use App\Models\Baby;
use Carbon\Carbon;

class Pregnancy extends Component
{
    public ?array $ringkasan  = null;
    public array  $kunjungan  = [];

    private function isNotPregnant(): bool
    {
        $userId = auth()->id();
        $user   = auth()->user();
        $hasBirth = Childbirth::where('id_user', $userId)->exists();
        $hasBaby  = Baby::where('id_user', $userId)->exists();
        $isHamil  = $user->chUser && $user->chUser->statusPregnant === 'hamil';
        return !($hasBirth && $hasBaby) && !$isHamil;
    }

    public function mount(): void
    {
        if ($this->isNotPregnant()) {
            $this->redirect(route('home'), navigate: true);
            return;
        }

        // Descending: visit terbaru di index 0
        $visits = PregnancyModel::where('id_user', auth()->id())
            ->orderByDesc('date_pregnancy')
            ->orderByDesc('created_at') // untuk jaga-jaga kalau ada 2 visit di hari yang sama
            ->get();

        if ($visits->isEmpty()) {
            return;
        }

        $latest      = $visits->first(); // terbaru karena desc
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

        // Sudah desc dari query, tinggal map
        $this->kunjungan = $visits->map(function ($v) {
                $d = $v->diagnosis;
                return [
                    'id'                 => $v->id_pregnancy,
                    'tanggal'            => $v->date_pregnancy->translatedFormat('d F Y'),
                    'usiaKehamilan'      => $v->gestational_age,
                    'hpht'               => $v->hpht?->translatedFormat('d F Y'),
                    'hemoglobin'         => $v->hemoglobin,
                    'weight'             => $v->weight,
                    'height'             => $v->height,
                    'systolic'           => $v->systolic,
                    'diastolic'          => $v->diastolic,
                    'lila'               => $v->lila,
                    'tookIronSupplement' => $v->took_iron_supplement,
                    'statusAnemia'       => $d['kategori'],
                    'warnaStatus'        => $d['warna'],
                    'labelStatus'        => $d['label'],
                ];
            })->values()->toArray();
    }

    public function render()
    {
        return view('livewire.pages.pregnancy')
            ->layout('layouts.app', ['pageTitle' => 'Kehamilan']);
    }
}