<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiExcel;
use App\Mail\PerpusGoMail;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::where('status_peminjaman', "dipinjam")->get();
        return view('transaksi.index', compact('transaksis'));
    }
    public function create()
    {
        $anggotas = Anggota::where('mode_tampil', "show")->get();
        $bukus = Buku::where('mode_tampil', "show")->get();
        $tgl_pinjam = date('Y-m-d');
        $tujuh_hari = mktime(0, 0, 0, date("n"), date("j") + 7, date("Y"));
        $tgl_kembali = date('Y-m-d', $tujuh_hari);
        return view('transaksi.create', compact('anggotas', 'bukus', 'tgl_pinjam', 'tgl_kembali'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_buku' => 'required',
            'id_anggota' => 'required',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date',
            'status_peminjaman' => 'required',
            'denda' => 'required',
        ]);
        $id_buku = $request->id_buku;
        $buku = Buku::findOrFail($id_buku);
        $jml = $buku->jumlah;
        if ($jml > 0) {
            $transaksi = Transaksi::create([
                'id_buku' => $request->id_buku,
                'id_anggota' => $request->id_anggota,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_kembali' => $request->tanggal_kembali,
                'status_peminjaman' => $request->status_peminjaman,
                'denda' => $request->denda
            ]);
            DB::table('tb_buku')
                ->where('id_buku', $id_buku)
                ->update(
                    ['jumlah' => ($jml - 1)]
                );
            if ($transaksi) {
                return redirect()
                    ->route('transaksi.index')
                    ->with(['success' => 'Peminjaman buku telah berhasil ditambahkan']);
            } else {
                return back()
                    ->withInput()
                    ->with([
                        'error' => 'Terjadi kesalahan, silahkan coba kembali'
                    ]);
            }
        } else {
            return back()
                ->withInput()
                ->with([
                    'error' => 'Buku tidak tersedia, silahkan pinjam buku yang lain'
                ]);
        }
    }
    //Fungsi Perpanjang Peminjaman (Terdapat dua parameter yang diambil: $id,$hari)
    public function perpanjang($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $tgl_pinjam = $transaksi->tanggal_pinjam;
        $pinjam = date_create($tgl_pinjam);
        $tgl_sekarang = date_create(date('Y-m-d'));
        $hari = date_diff($pinjam, $tgl_sekarang)->d;
        //membuat data yang akan diupdate

        if ($hari > 7) {
            return back()
                ->with([
                    'error' => 'Perpanjangan tidak dapat dilakukan karena waktu peminjaman melebihi 7 hari'
                ]);
        } else {
            $tgl_pinjamnew = date('Y-m-d');
            $tujuh_hari = mktime(0, 0, 0, date("n"), date("j") + 7, date("Y"));
            $tgl_kembalinew = date('Y-m-d', $tujuh_hari);


            //menampung data yang akan diupdate
            $dataperpanjang = array(
                'tanggal_pinjam' => $tgl_pinjamnew,
                'tanggal_kembali' => $tgl_kembalinew
            );
            //mengupdate tabel transaksi dan tabel buku
            DB::table('tb_transaksi')
                ->where('id_transaksi', $id)
                ->update($dataperpanjang);

            //pengecekan
            if ($transaksi) {
                return redirect()
                    ->route('transaksi.index')
                    ->with(['success' => 'Peminjaman buku telah berhasil diperpanjang']);
            } else {
                return back()
                    ->withInput()
                    ->with([
                        'error' => 'Terjadi kesalahan, silahkan coba kembali'
                    ]);
            }
        }
    }

    //Fungsi Pengembalian Transaksi (Terdapat 3 parameter yang diambil $id,$denda,$id_buku)
    public function kembali($id, $denda, $id_buku)
    {
        $transaksi = Transaksi::findOrFail($id)->where('status_peminjaman', "dikembalikan");
        //membuat data yang akan diupdate
        $tgl_kembali = date('Y-m-d');
        $buku = Buku::findOrFail($id_buku);
        $jml = $buku->jumlah;
        //menampung data yang akan diupdate
        $datapengembalian = array(
            'status_peminjaman' => 'dikembalikan',
            'tanggal_kembali' => $tgl_kembali,
            'denda' => $denda
        );
        //mengupdate tabel transaksi dan tabel buku
        DB::table('tb_transaksi')
            ->where('id_transaksi', $id)
            ->update($datapengembalian);
        DB::table('tb_buku')
            ->where('id_buku', $id_buku)
            ->update(
                ['jumlah' => ($jml + 1)]
            );
        //pengecekan
        if ($transaksi) {
            return redirect()
                ->route('transaksi.index')
                ->with(['success' => 'Buku telah dikembalikan']);
        } else {
            return back()
                ->withInput()
                ->with([
                    'error' => 'Terjadi kesalahan, silahkan coba kembali'
                ]);
        }
    }

    public function transaksipdf()
    {
        $transaksis = Transaksi::all();
        $pdf = PDF::loadview('transaksi.export-transaksi', ['transaksis' => $transaksis]);
        return $pdf->stream('laporan-transaksi.pdf');
    }

    public function transaksiexcel()
    {
        return Excel::download(new TransaksiExcel, 'transaksi.xlsx');
    }

    public function kirim_email($id, $denda, $id_buku, $id_anggota)
    {
        $transaksi = Transaksi::findOrFail($id);
        $buku = Buku::findOrFail($id_buku);
        $anggota = Anggota::findOrFail($id_anggota);
        //menghitung jumlah terlambat
        $kembali = date_create($transaksi->tanggal_kembali);
        $tgl_sekarang = date_create(date('Y-m-d'));
        $selisih = date_diff($kembali, $tgl_sekarang);
        $lambat = $selisih->format("%R%a");
        $tgl_pinjam = $transaksi->tanggal_pinjam;
        $nama = $anggota->nama_anggota;
        $email = $anggota->email;
        $judul = $buku->judul_buku;

        $data = [

            'nama' => $nama,
            'judul_buku' => $judul,
            'tgl_pinjam' => $tgl_pinjam,
            'lambat' => $lambat,
            'denda' => $denda

        ];
        Mail::to($email)->send(new PerpusGoMail($data));
        return redirect()
            ->route('transaksi.index')
            ->with(['success' => 'Notifikasi berhasil dikirimkan']);
    }

    public function transaksiAnggota()
    {
        $id = Auth::guard('anggota')->user()->id_anggota;
        $transaksis = Transaksi::latest()->where('id_anggota', $id)->get();
        return view('transaksi.index-transaksi-anggota', compact('transaksis'));
    }
}