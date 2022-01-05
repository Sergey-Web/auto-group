<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Group;

interface CounterInterface
{
    function add(Group $group): void;

    function resetCounter(): void;

    function getDataForView(): array;
}
