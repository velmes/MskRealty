<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        switch($role){
            case 'admin':
                if(!Auth::user()){
                    if($request->ajax())
                        return response('Access Denied')->setStatusCode(403);
                    abort(404);
                }else
                    if(!$request->user()->is_admin){
                        if($request->ajax())
                            return response('Access Denied')->setStatusCode(403);
                        abort(404);
                    }
                break;
            default:
                return response('Access Denied')->setStatusCode(403);
                break;
        }

        return $next($request);
    }
}
