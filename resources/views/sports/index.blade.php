@extends ('layouts.master')

@section('content')

<div class="row border-head">
        <h1 style="margin-bottom: 0px" class=" mr-auto">Sportarten</h1>
        <div>
          @if($role == 'lieferant')
            <a href="/sports/create" class="btn btn-success">Sportarten anlegen</a>
          @else
            <a href="/admin/sports/create" class="btn btn-success">Sportarten anlegen</a>
          @endif
        </div>
</div>


<div id="accordion" role="tablist" aria-multiselectable="true">
  <div class="card">
  @foreach ($sports as $sport)

    <div class="card-header" role="tab" id="headingOne">
        <div class="row">
      <h5 class="mb-0 mr-auto">
           <a data-toggle="collapse" data-parent="#accordion" href="#{{ $sport->name }}" aria-expanded="false" aria-controls="{{ $sport->name }}" class="sports-vert">

          {{ $sport->name }}

      </h5>
      </a>
      <div style="margin: 0px" class="row">
        @if($role == 'lieferant')
            <a style="margin-right: 5px;" href="/sports/{{$sport->id}}/edit" class="btn btn-primary">bearbeiten</a>
            <form class="margin0" action="{{ url('/sports/destroy', [$sport->id]) }}" method="POST">{{ csrf_field() }}
        @else
            <a style="margin-right: 5px;" href="/admin/sports/{{$sport->id}}/edit" class="btn btn-primary">bearbeiten</a>
            <form class="margin0" action="{{ url('/admin/sports/destroy', [$sport->id]) }}" method="POST">{{ csrf_field() }}
        @endif
  <input type ="submit" value="löschen" class="btn btn-danger">
</form>
        </div>
        </div>
    </div>



    <div id="{{ $sport->name }}" class="collapse" role="tabpanel" aria-labelledby="{{ $sport->name }}">
      <div class="card-block">
      <div class="row">
       @foreach ($sport->contacts as $contact)

         <div class="col-md-6">
           <div class="mediafield rounded">
              <h3>{{ $contact->name }}</h3>
              <strong>Telefonnummer:</strong> {{ $contact->phonenumber }}
            </div>
          </div>

       @endforeach
       </div>
      </div>
    </div>
       @endforeach
  </div>
</div>






@endsection
