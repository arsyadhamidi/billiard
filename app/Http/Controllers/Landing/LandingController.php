<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        $pakets = Paket::get();
        return view('landing.main.index', [
            'pakets' => $pakets,
            'users' => $users,
        ]);
    }
}
