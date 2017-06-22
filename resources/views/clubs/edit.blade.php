@extends ('layouts.master')

@section('content')
@if($role == 'lieferant')
<form method="post" action="/clubs/{{ $club->id }}/edit">

{{ csrf_field() }}

<div class="row border-head">
        <h1 style="margin-bottom: 0px" class=" mr-auto">Verein bearbeiten</h1>
        <div>
            <button type="submit" class="btn btn-primary ">Speichern</button>
  <a href="/clubs" class="btn btn-danger">abbrechen</a>
        </div>
</div>
@else
<form method="post" action="/admin/clubs/{{ $club->id }}/edit">

{{ csrf_field() }}

<div class="row border-head">
        <h1 style="margin-bottom: 0px" class=" mr-auto">Verein bearbeiten</h1>
        <div>
            <button type="submit" class="btn btn-primary ">Speichern</button>
  <a href="/admin/clubs" class="btn btn-danger">abbrechen</a>
        </div>
</div>
@endif


<div class="fieldmodal">
    <div class="media rounded">
        <div class="d-flex align-self-center mr-3">
        <figure>
        <img class="" style="width: 160px; height: auto;" src="http://www.gemologyproject.com/wiki/images/5/5f/Placeholder.jpg" alt="Generic placeholder image">
        <figcaption style="text-align: center; margin-top: 10px;"><a href="/clubs" class="btn btn-danger">Durchsuchen...</a></figcaption>
        </div>
        </figure>
        <div class="media-body">
        <b>Name:</b>
      <h2>
        <a href="">

       <input type="text" class="form-control" id="name" name="name" value="{{ $club->name }}">

        </a>
      </h2>
    <div class="form-group">
      <b>Beschreibung:</b> <textarea id="description" name="description" class="form-control">{{ $club->description }}</textarea><br>

      <b>Kontakt:</b> <textarea id="contact" name="contact" class="form-control">{{ $club->contact }}</textarea><br>
    </div>
      </div>
    </div>
</div>




@include ('layouts.errors')

</form>

@endsection
