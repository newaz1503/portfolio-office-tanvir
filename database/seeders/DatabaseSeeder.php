<?php

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\MenuSeeder;
use Database\Seeders\MasterSetup;
use Database\Seeders\AdminSeeder;
use Database\Seeders\WebsiteSeeder;
use Database\Seeders\SiteSettingsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // App\Models\User::factory(10000)->create();

        $arr = [
            MenuSeeder::class,
            MasterSetup::class,
            AdminSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            SiteSettingsSeeder::class,
            WebsiteSeeder::class
        ];
        $this->call($arr);
    }
}
