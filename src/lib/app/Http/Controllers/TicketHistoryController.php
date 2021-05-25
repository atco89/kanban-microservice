<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Interfaces\TicketService;
use Illuminate\Http\JsonResponse;

/**
 * Class TicketHistoryController
 * @package App\Http\Controllers
 */
final class TicketHistoryController extends Controller
{

    /**
     * @var TicketService
     */
    private TicketService $service;

    /**
     * TicketHistoryController constructor.
     * @param TicketService $service
     */
    public function __construct(TicketService $service)
    {
        $this->service = $service;
    }

    /**
     * @param string $uuid
     * @return JsonResponse
     */
    public function retrieveTicketHistory(string $uuid): JsonResponse
    {
        return response()->json($this->service->getHistory($uuid));
    }
}
