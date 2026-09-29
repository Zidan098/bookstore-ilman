<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Ilman',
            'email' => 'admin@ilmanbookstore.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '082131223091',
            'address' => 'Kantor Pusat IlmanBookstore, Jakarta'
        ]);

        User::create([
            'name' => 'Customer Demo',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone' => '089876543210',
            'address' => 'Jl. Merdeka No. 45, Jakarta'
        ]);

        $cat1 = Category::create(['name' => 'Teknologi', 'slug' => 'teknologi']);
        $cat2 = Category::create(['name' => 'Novel', 'slug' => 'novel']);
        $cat3 = Category::create(['name' => 'Bisnis & Finansial', 'slug' => 'bisnis-finansial']);
        $cat4 = Category::create(['name' => 'Self Development', 'slug' => 'self-development']);

        Book::create([
            'category_id' => $cat1->id,
            'title' => 'Mastering Laravel & Modern PHP',
            'author' => 'Wahyu Hidayat',
            'description' => 'Panduan komprehensif membangun aplikasi web modern, terstruktur, dan scalable dengan ekosistem Laravel terkini.',
            'price' => 125000,
            'stock' => 20,
            'cover' => null
        ]);

        Book::create([
            'category_id' => $cat2->id,
            'title' => 'Lentera Malam di Ujung Senja',
            'author' => 'Ahmad R.',
            'description' => 'Kisah inspiratif tentang perjuangan, mimpi, dan persahabatan di tengah hiruk-pikuk kota metropolitan.',
            'price' => 85000,
            'stock' => 15,
            'cover' => null
        ]);

        Book::create([
            'category_id' => $cat3->id,
            'title' => 'Psikologi Uang & Investasi Cerdas',
            'author' => 'Morgan H.',
            'description' => 'Memahami pola pikir dan perilaku manusia terhadap uang serta cara mengelola aset dengan bijak.',
            'price' => 98000,
            'stock' => 25,
            'cover' => null
        ]);

        Book::create([
            'category_id' => $cat4->id,
            'title' => 'Atomic Habits: Perubahan Kecil Berdampak Besar',
            'author' => 'James Clear',
            'description' => 'Cara mudah dan terbukti untuk membentuk kebiasaan baik dan menghilangkan kebiasaan buruk setiap hari.',
            'price' => 110000,
            'stock' => 30,
            'cover' => null
        ]);
    }
}
