<?php declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RequestLogger
{
    private $excludes = [
        '_debugbar',
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
        if (config('logging.request.enable')) {
            if ($this->isWrite($request)) {
                $this->write($request);
            }
        }
        return $next($request);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    private function isWrite(Request $request): bool
    {
        return !in_array($request->path(), $this->excludes, true);
    }

    /**
     * @param \Illuminate\Http\Request $request
     */
    private function write(Request $request): void
    {
        Log::debug($request->method(), ['url' => $request->fullUrl(), 'request' =>$request->session()->all()]);
    }
}
