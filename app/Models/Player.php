<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $display_name
 * @property string $created_at
 * @property string $updated_at
 */
class Player extends Model
{
    use HasFactory;

    protected $table = 'players';

    protected $fillable = [
        'display_name',
        'created_at',
        'updated_at'
    ];

    public function group()
    {
        return $this->hasOne(related: Group::class);
    }
}
