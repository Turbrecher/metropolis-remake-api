<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ParamIsNumeric
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request,  Closure $next): Response
    {

        if (!is_numeric($request->route('id'))) {
            return response()->json(
                "You have to filter by id, which has to be a number",
                400
            );
        }


        return $next($request);
    }
}
