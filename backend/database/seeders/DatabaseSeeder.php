<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Book;
 
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'User',
                'password' => bcrypt('password'),
                'role' => 'user',
            ]
        );

        $categoryNames = [
            'Pemrograman',
            'Novel',
            'Bisnis',
            'Sains',
            'Sejarah',
        ];

        $categories = [];

        foreach ($categoryNames as $name) {
            $categories[$name] = Category::firstOrCreate(['name' => $name]);
        }

        $books = [
            ['Belajar Laravel', 'Laravel Developer', 2024, 3, 'Pemrograman'],
            ['Dasar PHP', 'Programmer A', 2022, 5, 'Pemrograman'],
            ['Algoritma dan Struktur Data', 'Programmer B', 2021, 4, 'Pemrograman'],
            ['Bisnis Online untuk Pemula', 'Pengusaha A', 2019, 6, 'Bisnis'],
            ['Manajemen Keuangan Pribadi', 'Pengusaha B', 2020, 3, 'Bisnis'],
            ['Fisika Sederhana', 'Ilmuwan A', 2018, 2, 'Sains'],
            ['Sejarah Dunia Modern', 'Sejarawan A', 2015, 4, 'Sejarah'],
            ['Novel Fiksi', 'Penulis A', 2020, 2, 'Novel'],
            ['Petualangan di Negeri Ajaib', 'Penulis B', 2017, 5, 'Novel'],
            ['Rahasia Sang Motivator', 'Motivator A', 2016, 3, 'Bisnis'],
        ];

        foreach ($books as [$title, $author, $year, $stock, $categoryName]) {
            $category = $categories[$categoryName] ?? null;

            if ($category) {
                Book::updateOrCreate(
                    ['title' => $title, 'author' => $author],
                    [
                        'year' => $year,
                        'stock' => $stock,
                        'category_id' => $category->id,
                    ]
                );
            }
        }
    }
}
