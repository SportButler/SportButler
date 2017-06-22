@extends ('layouts.master')

@section('content')

  <div class="row">
    <div class="col-md-12 col-md-offset-3">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"> Registrieren </h3>
        </div>

        <div class="panel-body">
          <form action="/register" method="POST">
            {{ csrf_field() }}

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" id="name" name="name" class="form-control" placeholder="Vereinsname">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="email" id="email" name="email" class="form-control" placeholder="example@example.com">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Name">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Familienname">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                <input type="password" id="password" name="password" class="form-control" placeholder="Passwort">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Passwort wiederholen">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <input type="submit" value="Registrieren" class="btn btn-success btn-block">
              </div>
            </div>


            <div class="form-group">
              <div class="input-group">
                <a href="/login" value="Zurück zum Login" class="btn btn-primary btn-block">Zurück zum Login</a>
              </div>
            </div>
            @include ('layouts.errors')

          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
