
<div class="col-md-8" >
    <h3>Registrujte se</h3>

<form action="{{route('registracija')}}" method="POST"style="margin-top:80px;" >
        @csrf
    <div class="form-group">
        <label>Username : </label>
        <input type="text" id="idIme" name="username" class="form-control"/>
    </div>
    <div class="form-group">
        <label> Password: </label>
        <input type="password" id="idPassword" name="password" class="form-control"/>
    </div>
    <div class="form-group">
        <label> Email : </label>
        <input type="text" id="idEmail" name="email" class="form-control"/>
    </div>
    <div class="form-group">

        <input type="submit" id="login" name="btnReg" class="btn btn-default" value="Registruj"/>
    </div>
</form>
@empty(!session('neuspesnoReg'))
    <div class="alert alert-danger">{{ session('neuspesnoReg') }}</div>
@endempty

@empty(!session('uspesnoReg'))
    <div class="alert alert-success">{{ session('uspesnoReg') }} </div>
@endempty
@if ($errors->any())
    <div class="alert alert-danger" >
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>
