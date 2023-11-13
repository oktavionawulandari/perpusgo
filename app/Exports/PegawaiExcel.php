<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PegawaiExcel implements FromView
{
    public function view(): View
    {
        return view('pegawai.export-pegawai', [
            'pegawais' => User::all()->where('mode_tampil', "show")
        ]);
    }
}