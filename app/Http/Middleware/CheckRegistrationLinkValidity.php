<?php

namespace App\Http\Middleware;

use App\Models\RegistrationLink;
use Closure;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Symfony\Component\HttpFoundation\Response;

class CheckRegistrationLinkValidity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->token) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $link = RegistrationLink::where('token', $request->token)->first();

        $today = now()->format('Y-m-d H:i:s');

        // dd($request->all(), $link, $link->is_used, $link->expires_at <= $today);

        if ($link->is_used || $link->expires_at <= $today) {
            return redirect()->intended(RouteServiceProvider::HOME)->with('error_message', 'The link is already expired or used.');
        }

        // dd('passed');

        // Delete all expired or used links
        $expired_links = RegistrationLink::where('is_used', true)->orWhere('expires_at', '<=', $today);

        // dd($expired_links->get()->count(), $expired_links);

        if ($expired_links->get()->count() > 0) {
            // dd('Expired link found');

            $expired_links->delete();
        }

        return $next($request);
    }
}
