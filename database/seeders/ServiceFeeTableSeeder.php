<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\ServiceFee;
use Carbon\Carbon;

class ServiceFeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime = Carbon::now();

        $serviceFee = [
                    [
                        "name" => "Wedding",
                        'created_at' => $currentTime->toDateTimeString(),
                    ],
                    [
                        "name" => "Baptismal",
                        'created_at' => $currentTime->toDateTimeString(),
                    ]
                ];

            foreach($serviceFee as $sf) {
                ServiceFee::create([
                    'name' => $sf['name'],
                    'created_at' => $sf['created_at'],
                ]);
            }
    }
}
