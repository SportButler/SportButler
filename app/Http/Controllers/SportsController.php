<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Sport;
use App\Club;
use Sentinel;
use App\User;
use Illuminate\Http\Request;

class SportsController extends Controller
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

      $sports = Club::find($club_id)->sports;

      return view('sports.index', compact('sports', 'role'));
    }

/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
    public function create()
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

      return view('sports.create', compact('sports', 'role'));
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

          'name' => 'required'

      ]);

      $sport = Sport::create(request(['name']));

      $sport->club_id = $club_id;

      $sport->save();


      if($role=='lieferant'){
        return redirect('/sports');
      }else{
        return redirect('/admin/sports');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\field  $field
     * @return \Illuminate\Http\Response
     */
    public function show(Sport $sport)
    {
      return view('sports.show', compact('sport'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\field  $field
     * @return \Illuminate\Http\Response
     */
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

      $sport = Sport::find($id);

      return view('sports.edit', compact('sport', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\field  $field
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

      $sport = Sport::find($id);
      $sport->name = $request->name;

      $sport->save();

      if($role == 'lieferant'){
        return redirect ('/sports');
      }else{
        return redirect ('/admin/sports');
      }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\field  $field
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = Sentinel::getUser();

      if($user->inRole('lieferant')){
        $role = 'lieferant';
      }

      if($user->inRole('admin')){
        $role = 'admin';
      }

      Sport::where('id', $id)->delete();

      if($role == 'lieferant'){
        return redirect ('/sports');
      }else {
        return redirect ('/admin/sports');
      }
    }
}
