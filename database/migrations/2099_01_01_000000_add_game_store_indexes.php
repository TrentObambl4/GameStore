<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $indexes = [
            ['users', 'role_id', 'users_role_id_index'],
            ['games', 'category_id', 'games_category_id_index'],
            ['games', 'user_id', 'games_user_id_index'],
            ['games', 'published', 'games_published_index'],
        ];

        foreach ($indexes as [$tableName, $column, $indexName]) {
            if (Schema::hasTable($tableName) && !Schema::hasIndex($tableName, $indexName)) {
                Schema::table($tableName, function (Blueprint $table) use ($column, $indexName) {
                    $table->index($column, $indexName);
                });
            }
        }
    }

    public function down(): void
    {
        $indexes = [
            ['users', 'users_role_id_index'],
            ['games', 'games_category_id_index'],
            ['games', 'games_user_id_index'],
            ['games', 'games_published_index'],
        ];

        foreach ($indexes as [$tableName, $indexName]) {
            if (Schema::hasTable($tableName) && Schema::hasIndex($tableName, $indexName)) {
                Schema::table($tableName, function (Blueprint $table) use ($indexName) {
                    $table->dropIndex($indexName);
                });
            }
        }
    }
};
