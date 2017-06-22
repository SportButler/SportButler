@extends ('layouts.master')

@section('content')



<form method="POST" action="/clubs/create">

{{ csrf_field() }}

<div class="row border-head">
        <h1 style="margin-bottom: 0px" class=" mr-auto">Verein anlegen</h1>
        <div>
           <button type="submit" class="btn btn-primary ">Verein anlegen</button>
  <a href="/clubs" class="btn btn-danger">abbrechen</a>
        </div>
</div>

<div class="form-group">
  <label for="name">Name</label>
  <input type="text" class="form-control" id="name" name="name">
</div>

<div class="form-group">
    <label for="description">Beschreibung</label>
    <textarea id="description" name="description" class="form-control"></textarea>
</div>

<div class="form-group">
    <label for="contact">Kontaktinformationen</label>
    <textarea id="contact" name="contact" class="form-control"></textarea>
</div>

<div class="form-group">

 

</div>

@include ('layouts.errors')

</form>

@endsection
