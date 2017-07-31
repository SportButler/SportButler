<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Club;
use App\User;
use App\Sport;
use App\Event;
use App\Field;
use Sentinel;

class KundenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Check if User belongs to Club
     * Everything else like HomeController
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $fields = Field::orderBy('created_at', 'asc')->get();

      $id = Sentinel::getUser()->id;

      $user = User::find($id);

      $user_me = $user;

      $clubs = $user->clubs();

      $club = $clubs->first();

      if(!empty($club)){

        $club_id = $club->id;

        $clubs = Club::all();

        $sports = Club::find($club_id)->sports;

        $events = Club::find($club_id)->events;

        $fields = Club::find($club_id)->fields;

      }

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

      $clubs = Club::all();

      $users = User::doesntHave('clubs')->where('email', $user_me->email)->get();

      return view('kunde.index', compact('clubs', 'user_me', 'test', 'users', 'fields', 'events', 'sports', 'club', 'role'));
    }


    public function join($id){

      $club = Club::find($id);
      $user_id = Sentinel::getUser()->id;

      $club->users()->attach($user_id);

      return back();
      return redirect()->back();
    }

    public function leave($id){

      $club = Club::find($id);
      $user_id = Sentinel::getUser()->id;

      $club->users()->detach($user_id);

      return back();
      return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
