<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Os middlewares globais da aplicação.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \App\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \App\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
    ];

    /**
     * Os middlewares da aplicação por rota.
     *
     * @var array<string, class-string>
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth:sanctum' => \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        'auth.basic' => \App\Http\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \App\Http\Middleware\SetCacheHeaders::class,
        'can' => \App\Http\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \App\Http\Middleware\RequirePassword::class,
        'throttle' => \App\Http\Middleware\ThrottleRequests::class,
        'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
    ];

    /**
     * Define os middlewares da aplicação no kernel.
     */
    public function __construct()
    {
        parent::__construct();
    }

    
}
