<?php
namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $ekstrakurikulers = Ekstrakurikuler::where('status', true)->paginate(6);
        return view('home', compact('ekstrakurikulers'));
    }

    public function show($id)
    {
        $ekskul = Ekstrakurikuler::findOrFail($id);
        return view('detail', compact('ekskul'));
    }
}
