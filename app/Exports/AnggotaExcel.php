<?php

namespace App\Exports;

use App\Models\Anggota;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AnggotaExcel implements FromView
{
    public function view(): View
    {
        return view('anggota.export-anggota', [
            'anggotas' => User::all()->where('mode_tampil', "show")
        ]);
    }
}