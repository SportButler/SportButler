@extends ('layouts.master')

@section('content')


<div class="row" style="margin-bottom: 40px; margin-top: 30px;">
    <div class="col-md-3" style="text-align: left;"></div>
    <div class="col-md-6" style="text-align: center;">
            <h1 style="margin-bottom: 0px; color: #c1272d;" class=" mr-auto">Plätze</h1>
    </div>
    <div class="col-md-3" style="text-align: right;">
              @if($role == 'lieferant')
               <a href="/fieldscreate" class="btn btn-red btn-block">Feld hinzufügen</a>
              @else
                <a href="/admin/fieldscreate" class="btn btn-red btn-block">Feld hinzufügen</a>
              @endif
    </div>
</div>
<div class="row">
@foreach ($fields as $field)

    @include ('fields.field')

@endforeach
</div>
@endsection
