@if(!session()->has('korisnik'))
<form action="{{route('logovanje')}}" method="GET">
    <div class="form-group">
        <label>Username : </label>
        <input type="text" id="id" name="tbKorisnickoIme" class="form-control"/>
    </div>
    <div class="form-group">
        <label> Password: </label>
        <input type="text" id="korisnickoIme" name="tbLozinka" class="form-control"/>
    </div>

    <div class="form-group">
        <input type="submit" id="login" name="btnSubmit" class="btn btn-default" value="Submit"/>
    </div>
</form>
    @endif