<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Mapper\Mapper;
use App\Models\TicketDto;
use App\Services\Interfaces\TicketService;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class TicketController
 * @package App\Http\Controllers
 */
final class TicketController extends Controller
{

    /**
     * @var AutoMapper
     */
    private AutoMapper $mapper;

    /**
     * @var TicketService
     */
    private TicketService $service;

    /**
     * TicketController constructor.
     * @param Mapper $mapper
     * @param TicketService $service
     */
    public function __construct(Mapper $mapper, TicketService $service)
    {
        $this->mapper = $mapper->load();
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws UnregisteredMappingException
     */
    public function storeTicket(Request $request): JsonResponse
    {
        $ticketDto = $this->mapper->map($request, TicketDto::class);
        return response()->json($this->service->store($ticketDto), Response::HTTP_CREATED);
    }

    /**
     * @return JsonResponse
     */
    public function retrieveAllTickets(): JsonResponse
    {
        return response()->json($this->service->getAll());
    }

    /**
     * @param string $uuid
     * @return JsonResponse
     */
    public function retrieveTicket(string $uuid): JsonResponse
    {
        return response()->json($this->service->get($uuid));
    }

    /**
     * @param Request $request
     * @param string $uuid
     * @return JsonResponse
     * @throws UnregisteredMappingException
     */
    public function modifyTicket(Request $request, string $uuid): JsonResponse
    {
        $ticketDto = $this->mapper->map($request, TicketDto::class);
        return response()->json($this->service->modify($uuid, $ticketDto));
    }

    /**
     * @param string $uuid
     * @return JsonResponse
     */
    public function deleteTicket(string $uuid): JsonResponse
    {
        $this->service->delete($uuid);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
