@extends ('layouts.master')

@section('content')
<body>
<div class="flex-center position-ref full height">
  <form action="{{ route('sendmail') }}" method="post">
      <input type="email" name="email" placeholder="email">
      <input type="text" name="text" placeholder="password">
      <button type="submit">Send a mail</button>
  </form>
</div>
</body>

@endsection
