@extends ('layouts.master')

@section('content')


<div class="modal fade" id="deleteEvent" tabindex="-1" role="dialog" aria-labelledby="deleteEventLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteEventLabel">Achtung!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          Sind Sie sich sicher das Sie diese Veranstaltung löschen möchten?
      </div>
      <div class="modal-footer">
      @if($role == 'lieferant')
        <form style="margin-bottom: 0;" action="{{ url('/events/destroy', [$event->id]) }}" method="POST">
          @elseif($role == 'admin')
          <form style="margin-bottom: 0;" action="{{ url('/admin/events/destroy', [$event->id]) }}" method="POST">
          @else
          <form style="margin-bottom: 0;" action="{{ url('/user/events/destroy', [$event->id]) }}" method="POST">
          @endif
      {{ csrf_field() }}

      <input type ="submit" value="Ja" class="btn btn-danger">
    </form>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Nein</button>
      </div>
    </div>
  </div>
</div>


<div class="row border-head">
        <h1 style="margin-bottom: 0px" class=" mr-auto">Veranstaltungs Übersicht</h1>
        <div>


      <input type ="button" value="Veranstaltung Löschen" class="btn btn-danger" data-toggle="modal" data-target="#deleteEvent">
    </form>
    </div>
</div>
<div class="row">
  <div class="col-sm-8">
    <div style="margin-bottom: 15px;" class="media rounded">
        <div class="media-body">
      <h2>
        <a href="">
          Buchungs Informationen
       </a>
       <div class="form-inline pull-right">

   @if($event->users->contains($id))
    @if($role == 'lieferant')
      <form action="{{ url('/events/leave', [$event->id]) }}" method="POST">

        {{ csrf_field() }}

        <input type ="submit" value="Verlassen" class="btn btn-primary">
      </form>
    @elseif($role == 'admin')
      <form action="{{ url('/admin/events/leave', [$event->id]) }}" method="POST">

        {{ csrf_field() }}

        <input type ="submit" value="Verlassen" class="btn btn-primary">
      </form>
    @else
      <form action="{{ url('/user/events/leave', [$event->id]) }}" method="POST">

        {{ csrf_field() }}

        <input type ="submit" value="Verlassen" class="btn btn-primary">
      </form>
    @endif
  @elseif($event->players > $event->currentplayers)
    @if($role == 'lieferant')
    <form action="{{ url('/events/join', [$event->id]) }}" method="POST">

      {{ csrf_field() }}

      <input type ="submit" value="Teilnehmen" class="btn btn-primary">
    </form>
    @elseif($role == 'admin')
    <form action="{{ url('/admin/events/join', [$event->id]) }}" method="POST">

      {{ csrf_field() }}

      <input type ="submit" value="Teilnehmen" class="btn btn-primary">
    </form>
    @else
    <form action="{{ url('/user/events/join', [$event->id]) }}" method="POST">

      {{ csrf_field() }}

      <input type ="submit" value="Teilnehmen" class="btn btn-primary">
    </form>
    @endif
  @endif
</div>


      </h2><br>
    <div class="form-group">
      <?php
      $datetime = new DateTime($event->start);
      //$date = $event->start;
      $date = date_format($datetime,"d.m.Y");
      $endtime = new DateTime($event->end);
      $start = date_format($datetime,"H:i");
      $end = date_format($endtime,"H:i");
      ?>

      <strong>Ort: </strong>{{ $event->field->name }}<br>
      <strong>Datum: </strong>{{ $date }}<br>
      <strong>Uhrzeit: </strong>{{ $start }}<br>
      <strong>Ende: </strong>{{ $end }}<br><br>

      <strong>Veranstaltungs Informationen: </strong>{{ $event->description }}<br>
    </div>
      </div>
    </div>










    </div>
    <div class="col-sm-4">
      <div class="list-group">
        <a href="#" class="list-group-item active">
          <strong class="mr-auto">Teilnehmer</strong>{{ $event->currentplayers }} / {{ $event->players }}
        </a>
         @foreach ($users as $user)
          <a href="#" class="list-group-item list-group-item-action">{{ $user->first_name }} {{ $user->last_name }}</a>
        @endforeach
      </div>


  </div>
</div>





</div>

@endsection
