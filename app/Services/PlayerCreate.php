<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Player;
use App\Repositories\PlayerRepository;
use Illuminate\Support\Facades\DB;
use PHPUnit\Util\Exception;
use Throwable;

class PlayerCreate implements PlayerCreateInterface
{
    public function __construct(
        private PlayerRepository $userRepository
    ){}

    public function create(array $data): Player
    {
        if (array_key_exists(key: 'auto', array: $data) === false) {
            $user = $this->userRepository->createUser($data['display_name']);
        } else {
            try {
                DB::beginTransaction();

                $user = $this->userRepository->createUser($this->generateDisplayName());

                DB::commit();
            } catch (Throwable $e) {
                DB::rollBack();
                throw new Exception($e->getMessage(), 500);
            }
        }

        return $user;
    }

    private function generateDisplayName(): string
    {
        return 'Player #' . $this->userRepository->lastInsertId() + 1;
    }
}
