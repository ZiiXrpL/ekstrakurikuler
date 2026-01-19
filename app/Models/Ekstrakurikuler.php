<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
        'pembina',
        'jadwal',
        'tempat',
        'gambar',
        'kuota',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }

    public function pendaftaransDiterima()
    {
        return $this->hasMany(Pendaftaran::class)->where('status', 'diterima');
    }

    public function sisaTempat()
    {
        return $this->kuota - $this->pendaftaransDiterima()->count();
    }
}
