<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $name
 * @property int $weight
 * @property string $created_at
 * @property string $updated_at
 */
class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';

    protected $fillable = [
        'name',
        'weight',
        'created_at',
        'updated_at',
    ];

    public function users()
    {
        return $this->belongsToMany(related: Player::class, table: 'player_group');
    }

    public function registrationCounter(): HasOne
    {
        return $this->hasOne(related: RegistrationCounter::class);
    }
}
