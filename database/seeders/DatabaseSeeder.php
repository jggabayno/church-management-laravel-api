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
    public function run()
    {
        $this->call([
            UserTableSeeder::class,
            UserTypeTableSeeder::class,
            UserPositionTableSeeder::class,
            AddressTableSeeder::class,
            ServiceFeeTableSeeder::class
        ]);
    }
}
