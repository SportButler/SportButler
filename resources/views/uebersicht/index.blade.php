@extends ('layouts.master')

@section('content')




<div role="tabpanel">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist" id="rowTab">
      <a href="#all" aria-controls="Tennis" role="tab" data-toggle="tab" class="tabmenu-home active"><li role="presentation" class="">all</li></a>

      @foreach ($sports as $sport)
        <a href="#{{ $sport->name }}" aria-controls="{{ $sport->name }}" role="tab" data-toggle="tab" class="tabmenu-home"><li role="presentation" class="">{{ $sport->name}}</li></a>
      @endforeach
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">

      <div role="tabpanel" class="tab-pane active" name="all" id="all">
        <div class="row">
          @foreach ($fields as $field)

              @include ('fields.home_field')

          @endforeach
        </div>
      </div>
      @foreach ($sports as $sport)
        <div role="tabpanel" class="tab-pane" name="{{ $sport->name }}" id="{{ $sport->name }}">
          <div class="row">
          @foreach ($sport->fields as $field)

              @include ('fields.home_field')

          @endforeach
          </div>
        </div>
      @endforeach
    </div>
</div>
@endsection
