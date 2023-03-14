<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Маршрутизаторы',
            'Коммутаторы',
            'Активное сетевое оборудование',
            'Сетевые карты',
            'Кабели и разъемы',
            'Wi-Fi оборудование',
            'Серверы и хранилища данных',
            'Системы безопасности',
            'IP-телефония и видеоконференции',
            'Оптическое оборудование',
        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
            ]);
        }
    }
}
