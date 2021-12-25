<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    private const TABLE_NAME = 'users';

    public function up(): void
    {
        Schema::dropIfExists(table: 'personal_access_tokens');
        Schema::create(static::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->string(column: 'display_name', length: 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(table: static::TABLE_NAME);
    }
}
