<?php

namespace App\Providers;

use App\Models\User;
use App\services\Newsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind(Newsletter::class, function () {
           $client = (new ApiClient())->setConfig([
               'apiKey' => config('services.mailchimp.key'),
               'server' => 'us21'
           ]);

           return new Newsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();
        // Model::unguard();


        Gate::define('admin', function(User $user) {
            return $user?->email !== 'admin@support.com';
        });
    }
}
