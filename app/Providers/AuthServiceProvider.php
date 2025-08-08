<?php


namespace App\Providers;


use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;


class AuthServiceProvider extends ServiceProvider
{
   /**
    * The model to policy mappings.
    */
   protected $policies = [
       // 'App\Models\Model' => 'App\Policies\ModelPolicy',
   ];


   /**
    * Register any authentication / authorization services.
    */
   public function boot(): void
   {
       $this->registerPolicies();


       Gate::define('menu-users', function (User $user) {
           return $user->role === 'user';
       });

         Gate::define('menu-admin', function (User $user) {
           return $user->role === 'admin';
       });
   }
}
