<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        return view('setting.index', [
            'users' => $users,
        ]);
    }

    public function updateprofile(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'telp' => 'required|max:15',
        ], [
            'name.required' => 'Nama Lengkap wajib diisi',
            'name.max' => 'Nama Lengkap maksimal 100 karakter',

            'telp.required' => 'Nomor Telepon wajib diisi',
            'telp.max' => 'Nomor Telepon maksimal 15 karakter',
        ]);

        $users = Auth::user();

        User::where('id', $users->id)->update([
            'name' => $request->name,
            'telp' => $request->telp,
        ]);

        return back()->with('success', 'Selamat ! Anda berhasil memperbaharui data akun anda!');
    }

    public function updateemail(Request $request)
    {
        $request->validate([
            'email' => 'required|max:100|unique:users,email',
        ], [
            'email.required' => 'Alamat E-Mail wajib diisi',
            'email.max' => 'Alamat E-Mail maksimal 100 karakter',
            'email.unique' => 'Alamat E-Mail sudah tersedia',
        ]);

        $users = Auth::user();

        User::where('id', $users->id)->update([
            'email' => $request->email,
        ]);

        return back()->with('success', 'Selamat ! Anda berhasil memperbaharui E-Mail anda!');
    }

    public function updatepassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ], [
            'password.required' => 'Password wajib diisi',
        ]);

        $users = Auth::user();

        User::where('id', $users->id)->update([
            'password' => bcrypt($request->password),
        ]);

        return back()->with('success', 'Selamat ! Anda berhasil memperbaharui Password baru anda!');
    }

    public function updategambar(Request $request)
    {
        $request->validate([
            'foto_profile' => 'required|max:10248|mimes:png,jpg,jpeg',
        ], [
            'foto_profile.required' => 'Photo Profil wajib diisi',
            'foto_profile.max' => 'Photo Profil 10 MB',
            'foto_profile.mimes' => 'Photo Profil harus memiliki format PNG, JPG, atau JPEG',
        ]);

        $users = Auth::user();

        $fotoProfile = null;
        if ($request->file('foto_profile')) {
            if ($users->foto_profile) {
                Storage::delete($users->foto_profile);
            }
            $fotoProfile = $request->file('foto_profile')->store('foto_profile');
        } else {
            $fotoProfile = $users->foto_profile;
        }

        User::where('id', $users->id)->update([
            'foto_profile' => $fotoProfile,
        ]);

        return back()->with('success', 'Selamat ! Anda berhasil memperbaharui Photo Profil baru anda!');
    }

    public function hapusgambar()
    {
        $users = Auth::user();
        if ($users->foto_profile) {
            Storage::delete($users->foto_profile);
        }


        User::where('id', $users->id)->update([
            'foto_profile' => null,
        ]);

        return back()->with('success', 'Selamat ! Anda berhasil menghapus Photo Profil baru anda!');
    }
}
