<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = DB::table('users')->count();
        if ($count == 0) {
            DB::table('users')->insert(
                [
                    [
                        'name'              => 'Oshit Sutradar',
                        'email'             => 'oshitsd@gmail.com',
                        'mobile'            => '01883847733',
                        'password'          => Hash::make('oshitsd'),
                        'status'            => 'active',
                        'remember_token'    => Str::random(10),
                        'created_at'        => now(),
                        'updated_at'        => now(),
                    ]
                ]
            );
        }
    }
}
