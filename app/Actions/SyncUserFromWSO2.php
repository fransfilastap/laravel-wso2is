<?php

namespace App\Actions;

use Aacotroneo\Saml2\Saml2User;
use App\Actions\WSO2ISClaims;
use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Hash;

/**
 * 
 * @package App\Actions
 */
class SyncUserFromWSO2
{

    private $DEFAULT_PASSWORD = 'wso2is';

    public function sync(Saml2User $saml2User): User
    {

        if (!$this->isExistingUser($saml2User->getAttribute(WSO2ISClaims::$EMAIL_ADDRESS)[0])) {
            return $this->create($saml2User);
        }

        return $this->updateUser($saml2User);
    }


    /**
     * Check if user already exists
     * 
     * 
     * @param string $email 
     * @return bool 
     */
    public function isExistingUser(string $email)
    {
        $laravelUser = User::where(
            "email",
            $email
        )->first();

        return $laravelUser != null;
    }


    /**
     * 
     * @param Saml2User $saml2User 
     * @return mixed 
     * @throws BindingResolutionException 
     */
    public function create(Saml2User $saml2User)
    {

        $laravelUser = User::create([
            "name" =>
            $saml2User->getAttribute(WSO2ISClaims::$GIVEN_NAME)[0],
            "username" => $saml2User->getAttribute(
                WSO2ISClaims::$USERNAME
            )[0],
            "email" => $saml2User->getAttribute(
                WSO2ISClaims::$EMAIL_ADDRESS
            )[0],
            'email_verified_at' => now(),
            "password" => Hash::make($this->DEFAULT_PASSWORD),
        ]);



        return $laravelUser;
    }


    public function updateUser(Saml2User $saml2User)
    {
        $laravelUser = User::where(
            "email",
            $saml2User->getAttribute(
                WSO2ISClaims::$EMAIL_ADDRESS
            )[0]
        )->first();

        $laravelUser->name = $saml2User->getAttribute(WSO2ISClaims::$GIVEN_NAME)[0];
        $laravelUser->username = $saml2User->getAttribute(WSO2ISClaims::$USERNAME)[0];
        $laravelUser->email = $saml2User->getAttribute(WSO2ISClaims::$EMAIL_ADDRESS)[0];
        $laravelUser->password = Hash::make($this->DEFAULT_PASSWORD);

        $laravelUser->save();

        return $laravelUser;
    }
}
