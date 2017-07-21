


<div class="col-md-4">
    <div class="fieldbox rounded-bottom">
        <div class="row">
            <div class="col-2">
                <div class="">
                    @if($role == 'lieferant')

        <form action="{{ url('/destroy', [$field->id]) }}" method="POST">
        @else

        <form action="{{ url('/admin/fields/destroy', [$field->id]) }}" method="POST">
        @endif
          {{ csrf_field() }}
                   <button style="background: none; border: none; padding: 0;" type="submit"><i class="fa fa-trash-o field-btn-circle rounded-circle"></i></button>
                   </form>
                </div>
            </div>
            <div class="col-8">
                <img class="m-auto rounded-circle field-sportimage" src="http://www.gemologyproject.com/wiki/images/5/5f/Placeholder.jpg" alt="Generic placeholder image">
                <h3 class="field-heading">
                    {{ $field->name }}
                </h3>
            </div>
            <div class="col-2">
                <div class="pull-right">
        @if($role == 'lieferant')
            <a href="/fields/{{ $field->id }}/edit" class="">
                <i class="fa fa-pencil field-btn-circle rounded-circle"></i>
            </a>
        @else
            <a href="/admin/fields/{{ $field->id }}/edit" class="">
                <i class="fa fa-pencil field-btn-circle rounded-circle"></i>
            </a>
        @endif

                </div>
            </div>
        </div>
        <div class="max-players">
            Maximale Spieleranzahl: {{ $field->maxplayers }}
        </div>
        <hr class="field-hr">
        <div class="row" style="margin: 10px;">
            <div class="">
            <i class="fa fa-money fa-2x field-icon-circle rounded-circle"></i>
            </div>
            <div class="" style="color: #FFF; padding-left: 10px;">
                <p class="mb-0 field-bold">Stundenpreis</p>
                <p class="mb-0 field-bold"
                @if($field->priceperhour == 0)
                style="color:green">
                kostenlos
                @else
                style="color: #f93a34">
                € {{ $field->priceperhour }}
                @endif
                </p>
            </div>
        </div>
        <hr class="field-hr">
        <div class="row" style="margin: 10px;">
            <div class="">
            <i class="fa fa-tasks fa-2x field-icon-circle rounded-circle"></i>
            </div>
            <div class="" style="color: #FFF; padding-left: 10px; width: 80%">
                <p class="mb-0 field-bold">Platzbeschreibung</p>
                <p class="mb-0 field-bold" style="color: #f93a34; font-size: 12px;">{{ $field->description }}</p>
            </div>
        </div>
        <hr class="field-hr">
        <div class="row" style="margin: 10px;">
            <div class="">
            <i class="fa fa-tags fa-2x field-icon-circle rounded-circle"></i>
            </div>
            <div class="" style="color: #FFF; padding-left: 10px;">
                <p class="mb-0 field-bold">Sportarten</p>
                <p class="mb-0 field-bold" style="color: #f93a34">
                    @foreach($field->sports as $sport)
                    @if($sport == $field->sports->last())
                    {{ $sport->name}}
                    @else
                    {{ $sport->name}},
                    @endif
                    @endforeach
                </p>
            </div>
        </div>
    </div>
</div>
