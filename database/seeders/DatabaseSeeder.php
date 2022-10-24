<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Kategori::create([
            'namaKategori' => 'Component'
        ]);

        Kategori::create([
            'namaKategori' => 'Board'
        ]);

        Produk::create([
            'id' => 1001,
            'namaProduk' => 'Arquino',
            'beratProduk' => 1,
            'warnaProduk' => 'blue',
            'tanggalProduksi' => '2012-3-3',
            'hargaProduk' => 120000,
            'idKategori' => 2
        ]);

        Produk::create([
            'id' => 4004,
            'namaProduk' => 'Push Button',
            'beratProduk' => 2,
            'warnaProduk' => 'silver',
            'tanggalProduksi' => '1956-03-19',
            'hargaProduk' => 500,
            'idKategori' => 1
        ]);

        // Produk::create([]);

        // Produk::create([
        //     'product_name' => 'Indomie'
        // ]);



        Customer::create([
            'nama' => 'admin',
            'email' => 'admin@geekbot.com',
            'password' => bcrypt('code'),
            'is_admin' => true,
        ]);

        Customer::create([
            'nama' => 'pembeli',
            'alamat' => 'Medokan Asri',
            'noHP' => '0823478905673',
            'email' => 'pembeli@g.com',
            'password' => bcrypt('web'),
        ]);
    }
}