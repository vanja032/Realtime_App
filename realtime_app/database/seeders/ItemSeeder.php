<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        foreach(range(1, 30) as $range){
            Item::create([
                'name' => 'Item #' . $range,
                'description' => 'Item description ' . $range,
                'price' => $range * 100,
            ]);
        }
    }
}
