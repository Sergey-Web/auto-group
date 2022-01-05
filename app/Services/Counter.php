<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Group;
use App\Repositories\RegistrationCounterRepository;

class Counter implements CounterInterface
{
    public function __construct(
        private RegistrationCounterRepository $registrationCounterRepository
    ){}

    public function add(Group $group): void
    {
        if ($this->registrationCounterRepository->checkGroup(groupId: $group->id) === false) {
            $this->registrationCounterRepository->create(groupId: $group->id);
        }

        $this->registrationCounterRepository->incrementPlayersGroup($group->id);
    }

    public function resetCounter(): void
    {
        $this->registrationCounterRepository->resetCounterUsers();
    }

    public function getDataForView(): array
    {
        $countersRegistration = $this->registrationCounterRepository->getAllDataWithGroup();
        $data = [];

        if ($countersRegistration->count() > 0) {
            $data = (new StatisticData(rawData: $countersRegistration->toArray()))->get();
        }

        return $data;
    }
}
