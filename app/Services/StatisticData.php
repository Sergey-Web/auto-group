<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\RegistrationCounter;

class StatisticData implements StatisticDataInterface
{
    private array $weightPercentage;
    private array $playersPercentage;

    public function __construct(private array $rawData)
    {
        $this->weightPercentage = $this->calculatingWeightPercentage();
        $this->playersPercentage = $this->calculatingPlayersPercentage();
    }

    public function get(): array
    {
        $data = [];

        /** @var RegistrationCounter $registrationCounter */
        foreach ($this->rawData as $key => $registrationCounter) {
            $data[$key]['group_name'] = $registrationCounter['group']['name'];
            $data[$key]['weight'] = $registrationCounter['group']['weight'];
            $data[$key]['weight_percent'] = $this->weightPercentage[$registrationCounter['id']] ?? 0;
            $data[$key]['players'] = $registrationCounter['players'];
            $data[$key]['players_percent'] = $this->playersPercentage[$registrationCounter['id']] ?? 0;
        }

        return $data;
    }

    private function calculatingWeightPercentage(): array
    {
        $data = [];
        $groups = array_column(array: $this->rawData, column_key: 'group');
        $weightSum = array_sum(array_column(array: $groups, column_key: 'weight'));

        /** @var RegistrationCounter $registrationCounter */
        foreach ($this->rawData as $registrationCounter) {
            $data[$registrationCounter['id']] = (int) round(num: $registrationCounter['group']['weight'] / $weightSum * 100);
        }

        return $data;
    }

    private function calculatingPlayersPercentage(): array
    {
        $data = [];
        $playersSum = array_sum(array_column(array: $this->rawData, column_key: 'players'));

        /** @var RegistrationCounter $registrationCounter */
        foreach ($this->rawData as $registrationCounter) {
            if ($registrationCounter['players'] > 0) {
                $data[$registrationCounter['id']] = (int) round(num: $registrationCounter['players'] / $playersSum * 100);
            }
        }

        return $data;
    }
}
