<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Group;
use Illuminate\Database\Eloquent\Collection;

class GroupRepository
{
    public function __construct(
        private Group $group
    ){}

    public function getGroups(): Collection
    {
        return $this->group->newQuery()->get();
    }
}
