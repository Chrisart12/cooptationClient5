<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Exceptions\RoleException;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
    
        // check if user has role(s)
			if(Auth::user()->hasAnyRole($roles)) {

				return $next($request);
			}
            // return response("Vous n'avez pas la permission", 401);
        //    \abort(403);
        
        throw new RoleException;
        
    }
}
