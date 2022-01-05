<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Counter;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class CounterController extends Controller
{
    public function index(Counter $counter): View
    {
        return view(view: 'main.index', data: ['counters' => $counter->getDataForView()]);
    }

    public function reset(Counter $counter): JsonResponse
    {
        try {
            $counter->resetCounter();
        } catch(Throwable $e) {
            return response()->json(data: [
                'result' => 'error'
            ], status: Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json(data: [
            'result' => 'ok'
        ], status: Response::HTTP_OK);
    }
}
