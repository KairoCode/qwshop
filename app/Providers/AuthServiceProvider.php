<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Laravel\Passport\PassportServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // 令牌的有效期
        $this->passportConfig();
    }

    /**
     * passportConfig function
     *
     * @return void
     * @Description 令牌的有效期 配置
     * @Author hg <bishashiwo@gmail.com>
     * @Time 2021-09-21
     */
    public function passportConfig(): void
    {
        $passportProvider = new PassportServiceProvider($this->app);
        $passportProvider->boot();

        Passport::tokensExpireIn(now()->addDays(7));

        Passport::refreshTokensExpireIn(now()->addDays(14));

        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
