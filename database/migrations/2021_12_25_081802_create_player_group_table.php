<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerGroupTable extends Migration
{
    private const TABLE_NAME = 'player_group';

    public function up(): void
    {
        Schema::create(static::TABLE_NAME, function (Blueprint $table) {
            $table->foreignId(column: 'player_id')->constrained(table: 'players')->cascadeOnDelete()->cascadeOnUpdate();;
            $table->foreignId(column: 'group_id')->constrained(table: 'groups')->cascadeOnDelete()->cascadeOnUpdate();;
            $table->primary(columns: ['player_id', 'group_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: static::TABLE_NAME);
    }
}
