@extends ('layouts.master')

@section('content')


@if($role == 'lieferant')
<form method="POST" action="/fieldscreate">
@else
<form method="POST" action="/admin/fieldscreate">
@endif
{{ csrf_field() }}

<div class="row border-head">
        <h1 style="margin-bottom: 0px" class=" mr-auto">Feld erstellen</h1>
        <div>
           <button type="submit" class="btn btn-primary ">Feld erstellen!</button>
          @if($role == 'lieferant')
            <a href="/fields" class="btn btn-danger">abbrechen</a>
          @else
            <a href="/admin/fields" class="btn btn-danger">abbrechen</a>
          @endif
        </div>
</div>


<div class="form-group">
  <label for="name">Name</label>
  <input type="text" class="form-control" id="name" name="name">
</div>

<div class="form-group">
  <label for="maxplayers">Maximale Spieleranzahl</label>
  <input type="number" class="form-control" id="maxplayers" name="maxplayers">
</div>

<div class="form-group">
  <label for="priceperhour">Stundenpreis</label>
  <input type="number" class="form-control" id="priceperhour" name="priceperhour">
</div>

<div class="form-group">
    <label for="description">Beschreibung</label>
    <textarea id="description" name="description" class="form-control"></textarea>
</div>

<label>Sportarten zuweisen:</label><br>
@foreach($sports as $sport)
<label for="sport">{{ $sport->name }}</label>
<input type="hidden" name="{{ $sport->name }}" value="0"/>
<input name="{{$sport->name}}" type="checkbox" value="1"/> <br>
@endforeach

@include ('layouts.errors')

</form>

@endsection
