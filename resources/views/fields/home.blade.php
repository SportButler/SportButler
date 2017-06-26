@extends ('layouts.master')

@section('content')

<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css'/>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.3/themes/default.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.3/themes/default.date.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.3/themes/default.time.css">

<!-- Button trigger modal -->


<div class="row" style="margin-bottom: 40px; margin-top: 30px;">

    <div class="col-md-3" style="text-align: left;">
      <!-- <div class="form-group">
        <select class="select-tabs btn btn-block btn-red" id="exampleSelect1">
            <option data-target="#home">Home</option>
            <option data-target='#profile'>Profile</option>
            <option data-target='#messages'>Messages</option>
            <option data-target='#settings'>Settings</option>
        </select>
      </div>
-->    </div>

    <div class="col-md-6" style="text-align: center;">
            <h1 style="margin-bottom: 0px; color: #c1272d;" class=" mr-auto">Startseite</h1>
    </div>
    <div class="col-md-3" style="text-align: right;">

     @if($role == 'lieferant')
        <a class="btn btn-red btn-block" href="/create">
        Veranstaltung erstellen</a>
        @else
        <a class="btn btn-red btn-block" href="/admin/event/create">
        Veranstaltung erstellen</a>
        @endif
    </div>
</div>
<!--
<div class="tab-content">
    <div class="tab-pane active" id="home">Home content</div>
    <div class="tab-pane" id="profile">Profile content</div>
    <div class="tab-pane" id="messages">Messages content</div>
    <div class="tab-pane" id="settings">Settings content</div>
</div>
-->

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="createEvent" tabindex="-1" role="dialog" aria-labelledby="createEvent" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">


        @if($role == 'lieferant')
<form method="POST" action="/create">
@elseif($role == 'admin')
<form method="POST" action="/admin/event/create">
@else
<form method="POST" action="/user/create">
@endif
{{ csrf_field() }}

<div class="modal fade" id="timeused" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Fehler</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" role="alert">
             <strong>Das von Ihnen gewählte Feld ist in diesem Zeitraum leider schon belegt.</strong>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="endbeforstart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Fehler</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="alert alert-danger" role="alert">
             <strong>Das Ende der Veranstaltung darf nicht vor dem Begin der Veranstaltung liegen.</strong>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div class="row border-head">
        <h1 style="margin-bottom: 0px" class=" mr-auto">Veranstaltung erstellen</h1>
    <div>
        <button type="submit" class="btn btn-primary" id="spielerstellen">Event Anlegen</button>
    </div>
</div>
<div class="row">
<div class="col-sm-6">
  Feld auswählen
  <div class="form-group">
    <select class="field rounded" name="field_id" id="field_id">
      <option value="0" disabled="true" selected="true">Feld wählen</option>
      @foreach ($fields as $field)
        <option value="{{ $field->id }}"> {{ $field->name }}</option>
      @endforeach
    </select>
  </div>
  </div>
<div class="col-sm-6">

  Sportart wählen
  <div class="form-group">
    <select class="field rounded" name="sport_id" id="sport_id">
        <option value="0" disabled="true" selected="true">Sport wählen</option>
      @foreach ($sports as $sport)
        <option value="{{ $sport->id }}"> {{ $sport->name }}</option>
      @endforeach
    </select>
  </div>
  </div>
</div>
 Veranstaltungs Datum wählen
  <div class="form-group">
    <input type="text" class="form-control" id="date" name="date">
  </div>
Veranstaltungs Zeitraum
<div style="margin: 0px" class="row">

  <div style="padding: 0" class="form-group col-sm-5">

    <input type="text" class="form-control" id="start" name="start" placeholder="hh:mm">
  </div>
<div style="padding: 0; text-align:center; padding-bottom: 10px;" class="col-sm-2 event-vert">bis</div>
  <div style="padding: 0" class="form-group col-sm-5">

    <input type="text" class="form-control" id="end" name="end" placeholder="hh:mm">
  </div>
 </div>

  <div class="form-group" id='maxplayers'>
    Maximale Teilnehmer
    <input type="number" class="form-control" id="players" name="players" max="2" min="1" placeholder="">
  </div>

  <input name="currentplayers" id="currentplayers" type="hidden" value="1">

  <div class="form-group">
    Beschreibung
    <textarea id="description" name="description" class="form-control"></textarea>
  </div>

  <input name="startok" id="startok" type="hidden" value="4">

<div class="form-group">

</div>

@include ('layouts.errors')

</form>


      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
      </div>
    </div>
  </div>
</div>


