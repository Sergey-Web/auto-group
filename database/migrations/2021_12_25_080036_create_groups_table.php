<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    private const TABLE_NAME = 'groups';

    public function up(): void
    {
        Schema::create(static::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->string(column: 'name', length: 50);
            $table->tinyInteger(column: 'weight');
            $table->tinyInteger(column: 'wight_percent');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: static::TABLE_NAME);
    }
}
