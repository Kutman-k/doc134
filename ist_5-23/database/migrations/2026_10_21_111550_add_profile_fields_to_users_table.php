<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Проверяем каждую колонку перед добавлением
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->unique()->nullable();
            }
            if (!Schema::hasColumn('users', 'gender')) {
                $table->enum('gender', ['male', 'female', 'other'])->nullable();
            }
            if (!Schema::hasColumn('users', 'birth_date')) {
                $table->date('birth_date')->nullable();
            }
            if (!Schema::hasColumn('users', 'city')) {
                $table->string('city', 100)->nullable();
            }
            if (!Schema::hasColumn('users', 'bio')) {
                $table->text('bio')->nullable();
            }
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable();
            }
            if (!Schema::hasColumn('users', 'telegram')) {
                $table->string('telegram', 50)->nullable();
            }
            if (!Schema::hasColumn('users', 'is_subcribed')) {
                $table->boolean('is_subcribed')->default(false);
            }
        });
    }

    public function down(): void
    {
        // При откате удаляем только те колонки, которые есть
        Schema::table('users', function (Blueprint $table) {
            $columns = ['phone', 'gender', 'birth_date', 'city', 'bio', 'avatar', 'telegram', 'is_subcribed'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};