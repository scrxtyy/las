<?php

namespace Database\Seeders;

use DB;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'empID' => '001-001-001',
            'email' => 'test@example.com',
            'name' => 'Super',
            'empLastName' => 'Admin',
            'empStatus' => 'Employed',
            'empDept' => 'ADMIN',
            'usertype' => 'Super-Admin',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
    }
}
