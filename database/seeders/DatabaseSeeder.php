<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Ekstrakurikuler;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Admin SMK PGRI 5',
            'email' => 'admin@smkpgri5jember.sch.id',
            'password' => bcrypt('admin123'),
            'role' => 'admin'
        ]);

        // Regular User
        User::create([
            'name' => 'Siswa Test',
            'email' => 'siswa@test.com',
            'password' => bcrypt('siswa123'),
            'role' => 'user'
        ]);

        // Ekstrakurikuler
        Ekstrakurikuler::create([
            'nama' => 'Paskibra',
            'deskripsi' => 'Pasukan Pengibar Bendera adalah ekstrakurikuler yang melatih kedisiplinan dan kekompakan.',
            'pembina' => 'Bapak Agus Santoso, S.Pd',
            'jadwal' => 'Senin & Kamis, 15:00 - 17:00',
            'tempat' => 'Lapangan Upacara',
            'kuota' => 30,
            'status' => true
        ]);

        Ekstrakurikuler::create([
            'nama' => 'Basket',
            'deskripsi' => 'Ekstrakurikuler olahraga basket untuk mengembangkan bakat dan keterampilan bermain basket.',
            'pembina' => 'Bapak Budi Hartono, S.Pd',
            'jadwal' => 'Rabu & Jumat, 15:30 - 17:30',
            'tempat' => 'Lapangan Basket',
            'kuota' => 25,
            'status' => true
        ]);

        Ekstrakurikuler::create([
            'nama' => 'Seni Tari',
            'deskripsi' => 'Melestarikan budaya Indonesia melalui seni tari tradisional dan modern.',
            'pembina' => 'Ibu Siti Nurhaliza, S.Sn',
            'jadwal' => 'Selasa & Kamis, 14:00 - 16:00',
            'tempat' => 'Ruang Kesenian',
            'kuota' => 20,
            'status' => true
        ]);
    }
}
