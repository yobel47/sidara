<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Hashing\Hasher;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        /*
        |----------------------------------------------------------------------
        | Override Auth provider supaya cek kolom 'username' bukan 'email'
        | Ini dipanggil saat Auth::attempt(['username' => ..., 'password' => ...])
        |----------------------------------------------------------------------
        */
        Auth::provider('eloquent-username', function ($app, array $config) {
            return new UsernameUserProvider($app['hash'], $config['model']);
        });
    }
}

/*
|--------------------------------------------------------------------------
| Custom User Provider — login pakai username
|--------------------------------------------------------------------------
*/
class UsernameUserProvider extends EloquentUserProvider
{
    public function __construct(Hasher $hasher, string $model)
    {
        parent::__construct($hasher, $model);
    }

    /**
     * Laravel biasanya query WHERE email = ?
     * Kita override supaya query WHERE username = ?
     */
    public function retrieveByCredentials(array $credentials): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        $query = $this->newModelQuery();

        foreach ($credentials as $key => $value) {
            if ($key === 'password') continue;

            // Map 'username' key ke kolom username di database
            $query->where($key, $value);
        }

        return $query->first();
    }
}