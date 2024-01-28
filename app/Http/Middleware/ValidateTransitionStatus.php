<?php

namespace App\Http\Middleware;

use App\Enums\TransitionStatusEnum;
use Closure;

class ValidateTransitionStatus
{
    public function handle($request, Closure $next)
    {
        $type = $request->route('type');
        if (!in_array($type,TransitionStatusEnum::all())) {
            toast('Invalid request!','error');
            return redirect()->back();
        }
        return $next($request);
    }
}
