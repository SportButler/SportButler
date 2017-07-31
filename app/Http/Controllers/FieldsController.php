<?php

namespace App\Http\Controllers;

use Log;
use App\Field;
use App\Event;
use App\Sport;
use App\User;
use App\Club;
use Sentinel;
use Illuminate\Http\Request;

class FieldsController extends Controller
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

      $fields = Club::find($club_id)->fields;

      $sports = Club::find($club_id)->sports;

      return view('fields.index', compact('fields', 'sports', 'role'));
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

      return view('fields.create', compact('field', 'sports', 'role'));
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

          'name' => 'required',

          'maxplayers' => 'required',

          'priceperhour' => 'required',

          'description' => 'required'

      ]);

      $field = Field::create(request(['name', 'maxplayers', 'priceperhour', 'description']));

      $field->club_id = $club_id;
      $field->save();

      $sports = Club::find($club_id)->sports;

      foreach ($sports as $sport){
        $name = $sport->name;
        if($request->$name == 1){
          $field->sports()->attach($sport->id);
        }
      }

      if($role == 'lieferant'){
        return redirect('/fields');
      }else{
        return redirect('/admin/fields');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\field  $field
     * @return \Illuminate\Http\Response
     */
    public function show(Field $field)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\field  $field
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $field = Field::find($id);

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

      return view('fields.edit', compact('field', 'sports', 'role'));
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
        $field = Field::find($id);
        $field->name = $request->name;
        $field->maxplayers = $request->maxplayers;
        $field->priceperhour = $request->priceperhour;
        $field->description = $request->description;
        $field->save();

        $id = Sentinel::getUser()->id;

        $user = User::find($id);

        $clubs = $user->clubs();

        $club = $clubs->first();

        $club_id = $club->id;

        $sports = Club::find($club_id)->sports;

        foreach ($sports as $sport){
          $field->sports()->detach($sport->id);
        }

        foreach ($sports as $sport){
          $name = $sport->name;
          if($request->$name == 1){
            $field->sports()->attach($sport->id);
          } else{
            $field->sports()->detach($sport->id);
          }
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

      //  Field::find($id)->update($request->all());
        if($role == 'lieferant'){
          return redirect ('/fields');
        }else{
          return redirect ('/admin/fields');
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
        //Field:destroy($id);
        $events = Event::where('field_id', $id)->get();

        foreach($events as $event){
          $event->users()->detach();
          $event->delete();
        }

        $field = Field::find($id);
        $field->sports()->detach();

        Field::where('id', $id)->delete();

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

        if($role == 'lieferant'){
          return redirect ('/fields');
        }else{
          return redirect ('/admin/fields');
        }
    }
}
