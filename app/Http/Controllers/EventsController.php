<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Field;
use App\Event;
use App\Sport;
use App\User;
use App\Club;
use Sentinel;
use DateTime;
use DateInterval;
use DatePeriod;

class EventsController extends Controller

{

  public function statistics(){
      $fields = Field::all();
      $events = Event::all();

      return view('events.statistics', compact('events', 'fields'));
  }

  public function index(){

      $id = Sentinel::getUser()->id;

      $user = User::find($id);

      $events = $user->events();

      $clubs = $user->clubs();

      $club = $clubs->first();

      $events = $events->orderBy('start')->get();

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

      return view('events.index', compact('events', 'role', 'id'));
  }


  public function show(Event $event){
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

    $id = Sentinel::getUser()->id;
    $event = Event::find($event->id);
    $users = Event::find($event->id)->users;

    return view('events.show', compact('event', 'users', 'id', 'role'));
  }


  public function create(){

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

    $fields = Club::find($club_id)->fields;
    $events = Event::all();
    $maxplayers = 0;

    return view('events.create', compact('events', 'fields', 'sports', 'maxplayers', 'role', 'id'));
  }

  public function store(Request $request){

      $id = Sentinel::getUser()->id;

      $user = User::find($id);

      $clubs = $user->clubs();

      $club = $clubs->first();

      $club_id = $club->id;

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

      $start = $request->date.' '.$request->start;
      $start = new DateTime($start);
      $end = $request->date.' '.$request->end;
      $end = new DateTime($end);

      if($role == 'lieferant' || $role == 'admin'){

        foreach ($fields as $field){
          $startfield = $request->date.' '.$request->start;
          $startfield = new DateTime($startfield);
          $endfield = $request->date.' '.$request->end;
          $endfield = new DateTime($endfield);

          $field_id = $field->id;
          if($request->$field_id == 1){

            $this->validate(request(), [

                'sport_id' => 'required',

                'date' => 'required|date_format:d-m-Y',

                'start' => 'required|date_format:H:i',

                'end' => 'required|date_format:H:i',

                'players' => 'required',

                'currentplayers' => 'required',

            ]);


                $event = Event::create(request(['sport_id', 'players', 'currentplayers', 'description']));
                $event->club_id = $club_id;
                $event->field_id = $field_id;
                $event->start = $startfield;
                $event->end = $endfield;
                $event->user_id = $id;
                $event->save();

                $user_id = Sentinel::getUser()->id;

                $event->users()->attach($user_id);

                if($request->repeat == 1){
                  for($i=1;$i<12;$i++){
                    $startfield->add(new DateInterval('P7D'));
                    $endfield->add(new DateInterval('P7D'));

                    $event = Event::create(request(['sport_id', 'players', 'currentplayers', 'description']));
                    $event->club_id = $club_id;
                    $event->field_id = $field_id;
                    $event->start = $startfield;
                    $event->end = $endfield;
                    $event->user_id = $id;
                    $event->save();

                    $user_id = Sentinel::getUser()->id;

                    $event->users()->attach($user_id);
                  }
                }
                $i = 1;
            }
          }


      }else{

        $this->validate(request(), [

            'field_id' => 'required',

            'sport_id' => 'required',

            'date' => 'required|date_format:d-m-Y',

            'start' => 'required|date_format:H:i',

            'end' => 'required|date_format:H:i',

            'players' => 'required',

            'currentplayers' => 'required',

        ]);

      $event = Event::create(request(['field_id', 'sport_id', 'players', 'currentplayers', 'description']));
      $event->club_id = $club_id;
      $event->start = $startDateTime;
      $event->end = $endDateTime;
      $event->user_id = $id;
      $event->save();

      $user_id = Sentinel::getUser()->id;

      $event->users()->attach($user_id);

      }

      if($role == 'lieferant'){
        return redirect('/');
      }elseif($role == 'admin'){
        return redirect('/admin');
      }else{
        return redirect('/');
      }
  }

  public function destroy($id){
      $event = Event::find($id);
      $event->users()->detach();

      Event::where('id', $id)->delete();
      return redirect ('/');
  }

  public function join($id){
    $linkid = $id;
    $event = Event::find($id);
    $user_id = Sentinel::getUser()->id;
    $event->users()->attach($user_id);

    $event->currentplayers = $event->currentplayers + 1;
    $event->save();

    return back();
    return redirect()->back();
  }

  public function leave($id){
    $event = Event::find($id);
    $user_id = Sentinel::getUser()->id;
    $event->users()->detach($user_id);


    $event->currentplayers = $event->currentplayers - 1;
    $event->save();

    return back();
    return redirect()->back();
  }

  public function findFieldName(Request $request){
    $data = Field::select('maxplayers')->where('id', $request->id)->first();

    return response()->json($data);
  }

  public function checkStart(Request $request){
    $request->start = $request->date.' '.$request->start;
    $start = new DateTime($request->start);
    $request->end = $request->date.' '.$request->end;
    $end = new DateTime($request->end);

    $data = Event::select('id')->where(
      'field_id', '=', $request->id)->where(
      'start', '<=', $start)->where(
      'end', '>', $start)
      ->get();

    return response()->json($data);
  }

  public function checkEnd(Request $request){
    $request->start = $request->date.' '.$request->start;
    $start = new DateTime($request->start);
    $request->end = $request->date.' '.$request->end;
    $end = new DateTime($request->end);

    $data = Event::select('id')->where(
      'field_id', '=', $request->id)->where(
      'start', '<', $end)->where(
      'end', '>=', $end)
      ->get();

    return response()->json($data);
  }

  public function edit($id)
  {
    $event = Event::find($id);

    $id = Sentinel::getUser()->id;

    $user = User::find($id);

    $clubs = $user->clubs();

    $club = $clubs->first();

    $club_id = $club->id;

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

    $sports = Club::find($club_id)->sports;

    return view('events.edit', compact('event', 'sports', 'role', 'fields'));
  }

  public function update(Request $request, $id)
  {
      $start = $request->date.' '.$request->start;
      $start = new DateTime($start);
      $end = $request->date.' '.$request->end;
      $end = new DateTime($end);

      $event = Event::find($id);
      $event->description = $request->description;
      $event->players = $request->players;
      $event->start = $start;
      $event->end = $end;
      $event->sport_id = $request->sport_id;
      $event->save();

      $id = Sentinel::getUser()->id;

      $user = User::find($id);

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
        return redirect ('/');
      }else{
        return redirect ('/admin');
      }
  }
}
