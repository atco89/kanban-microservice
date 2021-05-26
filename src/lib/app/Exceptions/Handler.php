<?php
declare(strict_types=1);

namespace App\Exceptions;

use App\Models\ErrorDto;
use App\Models\Mapper\Mapper;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;
use Throwable;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

/**
 * Class Handler
 * @package App\Exceptions
 */
class Handler extends ExceptionHandler
{

    /**
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * @var string[]
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * @param Throwable $exception
     * @throws Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * @param Request $request
     * @param Throwable $exception
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     * @throws UnregisteredMappingException
     */
    public function render($request, Throwable $exception): \Symfony\Component\HttpFoundation\Response
    {
        $mapper = (new Mapper())->load();

        switch (true) {
            case $exception instanceof NotUniqueEmailException:
                return response()->json($mapper->map($exception, ErrorDto::class), Response::HTTP_BAD_REQUEST);
            case $exception instanceof UserNotFoundException:
                return response()->json($mapper->map($exception, ErrorDto::class), Response::HTTP_NOT_FOUND);
            case $exception instanceof Throwable:
                return response()->json($mapper->map($exception, ErrorDto::class), Response::HTTP_INTERNAL_SERVER_ERROR);
            case $exception instanceof TokenInvalidException:
            case $exception instanceof TokenExpiredException:
            case $exception instanceof UnauthorizedException:
                return response()->json($mapper->map($exception, ErrorDto::class), Response::HTTP_UNAUTHORIZED);
            default:
                return parent::render($request, $exception);
        }
    }
}
