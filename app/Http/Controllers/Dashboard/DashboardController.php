<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Meja;
use App\Models\Paket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $pakets = Paket::get();
        $users = Auth::user();

        $countMeja = Meja::count();
        $countPaket = Paket::count();
        $countUser = User::count();
        $countBooking = Booking::count();

        $pemesananData = Booking::selectRaw('MONTH(tgl_booking) as bulan, COUNT(*) as jumlah')
            ->whereYear('tgl_booking', Carbon::now()->year)   // thn ini
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('jumlah', 'bulan')                         // [1=>5, 2=>8, …]
            ->all();

        // jadikan array 12 elemen; isi 0 jika kosong
        $pesananData = collect(range(1, 12))
            ->map(fn ($m) => $pemesananData[$m] ?? 0)
            ->toArray();

        if ($users->level_id == '1') {
            return view('dashboard.main.index', [
                'countMeja' => $countMeja,
                'countPaket' => $countPaket,
                'countUser' => $countUser,
                'countBooking' => $countBooking,
                'pesananData'  => $pesananData,
            ]);
        } else {
            return view('landing.main.index', [
                'pakets' => $pakets,
                'users' => $users,
            ]);
        }
    }
}
