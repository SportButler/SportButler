@extends ('layouts.master')
@section('content')
<!--Falls keine Veranstaltungen vorhanden-->
@if(count($events) == 0 )
  Sie haben sich zur Zeit für keine Veranstaltung angemeldet!
@else
<!-- Veranstaltung vorhanden und bevorstehend-->
<p>Bevorstehende Veranstaltungen (test):</p>
<div id="accordion" role="tablist" aria-multiselectable="true">
  <div class="card">
  @foreach ($events as $event)
    <?php
    $dt = new DateTime();
    $dt = $dt->format('Y-m-d H:i:s');
    $users = $event->users;
     ?>
    @if($dt < $event->start)

      <div class="card-header" role="tab" id="headingOne">
        <div class="row">
          <h5 class="mb-0 mr-auto">
             <a data-toggle="collapse" data-parent="#accordion" href="#{{ $event->description }}{{$event->id}}" aria-expanded="false" aria-controls="{{ $event->description }}{{$event->id}}" class="sports-vert">
               <?php
                 $datetime = new DateTime($event->start);
                 //$date = $event->start;
                 $date = date_format($datetime,"d.m.Y");
                 $endtime = new DateTime($event->end);
                 $start = date_format($datetime,"H:i");
                 $end = date_format($endtime,"H:i");
               ?>
               {{$date}} {{$start}} - {{$end}}
               {{$event->currentplayers}}/{{$event->players}}
               {{$event->description }}
               {{$event->id }}
             </a>
          </h5>

          <div style="margin: 0px" class="row">
            @if($role == 'admin')
              <a href="/admin/events/{{ $event->id }}/edit" class="btn btn-primary">bearbeiten</a>

              <form action="{{ url('/admin/events/leave', [$event->id]) }}" method="POST">

                {{ csrf_field() }}

                <input type ="submit" value="Verlassen" class="btn btn-primary">
              </form><br>
            @elseif($role == 'kunde')
              @if($event->user_id == $id)
              <a href="/user/events/{{ $event->id }}/edit" class="btn btn-primary">bearbeiten</a>
              @endif
              <form action="{{ url('/user/events/leave', [$event->id]) }}" method="POST">

                {{ csrf_field() }}

                <input type ="submit" value="Verlassen" class="btn btn-primary">
              </form><br>
            @else
            <a href="/events/{{ $event->id }}/edit" class="btn btn-primary">bearbeiten</a>

              <form action="{{ url('/events/leave', [$event->id]) }}" method="POST">

                {{ csrf_field() }}

                <input type ="submit" value="Verlassen" class="btn btn-primary">
              </form><br>
            @endif
          </div>
      </div>
  </div>
      <div id="{{ $event->description }}{{$event->id}}" class="collapse" role="tabpanel" aria-labelledby="{{ $event->description }}{{$event->id}}">
        <div class="card-block">
          <div class="row">

           <div class="col-md-6">
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
        </div>
      </div>
    @endif
  @endforeach
  </div>
</div>

<p>Vergangene Veranstaltungen:</p>
<div id="accordion" role="tablist" aria-multiselectable="true">
  <div class="card">
  @foreach ($events as $event)
    <?php
    $dt = new DateTime();
    $dt = $dt->format('Y-m-d H:i:s');
    $users = $event->users;
     ?>
    @if($dt > $event->start)

      <div class="card-header" role="tab" id="headingOne">
        <div class="row">
          <h5 class="mb-0 mr-auto">
             <a data-toggle="collapse" data-parent="#accordion" href="#{{ $event->description }}{{$event->id}}" aria-expanded="false" aria-controls="{{ $event->description }}{{$event->id}}" class="sports-vert">
               <?php
                 $datetime = new DateTime($event->start);
                 //$date = $event->start;
                 $date = date_format($datetime,"d.m.Y");
                 $endtime = new DateTime($event->end);
                 $start = date_format($datetime,"H:i");
                 $end = date_format($endtime,"H:i");
               ?>
               {{$date}} {{$start}} - {{$end}}
               {{$event->currentplayers}}/{{$event->players}}
               {{$event->description }}
               {{$event->id }}
             </a>
          </h5>

          <div style="margin: 0px" class="row">
            @if($role == 'admin')
              <a href="/admin/events/{{ $event->id }}/edit" class="btn btn-primary">bearbeiten</a>

              <form action="{{ url('/admin/events/leave', [$event->id]) }}" method="POST">

                {{ csrf_field() }}

                <input type ="submit" value="Verlassen" class="btn btn-primary">
              </form><br>
            @elseif($role == 'kunde')
              @if($event->user_id == $id)
              <a href="/user/events/{{ $event->id }}/edit" class="btn btn-primary">bearbeiten</a>
              @endif
              <form action="{{ url('/user/events/leave', [$event->id]) }}" method="POST">

                {{ csrf_field() }}

                <input type ="submit" value="Verlassen" class="btn btn-primary">
              </form><br>
            @else
            <a href="/events/{{ $event->id }}/edit" class="btn btn-primary">bearbeiten</a>

              <form action="{{ url('/events/leave', [$event->id]) }}" method="POST">

                {{ csrf_field() }}

                <input type ="submit" value="Verlassen" class="btn btn-primary">
              </form><br>
            @endif
          </div>
      </div>
  </div>
      <div id="{{ $event->description }}{{$event->id}}" class="collapse" role="tabpanel" aria-labelledby="{{ $event->description }}{{$event->id}}">
        <div class="card-block">
          <div class="row">

           <div class="col-md-6">
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
        </div>
      </div>
    @endif
  @endforeach
  </div>
</div>
@endif

@endsection
