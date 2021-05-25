<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Interfaces\TicketService;
use App\Services\Interfaces\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class SearchController
 * @package App\Http\Controllers
 */
final class SearchController extends Controller
{

    /**
     * @var TicketService
     */
    private TicketService $ticketService;

    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     * SearchController constructor.
     * @param TicketService $ticketService
     * @param UserService $userService
     */
    public function __construct(TicketService $ticketService, UserService $userService)
    {
        $this->ticketService = $ticketService;
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function searchTicket(Request $request): JsonResponse
    {
        return response()->json($this->ticketService->search($request->query('title')));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function searchUser(Request $request): JsonResponse
    {
        return response()->json($this->userService->search($request->query('keyWords')));
    }
}
