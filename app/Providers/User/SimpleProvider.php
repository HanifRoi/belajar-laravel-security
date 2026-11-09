<?php
namespace App\Providers\User;

use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Override;

class  SimpleProvider implements UserProvider
{
    private GenericUser $user;

    public function __construct()
    {   
        $this->user = new GenericUser([
            'id'=>'roihan',
            'name'=>'Hanif Roihan',
            'token'=>'secret'
        ]);
    }

    #[Override]
    public function retrieveByCredentials(array $credentials)
    {
        if($credentials['token'] == $this->user->__get('token')){
            return $this->user;
        }

        return null;
    }

    #[Override]
    public function retrieveById($identifier)
    {
        throw new \Exception('Not implemented');
    }

    #[Override]
    public function retrieveByToken($identifier, $token)
    {
        throw new \Exception('Not implemented');
    }

    #[Override]
    public function updateRememberToken(Authenticatable $user, $token)
    {
        throw new \Exception('Not implemented');
    }

    #[Override]
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        throw new \Exception('Not implemented');
    }
}
