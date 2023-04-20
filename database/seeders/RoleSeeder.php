<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [ 
            [
                'role_id' => 'R001',
                'role_name' => 'Admin',
            ],
            [
                'role_id' => 'R002',
                'role_name' => 'Receptionist',
            ],
            [
                'role_id' => 'R003',
                'role_name' => 'Physician',
            ],
        ];

        foreach($roles as $key => $value) {
            Roles::create($value);
        }
    }
}
