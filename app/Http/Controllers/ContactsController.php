<?php

namespace App\Http\Controllers;

use App\Sport;
use App\Contact;
use App\User;
use App\Club;
use Sentinel;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $id = Sentinel::getUser()->id;

      $user = User::find($id);

      $clubs = $user->clubs();

      $club = $clubs->first();

      $club_id = $club->id;

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

      $contacts = Club::find($club_id)->contacts;

      $sports = Club::find($club_id)->sports;

      return view('contacts.index', compact('contacts', 'sports', 'role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $id = Sentinel::getUser()->id;

      $user = User::find($id);

      $clubs = $user->clubs();

      $club = $clubs->first();

      $club_id = $club->id;

      $sports = Club::find($club_id)->sports;

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

      return view('contacts.create', compact('contacts', 'sports', 'role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $id = Sentinel::getUser()->id;

      $user = User::find($id);

      $clubs = $user->clubs();

      $club = $clubs->first();

      $club_id = $club->id;

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

      $this->validate(request(), [

          'sport_id' => 'required',

          'name' => 'required',

          'phonenumber' => 'required'

      ]);

      $contact = Contact::create(request(['sport_id', 'name', 'phonenumber']));

      $contact->club_id = $club_id;
      $contact->save();

      if($role == 'lieferant'){
        return redirect('/contacts');
      }else{
        return redirect('/admin/contacts');
      }
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
      $contact = Contact::find($id);

      $id = Sentinel::getUser()->id;

      $user = User::find($id);

      $clubs = $user->clubs();

      $club = $clubs->first();

      $club_id = $club->id;

      $sports = Club::find($club_id)->sports;

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

      return view('contacts.edit', compact('contact', 'sports', 'role'));
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

      $contact = Contact::find($id);
      $contact->sport_id = $request->sport_id;
      $contact->name = $request->name;
      $contact->phonenumber = $request->phonenumber;
      $contact->save();

      if($role == 'lieferant'){
        return redirect ('/contacts');
      }else{
        return redirect ('/admin/contacts');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
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

      Contact::where('id', $id)->delete();

      if($role == 'lieferant'){
        return redirect ('/contacts');
      }else{
        return redirect ('/admin/contacts');
      }
    }
}
