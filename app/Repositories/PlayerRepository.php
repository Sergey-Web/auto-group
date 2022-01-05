<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Player;

class PlayerRepository
{
    public function __construct(
        private Player $player
    ){}

    public function createUser(string $displayName): Player
    {
        $this->player->display_name = $displayName;
        $this->player->save();

        return $this->player;
    }

    public function lastInsertId(): int
    {
        $user = $this->player->newQuery()
            ->select(columns: 'id')
            ->orderByDesc(column: 'id')
            ->first();

        return ($user !== null) ? $user->id : 0;
    }
}
