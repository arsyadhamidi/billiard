<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegistrasiController extends Controller
{
    public function index()
    {
        return view('auth.registrasi');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email:dns|unique:users,email|max:100',
            'password' => 'required|min:3|max:10',
            'telp' => 'required|max:15',
        ], [
            'name.required'     => 'Nama wajib diisi.',
            'name.max'          => 'Nama tidak boleh lebih dari 100 karakter.',

            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'email.dns'         => 'Email harus valid dan memiliki domain yang benar.',
            'email.unique'      => 'Email sudah digunakan.',
            'email.max'         => 'Email tidak boleh lebih dari 100 karakter.',

            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 3 karakter.',
            'password.max'      => 'Password maksimal 10 karakter.',

            'telp.required'     => 'Nomor telepon wajib diisi.',
            'telp.max'          => 'Nomor telepon maksimal 15 karakter.',
        ]);

        $carbons = Carbon::now();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => $carbons,
            'level_id' => '2',
            'password' => bcrypt($request->password),
            'telp' => $request->telp,
        ]);

        return redirect()->route('login')->with('success', 'Selamat ! Anda berhasil membuat akun baru di RK87 Billiard');
    }
}
