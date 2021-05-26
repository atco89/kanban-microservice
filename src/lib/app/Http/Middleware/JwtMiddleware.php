<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\UnauthorizedException;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

/**
 * Class JwtMiddleware
 * @package App\Http\Middleware
 */
class JwtMiddleware extends BaseMiddleware
{

    /**
     * @param $request
     * @param Closure $next
     * @return JsonResponse
     * @throws TokenExpiredException
     * @throws TokenInvalidException
     */
    public function handle($request, Closure $next): JsonResponse
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $exception) {
            if ($exception instanceof TokenInvalidException) {
                throw new TokenInvalidException('Token is invalid.');
            } else if ($exception instanceof TokenExpiredException) {
                throw new TokenExpiredException('Token is expired.');
            } else {
                throw new UnauthorizedException('Authorization token not found.');
            }
        }
        return $next($request);
    }

}
