<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Meja;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PelangganPaketController extends Controller
{
    public function index($id)
    {
        $pakets = Paket::where('id', $id)->first();
        $mejas = Meja::where('status', '1')->get();
        $users = Auth::user();
        return view('landing.paket.index', [
            'pakets' => $pakets,
            'users' => $users,
            'mejas' => $mejas,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'users_id'     => 'required|exists:users,id',
            'meja_id'      => 'required|exists:mejas,id',
            'paket_id'     => 'required|exists:pakets,id',
            'tgl_booking'  => 'required|date',
            'waktu_mulai'  => 'required',
            'waktu_selesai'  => 'required',
        ], [
            'users_id.required'    => 'Pengguna wajib dipilih.',
            'users_id.exists'      => 'Pengguna yang dipilih tidak ditemukan.',

            'meja_id.required'     => 'Meja wajib dipilih.',
            'meja_id.exists'       => 'Meja yang dipilih tidak tersedia.',

            'paket_id.required'    => 'Paket wajib dipilih.',
            'paket_id.exists'      => 'Paket yang dipilih tidak ditemukan.',

            'tgl_booking.required' => 'Tanggal booking wajib diisi.',
            'tgl_booking.date'     => 'Format tanggal booking tidak valid.',

            'waktu_mulai.required'      => 'Waktu Mulai wajib diisi.',
            'waktu_selesai.required'      => 'Waktu Selesai wajib diisi.',
        ]);

        $pakets = Paket::where('id', $request->paket_id)->first();
        $mejas = Meja::where('id', $request->meja_id)->first();

        if ($mejas->status != 1) {
            return back()->with('error', 'Meja yang dipilih sedang tidak tersedia.');
        }

        // Simpan booking
        Booking::create([
            'users_id' => $request->users_id,
            'meja_id' => $request->meja_id,
            'paket_id' => $request->paket_id,
            'kode_booking' => strtoupper(Str::random(7)),
            'tgl_booking' => $request->tgl_booking,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'status' => '1',
            'total_harga' => $pakets->harga,
        ]);

        $mejas->update([
            'status' => '2',
        ]);

        return redirect()->route('paket.show')->with('success', 'Selamat ! Anda berhasil membuat data booking!');
    }

    public function show()
    {
        $bookings = Booking::orderBy('id', 'desc')->first();
        $users = Auth::user();
        return view('landing.paket.show', [
            'bookings' => $bookings,
            'users' => $users,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bukti_pembayaran'  => 'required|mimes:png,jpeg,jpg|max:10248',
        ], [
            'bukti_pembayaran.required'      => 'Bukti Pembayaran wajib diisi.',
            'bukti_pembayaran.mimes'      => 'Bukti Pembayaran harus memiliki format PNG, JPG, tau JPEG.',
            'bukti_pembayaran.max'      => 'Bukti Pembayaran maksimal 10 MB.',
        ]);

        $buktiPembayarans = null;

        if($request->file('bukti_pembayaran')){
            $buktiPembayarans = $request->file('bukti_pembayaran')->store('bukti_pembayaran');
        }

        $bookings = Booking::where('id', $id)->first();
        $bookings->update([
            'bukti_pembayaran' => $buktiPembayarans,
        ]);

        return redirect()->route('riwayat.index')->with('success', 'Selamat ! Anda berhasil membuat data booking!');
    }
}
