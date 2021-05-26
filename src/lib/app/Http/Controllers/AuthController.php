<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\AuthDto;
use App\Models\Mapper\Mapper;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;

/**
 * Class AuthController
 * @package App\Http\Controllers
 */
final class AuthController extends Controller
{

    /**
     * @var AutoMapper
     */
    private AutoMapper $mapper;

    /**
     * AuthController constructor.
     * @param Mapper $mapper
     */
    public function __construct(Mapper $mapper)
    {
        $this->mapper = $mapper->load();
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws UnregisteredMappingException
     */
    public function signIn(Request $request, Response $response): Response
    {
        $credentials = get_object_vars($this->mapper->map($request, AuthDto::class));
        if (!$token = auth()->attempt($credentials)) {
            throw new UnauthorizedException("Not valid email or password.");
        }
        return $response->header('Authentication', $token);
    }
}
