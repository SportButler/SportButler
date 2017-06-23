<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Activation;
use App\User;
use Mail;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Flash;


class AppRegistrationController extends Controller
{

    public function postRegister(Request $request)
    {

      // $this->validate(request(), [
      //
      //     'email' => 'required|email|unique:users',
      //
      //     'first_name' => 'required',
      //
      //     'last_name' => 'required',
      //
      //     'password' => 'required',
      //
      //     'password_confirmation' => 'required|same:password'
      //
      // ]);

      $user = Sentinel::registerAndActivate(request(['email', 'first_name', 'last_name', 'password', 'password_confirmation']));

      //$activation = Activation::create($user);

      $role = Sentinel::findRoleBySlug('kunde');

      $role->users()->attach($user);

      // return Response::json([
      //         'message' => 'Joke Created Succesfully',
      //         'data' => $this->transform($user)
      // ]);

    //  Flash::message('Thanks for signing up! Please check your email.');

    //  $this->sendEmail($user, $activation->code);

    //  Sentinel::authenticate($request->all());

    }

    // private function transform($user){
    //         return [
    //                 'email' => $user['email'],
    //                 'password' => $user['password'],
    //                 'password_confirmation' => $user['password_confirmation'],
    //
    //         ];
    //     }

}
