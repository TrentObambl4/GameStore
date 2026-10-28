<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Game;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $userRole = Role::create([
            'name' => 'user',
        ]);

        $sellerRole = Role::create([
            'name' => 'seller',
        ]);

        $adminRole = Role::create([
            'name' => 'admin',
        ]);

        $action = Category::create([
            'name' => 'Экшен',
        ]);

        $adventure = Category::create([
            'name' => 'Приключения',
        ]);

        $rpg = Category::create([
            'name' => 'RPG',
        ]);

        $strategy = Category::create([
            'name' => 'Стратегии',
        ]);

        $simulator = Category::create([
            'name' => 'Симуляторы',
        ]);

        User::create([
            'login' => 'admin',
            'password' => Hash::make('admin123'),
            'role_id' => $adminRole->id,
        ]);

        $seller = User::create([
            'login' => 'seller',
            'password' => Hash::make('seller123'),
            'role_id' => $sellerRole->id,
        ]);

        User::create([
            'login' => 'user',
            'password' => Hash::make('user123'),
            'role_id' => $userRole->id,
        ]);

        Game::create([
            'name' => 'Cyber Assault',
            'description' => 'Динамичный экшен в футуристическом городе.',
            'price' => 1999.00,
            'category_id' => $action->id,
            'user_id' => $seller->id,
            'published' => true,
        ]);

        Game::create([
            'name' => 'Lost Island',
            'description' => 'Приключенческая игра об исследовании таинственного острова.',
            'price' => 1499.00,
            'category_id' => $adventure->id,
            'user_id' => $seller->id,
            'published' => true,
        ]);

        Game::create([
            'name' => 'Legends of Eldoria',
            'description' => 'Фэнтезийная RPG с исследованием мира и развитием персонажа.',
            'price' => 2499.00,
            'category_id' => $rpg->id,
            'user_id' => $seller->id,
            'published' => true,
        ]);

        Game::create([
            'name' => 'Empire Command',
            'description' => 'Стратегия, в которой игрок развивает собственную империю.',
            'price' => 1799.00,
            'category_id' => $strategy->id,
            'user_id' => $seller->id,
            'published' => true,
        ]);

        Game::create([
            'name' => 'City Driver',
            'description' => 'Симулятор вождения с большим городом для исследования.',
            'price' => 999.00,
            'category_id' => $simulator->id,
            'user_id' => $seller->id,
            'published' => true,
        ]);
    }
}