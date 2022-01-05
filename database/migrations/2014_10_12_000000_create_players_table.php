<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    private const TABLE_NAME = 'players';

    public function up(): void
    {
        Schema::create(static::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->string(column: 'display_name', length: 50)->unique()->nullable(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(table: static::TABLE_NAME);
    }
}
