<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $group_id
 * @property int $players
 */
class RegistrationCounter extends Model
{
    use HasFactory;

    protected $table = 'registration_counter';

    public $timestamps = false;

    protected $fillable = [
        'group_id',
        'players',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(related: Group::class);
    }
}
