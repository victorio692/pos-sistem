<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // MAKANAN
            [
                'name' => 'Chicken Wings',
                'description' => 'Ayam renyah dengan saus pedas',
                'price' => 20000,
                'category' => 'makanan',
                'image' => 'chicken-wings.jpg'
            ],
            [
                'name' => 'French Fries',
                'description' => 'Kentang goreng crispy',
                'price' => 15000,
                'category' => 'makanan',
                'image' => 'french-fries.jpg'
            ],
            [
                'name' => 'Grilled Salmon',
                'description' => 'Salmon panggang dengan lemon butter',
                'price' => 65000,
                'category' => 'makanan',
                'image' => 'grilled-salmon.jpg'
            ],
            [
                'name' => 'Beef Steak',
                'description' => 'Daging sapi premium dengan saus pilihan',
                'price' => 85000,
                'category' => 'makanan',
                'image' => 'beef-steak.jpg'
            ],
            [
                'name' => 'Caesar Salad',
                'description' => 'Salad segar dengan dressing caesar',
                'price' => 25000,
                'category' => 'makanan',
                'image' => 'caesar-salad.jpg'
            ],
            [
                'name' => 'Pasta Carbonara',
                'description' => 'Pasta dengan saus krim dan bacon',
                'price' => 45000,
                'category' => 'makanan',
                'image' => 'pasta-carbonara.jpg'
            ],
            [
                'name' => 'Pizza Margherita',
                'description' => 'Pizza klasik dengan tomat dan mozzarella',
                'price' => 55000,
                'category' => 'makanan',
                'image' => 'pizza-margherita.jpg'
            ],
            [
                'name' => 'Chicken Teriyaki',
                'description' => 'Ayam dengan saus teriyaki manis',
                'price' => 35000,
                'category' => 'makanan',
                'image' => 'chicken-teriyaki.jpg'
            ],

            // MINUMAN
            [
                'name' => 'Iced Tea',
                'description' => 'Teh dingin dengan es batu',
                'price' => 10000,
                'category' => 'minuman',
                'image' => 'iced-tea.jpg'
            ],
            [
                'name' => 'Fresh Orange Juice',
                'description' => 'Jus jeruk segar tanpa gula',
                'price' => 15000,
                'category' => 'minuman',
                'image' => 'orange-juice.jpg'
            ],
            [
                'name' => 'Iced Coffee',
                'description' => 'Kopi arabika dingin dengan es',
                'price' => 18000,
                'category' => 'minuman',
                'image' => 'iced-coffee.jpg'
            ],
            [
                'name' => 'Smoothie Bowl',
                'description' => 'Smoothie buah dengan topping granola',
                'price' => 25000,
                'category' => 'minuman',
                'image' => 'smoothie-bowl.jpg'
            ],
            [
                'name' => 'Mineral Water',
                'description' => 'Air mineral dingin 500ml',
                'price' => 5000,
                'category' => 'minuman',
                'image' => 'mineral-water.jpg'
            ],

            // SNACK
            [
                'name' => 'Garlic Bread',
                'description' => 'Roti bawang putih panggang',
                'price' => 18000,
                'category' => 'snack',
                'image' => 'garlic-bread.jpg'
            ],
            [
                'name' => 'Cheesy Nachos',
                'description' => 'Tortilla chips dengan keju meleleh',
                'price' => 22000,
                'category' => 'snack',
                'image' => 'cheesy-nachos.jpg'
            ],
            [
                'name' => 'Spring Rolls',
                'description' => 'Lumpia goreng dengan saus manis',
                'price' => 16000,
                'category' => 'snack',
                'image' => 'spring-rolls.jpg'
            ],
            [
                'name' => 'Onion Rings',
                'description' => 'Bawang goreng renyah',
                'price' => 14000,
                'category' => 'snack',
                'image' => 'onion-rings.jpg'
            ],

            // PAKET HEMAT
            [
                'name' => 'Paket Nasi Goreng',
                'description' => 'Nasi goreng spesial + minuman + dessert',
                'price' => 45000,
                'category' => 'paket',
                'image' => 'paket-nasi-goreng.jpg'
            ],
            [
                'name' => 'Paket Breakfast',
                'description' => 'Telur + bacon + toast + kopi + jus',
                'price' => 50000,
                'category' => 'paket',
                'image' => 'paket-breakfast.jpg'
            ],
            [
                'name' => 'Paket Family',
                'description' => 'Untuk 4 orang: 2 main dish + 2 minuman + dessert',
                'price' => 150000,
                'category' => 'paket',
                'image' => 'paket-family.jpg'
            ],
            [
                'name' => 'Paket BBQ',
                'description' => 'Daging bakar + sayuran + minuman',
                'price' => 80000,
                'category' => 'paket',
                'image' => 'paket-bbq.jpg'
            ],
        ];

        $this->db->table('menu')->insertBatch($data);
    }
}
