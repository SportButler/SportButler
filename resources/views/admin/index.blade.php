@extends ('layouts.master')

@section('content')

<div class="row border-head">
        <h1 style="margin-bottom: 0px" class=" mr-auto">Benutzerübersicht</h1>
        <div>
            <a href="/admin/create" class="btn btn-success">Mitarbeiter anlegen</a>
        </div>
</div>

  @if($user->id == 4)
    <p>Willkommen Superuser!</p>
    @foreach($clubs as $club)
      <b>{{ $club->name }}</b>
      <p>Admins:</p>
      @foreach($club->users as $user)
        @if($user->id != 4 && $admins->contains($user->id))
          <p>{{ $user->id }}  {{ $user->email }}
          <div class="row">
            <div class="form" style="margin-right: 5px;">
                <a href="/admin/{{ $user->id }}/edit" class="btn btn-primary">bearbeiten</a>
            </div>
              <form style="margin-right:5px; margin-left:5px;" action="{{ url('/admin/destroy', [$user->id]) }}" method="POST">

                {{ csrf_field() }}

                <input type ="submit" value="Löschen" class="btn btn-danger">
              </form>
          </p>
          @if($activations->where('user_id', $user->id)->where('completed', false)->count())
            <form style="margin-left:5px;" method="post" action="/activation/{{ $user->id }}/activate_user">
              {{ csrf_field() }}

              <button type="submit" class="btn btn-success ">User aktivieren</button>
            </form>
          </div>
          @else
            <form style="margin-left:5px;" method="post" action="/activation/{{ $user->id }}/deactivate_user">
              {{ csrf_field() }}

              <button type="submit" class="btn btn-danger ">User deaktivieren</button>
            </form>
          </div>
          @endif
        @endif
      @endforeach
      Mitarbeiter:<br>
      @foreach($club->users as $user)
        @if($user->id != $id && $user->id != 4 && $lieferanten->contains($user->id))
          <p>{{ $user->id }}  {{ $user->email }}
          <div class="row">
            <div class="form" style="margin-right: 5px;">
                <a href="/admin/{{ $user->id }}/edit" class="btn btn-primary">bearbeiten</a>
            </div>
              <form style="margin-right:5px; margin-left:5px;" action="{{ url('/admin/destroy', [$user->id]) }}" method="POST">

                {{ csrf_field() }}

                <input type ="submit" value="Löschen" class="btn btn-danger">
              </form>
          </p>
          @if($activations->where('user_id', $user->id)->where('completed', false)->count())
            <form style="margin-left:5px;" method="post" action="/activation/{{ $user->id }}/activate_user">
              {{ csrf_field() }}

              <button type="submit" class="btn btn-success ">User aktivieren</button>
            </form>
          </div>
          @else
            <form style="margin-left:5px;" method="post" action="/activation/{{ $user->id }}/deactivate_user">
              {{ csrf_field() }}

              <button type="submit" class="btn btn-danger ">User deaktivieren</button>
            </form>
          </div>
          @endif
        @endif
      @endforeach
      Mitglieder:<br>
      @foreach($club->users as $user)
        @if($user->id != $id && $user->id != 4 && $kunden->contains($user->id))
          <p>{{ $user->id }}  {{ $user->email }}
          <div class="row">
            <div class="form" style="margin-right:5px;">
                <a href="/admin/{{ $user->id }}/edit" class="btn btn-primary">bearbeiten</a>
            </div>
              <form  style="margin-right:5px; margin-left:5px;" action="{{ url('/admin/destroy', [$user->id]) }}" method="POST">

                {{ csrf_field() }}

                <input type ="submit" value="Löschen" class="btn btn-danger">
              </form>
          </p>
          @if($activations->where('user_id', $user->id)->where('completed', false)->count())
            <form style="margin-left:5px;" method="post" action="/activation/{{ $user->id }}/activate_user">
              {{ csrf_field() }}

              <button type="submit" class="btn btn-success ">User aktivieren</button>
            </form>
          @else
            <form style="margin-left:5px;" method="post" action="/activation/{{ $user->id }}/deactivate_user">
              {{ csrf_field() }}

              <button type="submit" class="btn btn-danger ">User deaktivieren</button>
            </form>
          </div>
          @endif
        @endif
      @endforeach
    @endforeach
  @else
  Willkommen Admin von
    @foreach($user->clubs as $club)
    <b>{{ $club->name }}</b>
      !<br>

      Das sind deine Mitarbeiter:<br>
      @foreach($club->users as $user)
        @if($user->id != $id && $user->id != 4 && $lieferanten->contains($user->id))
          <p>{{ $user->id }}  {{ $user->email }}
          <div class="row">
            <div class="form" style="margin-right: 5px;">
                <a href="/admin/{{ $user->id }}/edit" class="btn btn-primary">bearbeiten</a>
            </div>
              <form style="margin-right:5px; margin-left:5px;" action="{{ url('/admin/destroy', [$user->id]) }}" method="POST">

                {{ csrf_field() }}

                <input type ="submit" value="Löschen" class="btn btn-danger">
              </form>
          </p>
          @if($activations->where('user_id', $user->id)->where('completed', false)->count())
            <form style="margin-left:5px;" method="post" action="/activation/{{ $user->id }}/activate_user">
              {{ csrf_field() }}

              <button type="submit" class="btn btn-success ">User aktivieren</button>
            </form>
          </div>
          @else
            <form style="margin-left:5px;" method="post" action="/activation/{{ $user->id }}/deactivate_user">
              {{ csrf_field() }}

              <button type="submit" class="btn btn-danger ">User deaktivieren</button>
            </form>
          </div>
          @endif
        @endif
      @endforeach

      <br> Das sind deine Mitglieder:<br>
      @foreach($club->users as $user)
        @if($user->id != $id && $user->id != 4 && $kunden->contains($user->id))
          <p>{{ $user->id }}  {{ $user->email }}
          <div class="row">
            <div class="form" style="margin-right:5px;">
                <a href="/admin/{{ $user->id }}/edit" class="btn btn-primary">bearbeiten</a>
            </div>
              <form  style="margin-right:5px; margin-left:5px;" action="{{ url('/admin/destroy', [$user->id]) }}" method="POST">

                {{ csrf_field() }}

                <input type ="submit" value="Löschen" class="btn btn-danger">
              </form>
          </p>
          @if($activations->where('user_id', $user->id)->where('completed', false)->count())
            <form style="margin-left:5px;" method="post" action="/activation/{{ $user->id }}/activate_user">
              {{ csrf_field() }}

              <button type="submit" class="btn btn-success ">User aktivieren</button>
            </form>
          @else
            <form style="margin-left:5px;" method="post" action="/activation/{{ $user->id }}/deactivate_user">
              {{ csrf_field() }}

              <button type="submit" class="btn btn-danger ">User deaktivieren</button>
            </form>
          </div>
          @endif
        @endif
      @endforeach
    @endforeach
@endif

@endsection
