<?php

namespace App\Http\Controllers;

use App\Exports\AnggotaExcel;
use App\Models\Anggota;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggotas = Anggota::where('mode_tampil', "show")->get();
        return view('anggota.index', compact('anggotas'));
    }
    public function create()
    {
        $prodis = Prodi::all();
        return view('anggota.create', compact('prodis'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'nim' => 'required|string|max:10|unique:tb_anggota,nim',
            'nama_anggota' => 'required|string|max:50',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required|string|max:100',
            'no_hp' => 'required|string|max:12',
            'email' => 'required|string|max:50',
            'kode_prodi' => 'required',
            'role' => 'required',
            'username' => 'required|string|max:30|unique:tb_anggota,username',
            'password' => 'required|string|max:30',
        ]);

        $anggota = Anggota::create([
            'nim' => $request->nim,
            'nama_anggota' => $request->nama_anggota,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'kode_prodi' => $request->kode_prodi,
            'role' => $request->role,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'mode_tampil' => 'show',
        ]);
        if ($anggota) {
            return redirect()
                ->route('anggota.index')
                ->with(['success' => 'Data Anggota telah berhasil ditambahkan']);
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
        $anggota = Anggota::findOrFail($id);
        $prodis = Prodi::all();
        return view('anggota.edit', compact('anggota', 'prodis'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nim' => 'required|string|max:10',
            'nama_anggota' => 'required|string|max:50',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required|string|max:100',
            'no_hp' => 'required|string|max:12',
            'email' => 'required|string|max:50',
            'kode_prodi' => 'required',
            'role' => 'required',

        ]);
        $anggota = Anggota::findOrFail($id);
        $anggota->update([
            'nim' => $request->nim,
            'nama_anggota' => $request->nama_anggota,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'kode_prodi' => $request->kode_prodi,
            'role' => $request->role,
        ]);
        if ($anggota) {
            return redirect()
                ->route('anggota.index')
                ->with(['success' => 'Data anggota telah berhasil diperbarui']);
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
        $anggota = Anggota::findOrFail($id);
        DB::table('tb_anggota')
            ->where('id_anggota', $id)
            ->update(
                ['mode_tampil' => 'hide']
            );
        if ($anggota) {
            return redirect()
                ->route('anggota.index')
                ->with(['success' => 'Data anggota telah berhasil dihapus']);
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
        $anggotas = Anggota::where('mode_tampil', "show")->get();
        $pdf = PDF::loadview('anggota.export-anggota', ['anggotas' => $anggotas]);
        return $pdf->stream('data-anggota-perpusgo.pdf');
    }

    public function cetak_excel()
    {
        return Excel::download(new AnggotaExcel, 'anggota.xlsx');
    }

    public function editProfileAnggota()
    {
        $id = Auth::guard('anggota')->user()->id_anggota;
        $anggota = Anggota::findOrFail($id);
        $prodis = Prodi::all();
        return view('anggota.edit-profile', compact('anggota', 'prodis'));
    }
    public function updateprofile(Request $request, $id)
    {
        $this->validate($request, [
            'nim' => 'required|string|max:10',
            'nama_anggota' => 'required|string|max:50',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required|string|max:100',
            'no_hp' => 'required|string|max:12',
            'email' => 'required|string|max:50',
            'kode_prodi' => 'required',
            'username' => 'required|string|max:30',
            'role' => 'required',
        ]);
        $anggota = Anggota::findOrFail($id);
        $anggota->update([
            'nim' => $request->nim,
            'nama_anggota' => $request->nama_anggota,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'kode_prodi' => $request->kode_prodi,
            'username' => $request->username,
            'role' => $request->role
        ]);
        if ($anggota) {
            return redirect()
                ->route('anggota.edit-profile')
                ->with(['success' => 'Profile Anda telah berhasil diperbarui']);
        } else {
            return back()
                ->withInput()
                ->with([
                    'error' => 'Terjadi kesalahan, silahkan coba kembali'
                ]);
        }
    }

    public function ubahPassword()
    {
        return view('anggota.ubah-password');
    }
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required|string|min:8|max:30',
            'newpassword' => 'required|string|min:8|max:30',
        ]);
        $id = Auth::guard('anggota')->user()->id_anggota;
        $anggota = Anggota::findOrFail($id);
        if (Hash::check($request->input('oldpassword'), $anggota->password)) {
            $anggota->update([
                'password' => bcrypt($request->newpassword)
            ]);
            if ($anggota) {
                return back()
                    ->with(['success' => 'Password Anda telah berhasil diperbarui']);
            } else {
                return back()
                    ->withInput()
                    ->with([
                        'error' => 'Terjadi kesalahan, silahkan coba kembali'
                    ]);
            }
        }
        return back()
            ->withInput()
            ->with([
                'error' => 'Password lama yang Anda masukkan salah, silahkan coba kembali'
            ]);
    }
}