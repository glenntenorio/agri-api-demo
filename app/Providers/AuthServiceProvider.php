<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {
            if ($request->input('api_token')) {
                $user_repo = new UserRepository(new User);
                return $user_repo->findOneBy( ['api_token' => $request->input('api_token')] );
            }
        });

        Gate::define('field update', function ($user, $field) {
            if($user->is_admin)
                return true;
            
            return $user->id == $field->user_id;
        });

        Gate::define('field delete', function ($user, $field) {
            if($user->is_admin)
                return true;

            return $user->id == $field->user_id;
        });

        Gate::define('tractor update', function ($user, $tractor) {
            if($user->is_admin)
                return true;
            
            return $user->id == $tractor->user_id;
        });

        Gate::define('tractor delete', function ($user, $tractor) {
            if($user->is_admin)
                return true;
                
            return $user->id == $tractor->user_id;
        });

        Gate::define('processed_field update', function ($user, $processed_field) {
            if($user->is_admin)
                return true;
            
            return $user->id == $processed_field->user_id;
        });

        Gate::define('processed_field delete', function ($user, $processed_field) {
            if($user->is_admin)
                return true;
                
            return $user->id == $processed_field->user_id;
        });

        Gate::define('processed_field approve', function ($user) {
            return $user->is_admin;
        });
    }
}
