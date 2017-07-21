<div class="headlogo hidden-md-down">
  <div class="container">
    <div class="row">
      <div class="col-md-0"></div>
      <div class="col-md-6">
        <img src="http://dbserver.team-upp.com/img/logo.png" alt="logo" style="height:250px; display: block; margin-left: 0; margin-right: auto; background-color: none; border-radius: 100%; padding-top: 25px;"></img>
      </div>
      <div class="col-md-6">
          <img src="../img/butler.png" alt="butler" style="height:300px; display: block; margin-left: 0; margin-right: auto; background-color: none;"></img>
        @if(Sentinel::check())
        <form method="post" action="/logout">
          <div class="pull-right">
            {{ csrf_field() }}
            <button class="logout-btn"><i class="fa fa-sign-out"></i> Logout</button>
          </div>
          @endif
        </form>
      </div>
    </div>
  </div>
</div>
@if(Sentinel::check())
<div class="blog-masthead">
  <div class="container">
    <nav class="navbar navbar-inverse bg-inverse navbar-toggleable-md">
      <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleContainer" aria-controls="navbarsExampleContainer" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsExampleContainer">
        <ul class="navbar-nav m-auto">
          @if(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug == 'admin')

          <li class="nav-item"><a class="nav-link" href="/admin">Startseite</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/events">Meine Veranstaltungen</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/mitglieder">Meine Mitglieder</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			                      Management
			                    </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="/admin/clubs">Verein</a>
              <a class="dropdown-item" href="/admin/sports">Sportarten</a>
              <a class="dropdown-item" href="/admin/fields">Plätze</a>
              <a class="dropdown-item" href="/admin/contacts">Kontakte</a>
              <a class="dropdown-item" href="/admin/event/create">Event eintragen</a>
              <a class="dropdown-item" href="/admin/account/{{ Sentinel::getUser()->id }}/edit">Mein Account</a>
              <a class="dropdown-item" href="/admin/statistics">Statistiken</a>
            </div>
          </li>

          @elseif(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug == 'kunde')

          <li class="nav-item"><a class="nav-link" href="/startseite">Startseite</a></li>
          <li class="nav-item"><a class="nav-link" href="/user/clubs">Mein Verein</a></li>
          <li class="nav-item"><a class="nav-link" href="/user/events">Meine Veranstaltungen</a></li>
          <li class="nav-item"><a class="nav-link" href="/user/account/{{ Sentinel::getUser()->id }}/edit">Mein Account</a></li>

          @elseif(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug == 'lieferant')
          <li class="nav-item"><a class="nav-link" href="/">Startseite</a></li>
          <li class="nav-item"><a class="nav-link" href="/events">Meine Veranstaltungen</a></li>
          <!-- <li class="nav-item"><a class="nav-link" href="/uebersicht">Übersicht</a></li> -->


          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Management
                    </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="/clubs">Verein</a>
              <a class="dropdown-item" href="/sports">Sportarten</a>
              <a class="dropdown-item" href="/fields">Plätze</a>
              <a class="dropdown-item" href="/contacts">Kontakte</a>
              <a class="dropdown-item" href="/create">Event eintragen</a>
              <a class="dropdown-item" href="/account/{{ Sentinel::getUser()->id }}/edit">Mein Account</a>
              <a class="dropdown-item" href="/statistics">Statistiken</a>
            </div>
          </li>


          @else
          <li class="nav-item"><a class="nav-link" href="/login">Login</li></a>
            <a class="nav-link" href="/register">
              <li class="nav-item">Register</li>
            </a>
            @endif
        </ul>
      </div>
    </nav>
  </div>
</div>
@else @endif
<div class="headlogo hidden-lg-up">
  <div class="container">
    <div class="row hidden-sm-down">
      <div class="col-md-0"></div>
      <div class="col-md-3">
        <img src="http://dbserver.team-upp.com/img/logo.png" alt="logo" style="height:250px; display: block; margin-left: 0; margin-right: auto; background-color: none; border-radius: 100%; padding-top: 25px;"></img>
      </div>
      <div class="col-md-9">
          <img src="../img/butler.png" alt="butler" style="height:300px; display: block; margin-left: 0; margin-right: auto; background-color: none;"></img>
        @if(Sentinel::check())
        <form method="post" action="/logout">
          <div class="pull-right">
            {{ csrf_field() }}
            <button class="logout-btn"><i class="fa fa-sign-out"></i> Logout</button>
          </div>
          @endif
        </form>
      </div>
    </div>
    <div class="row hidden-md-up">
      <div class="col-md-0"></div>
      <div class="col-md-12">
        <img src="http://dbserver.team-upp.com/img/logo.png" alt="logo" style="height:250px; display: block; margin-left: auto; margin-right: auto; background-color: none; border-radius: 100%; padding-top: 25px;"></img>
      </div>

    </div>
  </div>
</div>
