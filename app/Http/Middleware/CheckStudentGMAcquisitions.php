<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use App\Enums\DocumentType;
use Illuminate\Http\Request;
use App\Models\DocumentAcquisition;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckStudentGMAcquisitions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->type === 'gm') {
            $acquisitions = DocumentAcquisition::where('user_id', Auth::user()->id);

            $gm_acquisitions = $acquisitions->where('name', DocumentType::GM->value);

            if ($gm_acquisitions->count() >= 3) {
                return redirect()->intended(RouteServiceProvider::HOME)->with('error_message', "You cannot issue this document as you've reached the maximum number of acquisitions.");
            }
        }

        return $next($request);
    }
}
