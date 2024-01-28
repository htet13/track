<?php

namespace App\Http\Middleware;

use App\Enums\RouteTypeEnum;
use Closure;
use Illuminate\Http\Request;

class ValidateRouteType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $type = $request->route('type');
        if (!in_array($type,RouteTypeEnum::all())) {
            toast('Invalid request!','error');
            return redirect()->back();
        }
        return $next($request);
    }
}
