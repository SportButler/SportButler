@extends ('layouts.master')
@section('content')
<!--Falls keine Veranstaltungen vorhanden-->
@if(count($events) == 0 )
  Sie haben sich zur Zeit für keine Veranstaltung angemeldet!
@else
<!-- Veranstaltung vorhanden und bevorstehend-->
  <p>Bevorstehende Veranstaltungen:</p>
  @foreach($events as $event)
    <?php
    $dt = new DateTime();
    $dt = $dt->format('Y-m-d H:i:s');
     ?>

     <!-- Nur Events die noch nicht angefangen haben -->

     @if($dt < $event->start)

     <!-- TODO: link auf Details der Veranstaltung -->

    {{$event->description }}
    <?php
    $datetime = new DateTime($event->start);
    //$date = $event->start;
    $date = date_format($datetime,"d.m.Y");
    $endtime = new DateTime($event->end);
    $start = date_format($datetime,"H:i");
    $end = date_format($endtime,"H:i");
    ?>
    {{$date}} {{$start}} - {{$end}}
    {{$event->players}}/{{$event->currentplayers}}

    <!-- Buttons für jede Art von User -->

      @if($role == 'admin')
      <form action="{{ url('/admin/events', [$event->id]) }}" method="GET">

        {{ csrf_field() }}

        <input type ="submit" value="Info" class="btn btn-primary">
      </form><br>
      <form action="{{ url('/admin/events/leave', [$event->id]) }}" method="POST">

        {{ csrf_field() }}

        <input type ="submit" value="Verlassen" class="btn btn-primary">
      </form><br>
      @elseif($role == 'kunde')
      <form action="{{ url('/user/events', [$event->id]) }}" method="GET">

        {{ csrf_field() }}

        <input type ="submit" value="Info" class="btn btn-primary">
      </form><br>
      <form action="{{ url('/user/events/leave', [$event->id]) }}" method="POST">

        {{ csrf_field() }}

        <input type ="submit" value="Verlassen" class="btn btn-primary">
      </form><br>
      @else
      <form action="{{ url('/events', [$event->id]) }}" method="GET">

        {{ csrf_field() }}

        <input type ="submit" value="Info" class="btn btn-primary">
      </form><br>
      <form action="{{ url('/events/leave', [$event->id]) }}" method="POST">

        {{ csrf_field() }}

        <input type ="submit" value="Verlassen" class="btn btn-primary">
      </form><br>
      @endif
    @endif
  @endforeach

  <!-- Veranstaltung vorhanden und vorbei-->

  <p>Vergangene Veranstaltungen:</p>
  @foreach($events as $event)
    <?php
    $dt = new DateTime();
    $dt = $dt->format('Y-m-d H:i:s');
     ?>
     <!-- Nur Events die schon vorbei sind -->

     @if($dt > $event->start)
    {{$event->description }}
    <?php
    $datetime = new DateTime($event->start);
    //$date = $event->start;
    $date = date_format($datetime,"d-m-Y");
    $endtime = new DateTime($event->end);
    $start = date_format($datetime,"H:i");
    $end = date_format($endtime,"H:i");
    ?>
    {{$date}} {{$start}} - {{$end}}
    {{$event->players}}/{{$event->currentplayers}}
      @if($role == 'admin')
      <form action="{{ url('/admin/events', [$event->id]) }}" method="GET">

        {{ csrf_field() }}

        <input type ="submit" value="Info" class="btn btn-primary">
      </form><br>
      <form action="{{ url('/admin/events/leave', [$event->id]) }}" method="POST">

        {{ csrf_field() }}

        <input type ="submit" value="Verlassen" class="btn btn-primary">
      </form><br>
      @elseif($role == 'kunde')
      <form action="{{ url('/user/events', [$event->id]) }}" method="GET">

        {{ csrf_field() }}

        <input type ="submit" value="Info" class="btn btn-primary">
      </form><br>
      <form action="{{ url('/user/events/leave', [$event->id]) }}" method="POST">

        {{ csrf_field() }}

        <input type ="submit" value="Verlassen" class="btn btn-primary">
      </form><br>
      @else
      <form action="{{ url('/events', [$event->id]) }}" method="GET">

        {{ csrf_field() }}

        <input type ="submit" value="Info" class="btn btn-primary">
      </form><br>
      <form action="{{ url('/events/leave', [$event->id]) }}" method="POST">

        {{ csrf_field() }}

        <input type ="submit" value="Verlassen" class="btn btn-primary">
      </form><br>
      @endif
      @endif
  @endforeach
@endif

@endsection
