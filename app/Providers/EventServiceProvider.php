<?php

namespace App\Providers;

use Aacotroneo\Saml2\Events\Saml2LoginEvent;
use Aacotroneo\Saml2\Events\Saml2LogoutEvent;
use App\Actions\SyncUserFromWSO2;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen("Aacotroneo\Saml2\Events\Saml2LoginEvent", function (
            Saml2LoginEvent $event
        ) {
            Log::info("Saml2LoginEvent");
            $user = $event->getSaml2User();
            $synchronizer = new SyncUserFromWSO2();
            $laravelUser = $synchronizer->sync($user);

            Auth::login($laravelUser);;
        });

        Event::listen("Aacotroneo\Saml2\Events\Saml2LogoutEvent", function (
            Saml2LogoutEvent $event
        ) {
            Auth::logout();
            Session::save();
        });
    }
}
