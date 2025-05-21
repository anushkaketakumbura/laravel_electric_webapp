<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TimeRestrictedAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       $currentTime = Carbon::now()->format('H:i');

       $startTime = '09:00';
       $endTime = '15:00';

       if ($currentTime >= $startTime && $currentTime <= $endTime){
        return $next($request);
       }else{
        return response()->json(['message' => 'Time restricted access.' .$currentTime],403);
       }
    }
}
