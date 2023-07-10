<?php

namespace App\Http\Middleware;

use App\Http\Resources\ErrorResource;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param $roles
     * @return Response
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        $roles = explode('|', $roles);
        $check = false;
        foreach($roles as $role){
            if(strtolower($request->user()->role->name) == $role) {
                $check = true;
            }
        }
        if(!$check) {
            return response()->json(['message' => 'Invalid permissions']);
//            return redirect('/login');
        }

        return $next($request);
    }
}
