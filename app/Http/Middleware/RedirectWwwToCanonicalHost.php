<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Sends www.<canonical host> to the canonical origin with a permanent redirect,
 * so search engines see one site instead of two copies.
 */
class RedirectWwwToCanonicalHost
{
    public function handle(Request $request, Closure $next): Response
    {
        $base = config('seo.canonical_base');
        $canonicalHost = parse_url($base, PHP_URL_HOST);

        if ($request->isMethodSafe() && $canonicalHost && strcasecmp($request->getHost(), 'www.' . $canonicalHost) === 0) {
            return redirect()->to($base . $request->getRequestUri(), 301);
        }

        return $next($request);
    }
}
