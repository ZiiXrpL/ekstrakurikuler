<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ekstrakurikuler;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class EkstrakurikulerController extends Controller
{
    /**
     * Menampilkan daftar ekstrakurikuler
     */
    public function index()
    {
        $ekstrakurikulers = Ekstrakurikuler::paginate(10);
        return view('admin.ekstrakurikuler.index', compact('ekstrakurikulers'));
    }

    /**
     * Menampilkan form tambah ekstrakurikuler
     */
    public function create()
    {
        return view('admin.ekstrakurikuler.create');
    }

    /**
     * Menyimpan data ekstrakurikuler baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required',
            'pembina' => 'required|string|max:255',
            'jadwal' => 'required|string|max:255',
            'tempat' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kuota' => 'required|integer|min:1',
            'status' => 'required|boolean'
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('ekstrakurikuler', 'public');
        }

        Ekstrakurikuler::create($validated);

        return redirect()->route('admin.ekstrakurikuler.index')
            ->with('success', 'Ekstrakurikuler berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit berdasarkan ID
     */
    public function edit($id)
    {
        // Menggunakan findOrFail agar jika ID tidak ada, muncul error 404 (bukan halaman putih)
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);

        return view('admin.ekstrakurikuler.edit', compact('ekstrakurikuler'));
    }

    /**
     * Memperbarui data ekstrakurikuler
     */
    public function update(Request $request, $id)
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required',
            'pembina' => 'required|string|max:255',
            'jadwal' => 'required|string|max:255',
            'tempat' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kuota' => 'required|integer|min:1',
            'status' => 'required|boolean'
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($ekstrakurikuler->gambar) {
                Storage::disk('public')->delete($ekstrakurikuler->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('ekstrakurikuler', 'public');
        }

        $ekstrakurikuler->update($validated);

        return redirect()->route('admin.ekstrakurikuler.index')
            ->with('success', 'Ekstrakurikuler berhasil diupdate!');
    }

    /**
     * Menghapus data ekstrakurikuler
     */
    public function destroy($id)
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);

        if ($ekstrakurikuler->gambar) {
            Storage::disk('public')->delete($ekstrakurikuler->gambar);
        }

        $ekstrakurikuler->delete();

        return redirect()->route('admin.ekstrakurikuler.index')
            ->with('success', 'Ekstrakurikuler berhasil dihapus!');
    }
}
