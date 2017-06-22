<div class="blog-post">
  <h2 class="blog-post-title">
    <a href="/events/{{ $event->id }}">

    {{ $event->sport }}

    </a>
  </h2>

  <p class="blog-post-meta">{{ $event->created_at->toDayDateTimeString() }} </p>

  Maximale Spieleranzahl: {{ $event->players }} <br>
  Angemeldete Spieler: {{ $event->currentplayers }} <br>

  Spielbeschreibung: <br>
  {{ $event->description }}

</div>
