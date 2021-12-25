<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationConuterTable extends Migration
{
    private const TABLE_NAME = 'registration_counter';

    public function up(): void
    {
        Schema::create(static::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_group_id')->constrained('users');
            $table->unsignedInteger('players');
            $table->tinyInteger('players_percent');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: static::TABLE_NAME);
    }
}
