<?php

namespace App\Providers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Laravel\Passport\Passport;
use Laravel\Passport\PassportServiceProvider;
use League\OAuth2\Server\Grant\PasswordGrant;
use Laravel\Passport\Bridge\RefreshTokenRepository;
use App\Repositorys\CustomPassportRepository;

class CustomPassportProvider extends PassportServiceProvider
{
    /**
     * @throws \Exception
     */
    protected function makePasswordGrant(): PasswordGrant
    {
        try {
            $grant = new PasswordGrant(
                $this->app->make(CustomPassportRepository::class),
                $this->app->make(RefreshTokenRepository::class)
            );
        } catch (BindingResolutionException $e) {
            throw new \Exception($e->getMessage());
        }
        $grant->setRefreshTokenTTL(Passport::refreshTokensExpireIn());
        return $grant;
    }

}
