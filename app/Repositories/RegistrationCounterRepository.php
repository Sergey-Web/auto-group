<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\RegistrationCounter;
use Illuminate\Database\Eloquent\Collection;

class RegistrationCounterRepository
{
    public function __construct(
        private RegistrationCounter $registrationCounter
    ){}

    public function checkGroup(int $groupId): bool
    {
        return $this->registrationCounter->newQuery()
            ->where(column: ['group_id' => $groupId])
            ->exists()
            ;
    }

    public function create(int $groupId): void
    {
        $this->registrationCounter->newQuery()->insert(['group_id' => $groupId]);
    }

    public function incrementPlayersGroup(int $groupId): void
    {
        $playersNum = $this->registrationCounter->newQuery()
            ->select(columns: 'players')
            ->where(column: ['group_id' => $groupId])
            ->first()
            ->players;
        ;

        $this->registrationCounter->newQuery()
            ->where(column: ['group_id' => $groupId])
            ->update(values: ['players' => $playersNum + 1]);
    }

    public function resetCounterUsers(): void
    {
        $counters = $this->registrationCounter->newQuery()->get();
        /** @var RegistrationCounter $counter */
        foreach ($counters as $counter) {
            $counter->players = 0;
            $counter->save();
        }
    }

    public function getAllDataWithGroup(): Collection
    {
        return $this->registrationCounter->newQuery()->with(relations: 'group')->get();
    }

}
