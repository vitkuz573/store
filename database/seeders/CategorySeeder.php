<?php

namespace Database\Seeders;

use Database\Factories\CategoryFactory;
use Database\Factories\ProductFactory;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    private CategoryFactory $categoryFactory;
    private ProductFactory $productFactory;
    private const CATEGORY_COUNT = 5;
    private const PRODUCT_COUNT = 10;
    private const MAX_CATEGORY_PER_PRODUCT = 5;

    public function __construct(CategoryFactory $categoryFactory, ProductFactory $productFactory)
    {
        $this->categoryFactory = $categoryFactory;
        $this->productFactory = $productFactory;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        DB::beginTransaction();

        try {
            $categories = $this->categoryFactory->count(self::CATEGORY_COUNT)->create();

            $this->productFactory->count(self::PRODUCT_COUNT)->create()->each(function ($product) use ($categories) {
                $product->categories()->attach(
                    $categories->random(rand(1, self::MAX_CATEGORY_PER_PRODUCT))->pluck('id')->toArray()
                );
            });

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
