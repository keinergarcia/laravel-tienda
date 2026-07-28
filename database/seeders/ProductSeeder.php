<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $electronics = Category::where('slug', 'electronica')->value('id');
        $clothing = Category::where('slug', 'ropa')->value('id');

        $products = [
            [
                'category_id' => $electronics,
                'name' => 'iPhone 15 Pro Max',
                'price' => 85000,
                'description' => 'El iPhone más avanzado con chip A17 Pro, cámara de 48MP y pantalla Super Retina XDR de 6.7 pulgadas.',
                'image' => 'https://images.pexels.com/photos/788946/pexels-photo-788946.jpeg?auto=compress&cs=tinysrgb&w=400',
                'is_featured' => true,
            ],
            [
                'category_id' => $electronics,
                'name' => 'MacBook Pro M3',
                'price' => 120000,
                'description' => 'Laptop profesional con chip M3, 16GB RAM, 512GB SSD. Perfecta para desarrollo y diseño.',
                'image' => 'https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=400',
                'is_featured' => true,
            ],
            [
                'category_id' => $clothing,
                'name' => 'Camisa Elegante',
                'price' => 35000,
                'description' => 'Camisa de algodón premium, corte slim fit, disponible en varios colores.',
                'image' => 'https://images.pexels.com/photos/996329/pexels-photo-996329.jpeg?auto=compress&cs=tinysrgb&w=400',
                'is_featured' => false,
            ],
            [
                'category_id' => $clothing,
                'name' => 'Zapatos Nike Air',
                'price' => 45000,
                'description' => 'Zapatos deportivos con tecnología Air, cómodos y duraderos para cualquier actividad.',
                'image' => 'https://images.pexels.com/photos/2529148/pexels-photo-2529148.jpeg?auto=compress&cs=tinysrgb&w=400',
                'is_featured' => true,
            ],
            [
                'category_id' => $electronics,
                'name' => 'Auriculares Sony',
                'price' => 25000,
                'description' => 'Auriculares inalámbricos con cancelación de ruido y 30 horas de batería.',
                'image' => 'https://images.pexels.com/photos/3394650/pexels-photo-3394650.jpeg?auto=compress&cs=tinysrgb&w=400',
                'is_featured' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(['name' => $product['name']], $product);
        }
    }
}
