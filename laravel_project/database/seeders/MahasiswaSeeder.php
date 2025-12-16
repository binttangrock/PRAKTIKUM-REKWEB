<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     */
    public function run(): void
    {
        Mahasiswa::create([
            'nama' => 'Bintang Billah P.W',
            'nim' => 'G.211.23.0013',
            'alamat' => 'Banjarbaru'
        ]);

        Mahasiswa::create([
            'nama' => 'Aulia Rahman',
            'nim' => 'G.211.23.0014',
            'alamat' => 'Martapura'
        ]);

        Mahasiswa::create([
            'nama' => 'Siti Nurhaliza',
            'nim' => 'G.211.23.0015',
            'alamat' => 'Banjarmasin'
        ]);
    }
}
