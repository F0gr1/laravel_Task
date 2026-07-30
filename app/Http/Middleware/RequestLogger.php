<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RequestLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->isWrite($request)){
            $this->write($request);
        }
        return $next($request);
    }

    private function isWrite(Request $request) : bool{
        return ! $request->isMethod('GET') && ! $request->isMethod('HEAD');
    }

    private function write(Request $request): void{
        // Keep credentials and tokens out of both structured logs and URLs.
        Log::debug('HTTP request', [
            'method' => $request->method(),
            'url' => $request->url(),
        ]);
    }
}
