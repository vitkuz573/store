<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'admin', 'description' => 'Administrator'],
            ['name' => 'user', 'description' => 'Regular user'],
            ['name' => 'editor', 'description' => 'Content editor'],
        ];

        foreach ($roles as $roleData) {
            Role::create($roleData);
        }
    }
}
