<?php

namespace App\Services;

use App\Models\Group;

interface AutomaticGroupSelectionInterface
{
    function getGroup(): Group;
}
