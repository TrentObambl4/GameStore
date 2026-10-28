<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GameController::class, 'index'])->name('home');

Route::get('/category/{category}', [GameController::class, 'category'])
    ->name('category');

Route::get('/game/{game}', [GameController::class, 'show'])
    ->name('game.show');


/*
|--------------------------------------------------------------------------
| Авторизация
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Раздел продавца
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:seller'])
    ->prefix('seller')
    ->group(function () {

        Route::get('/', [SellerController::class, 'index'])
            ->name('seller.index');

        Route::get('/create', [SellerController::class, 'create'])
            ->name('seller.create');

        Route::post('/', [SellerController::class, 'store'])
            ->name('seller.store');

        Route::get('/{game}/edit', [SellerController::class, 'edit'])
            ->name('seller.edit');

        Route::put('/{game}', [SellerController::class, 'update'])
            ->name('seller.update');

        Route::post('/{game}/toggle', [SellerController::class, 'toggle'])
            ->name('seller.toggle');
    });


/*
|--------------------------------------------------------------------------
| Раздел администратора
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/', [AdminController::class, 'index'])
            ->name('admin.index');

        /*
         * Сначала администратор видит список продавцов,
         * затем выбирает конкретного продавца
         * и видит игры этого продавца.
         */
        Route::get('/seller/{user}', [AdminController::class, 'sellerGames'])
            ->name('admin.seller.games');

        Route::post('/game/{game}/toggle', [AdminController::class, 'toggle'])
            ->name('admin.game.toggle');

        Route::get('/game/{game}/edit', [AdminController::class, 'edit'])
            ->name('admin.game.edit');

        Route::put('/game/{game}', [AdminController::class, 'update'])
            ->name('admin.game.update');

        Route::delete('/game/{game}', [AdminController::class, 'destroy'])
            ->name('admin.game.destroy');

        Route::get('/users', [AdminController::class, 'users'])
            ->name('admin.users');

        Route::put('/users/{user}/role', [AdminController::class, 'updateRole'])
            ->name('admin.user.role');
    });
