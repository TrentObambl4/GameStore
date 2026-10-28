<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("games", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("description");
            $table->decimal("price", 10, 2);
            $table->string("image")->nullable();
            $table->foreignId("category_id")
                ->constrained("categories")
                ->restrictOnDelete();
            $table->foreignId("user_id")
                ->constrained("users")
                ->cascadeOnDelete();
            $table->boolean("published")->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("games");
    }
};

