<?php

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
         $this->call(AdminSeeder::class);
         $this->call(PermissionSeeder::class);
         $this->call(SettingSeeder::class);
         $this->call(SettingTranslationSeeder::class);

    }
}