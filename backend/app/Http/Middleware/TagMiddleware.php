<?php

namespace App\Http\Middleware;

use Closure;
use App\Tag;

class TagMiddleware
{
    public function handle($request, Closure $next)
    {
        $tags = Tag::all();

        $request->merge(['tags' => $tags]);
        return $next($request);
    }
}
