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
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $sellerRole = Role::firstOrCreate(['name' => 'seller']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        $action = Category::firstOrCreate(['name' => 'Экшен']);
        $adventure = Category::firstOrCreate(['name' => 'Приключения']);
        $rpg = Category::firstOrCreate(['name' => 'RPG']);
        $strategy = Category::firstOrCreate(['name' => 'Стратегии']);
        $simulator = Category::firstOrCreate(['name' => 'Симуляторы']);

        User::firstOrCreate(
            ['login' => 'admin'],
            ['password' => Hash::make('admin123'), 'role_id' => $adminRole->id]
        );

        $seller = User::firstOrCreate(
            ['login' => 'seller'],
            ['password' => Hash::make('seller123'), 'role_id' => $sellerRole->id]
        );

        User::firstOrCreate(
            ['login' => 'user'],
            ['password' => Hash::make('user123'), 'role_id' => $userRole->id]
        );

        $games = [
            ['name' => 'Cyber Assault', 'description' => 'Динамичный экшен в футуристическом городе.', 'price' => 1999.00, 'category_id' => $action->id],
            ['name' => 'Lost Island', 'description' => 'Приключенческая игра об исследовании таинственного острова.', 'price' => 1499.00, 'category_id' => $adventure->id],
            ['name' => 'Legends of Eldoria', 'description' => 'Фэнтезийная RPG с исследованием мира и развитием персонажа.', 'price' => 2499.00, 'category_id' => $rpg->id],
            ['name' => 'Empire Command', 'description' => 'Стратегия, в которой игрок развивает собственную империю.', 'price' => 1799.00, 'category_id' => $strategy->id],
            ['name' => 'City Driver', 'description' => 'Симулятор вождения с большим городом для исследования.', 'price' => 999.00, 'category_id' => $simulator->id],
        ];

        foreach ($games as $game) {
            Game::firstOrCreate(
                ['name' => $game['name']],
                $game + ['user_id' => $seller->id, 'published' => true]
            );
        }
    }
}
