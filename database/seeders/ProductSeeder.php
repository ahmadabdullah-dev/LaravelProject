<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Get or create categories
        $electronics = Category::firstOrCreate(['name' => 'Electronics']);
        $clothing = Category::firstOrCreate(['name' => 'Clothing']);
        $books = Category::firstOrCreate(['name' => 'Books']);

        // Create sample products
        $products = [
            [
                'name' => 'Laptop Pro 15',
                'description' => 'High-performance laptop with 15-inch display, perfect for professionals and students. Features the latest processor, 16GB RAM, and 512GB SSD storage.',
                'price' => 1299.99,
                'stock' => 50,
                'image' => 'https://via.placeholder.com/400x300?text=Laptop+Pro+15',
                'category_id' => $electronics->id
            ],
            [
                'name' => 'Wireless Headphones',
                'description' => 'Premium noise-cancelling wireless headphones with 30-hour battery life. Perfect for music lovers and professionals.',
                'price' => 249.99,
                'stock' => 100,
                'image' => 'https://via.placeholder.com/400x300?text=Wireless+Headphones',
                'category_id' => $electronics->id
            ],
            [
                'name' => 'Smartphone X12',
                'description' => 'Latest flagship smartphone with 6.5-inch AMOLED display, 128GB storage, and advanced camera system.',
                'price' => 899.99,
                'stock' => 75,
                'image' => 'https://via.placeholder.com/400x300?text=Smartphone+X12',
                'category_id' => $electronics->id
            ],
            [
                'name' => 'Classic Cotton T-Shirt',
                'description' => 'Comfortable 100% cotton t-shirt available in multiple colors. Perfect for everyday wear.',
                'price' => 19.99,
                'stock' => 200,
                'image' => 'https://via.placeholder.com/400x300?text=Cotton+T-Shirt',
                'category_id' => $clothing->id
            ],
            [
                'name' => 'Denim Jeans',
                'description' => 'Classic fit denim jeans with premium quality. Durable and stylish for any occasion.',
                'price' => 49.99,
                'stock' => 150,
                'image' => 'https://via.placeholder.com/400x300?text=Denim+Jeans',
                'category_id' => $clothing->id
            ],
            [
                'name' => 'Winter Jacket',
                'description' => 'Warm and stylish winter jacket with fleece lining. Perfect for cold weather.',
                'price' => 129.99,
                'stock' => 80,
                'image' => 'https://via.placeholder.com/400x300?text=Winter+Jacket',
                'category_id' => $clothing->id
            ],
            [
                'name' => 'Programming Guide',
                'description' => 'Complete guide to modern programming with practical examples. Ideal for beginners and intermediate developers.',
                'price' => 39.99,
                'stock' => 60,
                'image' => 'https://via.placeholder.com/400x300?text=Programming+Guide',
                'category_id' => $books->id
            ],
            [
                'name' => 'Business Strategy Book',
                'description' => 'Learn essential business strategies from industry experts. Comprehensive guide for entrepreneurs.',
                'price' => 29.99,
                'stock' => 45,
                'image' => 'https://via.placeholder.com/400x300?text=Business+Strategy',
                'category_id' => $books->id
            ],
            [
                'name' => 'Cookbook Collection',
                'description' => 'Over 500 delicious recipes from around the world. Perfect for home cooks of all skill levels.',
                'price' => 34.99,
                'stock' => 70,
                'image' => 'https://via.placeholder.com/400x300?text=Cookbook',
                'category_id' => $books->id
            ],
            [
                'name' => 'Smart Watch',
                'description' => 'Feature-rich smartwatch with heart rate monitor, GPS, and 7-day battery life. Track your fitness goals.',
                'price' => 199.99,
                'stock' => 90,
                'image' => 'https://via.placeholder.com/400x300?text=Smart+Watch',
                'category_id' => $electronics->id
            ],
            [
                'name' => 'Bluetooth Speaker',
                'description' => 'Portable Bluetooth speaker with 360-degree sound and 20-hour battery life. Waterproof design.',
                'price' => 79.99,
                'stock' => 120,
                'image' => 'https://via.placeholder.com/400x300?text=Bluetooth+Speaker',
                'category_id' => $electronics->id
            ],
            [
                'name' => 'Running Shoes',
                'description' => 'Lightweight running shoes with superior cushioning. Perfect for athletes and fitness enthusiasts.',
                'price' => 89.99,
                'stock' => 100,
                'image' => 'https://via.placeholder.com/400x300?text=Running+Shoes',
                'category_id' => $clothing->id
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}