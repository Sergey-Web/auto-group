<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Group;
use App\Repositories\GroupRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class AutomaticGroupSelection implements AutomaticGroupSelectionInterface
{
    public function __construct(
        private GroupRepository $groupRepository
    ){}

    /**
     * @throws Exception
     */
    public function getGroup(): Group
    {
        $groups = $this->groupRepository->getGroups();

        if ($groups->count() === 0) {
            $group = new Group();
            $group->id = 0;
        } else {
            $group = $this->selectGroup($groups);
        }

        return $group;
    }

    /**
     * @throws \Exception
     */
    private function selectGroup(Collection $groups): Group
    {
        $totalWeight = $this->totalWeight($groups);
        $randInt = random_int(min: 1, max: $totalWeight);
        $autoGroup = null;
        $groupRange = 0;

        /** @var Group $group */
        foreach ($groups as $group) {
            $groupRange += $group->weight;
            if ($randInt <= $groupRange) {
                $autoGroup = $group;
                break;
            }
        }

        if ($autoGroup === null) {
            throw new Exception('No group selected', 500);
        }

        return $autoGroup;
    }

    private function totalWeight(Collection $groups): int
    {
        $total = 0;
        /** @var Group $group */
        foreach ($groups as $group) {
            $total += $group->weight;
        }

        return $total;
    }
}
