<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 26/03/16
 * Time: 03:03
 */

namespace Veloci\User\Resolver;


use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;
use Veloci\User\Exception\AuthenticationFailException;
use Veloci\User\Exception\ValidationException;
use Veloci\User\Repository\UserRepository;
use Veloci\User\User;

class StandardUserResolver implements UserResolver
{
    use ProvidesConvenienceMethods;

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function resolve(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request->get('username');
        $password = $request->get('password');

        //
        $user = $this->userRepository->getUserByUsername($username);

        if ($user === null) {
            throw new ValidationException([
                'username' => 'not exists'
            ]);
        }
        
        if($user->getPassword() !== $password) {
            throw new ValidationException([
                'password' => 'wrong'
            ]);
        }
        
        return $user;
    }

    public static function getType():string
    {
        return 'standard';
    }
}