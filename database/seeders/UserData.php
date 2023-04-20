<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [ 
            [
                'email' => 'admin@bah.com',
                'username' => 'admin',
                'password' => bcrypt('123456'),
                'level' => 'R001',
                'user_fname' => 'admin',
                'user_mname' => 'admin',
                'user_lname' => 'admin',
                'user_gender' => 'Male',
                'user_room' => 'Rose 101',
                'polyid' => 'PL-001',
            ],
            [
                'email' => 'receptionist@bah.com',
                'username' => 'receptionist',
                'password' => bcrypt('123456'),
                'level' => 'R002',
                'user_fname' => 'receptionist',
                'user_mname' => 'receptionist',
                'user_lname' => 'receptionist',
                'user_gender' => 'Male',
                'user_room' => 'Rose 101',
                'polyid' => 'PL-001',
            ],
        ];

        foreach($user as $key => $value) {
            User::create($value);
        }
    }
}
