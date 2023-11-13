<?php

namespace App\Http\Controllers;

use App\Exports\BukuExcel;
use App\Models\Buku;
use App\Models\KategoriBuku;
use App\Models\Penerbit;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::where('mode_tampil', "show")->get();
        return view('buku.index', compact('bukus'));
    }
    public function create()
    {
        $penerbits = Penerbit::all();
        $kategoris = KategoriBuku::all();
        return view('buku.create', compact('penerbits', 'kategoris'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'isbn' => 'required|string|max:13|unique:tb_buku,isbn',
            'judul_buku' => 'required|string|max:100',
            'nama_penulis' => 'required|string|max:100',
            'tahun_terbit' => 'required|date_format:Y',
            'jumlah' => 'required|digits_between:1,100',
            'deskripsi' => 'required|string|max:200',
            'kode_penerbit' => 'required',
            'kode_kategori' => 'required',

        ]);

        $buku = Buku::create([
            'isbn' => $request->isbn,
            'judul_buku' => $request->judul_buku,
            'nama_penulis' => $request->nama_penulis,
            'tahun_terbit' => $request->tahun_terbit,
            'jumlah' => $request->jumlah,
            'deskripsi' => $request->deskripsi,
            'kode_penerbit' => $request->kode_penerbit,
            'kode_kategori' => $request->kode_kategori
        ]);
        if ($buku) {
            return redirect()
                ->route('buku.index')
                ->with(['success' => 'Data buku telah berhasil ditambahkan']);
        } else {
            return back()
                ->withInput()
                ->with([
                    'error' => 'Terjadi kesalahan, silahkan coba kembali'
                ]);
        }
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $penerbits = Penerbit::all();
        $kategoris = KategoriBuku::all();
        return view('buku.edit', compact('buku', 'penerbits', 'kategoris'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'isbn' => 'required|string|max:13',
            'judul_buku' => 'required|string|max:100',
            'nama_penulis' => 'required|string|max:100',
            'tahun_terbit' => 'required|date_format:Y',
            'jumlah' => 'required|digits_between:1,100',
            'deskripsi' => 'required|string|max:200',
            'kode_penerbit' => 'required',
            'kode_kategori' => 'required',

        ]);
        $buku = Buku::findOrFail($id);
        $buku->update([
            'isbn' => $request->isbn,
            'judul_buku' => $request->judul_buku,
            'nama_penulis' => $request->nama_penulis,
            'kode_penerbit' => $request->kode_penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'jumlah' => $request->jumlah,
            'kode_kategori' => $request->kode_kategori,
            'deskripsi' => $request->deskripsi
        ]);
        if ($buku) {
            return redirect()
                ->route('buku.index')
                ->with(['success' => 'Data Buku telah berhasil diperbarui']);
        } else {
            return back()
                ->withInput()
                ->with([
                    'error' => 'Terjadi kesalahan, silahkan coba kembali'
                ]);
        }
    }
    public function hapus($id)
    {
        $buku = Buku::findOrFail($id);
        DB::table('tb_buku')
            ->where('id_buku', $id)
            ->update(
                ['mode_tampil' => 'hide']
            );
        if ($buku) {
            return redirect()
                ->route('buku.index')
                ->with(['success' => 'Data buku telah berhasil dihapus']);
        } else {
            return back()
                ->withInput()
                ->with([
                    'error' => 'Terjadi kesalahan, silahkan coba kembali'
                ]);
        }
    }
    public function cetak_pdf()
    {
        $bukus = Buku::where('mode_tampil', "show")->get();
        $pdf = PDF::loadview('buku.export-buku', ['bukus' => $bukus]);
        return $pdf->stream('data-buku-perpusgo.pdf');
    }
    public function cetak_excel()
    {
        return Excel::download(new BukuExcel, 'buku.xlsx');
    }

    public function bukuAnggota()
    {
        $bukus = Buku::latest()->get();
        return view('buku.index-buku-anggota', compact('bukus'));
    }
}