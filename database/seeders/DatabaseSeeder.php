<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::create([
            'name' => 'usuario administrador',
            'email' => 'sistemas@lanmei.com.pe',
            'password' => bcrypt('*o+045H8BSdcYm'),
            //'role' => 'admin',
        ]);
    }
}
