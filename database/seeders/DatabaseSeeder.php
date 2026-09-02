<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
{
    $this->call([
        UserSeeder::class,
        PelangganSeeder::class, // Harus sebelum TransaksiSeeder
        LayananSeeder::class,   // Harus sebelum TransaksiSeeder
        BarangSeeder::class,    // Harus sebelum TransaksiSeeder
        TransaksiSeeder::class,
    ]);
}
}
