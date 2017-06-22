<div class="col-md-6 fieldmodal">
    <div class="media rounded">
        <img class="d-flex align-self-center mr-3" style="width: 160px; height: auto;" src="http://www.gemologyproject.com/wiki/images/5/5f/Placeholder.jpg" alt="Generic placeholder image">
        <div class="media-body">
      <h2>
        <a href="#">

        {{ $field->name }}

        </a>
      </h2>
    <div class="form-group">
      <b>Maximale Spieleranzahl:</b> {{ $field->maxplayers }} <br>
      <b>Stundenpreis:</b> {{ $field->priceperhour }} €<br>

      <b>Platzbeschreibung:</b> <br>
      {{ $field->description }}
    </div>
      </div>
    </div>
</div>
