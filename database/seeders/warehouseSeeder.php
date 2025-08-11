<?php

namespace Database\Seeders;

use App\Models\warehouses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class warehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => "Main Warehouse"],
        ];
        warehouses::insert($data);
    }
}
