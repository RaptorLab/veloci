<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 26/03/16
 * Time: 02:51
 */

namespace Veloci\User\Resolver;


use Illuminate\Http\Request;
use Veloci\User\User;

interface UserResolver
{
    public function resolve(Request $request);

    public static function getType():string;
}