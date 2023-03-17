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
                ['name' => 'Cisco Catalyst 3560CX-8PC-S Compact Switch', 'description' => 'Компактный коммутатор с 8 портами Gigabit Ethernet и 2 портами SFP+', 'price' => '95800'],
                ['name' => 'Netgear GS108 8-Port Gigabit Ethernet Switch', 'description' => 'Коммутатор с 8 портами Gigabit Ethernet и функцией автоматического определения скорости', 'price' => '4500'],
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
                ['name' => 'Belkin CAT6 Snagless UTP Patch Cable', 'description' => 'Кабель категории 6 для подключения сетевого оборудования', 'price' => '320'],
                ['name' => 'UGREEN RJ45 CAT6A Shielded Keystone Jack', 'description' => 'Категория 6A экранированный Keystone разъем для быстрой и надежной передачи данных', 'price' => '220'],
                ['name' => 'Monoprice SlimRun Cat6A Ethernet Patch Cable', 'description' => 'Тонкий кабель Cat6A для подключения сетевого оборудования', 'price' => '350'],
                ['name' => 'Anker USB-C to Ethernet Adapter', 'description' => 'Адаптер USB-C на Ethernet для подключения к сети через порт USB-C', 'price' => '1490'],
            ],
            'Wi-Fi оборудование' => [
                ['name' => 'TP-Link Archer C9 AC1900', 'description' => 'Wi-Fi маршрутизатор с поддержкой стандарта 802.11ac и скоростью до 1900 Мбит/с', 'price' => '1600'],
                ['name' => 'ASUS RT-AC68U AC1900', 'description' => 'Wi-Fi маршрутизатор с поддержкой стандарта 802.11ac и скоростью до 1900 Мбит/с', 'price' => '14240'],
                ['name' => 'D-Link DIR-878 AC1900 MU-MIMO Wi-Fi Router', 'description' => 'Wi-Fi маршрутизатор с поддержкой стандарта 802.11ac и технологией MU-MIMO', 'price' => '6827'],
                ['name' => 'Netgear Nighthawk AX12 12-Stream AX6000', 'description' => 'Wi-Fi маршрутизатор с поддержкой стандарта 802.11ax и скоростью до 6000 Мбит/с', 'price' => '30180'],
                ['name' => 'Linksys EA8300 Max-Stream AC2200', 'description' => 'Wi-Fi маршрутизатор с поддержкой стандарта 802.11ac и скоростью до 2200 Мбит/с', 'price' => '11195'],
                ['name' => 'Google Nest WiFi Router', 'description' => 'Wi-Fi маршрутизатор с поддержкой стандарта 802.11ac и интеграцией с Google Assistant', 'price' => '8990'],
                ['name' => 'ASUS RT-AX88U AX6000', 'description' => 'Wi-Fi маршрутизатор с поддержкой стандарта 802.11ax и скоростью до 6000 Мбит/с', 'price' => '28890'],
                ['name' => 'TP-Link Archer AX50 AX3000', 'description' => 'Wi-Fi маршрутизатор с поддержкой стандарта 802.11ax и скоростью до 3000 Мбит/с', 'price' => '12490'],
            ],
            'Серверы и хранилища данных' => [
                ['name' => 'Dell EMC PowerEdge R640 Server', 'description' => 'Сервер высокой производительности с поддержкой многопроцессорных конфигураций', 'price' => '1950000'],
                ['name' => 'HP ProLiant DL380 Gen10 Server', 'description' => 'Сервер с поддержкой технологии виртуализации и расширенными возможностями безопасности', 'price' => '529000'],
                ['name' => 'Synology DiskStation DS218+ NAS Server', 'description' => 'Сетевое хранилище данных с поддержкой RAID и возможностью удаленного доступа', 'price' => '42360'],
                ['name' => 'QNAP TS-431XeU-2G 4-Bay NAS Server', 'description' => 'Сетевое хранилище данных с 4 отсеками для жестких дисков и поддержкой аппаратного шифрования', 'price' => '102500'],
                ['name' => 'Lenovo ThinkSystem SR630 V2 Server', 'description' => 'Сервер для средних и крупных предприятий с поддержкой двух процессоров Intel Xeon Scalable', 'price' => '2390000'],
                ['name' => 'Western Digital My Cloud EX2 Ultra NAS Server', 'description' => 'Сетевое хранилище данных с 2 отсеками для жестких дисков и поддержкой медиасервера', 'price' => '25790'],
                ['name' => 'Supermicro SYS-5019C-MR 1U Rackmount Server', 'description' => 'Сервер 1U с процессором Intel Xeon E-2100 и поддержкой до 4 жестких дисков', 'price' => '99000'],
            ],
            'Системы безопасности' => [
                ['name' => 'Hikvision DS-2CD2385FWD-I 8 Megapixel Network Camera', 'description' => 'IP-камера с разрешением 8 Мегапикселей и поддержкой технологии видеоаналитики', 'price' => '21558'],
                ['name' => 'Axis M2026-LE Mk II 4 Megapixel Network Camera', 'description' => 'IP-камера с разрешением 4 Мегапикселя и поддержкой технологии ик-подсветки', 'price' => '44184'],
                ['name' => 'Dahua DH-IPC-HFW1320S-W 3 Megapixel Network Camera', 'description' => 'IP-камера с разрешением 3 Мегапикселя и поддержкой беспроводной связи', 'price' => '1250'],
                ['name' => 'Arlo Pro 3 Wireless Security Camera', 'description' => 'Беспроводная IP-камера с разрешением 2К, интегрированным фонариком и цветной ночной съемкой', 'price' => '14350'],
                ['name' => 'Nest Cam IQ Outdoor', 'description' => 'Уличная IP-камера с разрешением 4К, фейс-детекцией и интеграцией с Google Assistant', 'price' => '27800'],
                ['name' => 'Ring Spotlight Cam Wired', 'description' => 'Проводная IP-камера с интегрированным светильником и двусторонним аудио', 'price' => '12500'],
                ['name' => 'Reolink Argus 2', 'description' => 'Беспроводная IP-камера с поддержкой Full HD и солнечной панелью для зарядки', 'price' => '11990'],
                ['name' => 'Logitech Circle 2', 'description' => 'IP-камера с поддержкой Full HD, двусторонним аудио и интеграцией с голосовыми ассистентами', 'price' => '12900'],
            ],
            'IP-телефония и видеоконференции' => [
                ['name' => 'Polycom SoundStation IP 5000 Conference Phone', 'description' => 'IP-телефон для конференц-связи с широким диапазоном частот и поддержкой технологии HD Voice', 'price' => '40144'],
                ['name' => 'Cisco Unified IP Phone 7945G', 'description' => 'IP-телефон с монохромным дисплеем и поддержкой технологии видеоконференций', 'price' => '14740'],
                ['name' => 'Grandstream GXP2140 Enterprise IP Phone', 'description' => 'IP-телефон с цветным дисплеем и поддержкой технологии видеоконференций', 'price' => '9086'],
                ['name' => 'Yealink CP960 IP Conference Phone', 'description' => 'IP-телефон для конференц-связи с поддержкой HD-аудио и интеграцией с голосовыми ассистентами', 'price' => '34500'],
                ['name' => 'Cisco IP Phone 8841', 'description' => 'IP-телефон с цветным дисплеем и поддержкой широкополосного аудио', 'price' => '15800'],
            ],
            'Оптическое оборудование' => [
                ['name' => 'Cisco SFP-10G-SR-S Transceiver Module', 'description' => 'Оптический модуль с поддержкой 10-Gigabit Ethernet и многомодовым волокном', 'price' => '6278'],
                ['name' => 'Juniper Networks SFP-10G-LR-S Transceiver Module', 'description' => 'Оптический модуль с поддержкой 10-Gigabit Ethernet и одномодовым волокном на расстояние до 10 км', 'price' => '33203'],
                ['name' => 'HPE X132 10G SFP+ LC SR Transceiver', 'description' => 'Оптический модуль с поддержкой 10-Gigabit Ethernet и многомодовым волокном на расстояние до 300 м', 'price' => '9025'],
                ['name' => 'FS SFP1G-LX-31 1310nm 10km DOM LC LX Transceiver', 'description' => 'Оптический модуль с поддержкой Gigabit Ethernet и одномодовым волокном на расстояние до 10 км', 'price' => '2500'],
                ['name' => 'MikroTik S+85DLC03D 10G SFP+ Transceiver', 'description' => 'Оптический модуль с поддержкой 10-Gigabit Ethernet и многомодовым волокном на расстояние до 300 м', 'price' => '6800'],
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
                    'stock' => $faker->numberBetween(2, 100),
                    'is_new' => $faker->boolean(),
                    'image_url' => $faker->imageUrl(randomize: false, word: $product['name'], gray: true),
                ]);

                $categoryItem->products()->save($productItems);
            }
        }
    }
}

