<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserGroupTable extends Migration
{
    private const TABLE_NAME = 'user_group';

    public function up(): void
    {
        Schema::create(static::TABLE_NAME, function (Blueprint $table) {
            $table->id();

            $table->foreignId(column: 'user_id')->constrained(table: 'users');
            $table->foreignId(column: 'group_id')->constrained(table: 'groups');

            $table->unique(['user_id', 'group_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: static::TABLE_NAME);
    }
}