<div role="tabpanel">
    <!-- Nav tabs -->
   <!-- <ul class="nav nav-tabs" role="tablist" id="rowTab">
      <a href="#all" aria-controls="Tennis" role="tab" data-toggle="tab" class="tabmenu-home active"><li role="presentation" class="">Alle Sportarten</li></a>

      @foreach ($sports as $sport)
        <a href="#{{ $sport->name }}" aria-controls="{{ $sport->name }}" role="tab" data-toggle="tab" class="tabmenu-home"><li role="presentation" class="">{{ $sport->name}}</li></a>
      @endforeach
    </ul>-->

    <div class="tab-content" style="margin-top: 10px;">

      <div role="tabpanel" class="tab-pane active" name="all" id="all">
        <div style="margin: 0;" class="row">
          <div id='calendar'></div>

          <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
          <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
          <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/locale-all.js'></script>
          <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
          <script src="//cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.3/picker.js"></script>
          <script src="//cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.3/picker.date.js"></script>
          <script src="//cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.3/picker.time.js"></script>
          <script src="//cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.3/legacy.js"></script>

          <script>
          $(document).ready(function() {
                $.extend($.fn.pickadate.defaults, {
                monthsFull: ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'],
                firstDay: 1,
                weekdaysShort: [ 'So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
                today: 'Heute',
                clear: 'Löschen',
              })
              $('#date').pickadate({
                format: 'dd-mm-yyyy',
                formatSubmit: 'dd-mm-yyyy',
                hiddenName: true
              });
              $('#start').pickatime({
                clear: 'Löschen',
                format: 'H:i',
                interval: 15,
                min: '08:00',
                max: '22:00'
              });
              $('#end').pickatime({
                clear: 'Löschen',
                format: 'H:i',
                interval: 15,
                min: '08:00',
                max: '22:00'
              });
          });
          </script>

          <script>
            $(document).ready(function() {
                // page is now ready, initialize the calendar...
                $('#calendar').fullCalendar({
                    locale: 'de',
                    allDaySlot: false,
                    height: 'auto',
                    displayEventTime: false,
                    defaultView: 'month',
                    // put your options and callbacks here
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    views: {
                      month: {
                        eventLimit: 1
                      },
                      basic: {
                        minTime: "08:00:00",
                        maxTime: "22:00:00"
                          // options apply to basicWeek and basicDay views
                      },
                      agenda: {
                          // options apply to agendaWeek and agendaDay views
                      },
                      week: {
                        minTime: "08:00:00",
                        maxTime: "22:00:00"
                          // options apply to basicWeek and agendaWeek views
                      },
                      day: {
                        minTime: "08:00:00",
                        maxTime: "22:00:00"
                      // options apply to basicDay and agendaDay views
                        }
                    },
                    dayClick: function(date, jsEvent, view) {

                      $('#calendar').fullCalendar('gotoDate',date);
                      $('#calendar').fullCalendar('changeView','agendaDay');

                    },
                    events : [
                        @foreach($events as $event)
                        {
                            @if ($role=='admin')
                              @if($event->currentplayers == $event->players)
                                title : '{{ $event->field->name }}  {{ $event->currentplayers }}/{{ $event->players }}',
                                start : '{{ $event->start }}',
                                end : '{{ $event->end }}',
                                url : '/admin/events/{{ $event->id }}',
                                color: 'red'
                              @else
                                title : '{{ $event->field->name }}  {{ $event->currentplayers }}/{{ $event->players}}',
                                start : '{{ $event->start }}',
                                end : '{{ $event->end }}',
                                url : '/admin/events/{{ $event->id }}',
                                color: 'green'
                              @endif
                            @else
                              @if($event->currentplayers == $event->players)
                                title : '{{ $event->field->name }}  {{ $event->currentplayers }}/{{ $event->players }}',
                                start : '{{ $event->start }}',
                                end : '{{ $event->end }}',
                                url : '/events/{{ $event->id }}',
                                color: 'red'
                              @else
                                title : '{{ $event->field->name }}  {{ $event->currentplayers }}/{{ $event->players}}',
                                start : '{{ $event->start }}',
                                end : '{{ $event->end }}',
                                url : '/events/{{ $event->id }}',
                                color: 'green'
                              @endif
                            @endif
                        },
                        @endforeach
                    ]
                })
            });
            </script>

        </div>
      </div>
      @foreach ($sports as $sport)
        <div role="tabpanel" class="tab-pane" name="{{ $sport->name }}" id="{{ $sport->name }}">
          <div class="row">
            <div id='{{ $sport->name }}'></div>

            <script>
              $(document).ready(function() {
                  $('#{{ $sport->name }}').fullCalendar('render');
                  // page is now ready, initialize the calendar...
                  $('#{{ $sport->name }}').fullCalendar({
                      locale: 'de',
                      allDaySlot: false,
                      displayEventTime: false,
                      defaultView: 'agendaWeek',
                      // put your options and callbacks here
                      header: {
                          left: 'prev,next today',
                          center: 'title',
                          right: 'month,agendaWeek,agendaDay'
                      },
                      views: {
                        basic: {
                          minTime: "08:00:00",
                          maxTime: "22:00:00"
                            // options apply to basicWeek and basicDay views
                        },
                        agenda: {
                            // options apply to agendaWeek and agendaDay views
                        },
                        week: {
                          minTime: "08:00:00",
                          maxTime: "22:00:00"
                            // options apply to basicWeek and agendaWeek views
                        },
                        day: {
                          minTime: "08:00:00",
                          maxTime: "22:00:00"
                        // options apply to basicDay and agendaDay views
                          }
                      },
                      dayClick: function(date, jsEvent, view) {

                        $('#{{ $sport->name }}').fullCalendar('gotoDate',date);
                        $('#{{ $sport->name }}').fullCalendar('changeView','agendaDay');

                      },
                      events : [
                          @foreach($sport->events()->get() as $event)
                          {
                            @if ($role=='admin')
                            @if($event->currentplayers == $event->players)
                          title : '{{ $event->field->name }}  {{ $event->currentplayers }}/{{ $event->players }}',
                          start : '{{ $event->start }}',
                          end : '{{ $event->end }}',
                          url : 'http://dbserver.team-upp.com/admin/events/{{ $event->id }}',
                          color: 'red'
                          @else
                          title : '{{ $event->field->name }}  {{ $event->currentplayers }}/{{ $event->players}}',
                          start : '{{ $event->start }}',
                          end : '{{ $event->end }}',
                          url : 'http://dbserver.team-upp.com/admin/events/{{ $event->id }}',
                          color: 'green'
                          @endif
                            @else
                          @if($event->currentplayers == $event->players)
                          title : '{{ $event->field->name }}  {{ $event->currentplayers }}/{{ $event->players }}',
                          start : '{{ $event->start }}',
                          end : '{{ $event->end }}',
                          url : 'http://dbserver.team-upp.com/events/{{ $event->id }}',
                          color: 'red'
                          @else
                          title : '{{ $event->field->name }}  {{ $event->currentplayers }}/{{ $event->players}}',
                          start : '{{ $event->start }}',
                          end : '{{ $event->end }}',
                          url : 'http://dbserver.team-upp.com/events/{{ $event->id }}',
                          color: 'green'
                          @endif
                          @endif
                        },
                          @endforeach
                      ]
                  })
              });
              </script>
          </div>
        </div>
      @endforeach
    </div>
</div>
<script>
$('#exampleSelect1').on('change', function () {
    //console.log($(':selected', this));
    $(':selected', this).tab('show');
});

</script>
@if($role == 'admin')
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('change', '.field', function(){
      console.log("jo");
      var field_id = $(this).val();
      var a=$(this).parent();
      $.ajax({
        type:'get',
        url:'/admin/findFieldName',
        data:{'id':field_id},
        success:function(data){
          $('#players').attr({
            "max" : data.maxplayers
          });
          console.log(data.maxplayers);
          $('#start').val('');
        },
        error:function(){
          console.log('error');
        }
      });
    });
  });

  $(document).ready(function(){
    $(document).on('change', '#start', function(){
      var start = $(this).val();
      var field_id = $('.field').val();
      var end = $('#end').val();
      var date = $('#date').val();



      console.log(start);
      console.log(date);

      $.ajax({
        type:'get',
        url:'/admin/checkStart',
        data:{'id':field_id, 'start':start, 'date':date},
        success:function(data){
          if(start < end || end.length == 0){
            if(data.length == 0){
            //  console.log('frei');
            }else{
              $('#start').val('');
            //  console.log('Dieses Feld ist besetzt!');
              $('#timeused').modal('show')

            }
          }else {
            $('#start').val('');
            $('#endbeforstart').modal('show')
          }
        },
        error:function(){
          console.log('error');
        }
      });
    });
  });

  $(document).ready(function(){
    $(document).on('change', '#end', function(){
      //console.log("jo");
      var end = $(this).val();
      var field_id = $('.field').val();
      var start = $('#start').val();
      var date = $('#date').val();

      //console.log(end);
      //console.log(field_id);
      $.ajax({
        type:'get',
        url:'/admin/checkEnd',
        data:{'id':field_id, 'end':end},
        success:function(data){
          if(start < end || start.length == 0){
            if(data.length == 0){
            //  console.log('frei');
            }else{
              $('#end').val('');
            //  console.log('Dieses Feld ist besetzt!');
            $('#timeused').modal('show');
            }
          }
          else {
            $('#end').val('');
            $('#endbeforstart').modal('show');
          }
        },
        error:function(){
          console.log('error');
        }
      });
    });
  });
