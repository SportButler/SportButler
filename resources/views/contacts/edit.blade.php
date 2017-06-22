@extends ('layouts.master')

@section('content')

@if($role == 'lieferant')
<form method="post" action="/contacts/{{ $contact->id }}/edit">
@else
<form method="post" action="/admin/contacts/{{ $contact->id }}/edit">
@endif
{{ csrf_field() }}

<div class="row border-head">
        <h1 style="margin-bottom: 0px" class=" mr-auto">Kontakt bearbeiten</h1>
        <div>
           <button type="submit" class="btn btn-primary ">Kontakt bearbeiten!</button>
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
  <input type="text" class="form-control" id="name" name="name" value="{{ $contact->name }}">
</div>

<div class="form-group">
  <label for="phonenumber">Name</label>
  <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="{{ $contact->phonenumber }}">
</div>


</form>

@endsection
