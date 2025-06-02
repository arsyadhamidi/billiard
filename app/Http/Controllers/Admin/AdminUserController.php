<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view('admin.users.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|max:100|unique:users,email',
            'level_id' => 'required|max:5',
            'telp' => 'required|max:15',
            'foto_profile' => 'nullable|max:10248|mimes:png,jpg,jpeg',
        ], [
            'name.required' => 'Nama Lengkap wajib diisi',
            'name.max' => 'Nama Lengkap maksimal 100 karakter',

            'email.required' => 'Alamat Email wajib diisi',
            'email.max' => 'Alamat Email maksimal 100 karakter',
            'email.unique' => 'Alamat Email sudah tersedia',

            'level_id.required' => 'Role wajib diisi',
            'level_id.max' => 'Role maksimal 5 karakter',

            'telp.required' => 'Telepon wajib diisi',
            'telp.max' => 'Telepon maksimal 15 karakter',

            'foto_profile.max' => 'Photo Profile maksimal 10 MB',
            'foto_profile.mimes' => 'Photo Profile harus memiliki format PNG, JPG, atau JPEG',
        ]);

        $carbons = Carbon::now();

        $fotoProfile = null;
        if ($request->file('foto_profile')) {
            $fotoProfile = $request->file('foto_profile')->store('foto_profile');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => $carbons,
            'level_id' => $request->level_id,
            'password' => bcrypt('12345'),
            'telp' => $request->telp,
            'foto_profile' => $fotoProfile,
        ]);

        return redirect()->route('data-users.index')->with('success', 'Selamat ! Anda berhasil menambahkan data users registrasi');
    }

    public function edit($id)
    {
        $users = User::where('id', $id)->first();
        return view('admin.users.edit', [
            'users' => $users,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|max:100|unique:users,email',
            'level_id' => 'required|max:5',
            'telp' => 'required|max:15',
            'foto_profile' => 'nullable|max:10248|mimes:png,jpg,jpeg',
        ], [
            'name.required' => 'Nama Lengkap wajib diisi',
            'name.max' => 'Nama Lengkap maksimal 100 karakter',

            'email.required' => 'Alamat Email wajib diisi',
            'email.max' => 'Alamat Email maksimal 100 karakter',
            'email.unique' => 'Alamat Email sudah tersedia',

            'level_id.required' => 'Role wajib diisi',
            'level_id.max' => 'Role maksimal 5 karakter',

            'telp.required' => 'Telepon wajib diisi',
            'telp.max' => 'Telepon maksimal 15 karakter',

            'foto_profile.max' => 'Photo Profile maksimal 10 MB',
            'foto_profile.mimes' => 'Photo Profile harus memiliki format PNG, JPG, atau JPEG',
        ]);

        $users = User::where('id', $id)->first();

        $fotoProfile = null;
        if ($request->file('foto_profile')) {
            if ($users->foto_profile) {
                Storage::delete($users->foto_profile);
            }
            $fotoProfile = $request->file('foto_profile')->store('foto_profile');
        } else {
            $fotoProfile = $users->foto_profile;
        }

        $users->update([
            'name' => $request->name,
            'email' => $request->email,
            'level_id' => $request->level_id,
            'telp' => $request->telp,
            'foto_profile' => $fotoProfile,
        ]);

        return redirect()->route('data-users.index')->with('success', 'Selamat ! Anda berhasil memperbaharui data users registrasi');
    }

    public function destroy($id)
    {

        $users = User::where('id', $id)->first();

        if ($users->foto_profile) {
            Storage::delete($users->foto_profile);
        }

        $users->delete();

        return back()->with('success', 'Selamat ! Anda berhasil menghapus data users registrasi');
    }
}
