@extends ('layouts.master')

@section('content')



<div class="row border-head">
        <h1 style="margin-bottom: 0px" class=" mr-auto">Buchungen:  {{ $field->name }}</h1>
</div>
<div class="fieldmodal">
    <div class="media rounded">
        <img class="d-flex align-self-center mr-3" style="width: 160px; height: auto;" src="http://www.gemologyproject.com/wiki/images/5/5f/Placeholder.jpg" alt="Generic placeholder image">
        <div class="media-body">
      <h2>
        <a href="">

       {{ $field->name }}


        </a>
      </h2><br>
    <div class="form-group">
     <b>Maximale Spieleranzahl:</b> {{ $field->maxplayers }} <br>
     <b>Stundenpreis:</b> {{ $field->priceperhour }} <br><br>

      <b>Beschreibung:</b> {{ $field->description }}<br>
    </div>
      </div>
    </div>
</div>


<div id="accordion" role="tablist" aria-multiselectable="true">
  <div class="card">
   @foreach ($field->events as $event)
 
    <div class="card-header" role="tab" id="headingOne">
        <div class="row">
      <h5 class="mb-0 mr-auto">
           <a data-toggle="collapse" data-parent="#accordion" href="#test" aria-expanded="false" aria-controls="test" class="sports-vert">
        
          {{ $event->start }}
        
      </h5>
      </a>
      <div style="margin: 0px" class="row">
            <a style="margin-right: 5px;" href="" class="btn btn-primary">bearbeiten</a>
        </div>
        </div>
    </div>
    


    <div id="test" class="collapse" role="tabpanel" aria-labelledby="test">
      <div class="card-block">
      <div class="row">
       
        {{ $event->start }} <br>
          {{ $event->end }} <br>
          {{ $event->sport }} <br>
          {{ $event->description }} <br>
          {{ $event->players }} <br>
          {{ $event->currentplayers }} <br>
       </div>
      </div>
    </div>
       @endforeach
  </div>
</div>











<div class="blog-main">

  <h1>Feldname: {{ $field->name }}</h1>

    

    Feldbeschreibung: <br>
    {{ $field->description }}

    <div class="events">
      @foreach ($field->events as $event)
        <article>
          {{ $event->date }} <br>
          {{ $event->start }} <br>
          {{ $event->end }} <br>
          {{ $event->sport }} <br>
          {{ $event->description }} <br>
          {{ $event->players }} <br>
          {{ $event->currentplayers }} <br>
        </article>
      @endforeach
    </div>

</div>

@endsection
