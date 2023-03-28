<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterSetup extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = DB::table('account_heads')->count();
        if ($count == 0) {
            DB::table('account_heads')->insert(
                [
                    [
                        'name'              => 'Testing Purpose',
                        'created_at'        => now(),
                        'updated_at'        => now(),
                    ],
                ]
            );
        }
    }
}
