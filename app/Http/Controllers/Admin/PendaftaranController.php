<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        $pendaftarans = Pendaftaran::with(['user', 'ekstrakurikuler'])
            ->latest()
            ->paginate(10);

        return view('admin.pendaftaran.index', compact('pendaftarans'));
    }

    public function approve($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update(['status' => 'diterima']);

        return redirect()->back()->with('success', 'Pendaftaran berhasil disetujui!');
    }

    public function reject($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update(['status' => 'ditolak']);

        return redirect()->back()->with('success', 'Pendaftaran berhasil ditolak!');
    }
}
