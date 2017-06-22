@extends ('layouts.master')

@section('content')

@if($role == 'lieferant')
<form method="post" action="/fields/{{ $field->id }}/edit">
@else
<form method="post" action="/admin/fields/{{ $field->id }}/edit">
@endif
{{ csrf_field() }}

<div class="row border-head">
        <h1 style="margin-bottom: 0px" class=" mr-auto">Feld bearbeiten</h1>
        <div>
           <button type="submit" class="btn btn-primary ">Feld bearbeiten!</button>
        @if($role == 'lieferant')
          <a href="/fields" class="btn btn-danger">abbrechen</a>
        @else
          <a href="/admin/fields" class="btn btn-danger">abbrechen</a>
        @endif
        </div>
</div>


<div class="form-group">
  <label for="name">Name</label>
  <input type="text" class="form-control" id="name" name="name" value="{{ $field->name }}">
</div>

<div class="form-group">
  <label for="maxplayers">Maximale Spieleranzahl</label>
  <input type="number" class="form-control" id="maxplayers" name="maxplayers" value="{{ $field->maxplayers }}">
</div>

<div class="form-group">
  <label for="priceperhour">Stundenpreis</label>
  <input type="number" class="form-control" id="priceperhour" name="priceperhour" value="{{ $field->priceperhour }}">
</div>

<div class="form-group">
    <label for="description">Beschreibung</label>
    <textarea id="description" name="description" class="form-control">{{ $field->description }}</textarea>
</div>

<label>Sportarten zuweisen:</label><br>
@foreach($sports as $sport)
<label for="sport">{{ $sport->name }}</label>
<input type="hidden" name="{{ $sport->name }}" value="0"/>
<input type="checkbox" name="{{$sport->name}}" value="1"
@if($field->hasSport($sport))
  checked
@endif
/> <br>
@endforeach

<div class="form-group">

</div>

@include ('layouts.errors')

</form>

@endsection
