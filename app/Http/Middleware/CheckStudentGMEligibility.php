<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Symfony\Component\HttpFoundation\Response;

class CheckStudentGMEligibility
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($request->type === 'gm') {
            if ($user->studentInfo->complaintsReceived->count() >= 1) {
                return redirect()->intended(RouteServiceProvider::HOME)->with('error_message', "You are not eligible to issue this document.");
            }
        }

        return $next($request);
    }
}
