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
        Schema::dropIfExists(table: 'personal_access_tokens');
        Schema::create(static::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->string(column: 'name', length: 50)->unique()->nullable(false);
            $table->tinyInteger(column: 'weight')->nullable(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: static::TABLE_NAME);
    }
}
