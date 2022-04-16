<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Support\Str;
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
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'User']);

        \App\Models\User::create([
            'name' => 'Administrador rodartsinimdA',
            'email' => 'admin@admin.com',
            'document' => '1234567890',
            'email_verified_at' => now(),
            'role_id' => 1,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        \App\Models\User::factory(5)->create();
        \App\Models\Category::factory(7)->create();
        \App\Models\WoodType::factory(4)->create();
        \App\Models\Product::factory(30)->create();
        \App\Models\Payment::factory(5)->create();
        \App\Models\Rate::factory(20)->create();
        \App\Models\Address::factory(10)->create();
        \App\Models\Question::factory(10)->create();
        // \App\Models\Order::factory(10)->create();
        $this->call(OrderSeeder::class);
    }
}
