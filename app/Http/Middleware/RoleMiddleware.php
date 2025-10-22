<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class RoleMiddleware
{
   
    public function handle(Request $request, Closure $next): Response
    {
        $user =Auth::user();


        if(!$user || !in_array($user->role, $roles)){
            return response()->json(['error'=>'sizda bu amalni bajarish huquqi yoq!']);
        }
    }
}