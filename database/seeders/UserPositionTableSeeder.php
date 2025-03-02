<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\UserPosition;
use Carbon\Carbon;

class UserPositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime = Carbon::now();

        $user_positions = [
            
                    [
                        "name" => "Member",
                        "description" => "The member",
                        'created_at' => $currentTime->toDateTimeString(),
                    ],
                    [
                        "name" => "Worker",
                        "description" => "The worker",
                        'created_at' => $currentTime->toDateTimeString(),
                    ],
                    [
                        "name" => "Leader",
                        "description" => "The leader",
                        'created_at' => $currentTime->toDateTimeString(),
                    ],
                    [
                        "name" => "Pastor",
                        "description" => "The pastor",
                        'created_at' => $currentTime->toDateTimeString(),
                    ],
                ];

            foreach($user_positions as $user_position) {
                UserPosition::create([
                    'name' => $user_position['name'],
                    'description' => $user_position['description'],
                    'created_at' => $user_position['created_at'],
                ]);
            }
    }
}
