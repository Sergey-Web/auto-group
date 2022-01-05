<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\AutomaticGroupSelection;
use App\Services\Counter;
use App\Services\PlayerCreate;
use App\Validators\PlayerValidate;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class PlayerController extends Controller
{
    public function create(
        Request                 $request,
        PlayerCreate            $userService,
        AutomaticGroupSelection $automaticGroupSelection,
        Counter                 $counter
    ): JsonResponse
    {
        try {
            PlayerValidate::toCreate($request->all());
            $user = $userService->create(data: $request->all());
            $group = $automaticGroupSelection->getGroup();

            if ($group->id !== 0) {
                $group->users()->save(model: $user);
                $counter->add($group);
            }

        } catch(Throwable $e) {
            return response()->json(data: [
                'result' => 'error',
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ], status: Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json(data: [
            'result' => 'ok',
            'player' => [
                'id' => $user->id,
                'group' => $group->id
            ]
        ], status: Response::HTTP_OK);
    }
}
