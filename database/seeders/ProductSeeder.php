<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use App\Models\Product;
use App\Models\Category;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        for ($i = 0; $i < 20; $i++) {
            DB::table('products')->insert([
                'title' => 'product' . $i + 1 ,
                'category_id' => Category::inRandomOrder()->first()->id,
                'image' => 'https://picsum.photos/200/300',
                'short_desc' => 'product short desc',
                'full_desc' => 'product full desc',
                'price' => 1000,
                'quantity' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
