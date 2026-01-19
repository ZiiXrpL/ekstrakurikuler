<?php

namespace App\Http\Controllers;
use App\Models\Ekstrakurikuler;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $totalEkskul = Ekstrakurikuler::count();
            $totalPendaftar = Pendaftaran::count();
            $pendingApproval = Pendaftaran::where('status', 'pending')->count();

            return view('dashboard.admin', compact('totalEkskul', 'totalPendaftar', 'pendingApproval'));
        } else {
            $pendaftarans = Pendaftaran::where('user_id', $user->id)
                ->with('ekstrakurikuler')
                ->latest()
                ->get();

            return view('dashboard.user', compact('pendaftarans'));
        }
    }

}
