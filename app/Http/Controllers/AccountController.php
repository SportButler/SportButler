<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Activation;
use App\User;
use Mail;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
  public function edit($id)
  {
    $user = Sentinel::getUser();

    if($user->inRole('lieferant')){
      $role = 'lieferant';
    }

    if($user->inRole('kunde')){
      $role = 'kunde';
    }

    if($user->inRole('admin')){
      $role = 'admin';
    }


    return view('account.edit', compact('user', 'role'));
  }

  public function update(Request $request, $id)
  {
    $this->validate(request(), [

        'email' => 'required|email',

        'password' => 'required',

    ]);

      $user = Sentinel::findById($id);
      $user->email = $request->email;
      $user->password = Hash::make($request->password);

      $user->save();


    //  Field::find($id)->update($request->all());

      return redirect ('/');

  }
}
