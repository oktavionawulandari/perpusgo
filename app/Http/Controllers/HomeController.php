<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function homepegawai()
    {
        $data = [];

        //Menampilkan informasi rekap transaksi terlambat
        $datatransaksi = DB::table('tb_transaksi')
            ->select(DB::raw('count(id_transaksi) as jumlah'))
            ->whereRaw('status_peminjaman="dipinjam" and datediff(curdate(),tanggal_kembali)>0')
            ->get();
        foreach ($datatransaksi as $row) {
            $tr = $row->jumlah;
        }
        $data['infotransaksi'] = (int)$tr;

        //Menampilkan informasi buku
        //Menampilkan jumlah buku yang sedang dipinjam
        $databuku1 = DB::table('tb_transaksi')
            ->select(DB::raw('count(id_buku) as jmlbuku'))
            ->whereRaw('status_peminjaman="dipinjam"')
            ->get();
        foreach ($databuku1 as $row) {
            $buku1 = $row->jmlbuku;
        }

        //Menampilkan jumlah buku yang tersedia
        $databuku2 = DB::table('tb_buku')
            ->select(DB::raw('sum(jumlah) as jmlbuku'))
            ->get();
        foreach ($databuku2 as $row) {
            $buku2 = $row->jmlbuku;
        }
        $data['jmlbukudipinjam'] = (int)$buku1;
        $data['jmlbukutersedia'] = (int)$buku2;

        //Menampilkan jumlah anggota
        $dataanggota = DB::table('tb_anggota')
            ->select(DB::raw('count(id_anggota) as jmlanggota'))
            ->get();
        foreach ($dataanggota as $row) {
            $jmlanggota = $row->jmlanggota;
        }
        $data['totalanggota'] = (int)$jmlanggota;

        //Menampilkan jumlah pegawai
        $datapegawai = DB::table('user')
            ->select(DB::raw('count(id_pegawai) as jmlpegawai'))
            ->get();
        foreach ($datapegawai as $row) {
            $jmlpegawai = $row->jmlpegawai;
        }
        $data['totalpegawai'] = (int)$jmlpegawai;

        //Menampilkan Chart Anggota Per Jurusan
        $recordanggota = DB::table('tb_anggota')
            ->join('tb_prodi', 'tb_anggota.kode_prodi', '=', 'tb_prodi.kode_prodi')
            ->join('tb_jurusan', 'tb_prodi.kode_jurusan', '=', 'tb_jurusan.kode_jurusan')
            ->select(DB::raw('nama_jurusan,count(tb_prodi.kode_jurusan) as jml'))
            ->groupBy('nama_jurusan')
            ->orderBy('tb_jurusan.kode_jurusan')
            ->get();
        $chart1 = [];
        foreach ($recordanggota as $row) {
            $chart1['label'][] = $row->nama_jurusan;
            $chart1['data'][] = (int)$row->jml;
        }
        $data['chart_data1'] = json_encode($chart1);

        //Menampilkan Chart Buku Per Kategori
        $recordbuku = DB::table('tb_buku')
            ->join('tb_kategoribk', 'tb_buku.kode_kategori', '=', 'tb_kategoribk.kode_kategori')
            ->select(DB::raw('kategori,count(tb_buku.kode_kategori) as jml'))
            ->groupBy('kategori')
            ->orderBy('tb_kategoribk.kode_kategori')
            ->get();
        $chart2 = [];
        foreach ($recordbuku as $row) {
            $chart2['label'][] = $row->kategori;
            $chart2['data'][] = (int)$row->jml;
        }
        $data['chart_data2'] = json_encode($chart2);

        //Menampilkan Chart Transaksi per Bulan Tahun Sekarang
        $thn = date("Y");
        $recordtransaksi = DB::table('tb_transaksi')
            ->select(DB::raw('monthname(tanggal_pinjam) as bulan,count(tanggal_pinjam) as jml'))
            ->whereRaw('year(tanggal_pinjam)=?', $thn)
            ->groupBy('bulan')
            ->orderBy('tanggal_pinjam')
            ->get();
        $chart3 = [];
        foreach ($recordtransaksi as $row) {
            $chart3['label'][] = $row->bulan;
            $chart3['data'][] = (int)$row->jml;
        }
        $data['chart_data3'] = json_encode($chart3);

        //Menampilkan Chart Pegawai Berdasarkan Jenis Kelamin
        $recordpegawai = DB::table('user')
            ->select(DB::raw('jenis_kelamin,count(jenis_kelamin) as jml'))
            ->groupBy('jenis_kelamin')
            ->orderBy('jenis_kelamin')
            ->get();
        $chart4 = [];
        foreach ($recordpegawai as $row) {
            $chart4['label'][] = $row->jenis_kelamin;
            $chart4['data'][] = (int)$row->jml;
        }
        $data['chart_data4'] = json_encode($chart4);

        //Pengecekan role pegawai untuk diarahkan ke halaman home masing-masing
        if (Auth::guard('user')->user()->role == "Admin") {
            return view('home.home-admin', $data);
        } elseif (Auth::guard('user')->user()->role == "Pustakawan") {
            return view('home.home-pustakawan', $data);
        }
    }

    public function homeanggota()
    {
        $id_anggota = Auth::guard('anggota')->user()->id_anggota;
        $data = [];

        //Menampilkan informasi rekap transaksi terlambat anggota yang login
        $transaksiAnggota = DB::table('tb_transaksi')
            ->select(DB::raw('count(id_transaksi) as jumlah'))
            ->whereRaw('status_peminjaman="dipinjam" and datediff(curdate(),tanggal_kembali)>0 and tb_transaksi.id_anggota=?', $id_anggota)
            ->get();
        foreach ($transaksiAnggota as $row) {
            $datatr = $row->jumlah;
        }
        $data['infotransaksi_anggota'] = (int)$datatr;

        //Menampilkan informasi buku
        //Menampilkan jumlah buku yang sedang dipinjam anggota terkait
        $databuku1 = DB::table('tb_transaksi')
            ->select(DB::raw('count(id_buku) as jmlbuku'))
            ->whereRaw('status_peminjaman="dipinjam" and tb_transaksi.id_anggota=?', $id_anggota)
            ->get();
        foreach ($databuku1 as $row) {
            $bukupinjaman = $row->jmlbuku;
        }

        $data['jmlbukupinjaman'] = (int)$bukupinjaman;

        //Menampilkan Chart Buku Per Kategori
        $recordbuku = DB::table('tb_buku')
            ->join('tb_transaksi', 'tb_buku.id_buku', '=', 'tb_transaksi.id_buku')
            ->join('tb_kategoribk', 'tb_buku.kode_kategori', '=', 'tb_kategoribk.kode_kategori')
            ->select(DB::raw('kategori,count(tb_buku.kode_kategori) as jml'))
            ->whereRaw('tb_transaksi.id_anggota=?', $id_anggota)
            ->groupBy('kategori')
            ->orderBy('tb_kategoribk.kode_kategori')
            ->get();
        $chart1 = [];
        foreach ($recordbuku as $row) {
            $chart1['label'][] = $row->kategori;
            $chart1['data'][] = (int)$row->jml;
        }
        $data['chart_data1'] = json_encode($chart1);

        //Menampilkan Chart Transaksi per Bulan Tahun Sekarang Oleh Anggota yang Sedang Login
        $thn = date("Y");
        $recordtransaksi = DB::table('tb_transaksi')
            ->select(DB::raw('monthname(tanggal_pinjam) as bulan,count(tanggal_pinjam) as jml'))
            ->whereRaw('year(tanggal_pinjam)=?', $thn)
            ->whereRaw('id_anggota=?', $id_anggota)
            ->groupBy('bulan')
            ->orderBy('tanggal_pinjam')
            ->get();
        $chart2 = [];
        foreach ($recordtransaksi as $row) {
            $chart2['label'][] = $row->bulan;
            $chart2['data'][] = (int)$row->jml;
        }
        $data['chart_data2'] = json_encode($chart2);


        return view('home.home-anggota', $data);
    }
}