@extends ('layouts.master')

@section('content')

<h1>User bearbeiten</h1>

<form method="post" action="/admin/{{ $user->id }}/edit">

{{ csrf_field() }}

<div class="form-group">
  <label for="email">Name</label>
  <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
</div>

<div class="form-group">
  <label for="password">Password</label>
  <input type="text" class="form-control" id="password" name="password">
</div>

<div class="form-group">
  <button type="submit" class="btn btn-primary ">Kontakt bearbeiten!</button>
  <a href="/contacts" class="btn btn-danger">abbrechen</a>
</div>

</form>

@endsection
