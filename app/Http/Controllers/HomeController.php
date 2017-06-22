<?php

namespace App\Http\Controllers;

use Sentinel;
use App\Sport;
use App\Event;
use App\Field;
use App\Club;
use App\User;
use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;

class HomeController extends Controller
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

      $sports = Club::find($club_id)->sports;

      $events = Club::find($club_id)->events;

      $fields = Club::find($club_id)->fields;

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

      $color = 'green';

      return view('fields.home', compact('events', 'sports', 'id', 'color', 'fields', 'role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('fields.create', compact('field'));
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

          'name' => 'required',

          'maxplayers' => 'required',

          'priceperhour' => 'required',

          'description' => 'required'

      ]);

      Field::create(request(['name', 'maxplayers', 'priceperhour', 'description']));

      return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\field  $field
     * @return \Illuminate\Http\Response
     */
    public function show(Field $field)
    {
      return view('fields.show', compact('field'));
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
      return view('fields.edit', compact('field'));
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

      //  Field::find($id)->update($request->all());

        return redirect ('/');

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
        Field::where('id', $id)->delete();
        return redirect ('/');
    }
}
