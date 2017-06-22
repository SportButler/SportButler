@extends ('layouts.master')

@section('content')

@if($role == 'kunde')
<form method="post" action="/user/account/{{ $user->id }}/edit">
@elseif($role == 'lieferant')
<form method="post" action="/account/{{ $user->id }}/edit">
@else
<form method="post" action="/admin/account/{{ $user->id }}/edit">
@endif


{{ csrf_field() }}

<div class="row border-head">
        <h1 style="margin-bottom: 0px" class=" mr-auto">Accountinformationen bearbeiten</h1>
    <div>
         <button type="submit" class="btn btn-primary ">Speichern</button>
    </div>
</div>

<div class="form-group">
  <label for="email">Email</label>
  <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
</div>

<div class="form-group">
  <label for="password">Passwort</label>
  <input type="text" class="form-control" id="password" name="password">
</div>

@include ('layouts.errors')



@endsection
