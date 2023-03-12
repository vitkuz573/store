<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::whereName('admin')->firstOrFail();

        $admin = new User([
            'name' => 'Vitaly',
            'email' => 'admin@store.ru',
            'password' => Hash::make('password'),
        ]);

        $admin->save();
        $admin->roles()->attach($adminRole);
    }
}
