<?php

namespace App\Exports;

use App\Models\Buku;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BukuExcel implements FromView
{
    public function view(): View
    {
        return view('buku.export-buku', [
            'bukus' => Buku::all()->where('mode_tampil', "show")
        ]);
    }
}