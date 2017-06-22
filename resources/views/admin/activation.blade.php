@extends ('layouts.master')

@section('content')

  Hier könnnen wir User selber aktivieren

  @foreach ($activations as $activation)
      <p>This is User {{ $activation->user_id }}</p>

      @if ( $activation->completed == false)
      <form method="post" action="/activation/{{ $activation->id }}/activate_user">
        {{ csrf_field() }}

        <button type="submit" class="btn btn-success ">User aktivieren</button>
      </form>

      @else
      <form method="post" action="/activation/{{ $activation->id }}/deactivate_user">
        {{ csrf_field() }}

        <button type="submit" class="btn btn-danger ">User deaktivieren</button>
      </form>
      @endif
    @endforeach

@endsection
