@extends ('layouts.master')

@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.3/themes/default.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.3/themes/default.date.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.3/themes/default.time.css">

@if($role == 'lieferant')
<form method="POST" action="/create">
@elseif($role == 'admin')
<form method="POST" action="/admin/event/create">
@else
<form method="POST" action="/user/create">
@endif
{{ csrf_field() }}

<div class="modal fade" id="timeused" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="endbeforstart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
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
        <a class="btn btn-danger" href="/" id="abbrechen">
          Abbrechen
        </a>
        <button type="submit" class="btn btn-primary" id="spielerstellen">Event Anlegen</button>
    </div>
</div>
<div class="row">
<div class="col-sm-6">
  Feld auswählen
  <div class="form-group" id="checkbox-container">
    @if($role == 'admin' || $role == 'lieferant')
      <label>Alle Felder</label>
      <input type="checkbox" name="Alle" id="select_all" value="0"/><br>
      <div class="checkbox-group required">
        @foreach($fields as $field)
          <label for="field">{{ $field->name }}</label>
          <input type="hidden" name="{{$field->id}}" value="0"/>
          <input class="checkbox" type="checkbox" name="{{$field->id}}" id="{{$field->id}}" value="1"/>
        @endforeach
      </div>
    @else
    <select class="field rounded" name="field_id" id="field_id">
      <option value="0" disabled="true" selected="true">Feld wählen</option>
      @foreach ($fields as $field)
        <option value="{{ $field->id }}"> {{ $field->name }}</option>
      @endforeach
    </select>
    @endif
  </div>
  </div>
<div class="col-sm-6">

  Sportart wählen
  <div class="form-group">
    <select class="field rounded" name="sport_id" id="sport_id" required>
        <option value="0" disabled="true" selected="true">Sport wählen</option>
      @foreach ($sports as $sport)
        @if(old('sport_id') == $sport->id)
          <option value="{{ $sport->id }}" selected> {{ $sport->name }}</option>
        @else
          <option value="{{ $sport->id }}"> {{ $sport->name }}</option>
        @endif
      @endforeach
    </select>
    @if($role == 'admin' || $role == 'lieferant')
    <label for="repeat">Event wöchentlich wiederholen:</label>
    <input type="checkbox" name="repeat" value="1"/>
    @endif
  </div>
  </div>
</div>
 Veranstaltungs Datum wählen
  <div class="form-group">
    <input type="text" class="form-control" id="date" name="date" value="{{ old('date') }}" required>
  </div>
Veranstaltungs Zeitraum
<div style="margin: 0px" class="row">

  <div style="padding: 0" class="form-group col-sm-5">

    <input type="text" class="form-control" id="start" name="start" placeholder="hh:mm" value="{{ old('start') }}" required>
  </div>
<div style="padding: 0; text-align:center; padding-bottom: 10px;" class="col-sm-2 event-vert">bis</div>
  <div style="padding: 0" class="form-group col-sm-5">

    <input type="text" class="form-control" id="end" name="end" placeholder="hh:mm" value="{{ old('end') }}" required>
  </div>
 </div>

  <div class="form-group" id='maxplayers'>
    Maximale Teilnehmer
    <input type="number" class="form-control" id="players" name="players" max="4" placeholder="" required value="{{ old('players') }}">
  </div>

  <input name="currentplayers" id="currentplayers" type="hidden" value="1">

  <div class="form-group">
    Beschreibung
    <textarea id="description" name="description" class="form-control">{{old('description')}}
    </textarea>
  </div>

  <input name="startok" id="startok" type="hidden" value="4">

<div class="form-group">

</div>

@include ('layouts.errors')
<script>
var checkboxValues = JSON.parse(localStorage.getItem('checkboxValues')) || {};
if (checkboxValues === null){
  checkboxValues = {};
}
var $checkboxes = $("#checkbox-container :checkbox");

$checkboxes.on("change", function(){
  $checkboxes.each(function(){
    checkboxValues[this.id] = this.checked;
  });
  localStorage.setItem("checkboxValues", JSON.stringify(checkboxValues));
});

$.each(checkboxValues, function(key, value) {
  $("#" + key).prop('checked', value);
});

$("#spielerstellen").click(function(e){
    if( $("input[id=checkbox]:checked").length == 0){
        $("input[id=checkbox]:first").attr("required", "required");
    }else{
        $("input[id=checkbox]").removeAttr("required");
        $form.submit();
    }
});

$("#abbrechen").click(function(e){
  localStorage.clear();
  $checkboxes.each(function(){
    checkboxValues[this.id] = this.checked;
  });
  localStorage.removeItem("checkboxValues", JSON.stringify(checkboxValues));
});
</script>

</form>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.3/picker.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.3/picker.date.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.3/picker.time.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.3/legacy.js"></script>


<script>

var select_all = document.getElementById("select_all"); //select all checkbox
var checkboxes = document.getElementsByClassName("checkbox"); //checkbox items

//select all checkboxes
select_all.addEventListener("change", function(e){
    for (i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = select_all.checked;
    }
});


for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].addEventListener('change', function(e){ //".checkbox" change
        //uncheck "select all", if one of the listed checkbox item is unchecked
        if(this.checked == false){
            select_all.checked = false;
        }
        //check "select all" if all checkbox items are checked
        if(document.querySelectorAll('.checkbox:checked').length == checkboxes.length){
            select_all.checked = true;
        }
    });
}
</script>
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

@if($role == 'admin')

@elseif($role == 'lieferant')

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
