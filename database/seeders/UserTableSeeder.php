<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime = Carbon::now();

        $users = [
            [
                'photo' => 'default_user.jpg',
                'first_name' => 'Gary',
                'middle_name' => 'Betana',
                'last_name' => 'Gabayno',
                'added_by' => 1,
                'user_type_id' => 1,
                'position_id' => 1,
                'age' => 23,
                'gender' => 2,
                'citizenship' => 1,
                'birth_date' => '1998-09-12',
                'place_of_birth' => 'Binangonan, Rizal',
                'mobile_number' => '09392006624',
                'email' => 'admin@email.com',
                'password' => Hash::make('admin'),
                'status' => 1,
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString(),            ]
        ];
        
        foreach($users as $user) {
            User::create([
                'photo' => $user['photo'],
                'first_name' => $user['first_name'],
                'middle_name' => $user['middle_name'],
                'last_name' => $user['last_name'],
                'user_type_id' => $user['user_type_id'],
                'position_id' => $user['position_id'],
                'age' => $user['age'],
                'gender' => $user['gender'],
                'citizenship' => $user['citizenship'],
                'birth_date' => $user['birth_date'],
                'place_of_birth' => $user['place_of_birth'],
                'added_by' => $user['added_by'],
                'mobile_number' => $user['mobile_number'],
                'email' => $user['email'],
                'password' => $user['password'],
                'status' => $user['status'],
                'created_at' => $user['created_at'],
                'updated_at' => $user['updated_at']
            ]);
        }
    }
}
