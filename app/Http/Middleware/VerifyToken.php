<?php

namespace App\Http\Middleware;

use App\Utils\TokenValidator;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyToken
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $bearerToken = $request->bearerToken();
        if (is_null($bearerToken)) {
           return  response(__('validation.missingProperty', ['property' => 'token']), 400);
        }
        if (!(new TokenValidator($bearerToken))->isValid()) {
            return response(__('validation.wrongFormatProperty', ['property' => 'token']), 401);
        }
        return $next($request);
    }
}
