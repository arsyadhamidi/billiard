<?php

namespace App\Http\Controllers\Pelanggan;

use PDF;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelangganRiwayatController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        $bookings = Booking::where('users_id', $users->id)->orderBy('id', 'desc')->limit(10)->get();

        return view('landing.riwayat.index', [
            'users' => $users,
            'bookings' => $bookings,
        ]);
    }

    public function generatepdf($id)
    {
        $users = Auth::user();
        $bookings = Booking::where('id', $id)->first();

        $pdf = PDF::loadview('landing.riwayat.cetak-pdf', [
            'bookings' => $bookings,
            'users' => $users
        ]);
        return $pdf->stream('cetak_pemesanan.pdf');
    }
}
