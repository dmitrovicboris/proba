<div class="col-md-8" style="margin-top:80px; ">

    <table class="table">
        <h3>KORISNICI</h3>
        @empty(!session('msg'))
            {{ session('msg') }}
        @endempty
        @isset($errors)
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger"> {{ $error }} </div>
                @endforeach
            @endif
        @endisset
        <form action="{{ (isset($korisnikOne))? asset('admin/korisnik/update/'.$korisnikOne->id_korisnik) : asset
            ('/admin/korisnik/save')}}"
              method="POST" enctype="multipart/form-data">

            @csrf
            <div class="form-group">
                <label>username:</label>
                <input type="text" name="username" class="form-control" value="{{(isset($korisnikOne))?
                    $korisnikOne->username : old('username')}}"/>
            </div>
            <div class="form-group">
                <label>password:</label>
                <input type="text" name="password" class="form-control" value="{{ (isset($korisnikOne))?
                    $korisnikOne->password : old('password')}}"/>
            </div>
            <div class="form-group">
                <label>email:</label>
                <input type="text" name="email" class="form-control" value="{{ (isset($korisnikOne))?
                    $korisnikOne->email : old('email')}}"/>
            </div>

            <div class="form-group">
                <label>Uloga:</label>
                <select name="ddlUloga">
                    <option value="0">Izaberite</option>


                    @foreach($uloge as $u)
                        <option  value="{{$u->id_uloga}}" {{ (isset($korisnikOne) &&
                            $korisnikOne->id_uloga==$u->id_uloga)?
                            'selected' : (old('ddlUloga')== $u->id_uloga)? 'selected' : ''}}>{{$u->naziv}} </option>
                    @endforeach


                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="DodajKorisinka" value="{{ isset($korisnikOne)? 'Izmeni usera' : 'Dodaj
                    usera' }}" class="btn btn-default" />
            </div>
        </form>
        @empty(!session('neuspehKorisnik'))
            <div class="alert alert-danger">{{ session('neuspehKorisnik') }}</div>
        @endempty

        @empty(!session('uspehKorisnik'))
            <div class="alert alert-success">{{ session('uspehKorisnik') }} </div>
        @endempty
        <tr>Informacije o Korisniku</tr>
        <tr>
            <td>Id:</td>
            <td>Username:</td>

            <td>email:</td>
            <td>id_uloga:</td>


            <td>Izmena:</td>
            <td>Delete:</td>
        </tr>
        @isset($listajKorisnika)
            @foreach($listajKorisnika as $l)
                <tr>
                    <td>{{$l->id_korisnik}} </td>
                    <td>{{$l->username}} </td>

                    <td>{{$l->email}} </td>

                    <td>{{$l->id_uloga}} </td>


                    <td> <a href="{{asset('/admin/korisnik/view/'.$l->id_korisnik)}}">Update korisnika</a> </td>
                    <td> <a href="{{asset('/admin/korisnik/delete/'.$l->id_korisnik)}}">Obrisi korisnika</a> </td>
                </tr>
            @endforeach
        @endisset

    </table>

</div>