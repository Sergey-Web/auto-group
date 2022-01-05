<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Player;

interface PlayerCreateInterface
{
    function create(array $data): Player;
}
