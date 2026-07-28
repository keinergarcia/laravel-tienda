<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['Electrónica', 'Ropa', 'Hogar', 'Deportes'] as $name) {
            Category::updateOrCreate(
                ['slug' => str($name)->slug()->toString()],
                ['name' => $name]
            );
        }
    }
}