</script>
@elseif($role == 'lieferant')
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('change', '.field', function(){
      console.log("jo");
      var field_id = $(this).val();
      var a=$(this).parent();
      $.ajax({
        type:'get',
        url:'/findFieldName',
        data:{'id':field_id},
        success:function(data){
          $('#players').attr({
            "max" : data.maxplayers
          });
          console.log(data.maxplayers);
          $('#start').val('');
        },
        error:function(){
          console.log('error');
        }
      });
    });
  });

  $(document).ready(function(){
    $(document).on('change', '#start', function(){
      var start = $(this).val();
      var field_id = $('.field').val();
      var end = $('#end').val();
      var date = $('#date').val();

      console.log(start);
      console.log(date);

      $.ajax({
        type:'get',
        url:'/checkStart',
        data:{'id':field_id, 'start':start, 'date':date},
        success:function(data){
          if(start < end || end.length == 0){
            if(data.length == 0){
            //  console.log('frei');
            }else{
              $('#start').val('');
            //  console.log('Dieses Feld ist besetzt!');
              $('#timeused').modal('show')

            }
          }else {
            $('#start').val('');
            $('#endbeforstart').modal('show')
          }
        },
        error:function(){
          console.log('error');
        }
      });
    });
  });

  $(document).ready(function(){
    $(document).on('change', '#end', function(){
      //console.log("jo");
      var end = $(this).val();
      var field_id = $('.field').val();
      var start = $('#start').val();
      var date = $('#date').val();

      //console.log(end);
      //console.log(field_id);
      $.ajax({
        type:'get',
        url:'/checkEnd',
        data:{'id':field_id, 'end':end},
        success:function(data){
          if(start < end || start.length == 0){
            if(data.length == 0){
            //  console.log('frei');
            }else{
              $('#end').val('');
            //  console.log('Dieses Feld ist besetzt!');
            $('#timeused').modal('show');
            }
          }
          else {
            $('#end').val('');
            $('#endbeforstart').modal('show');
          }
        },
        error:function(){
          console.log('error');
        }
      });
    });
  });
