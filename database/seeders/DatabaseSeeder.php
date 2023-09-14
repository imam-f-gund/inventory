<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Role::insert(
            [
                [
                    'role_name' => 'Super Admin',
                ],
                [
                    'role_name' => 'Employee',
                ],
            ]
        );

        User::insert(
            [
                [
                    'first_name' => 'Superadmin',
                    'last_name' => 'User',
                    'username' => 'superadmin',
                    'email' => 'superadmin@example.com',
                    'role_id' => 1,
                    'password' => bcrypt('password'),
                ]
            ]
        );

        Category::factory()->count(5)->create();
        Product::factory()->count(20)->create();
        Stock::factory()->count(1000)->create();
    }
}
