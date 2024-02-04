<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $defaultLocale)
    {
        $locale = $request->segment(1) ?: $defaultLocale;
        $supportedLocales = config('app.locales');

        // Check if the {locale} segment is provided, otherwise set a default
        if (in_array($locale, array_keys($supportedLocales))) {
            app()->setLocale($locale);
            URL::defaults(['locale' => $locale]);
        } else {
            // Set a default locale if {locale} is not provided
            app()->setLocale(config('app.fallback_locale'));
            URL::defaults(['locale' => null]); // or remove the 'locale' parameter from the URL
        }

        return $next($request);
    }
}
