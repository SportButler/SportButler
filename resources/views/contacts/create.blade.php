@extends ('layouts.master')

@section('content')


@if($role == 'lieferant')
<form method="POST" action="/contacts/create">
@else
<form method="POST" action="/admin/contacts/create">
@endif
{{ csrf_field() }}


<div class="row border-head">
        <h1 style="margin-bottom: 0px" class=" mr-auto">Kontakte anlegen</h1>
        <div>
           <button type="submit" class="btn btn-primary ">Kontakt anlegen</button>
           @if($role == 'lieferant')
           <a href="/contacts" class="btn btn-danger">abbrechen</a>
           @else
           <a href="/admin/contacts" class="btn btn-danger">abbrechen</a>
           @endif
        </div>
</div>


<div class="form-group">
  <label for="sport_id">Sportart zuweisen</label>
  <select name="sport_id" id="sport_id">
    @foreach ($sports as $sport)
      <option value="{{ $sport->id }}"> {{ $sport->name }}</option>
    @endforeach
  </select>
</div>

<div class="form-group">
  <label for="name">Name</label>
  <input type="text" class="form-control" id="name" name="name">
</div>

<div class="form-group">
  <label for="phonenumber">Telefonnummer</label>
  <input type="text" class="form-control" id="phonenumber" name="phonenumber">
</div>



@include ('layouts.errors')

</form>

@endsection
