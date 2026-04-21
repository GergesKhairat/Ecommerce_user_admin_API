<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $access_token = $request->header("access_token");
        if ($access_token != null) {
            $user = User::where("access_token", $access_token)->first();
            if ($user) {
                return $next($request);
            } else {
                return response()->json([
                    "msg" => "no user founded"
                ], 401);
            }
        } else {
            return response()->json([
                "msg" => "no access token founded"
            ], 404);
        }
    }
}
