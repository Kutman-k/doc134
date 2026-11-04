<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Если старая колонка birthdate существует, удаляем её
            if (Schema::hasColumn('users', 'birthdate')) {
                $table->dropColumn('birthdate');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // На случай отката (если нужно будет вернуть)
            if (!Schema::hasColumn('users', 'birthdate')) {
                $table->date('birthdate')->nullable();
            }
        });
    }
};