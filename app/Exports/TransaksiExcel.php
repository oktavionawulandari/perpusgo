<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class TransaksiExcel implements FromView
{
    public function view(): View
    {
        return view('transaksi.export-transaksi', [
            'transaksis' => Transaksi::all()
        ]);
    }
}