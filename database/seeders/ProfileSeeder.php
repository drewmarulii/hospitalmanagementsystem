<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profile = [ 
            [
                'user_id' => 'BAH-2023-00001',
                'email' => 'admin@bah.com',
                'username' => 'admin',
                'password' => bcrypt('123456'),
                'level' => 'R001',                
            ],
        ];

        foreach($profile as $key => $value) {
            Profile::create($value);
        }
    }
}
