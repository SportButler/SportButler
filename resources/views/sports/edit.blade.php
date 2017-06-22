@extends ('layouts.master')

@section('content')

@if($role == 'lieferant')
<form method="post" action="/sports/{{ $sport->id }}/edit">
@else
<form method="post" action="/admin/sports/{{ $sport->id }}/edit">
@endif
{{ csrf_field() }}

<div class="row border-head">
        <h1 style="margin-bottom: 0px" class=" mr-auto">Sportart bearbeiten</h1>
        <div>
           <button type="submit" class="btn btn-primary ">Speichern</button>
          @if($role == 'lieferant')
           <a href="/sports" class="btn btn-danger">abbrechen</a>
          @else
            <a href="/admin/sports" class="btn btn-danger">abbrechen</a>
          @endif
        </div>
</div>

<div class="form-group">
  <label for="name">Name</label>
  <input type="text" class="form-control" id="name" name="name" value="{{ $sport->name }}">
</div>


</form>

@endsection
