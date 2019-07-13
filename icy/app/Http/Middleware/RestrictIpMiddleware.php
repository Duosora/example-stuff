<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Bannedips;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RestrictIpMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $ips = Bannedips::all();

        $query = "SELECT ip from bannedips";
        $ips = DB::select( DB::raw($query) );

        $restricted_ips = array();

        foreach ($ips as $obj){
            $ip = $obj->ip;
            array_push($restricted_ips,$ip);
        }

    if(in_array(request()->ip(), $restricted_ips))
    {
        \Log::warning("Unauthorized access, IP address was => ".request()->ip);
         return response()->json(['Unauthorized Access!'],400);
    }
    return $next($request);
    }
}