</script>
@else
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('change', '.field', function(){
      console.log("jo");
      var field_id = $(this).val();
      var a=$(this).parent();
      $.ajax({
        type:'get',
        url:'/user/findFieldName',
        data:{'id':field_id},
        success:function(data){
          $('#players').attr({
            "max" : data.maxplayers
          });
          console.log(data.maxplayers);
          $('#start').val('');
        },
        error:function(){
          console.log('error');
        }
      });
    });
  });

  $(document).ready(function(){
    $(document).on('change', '#start', function(){
      var start = $(this).val();
      var field_id = $('.field').val();
      var end = $('#end').val();
      var date = $('#date').val();


      console.log(start);
      console.log(date);

      $.ajax({
        type:'get',
        url:'/user/checkStart',
        data:{'id':field_id, 'start':start},
        success:function(data){
          if(start < end || end.length == 0){
            if(data.length == 0){
            //  console.log('frei');
            }else{
              $('#start').val('');
            //  console.log('Dieses Feld ist besetzt!');
              $('#timeused').modal('show')

            }
          }else {
            $('#start').val('');
            $('#endbeforstart').modal('show')
          }
        },
        error:function(){
          console.log('error');
        }
      });
    });
  });

  $(document).ready(function(){
    $(document).on('change', '#end', function(){
      //console.log("jo");
      var end = $(this).val();
      var field_id = $('.field').val();
      var start = $('#start').val();
      var date = $('#date').val();

      //console.log(end);
      //console.log(field_id);
      $.ajax({
        type:'get',
        url:'/user/checkEnd',
        data:{'id':field_id, 'end':end},
        success:function(data){
          if(start < end || start.length == 0){
            if(data.length == 0){
            //  console.log('frei');
            }else{
              $('#end').val('');
            //  console.log('Dieses Feld ist besetzt!');
            $('#timeused').modal('show');
            }
          }
          else {
            $('#end').val('');
            $('#endbeforstart').modal('show');
          }
        },
        error:function(){
          console.log('error');
        }
      });
    });
  });
</script>

@endif
@endsection
