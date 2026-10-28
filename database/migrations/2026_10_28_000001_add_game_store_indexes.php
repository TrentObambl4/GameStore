<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->index('role_id', 'users_role_id_index');
        });

        Schema::table('games', function (Blueprint $table) {
            $table->index('category_id', 'games_category_id_index');
            $table->index('user_id', 'games_user_id_index');
            $table->index('published', 'games_published_index');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('users_role_id_index');
        });

        Schema::table('games', function (Blueprint $table) {
            $table->dropIndex('games_category_id_index');
            $table->dropIndex('games_user_id_index');
            $table->dropIndex('games_published_index');
        });
    }
};
