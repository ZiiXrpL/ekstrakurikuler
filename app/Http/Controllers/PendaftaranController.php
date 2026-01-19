<?php
namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function create($ekstrakurikuler_id)
    {
        $ekskul = Ekstrakurikuler::findOrFail($ekstrakurikuler_id);

        // Cek apakah user sudah daftar
        $sudahDaftar = Pendaftaran::where('user_id', auth()->id())
            ->where('ekstrakurikuler_id', $ekstrakurikuler_id)
            ->exists();

        if ($sudahDaftar) {
            return redirect()->back()->with('error', 'Anda sudah mendaftar ekstrakurikuler ini!');
        }

        return view('pendaftaran.create', compact('ekskul'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ekstrakurikuler_id' => 'required|exists:ekstrakurikulers,id',
            'kelas' => 'required|string|max:10',
            'no_telepon' => 'required|string|max:15',
            'alasan' => 'required|string'
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';

        Pendaftaran::create($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Pendaftaran berhasil! Silakan tunggu approval dari admin.');
    }
}
