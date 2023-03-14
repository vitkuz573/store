<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = Category::all();

        $productsByCategory = [
            'Маршрутизаторы' => [
                'Cisco RV345P VPN Router',
                'Ubiquiti UniFi Security Gateway',
                'Juniper Networks SRX320 Services Gateway',
            ],
            'Коммутаторы' => [
                'Cisco Catalyst 2960 Plus 24 Port',
                'Juniper Networks EX2200-24T-4G',
                'HPE Aruba 2530 24G PoE+',
            ],
            'Активное сетевое оборудование' => [
                'TP-Link TL-SG1016D 16-Port Gigabit Ethernet',
                'D-Link DGS-1100-24P 24-Port PoE Gigabit',
                'Ubiquiti UniFi Switch 24 PoE',
            ],
            'Сетевые карты' => [
                'Intel Gigabit CT Desktop Adapter',
                'D-Link DGE-528T PCI Express Gigabit Ethernet Adapter',
                'TP-Link TG-3468 Gigabit PCIe Network Adapter',
            ],
            'Кабели и разъемы' => [
                'Belkin CAT5e Snagless UTP Patch Cable',
                'D-Link NCB-C6SGRYR-305-24 Cat6 FTP STP Networking Cable',
                'TP-Link TL-SF1005D 5-Port Fast Ethernet Switch',
            ],
            'Wi-Fi оборудование' => [
                'TP-Link Archer C9 AC1900',
                'ASUS RT-AC68U AC1900',
                'D-Link DIR-878 AC1900 MU-MIMO Wi-Fi Router',
            ],
            'Серверы и хранилища данных' => [
                'Dell EMC PowerEdge R640 Server',
                'HP ProLiant DL380 Gen10 Server',
                'Synology DiskStation DS218+ NAS Server',
            ],
            'Системы безопасности' => [
                'Hikvision DS-2CD2385FWD-I 8 Megapixel Network Camera',
                'Axis M2026-LE Mk II 4 Megapixel Network Camera',
                'Dahua DH-IPC-HFW1320S-W 3 Megapixel Network Camera',
            ],
            'IP-телефония и видеоконференции' => [
                'Polycom SoundStation IP 5000 Conference Phone',
                'Cisco Unified IP Phone 7945G',
                'Grandstream GXP2140 Enterprise IP Phone',
            ],
            'Оптическое оборудование' => [
                'Cisco SFP-10G-SR-S Transceiver Module',
                'Juniper Networks SFP-10G-LR-S Transceiver Module',
                'HPE X132 10G SFP+ LC SR Transceiver',
            ],
        ];

        $category = $categories->random();
        $products = $productsByCategory[$category->name];

        return [
            'name' => $this->faker->unique()->randomElement($products),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->numberBetween(100, 1000),
            'stock' => $this->faker->numberBetween(0, 100),
            'is_new' => $this->faker->boolean(),
            'image_url' => $this->faker->imageUrl(),
            'category_id' => $category->id,
            'created_at' => $this->faker->dateTimeBetween('-1 month'),
            'updated_at' => $this->faker->dateTimeBetween('-1 month'),
        ];
    }
}
