<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class socialiteController extends Controller
{
    public function redirect($service)
    {
        return Socialite::driver($service)->redirect();
    }

    public function callback($service) 
    {
        return redirect(url('index'))->with('error','something wrong try again later');
        /*return $user = Socialite::with($service)->user();
        $id = $user->getId();
        $name = $user->getName();
        $email = $user->getEmail();
        $pic = $user->getAvatar();

        return $id;

        // save in db

        // return 

        return redirect(url('index'));*/
    }
}
