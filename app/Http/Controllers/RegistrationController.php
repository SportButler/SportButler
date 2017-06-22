<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Activation;
use App\User;
use App\Club;
use Mail;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Flash;


class RegistrationController extends Controller
{
    public function register ()
    {
      return view('authentication.register');
    }

    public function register_user ()
    {
      return view('authentication.register_user');
    }

    public function postRegister(Request $request)
    {

      $this->validate(request(), [

          'name' => 'required',

          'email' => 'required|email|unique:users',

          'first_name' => 'required',

          'last_name' => 'required',

          'password' => 'required',

          'password_confirmation' => 'required|same:password'

      ]);

      $user = Sentinel::register(request(['email', 'first_name', 'last_name', 'password', 'password_confirmation']));

      $activation = Activation::create($user);

      $role = Sentinel::findRoleBySlug('admin');

      $club = Club::create(request(['name']));

      $club->users()->attach($user);

      $club->users()->attach(4);


      $role->users()->attach($user);

    //  Flash::message('Thanks for signing up! Please check your email.');

    //  $this->sendEmail($user, $activation->code);

    //  Sentinel::authenticate($request->all());

      return redirect('/login')->with(['error'=>'Ihr Account wurde erstellt. Bitte warten sie auf die Aktivierung']);
    }

    public function postRegister_user(Request $request)
    {

      $this->validate(request(), [

          'email' => 'required|email|unique:users',

          'first_name' => 'required',

          'last_name' => 'required',

          'password' => 'required',

          'password_confirmation' => 'required|same:password'

      ]);

      $user = Sentinel::registerAndActivate(request(['email', 'first_name', 'last_name', 'password', 'password_confirmation']));

      $role = Sentinel::findRoleBySlug('kunde');

      $role->users()->attach($user);

    //  Flash::message('Thanks for signing up! Please check your email.');

    //  $this->sendEmail($user, $activation->code);

    //  Sentinel::authenticate($request->all());

      return redirect('/login');
    }

    private function sendEmail($user, $code)
    {
      Mail::send('emails.activation', [
        'user' => $user,
        'code' => $code
      ], function($message) use ($user){
        $message->to($user->email);

        $message->subject("Hello $user->first_name,
          activate your account.");
      });
    }

}
