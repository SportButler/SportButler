<!DOCTYPE html>
<html>
<head>
  <title>Hier entsteht die Middleware</title>
</head>
<body>
  <ul>
@foreach($games as $game)
  <li>{{ $game->description }} </li>
  <li>{{ $game->id }} </li>
@endforeach

  </ul>
</body>
</html>
