<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Activation;
use App\User;
use App\Club;
use Mail;
use Illuminate\Support\Facades\Hash;
use Cartalyst\Sentinel\Users\UserInterface;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $role = Sentinel::findRoleBySlug('lieferant');

      $lieferanten = $role->users()->with('roles')->get();

      $role = Sentinel::findRoleBySlug('kunde');

      $kunden = $role->users()->with('roles')->get();

      $role = Sentinel::findRoleBySlug('admin');

      $admins = $role->users()->with('roles')->get();

      $id = Sentinel::getUser()->id;

      $user = User::find($id);

      $activations = Activation::all();

      $users = User::all();

      return view('admin.index', compact('activations', 'user', 'users', 'id', 'lieferanten', 'kunden', 'admins'));
    }

    public function activation()
    {
      $users = User::all();

      $activations = Activation::all();

      return view('admin.activation',compact('activations', 'users'));
    }

    public function activate_user(Request $request, $id) {

      $activation = Activation::find($id);
      $activation->completed = true;
      $activation->save();

      return redirect ('/admin/mitglieder');

    }

    public function deactivate_user(Request $request, $id) {

      $activation = Activation::find($id);
      if($activation->completed = true){
        $activation->completed = false;
      }
      $activation->save();
      return redirect ('/admin/mitglieder');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(request(), [

            'email' => 'required|email|unique:users',

            'first_name' => 'required',

            'last_name' => 'required',

            'password' => 'required',

            'password_confirmation' => 'required|same:password'

        ]);

        $new_user = Sentinel::registerAndActivate(request(['email', 'first_name', 'last_name', 'password', 'password_confirmation']));

        $role = Sentinel::findRoleBySlug('lieferant');

        $role->users()->attach($new_user);

        $user_id = $new_user->id;

        $id = Sentinel::getUser()->id;

        $user = User::find($id);

        foreach($user->clubs as $club){
          $club->users()->attach($user_id);
        }


        return redirect('/admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
     {
       $user = User::find($id);
       return view('admin.edit', compact('user'));
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
     {
         $user = Sentinel::findById($id);
         $user->email = $request->email;
         $user->password = Hash::make($request->password);

         $user->save();


       //  Field::find($id)->update($request->all());

         return redirect ('/admin');

     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     {
       $user = Sentinel::findById($id);
       Activation::remove($user);

       $role = Sentinel::findRoleByName('Lieferant');
       $role->users()->detach($user);

       User::where('id', $id)->delete();
       return redirect ('/admin');
     }
}
