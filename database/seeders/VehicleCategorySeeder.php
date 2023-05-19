<?php

namespace Database\Seeders;

use App\Models\VehicleCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicle_categories = [
            [
                'category' => 'Taxi Mini',
                'price_km' => 100,
                'distance' => 10,
                'min_km' => 60,
                'min_price' => 200,
                'extra_km' => 0,
                'seat' => 4,
            ],
            [
                'category' => 'APV',
                'price_km' => 149,
                'distance' => 64,
                'min_km' => 60,
                'min_price' => 312,
                'extra_km' => 0,
                'seat' => 6,
            ],
            [
                'category' => 'Mini Bus',
                'price_km' => 1000,
                'distance' => 1000,
                'min_km' => 1000,
                'min_price' => 1000,
                'extra_km' => 0,
                'seat' => 3,
            ],
        ];

        foreach ($vehicle_categories as $key => $vehicle_category) {
            VehicleCategory::create($vehicle_category);
        }
    }
}
