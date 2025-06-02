<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use Illuminate\Http\Request;

class AdminMejaController extends Controller
{
    public function index()
    {
        $mejas = Meja::orderBy('id', 'desc')->get();
        return view('admin.meja.index', [
            'mejas' => $mejas,
        ]);
    }

    public function create()
    {
        return view('admin.meja.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_meja' => 'required|max:20',
            'status' => 'required|in:1,2,3',
            'lokasi' => 'required|max:20',
        ], [
            'no_meja.required' => 'Nomor meja wajib diisi.',
            'no_meja.max' => 'Nomor meja tidak boleh lebih dari 20 karakter.',

            'status.required' => 'Status meja wajib dipilih.',
            'status.in' => 'Status yang dipilih tidak valid. (1=available, 2=booked, 3=ongoing)',

            'lokasi.required' => 'Lokasi meja wajib diisi.',
            'lokasi.max' => 'Lokasi tidak boleh lebih dari 20 karakter.',
        ]);

        Meja::create([
            'no_meja' => $request->no_meja,
            'status' => $request->status,
            'lokasi' => $request->lokasi,
        ]);

        return redirect()->route('data-meja.index')->with('success', 'Selamat ! Anda berhasil membuat data meja!');
    }

    public function edit($id)
    {
        $mejas = Meja::where('id', $id)->first();
        return view('admin.meja.edit', [
            'mejas' => $mejas,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_meja' => 'required|max:20',
            'status' => 'required|in:1,2,3',
            'lokasi' => 'required|max:20',
        ], [
            'no_meja.required' => 'Nomor meja wajib diisi.',
            'no_meja.max' => 'Nomor meja tidak boleh lebih dari 20 karakter.',

            'status.required' => 'Status meja wajib dipilih.',
            'status.in' => 'Status yang dipilih tidak valid. (1=available, 2=booked, 3=ongoing)',

            'lokasi.required' => 'Lokasi meja wajib diisi.',
            'lokasi.max' => 'Lokasi tidak boleh lebih dari 20 karakter.',
        ]);

        $mejas = Meja::where('id', $id)->first();

        $mejas->update([
            'no_meja' => $request->no_meja,
            'status' => $request->status,
            'lokasi' => $request->lokasi,
        ]);

        return redirect()->route('data-meja.index')->with('success', 'Selamat ! Anda berhasil memperbaharui data meja!');
    }

    public function destroy($id)
    {
        $mejas = Meja::where('id', $id)->first();

        $mejas->delete();

        return back()->with('success', 'Selamat ! Anda berhasil menghapus data meja!');
    }
}
