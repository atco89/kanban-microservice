<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Mapper\Mapper;
use App\Models\UserDto;
use App\Services\Interfaces\UserService;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
final class UserController extends Controller
{

    /**
     * @var AutoMapper
     */
    private AutoMapper $mapper;

    /**
     * @var UserService
     */
    private UserService $service;

    /**
     * UserController constructor.
     * @param Mapper $mapper
     * @param UserService $service
     */
    public function __construct(Mapper $mapper, UserService $service)
    {
        $this->mapper = $mapper->load();
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws UnregisteredMappingException
     */
    public function storeUser(Request $request): JsonResponse
    {
        $userDto = $this->mapper->map($request, UserDto::class);
        return response()->json($this->service->store($userDto), Response::HTTP_CREATED);
    }

    /**
     * @return JsonResponse
     */
    public function retrieveAllUsers(): JsonResponse
    {
        return response()->json($this->service->getAll());
    }

    /**
     * @param string $uuid
     * @return JsonResponse
     */
    public function retrieveUser(string $uuid): JsonResponse
    {
        return response()->json($this->service->get($uuid));
    }

    /**
     * @param Request $request
     * @param string $uuid
     * @return JsonResponse
     * @throws UnregisteredMappingException
     */
    public function modifyUser(Request $request, string $uuid): JsonResponse
    {
        $userDto = $this->mapper->map($request, UserDto::class);
        return response()->json($this->service->modify($uuid, $userDto));
    }

    /**
     * @param string $uuid
     * @return JsonResponse
     */
    public function deleteUser(string $uuid): JsonResponse
    {
        $this->service->delete($uuid);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
