@extends ('layouts.master')

@section('content')


  <div class="row">
    <div class="col-md-12 col-md-offset-3">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"> Login </h3>
        </div>

        <div class="panel-body">
          <form action="/login" method="POST">
            {{ csrf_field() }}

            @if(session('error'))
              <div class="alert alert-danger">
                {{ session('error') }}
              </div>
            @endif
            @include ('layouts.errors')

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="email" name="email" class="form-control" placeholder="example@example.com">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                <input type="password" name="password" class="form-control" placeholder="Password">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <input type="submit" value="Login" class="btn btn-red btn-block">
              </div>
            </div>
          </form>




          Du hast noch keinen SportButler? <br>
          <a data-toggle="collapse" data-parent="#accordion" href="#dasdad" aria-expanded="false" aria-controls="dasdad" >
            Jetzt Registrieren!
          </a>

            <div id="dasdad" class="collapse" role="tabpanel" aria-labelledby="dasdad">
              <div class="card-block login-card-block">
              <div class="row">
                <div class="col-md-12">
                  <div class="mediafield login-mediafield rounded">
                    <form action="/register_user">
                      <div class="form-group">
                          <div class="input-group">
                            <input type="submit" value="Registrieren als Mitglied" class="btn btn-red btn-block">
                          </div>
                      </div>
                    </form>
                    <form action="/register">
                      <div class="form-group">
                          <div class="input-group">
                            <input type="submit" value="Registrieren als Verein" class="btn btn-red btn-block">
                          </div>
                      </div>
                    </form>
                   </div>
                 </div>
               </div>
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
