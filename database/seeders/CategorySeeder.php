<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' =>'Web Desain',
            'slug' =>'web-desain',
            'color' => 'bg-red-100'
        ]);

        Category::create([
            'name' =>'Artificial Intelligence',
            'slug' =>'ai',
            'color' => 'bg-green-100'

        ]);
        Category::create([
            'name' =>'Web Programming',
            'slug' =>'Web-programming',
            'color' => 'bg-blue-100'

        ]);
    }
}
