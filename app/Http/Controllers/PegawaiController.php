<?php

namespace App\Http\Controllers;

use App\Exports\PegawaiExcel;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function Symfony\Component\String\b;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = User::where('mode_tampil', "show")->get();
        return view('pegawai.index', compact('pegawais'));
    }
    public function create()
    {
        return view('pegawai.create', [
            'pegawais' => User::all()
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'nip' => 'required|string|max:10|unique:user,nip',
            'nama' => 'required|string|max:50',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required|string|max:100',
            'no_hp' => 'required|string|max:12',
            'email' => 'required|string|max:50',
            'role' => 'required',
            'username' => 'required|string|max:30|unique:user,username',
            'password' => 'required|string|min:8|max:30',
        ]);

        $pegawai = User::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'role' => $request->role,
            'username' => $request->username,
            'password' => bcrypt($request->password)
        ]);
        if ($pegawai) {
            return redirect()
                ->route('pegawai.index')
                ->with(['success' => 'Data Pegawai telah berhasil ditambahkan']);
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
        $pegawai = User::findOrFail($id);
        return view('pegawai.edit', compact('pegawai'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nip' => 'required|string|max:10',
            'nama' => 'required|string|max:50',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required|string|max:100',
            'no_hp' => 'required|string|max:12',
            'email' => 'required|string|max:50',
            'role' => 'required',
        ]);
        $pegawai = User::findOrFail($id);
        $pegawai->update([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'role' => $request->role
        ]);
        if ($pegawai) {
            return redirect()
                ->route('pegawai.index')
                ->with(['success' => 'Data Pegawai telah berhasil diperbarui']);
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
        $pegawai = User::findOrFail($id);
        DB::table('user')
            ->where('id_pegawai', $id)
            ->update(
                ['mode_tampil' => 'hide']
            );
        if ($pegawai) {
            return redirect()
                ->route('pegawai.index')
                ->with(['success' => 'Data pegawai telah berhasil dihapus']);
        } else {
            return redirect()
                ->route('pegawai.index')
                ->with(['error' => 'Error! Silakan coba kembali']);
        }
    }

    public function cetak_pdf()
    {
        $pegawai = User::where('mode_tampil', "show")->get();
        $pdf = PDF::loadview('pegawai.export-pegawai', ['pegawais' => $pegawai]);
        return $pdf->stream('data-pegawai-perpusgo.pdf');
    }

    public function cetak_excel()
    {
        return Excel::download(new PegawaiExcel, 'pegawai.xlsx');
    }
    public function editProfile()
    {
        $id = Auth::guard('user')->user()->id_pegawai;
        $pegawai = User::findOrFail($id);
        return view('pegawai.edit-profile', compact('pegawai'));
    }
    
    public function updateprofile(Request $request, $id)
    {
        $this->validate($request, [
            'nip' => 'required|string|max:10',
            'nama' => 'required|string|max:50',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required|string|max:100',
            'no_hp' => 'required|string|max:12',
            'email' => 'required|string|max:50',
            'username' => 'required|string|max:30',
            'role' => 'required',
        ]);
        $pegawai = User::findOrFail($id);
        $pegawai->update([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'username' => $request->username,
            'role' => $request->role
        ]);
        if ($pegawai) {
            return redirect()
                ->route('pegawai.editprofile')
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
        return view('pegawai.ubah-password');
    }
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required|string|min:8|max:30',
            'newpassword' => 'required|string|min:8|max:30',
        ]);
        $id = Auth::guard('user')->user()->id_pegawai;
        $pegawai = User::findOrFail($id);
        if (Hash::check($request->input('oldpassword'), $pegawai->password)) {
            $pegawai->update([
                'password' => bcrypt($request->newpassword)
            ]);
            if ($pegawai) {
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