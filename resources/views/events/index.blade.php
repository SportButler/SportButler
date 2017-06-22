@extends ('layouts.master')

@section('content')

@foreach ($events as $event)

    @include ('events.event')

@endforeach

@endsection
