
<div class="col-md-4" style="margin-top:50px;">

    @empty(!session('neuspesno'))
        <div class="alert alert-danger">{{ session('neuspesno') }}</div>
    @endempty

    @empty(!session('uspesno'))
        <div class="alert alert-success">{{ session('uspesno') }} </div>
    @endempty
    @if(isset($igraci))
        <div class="card my-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Pretrаži igrača po imenu ili prezimenu" name="search"/>
        <span class="input-group-btn">
                      <button class="btn btn-secondary" type="button" id="btnSearch">Go!</button>
        </span>
    </div>
    </div>
    </div>
    @endif


    <div class="card my-4">
        @if(!session()->has('korisnik'))
            <h5 class="card-header text-center">Login</h5>
        <div class="card-body">

                <div class="form-group">
                    <form action="{{route('logovanje')}}" method="POST">
                        @csrf
                        <label for="username" class="text-muted"><b>Username : </b></label>
                        <input type="text" class="form-control" name="username" placeholder="Username...">

                <div class="form-group">
                    <label for="password" class="text-muted"><b>Passord : </b></label>
                    <input type="password" class="form-control" name="pass" placeholder="Password...">
                </div>
                <div class="form-group">
                <span class="input-group-btn">
                  <input type="submit" class="btn btn-primary" type="submit" name="btnLogin" value="Login" />

                </span>
                </div>
                    </form>

                </div>

        </div>
        @endif
     </div>

        <div class="card my-4">
        <h5 class="card-header">Dokumentacija</h5>
        <div class="card-body">

            <a href="{{ route('dokumentacija') }}" class="btn btn-success">--- DOKUMENTACIJA ---</a>
        </div>
        </div>
</div>
