@extends ('layouts.master')

@section('content')

<div class="row border-head">
        <h1 style="margin-bottom: 0px" class=" mr-auto">Kontakte</h1>
        <div>
          @if($role == 'lieferant')
           <a href="/contacts/create" class="btn btn-success">Kontakt anlegen</a>
          @else
            <a href="/admin/contacts/create" class="btn btn-success">Kontakt anlegen</a>
          @endif
        </div>
</div>



<table class="table table-striped">
  <thead>
    <tr>
      <th>Sportart</th>
      <th>Kontaktperson</th>
      <th>Tel. Nummer</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
@foreach ($contacts as $contact)
    <tr>
      <td>@if( count($contact->sport) == 0)
          Derzeit keine Sportart zugewiesen!
          @else
          {{ $contact->sport->name }}
          @endif
      </td>
      <td>{{ $contact->name }}</td>
      <td>{{ $contact->phonenumber }} </td>
      @if($role == 'lieferant')
      <td style="width:1;"><a href="/contacts/{{ $contact->id }}/edit" class="btn btn-primary">bearbeiten</a></td>
      <td style="width:1;"><form class="margin0" action="{{ url('/contacts/destroy', [$contact->id]) }}" method="POST">{{ csrf_field() }}
      @else
      <td style="width:1;"><a href="/admin/contacts/{{ $contact->id }}/edit" class="btn btn-primary">bearbeiten</a></td>
      <td style="width:1;"><form class="margin0" action="{{ url('/admin/contacts/destroy', [$contact->id]) }}" method="POST">{{ csrf_field() }}
      @endif
  <input type ="submit" value="löschen" class="btn btn-danger">
</form></td>
    </tr>
    @endforeach
  </tbody>
</table>



@endsection
