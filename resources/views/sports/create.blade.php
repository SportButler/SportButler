@extends ('layouts.master')

@section('content')

@if($role=='lieferant')
<form method="POST" action="/sports/create">
@else
<form method="POST" action="/admin/sports/create">
@endif

{{ csrf_field() }}

<div class="row border-head">
        <h1 style="margin-bottom: 0px" class=" mr-auto">Sportart anlegen</h1>
        <div class="form-group">
           <button type="submit" class="btn btn-primary ">Anlegen</button>
           @if($role=='lieferant')
            <a href="/sports" class="btn btn-danger">abbrechen</a>
           @else
            <a href="/admin/sports" class="btn btn-danger">abbrechen</a>
           @endif
        </div>
</div>

<div class="form-group">
  <label for="name">Name</label>
  <input type="text" class="form-control" id="name" name="name">
</div>


@include ('layouts.errors')

</form>

@endsection
