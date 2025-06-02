<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminPaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::orderBy('id', 'desc')->get();
        return view('admin.paket.index', [
            'pakets' => $pakets,
        ]);
    }

    public function create()
    {
        return view('admin.paket.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'deskripsi' => 'required|max:500',
            'harga' => 'required|integer|min:0',
            'durasi' => 'required|integer|min:0',
        ], [
            'nama.required' => 'Nama paket wajib diisi.',
            'nama.max' => 'Nama paket maksimal 100 karakter.',

            'deskripsi.required' => 'Deskripsi paket wajib diisi.',
            'deskripsi.max' => 'Deskripsi maksimal 500 karakter.',

            'harga.required' => 'Harga paket wajib diisi.',
            'harga.integer' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh negatif.',

            'durasi.required' => 'Durasi paket wajib diisi.',
            'durasi.integer' => 'Durasi harus berupa angka.',
            'durasi.min' => 'Durasi tidak boleh negatif.',
        ]);

        Paket::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'durasi' => $request->durasi,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
        ]);

        return redirect()->route('data-paket.index')->with('success', 'Selamat! Anda berhasil membuat data paket!');
    }


    public function edit($id)
    {
        $pakets = Paket::where('id', $id)->first();
        return view('admin.paket.edit', [
            'pakets' => $pakets,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'deskripsi' => 'required|max:500',
            'harga' => 'required|integer|min:0',
            'durasi' => 'required|integer|min:0',
        ], [
            'nama.required' => 'Nama paket wajib diisi.',
            'nama.max' => 'Nama paket maksimal 100 karakter.',

            'deskripsi.required' => 'Deskripsi paket wajib diisi.',
            'deskripsi.max' => 'Deskripsi maksimal 500 karakter.',

            'harga.required' => 'Harga paket wajib diisi.',
            'harga.integer' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh negatif.',

            'durasi.required' => 'Durasi paket wajib diisi.',
            'durasi.integer' => 'Durasi harus berupa angka.',
            'durasi.min' => 'Durasi tidak boleh negatif.',
        ]);

        $pakets = Paket::where('id', $id)->first();

        $pakets->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'durasi' => $request->durasi,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
        ]);

        return redirect()->route('data-paket.index')->with('success', 'Selamat! Anda berhasil memperbaharui data paket!');
    }

    public function destroy($id)
    {
        $pakets = Paket::where('id', $id)->first();

        $pakets->delete();

        return back()->with('success', 'Selamat! Anda berhasil menghapus data paket!');
    }
}
