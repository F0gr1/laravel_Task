<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RequestLogger
{
    private array $excludes = [
        '_debugger',
    ];
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
        return !in_array($request->path(), $this->excludes, true);
    }

    private function write(Request $request): void{
        Log::debug($request->method(), ['url' => $request->fullUrl(), 'request' => $request->all()]);
    }
}
