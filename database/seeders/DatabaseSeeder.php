<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Instansi::factory(6)->create();
        // \App\Models\Pengaduan::factory(6)->create();

        \App\Models\User::create([
            'nama' => 'Admin',
            'username' => 'admin.dpmptsp',
            'password' => Hash::make('Banjarmasin123#'),
        ]);

        \App\Models\Status::insert([
            ['status' => 'diterima'],
            ['status' => 'dikirim'],
            ['status' => 'dijawab'],
            ['status' => 'ditolak'],
        ]);
    }
}
