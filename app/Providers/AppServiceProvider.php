<?php

namespace App\Providers;

use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                // ->flags([
                //     'fa' => asset('flags/iran.svg'),
                //     'fr' => asset('flags/france.svg'),
                //     'en' => asset('flags/usa.svg'),
                // ])
                // ->circular()
                ->locales(['en', 'fr', 'fa']); // also accepts a closure
        });

    }
}
