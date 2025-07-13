<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LoginResponse;
use App\Actions\Fortify\LoginResponse as CustomLoginResponse;
use Laravel\Fortify\FortifyServiceProvider as BaseFortifyServiceProvider;
use App\Actions\Fortify\CreateNewUser;

class FortifyServiceProvider extends BaseFortifyServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LoginResponse::class, CustomLoginResponse::class);
    }

    public function boot(): void
    {
        Fortify::loginView(fn() => view('auth.login'));
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::registerView(fn() => view('auth.register'));

        Fortify::authenticateUsing(function ($request) {
            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password,
            ])) {
                $user = Auth::user();

                session(['redirect_after_login' => match ($user->role) {
                    'admin' => route('dashboard.admin'),
                    'mahasiswa' => route('mahasiswa.dashboard'),
                    default => '/',
                }]);

                return $user;
            }

            return null;
        });
    }
}
