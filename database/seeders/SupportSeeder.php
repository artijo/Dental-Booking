<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\Support::create([
            'support_id' => 'sp0000',
            'name' => 'Admin',
            'tel' => '0000000000',
            'level' => 0,
            'email' => 'admin@dental.app',
            'password' => Hash::make('12345678')
        ]);
    }
}
