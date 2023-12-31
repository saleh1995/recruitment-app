<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // authorization for job seeker user type
        Gate::define('job-seeker', function($user){
            return $user->type == 1;
        });

        // authorization for employer user type
        Gate::define('employer', function($user){
            return $user->type == 2;
        });


        // authorization for preforming actions on joblistings by employers
        Gate::define('job-listing', function($user, $job){
            return $user->id == $job->employer_id;
        });

        // authorization for preforming actions on applications by job seeker
        Gate::define('job-seeker-application', function($user, $application){
            return $user->id == $application->job_seeker_id;
        });

    }
}
