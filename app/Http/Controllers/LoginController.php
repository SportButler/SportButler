<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;


class LoginController extends Controller
{
    public function index ()
    {
      return view('authentication.login');
    }

    public function login (Request $request)
    {

      $this->validate(request(), [

          'email' => 'required|email',

          'password' => 'required',

      ]);

        try{
          $rememberMe = true;

          if(Sentinel::authenticate($request->all(), $rememberMe))
          {
            $slug = Sentinel::getUser()->roles()->first()->slug;

            if($slug == 'admin')
              return redirect('/admin');
            elseif($slug == 'lieferant')
              return redirect('/');
            elseif($slug == 'kunde')
              return redirect('/startseite');
          }
          else {
            return redirect()->back()->with(['error'=>'Wrong Email or Password']);
          }
        }
      catch(ThrottlingException $e){
        $delay = $e->getDelay();

        return redirect()->back()->with(['error'=>"You are banned for $delay seconds."]);
      }
      catch(NotActivatedException $e){

        return redirect()->back()->with(['error'=>"Your Account is not activated yet."]);
      }
    }

    public function logout ()
    {
      Sentinel::logout();

      return redirect('/login');
    }
}
