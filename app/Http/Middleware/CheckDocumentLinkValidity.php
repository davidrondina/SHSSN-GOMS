<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\DocumentLink;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Symfony\Component\HttpFoundation\Response;

class CheckDocumentLinkValidity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $document = DocumentLink::where('token', $request->token)->first();

        $today = now()->format('Y-m-d H:i:s');

        // dd($request->all(), $document, $document->is_used, $document->expires_at <= $today);

        if ($document->is_used || $document->expires_at <= $today) {
            return redirect()->intended(RouteServiceProvider::HOME)->with('error_message', 'The link is already expired or used.');
        }

        // dd('passed');

        // Delete all expired or used links
        $expired_links = DocumentLink::where('is_used', true)->where('expires_at', '<=', $today)->get();

        // dd($expired_links);

        if ($expired_links->count() > 0) {
            // dd('Expired link found');

            $expired_links->delete();
        }

        return $next($request);
    }
}
