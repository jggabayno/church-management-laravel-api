<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Address;
use Carbon\Carbon;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime = Carbon::now();

        $addresses = [
            [
                "user_id" => 1,
                "house_no" => "214",
                "street" => "Hinayon Street",
                "barangay" => "Calumpang",
                "municipality" => "Binangonan, Rizal",
                'created_at' => $currentTime->toDateTimeString(),
            ]
        ];

            foreach($addresses as $address) {
                Address::create([
                    'user_id' => $address['user_id'],
                    'house_no' => $address['house_no'],
                    'street' => $address['street'],
                    'barangay' => $address['barangay'],
                    'municipality' => $address['municipality'],
                    'created_at' => $address['created_at'],
                ]);
            }
    }
}
