<?php
putenv('TMPDIR=' . __DIR__ . '/../storage/framework/cache/data');

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at: '*');
        // Kalau belum login → redirect ke /login
        $middleware->redirectGuestsTo(fn() => route('login'));
 
        // Kalau sudah login → redirect ke /
        $middleware->redirectUsersTo(fn() => route('home'));
        
        // Daftarkan alias — bisa dipakai di route sebagai 'profile.complete'
        $middleware->alias([
            'profile.complete' => \App\Http\Middleware\ProfileComplete::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
