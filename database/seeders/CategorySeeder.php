<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    

    public function run(): void
    {
        $titles = ['mobiles', 'electronics', 'travel', 'home', 'fashion'];
        $titles = collect($titles)->shuffle()->unique();

        for ($i = 0; $i < 5; $i++) {
            DB::table('categories')->insert([
                'title' => $titles->shift(),
                'description' => 'Category Description' . $i + 1,
                'image' => 'https://picsum.photos/200/300',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
