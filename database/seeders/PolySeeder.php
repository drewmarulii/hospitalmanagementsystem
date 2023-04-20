<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Poly;

class PolySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $poly = [ 
            [
                'poly_id' => 'PL-001',
                'poly_name' => 'Administrator User',
            ],
            [
                'poly_id' => 'PL-002',
                'poly_name' => 'Poly Dentist',
            ],
            [
                'poly_id' => 'PL-003',
                'poly_name' => 'Poly Neurologist',
            ],
        ];

        foreach($poly as $key => $value) {
            Poly::create($value);
        }
    }
}
