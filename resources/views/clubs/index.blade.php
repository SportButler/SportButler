@extends ('layouts.master')

@section('content')

<div class="row border-head">
        <h1 style="margin-bottom: 0px" class=" mr-auto">Mein Verein</h1>
</div>

@if(empty($club))
Sie sind noch in keinem Verein
@else
<div class="fieldmodal">
    <div class="media rounded">
        <img class="d-flex align-self-center mr-3" style="width: 160px; height: auto;" src="http://www.gemologyproject.com/wiki/images/5/5f/Placeholder.jpg" alt="Generic placeholder image">
        <div class="media-body">
      <h2>
        <a href="">

       {{ $club->name }}
       <div class="form-inline pull-right">
    @if($role == 'kunde')
      <form action="{{ url('/user/club/leave', [$club->id]) }}" method="POST">

        {{ csrf_field() }}

        <input type ="submit" value="Verlassen" class="btn btn-danger">
      </form>
    @elseif($role == 'lieferant')
      <a href="/clubs/{{ $club->id }}/edit" class="btn btn-primary">bearbeiten</a>
    @else
      <a href="/admin/clubs/{{ $club->id }}/edit" class="btn btn-primary">bearbeiten</a>
    @endif
</div>

        </a>
      </h2><br>
    <div class="form-group">
      <b>Beschreibung:</b> {{ $club->description }}<br><br>

      <b>Kontakt:</b> {{ $club->contact }}<br>
    </div>
      </div>
    </div>
</div>
@endif
@endsection
