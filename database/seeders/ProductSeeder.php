<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $products = [
            'Маршрутизаторы' => [
                ['name' => 'Cisco RV345P VPN Router', 'description' => 'Маршрутизатор с поддержкой VPN', 'price' => '44398'],
                ['name' => 'Ubiquiti UniFi Security Gateway', 'description' => 'Маршрутизатор с функциями безопасности', 'price' => '63880'],
                ['name' => 'Juniper Networks SRX320 Services Gateway', 'description' => 'Маршрутизатор с расширенными сервисными возможностями', 'price' => '184038'],
            ],
            'Коммутаторы' => [
                ['name' => 'Cisco Catalyst 2960 Plus 24 Port', 'description' => 'Коммутатор с 24 портами', 'price' => '50333'],
                ['name' => 'Juniper Networks EX2200-24T-4G', 'description' => 'Коммутатор с поддержкой Gigabit Ethernet и 10-Gigabit Ethernet', 'price' => '70020'],
                ['name' => 'HPE Aruba 2530 24G PoE+', 'description' => 'Коммутатор с поддержкой Power over Ethernet', 'price' => '111380'],
            ],
            'Активное сетевое оборудование' => [
                ['name' => 'TP-Link TL-SG1016D 16-Port Gigabit Ethernet', 'description' => 'Сетевой коммутатор с 16 портами Gigabit Ethernet', 'price' => '4199'],
                ['name' => 'D-Link DGS-1100-24P 24-Port PoE Gigabit', 'description' => 'Сетевой коммутатор с 24 портами Gigabit Ethernet и поддержкой Power over Ethernet', 'price' => '19915'],
                ['name' => 'Ubiquiti UniFi Switch 24 PoE', 'description' => 'Сетевой коммутатор с 24 портами Gigabit Ethernet и поддержкой Power over Ethernet', 'price' => '57711'],
            ],
            'Сетевые карты' => [
                ['name' => 'Intel Gigabit CT Desktop Adapter', 'description' => 'Сетевая карта Gigabit Ethernet для настольных ПК', 'price' => '1666'],
                ['name' => 'D-Link DGE-528T PCI Express Gigabit Ethernet Adapter', 'description' => 'Сетевая карта Gigabit Ethernet для компьютеров с PCI Express интерфейсом', 'price' => '515'],
                ['name' => 'TP-Link TG-3468 Gigabit PCIe Network Adapter', 'description' => 'Сетевая карта Gigabit Ethernet для компьютеров с PCI Express интерфейсом', 'price' => '625'],
            ],
            'Кабели и разъемы' => [
                ['name' => 'Belkin CAT5e Snagless UTP Patch Cable', 'description' => 'Кабель категории 5e для подключения сетевого оборудования', 'price' => '226'],
                ['name' => 'D-Link NCB-C6SGRYR-305-24 Cat6 FTP STP Networking Cable 305M', 'description' => 'Кабель категории 6 для подключения сетевого оборудования', 'price' => '7861'],
                ['name' => 'TP-Link TL-SF1005D 5-Port Fast Ethernet Switch', 'description' => 'Коммутатор с 5 портами Fast Ethernet', 'price' => '695'],
            ],
            'Wi-Fi оборудование' => [
                ['name' => 'TP-Link Archer C9 AC1900', 'description' => 'Wi-Fi маршрутизатор с поддержкой стандарта 802.11ac и скоростью до 1900 Мбит/с', 'price' => '1600'],
                ['name' => 'ASUS RT-AC68U AC1900', 'description' => 'Wi-Fi маршрутизатор с поддержкой стандарта 802.11ac и скоростью до 1900 Мбит/с', 'price' => '14240'],
                ['name' => 'D-Link DIR-878 AC1900 MU-MIMO Wi-Fi Router', 'description' => 'Wi-Fi маршрутизатор с поддержкой стандарта 802.11ac и технологией MU-MIMO', 'price' => '6827'],
            ],
            'Серверы и хранилища данных' => [
                ['name' => 'Dell EMC PowerEdge R640 Server', 'description' => 'Сервер высокой производительности с поддержкой многопроцессорных конфигураций', 'price' => '1950000'],
                ['name' => 'HP ProLiant DL380 Gen10 Server', 'description' => 'Сервер с поддержкой технологии виртуализации и расширенными возможностями безопасности', 'price' => '529000'],
                ['name' => 'Synology DiskStation DS218+ NAS Server', 'description' => 'Сетевое хранилище данных с поддержкой RAID и возможностью удаленного доступа', 'price' => '42360'],
            ],
            'Системы безопасности' => [
                ['name' => 'Hikvision DS-2CD2385FWD-I 8 Megapixel Network Camera', 'description' => 'IP-камера с разрешением 8 Мегапикселей и поддержкой технологии видеоаналитики', 'price' => '21558'],
                ['name' => 'Axis M2026-LE Mk II 4 Megapixel Network Camera', 'description' => 'IP-камера с разрешением 4 Мегапикселя и поддержкой технологии ик-подсветки', 'price' => '44184'],
                ['name' => 'Dahua DH-IPC-HFW1320S-W 3 Megapixel Network Camera', 'description' => 'IP-камера с разрешением 3 Мегапикселя и поддержкой беспроводной связи', 'price' => '1250'],
            ],
            'IP-телефония и видеоконференции' => [
                ['name' => 'Polycom SoundStation IP 5000 Conference Phone', 'description' => 'IP-телефон для конференц-связи с широким диапазоном частот и поддержкой технологии HD Voice', 'price' => '40144'],
                ['name' => 'Cisco Unified IP Phone 7945G', 'description' => 'IP-телефон с монохромным дисплеем и поддержкой технологии видеоконференций', 'price' => '14740'],
                ['name' => 'Grandstream GXP2140 Enterprise IP Phone', 'description' => 'IP-телефон с цветным дисплеем и поддержкой технологии видеоконференций', 'price' => '9086'],
            ],
            'Оптическое оборудование' => [
                ['name' => 'Cisco SFP-10G-SR-S Transceiver Module', 'description' => 'Оптический модуль с поддержкой 10-Gigabit Ethernet и многомодовым волокном', 'price' => '6278'],
                ['name' => 'Juniper Networks SFP-10G-LR-S Transceiver Module', 'description' => 'Оптический модуль с поддержкой 10-Gigabit Ethernet и одномодовым волокном на расстояние до 10 км', 'price' => '33203'],
                ['name' => 'HPE X132 10G SFP+ LC SR Transceiver', 'description' => 'Оптический модуль с поддержкой 10-Gigabit Ethernet и многомодовым волокном на расстояние до 300 м', 'price' => '9025'],
            ],
        ];

        foreach ($products as $category => $productItems)
        {
            $categoryItem = Category::create(['name' => $category]);

            foreach ($productItems as $product)
            {
                $productItems = new Product([
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'stock' => $faker->numberBetween(0, 100),
                    'is_new' => $faker->boolean(),
                    'image_url' => $faker->imageUrl(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $categoryItem->products()->save($productItems);
            }
        }
    }
}

