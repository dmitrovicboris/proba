
<div class="col-md-8" style="margin-top: 80px;">
    <h3>Igrači</h3>

    @isset($errors)
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger"> {{ $error }} </div>
            @endforeach
        @endif
    @endisset

    <form action="{{ (isset($igrac))? asset('/admin/igrac/update/'.$igrac->id_igraci)  : asset('/admin/igrac/insert')}}"
          method="POST" enctype="multipart/form-data">
       @csrf
        <div class="form-group3">
            <label>Ime :</label>
            <input type="text" value="{{(isset($igrac))? $igrac->ime : old('ime')}}" name="ime"
                   class="form-control"/>
        </div>
        <div class="form-group3">
            <label>Prezime :</label>
            <input type="text" value="{{(isset($igrac))? $igrac->prezime : old('prezime')}}" name="prezime"
                   class="form-control"/>
        </div>
        <div class="form-group3">
            <label>Broj :</label>
            <input type="text" value="{{(isset($igrac))? $igrac->broj : old('broj')}}" name="broj"
                   class="form-control"/>
        </div>
        <div class="form-group3">
            <label>Pozicija :</label>
            <input type="text" value="{{(isset($igrac))? $igrac->pozicija : old('pozicija')}}" name="pozicija"
                   class="form-control"/>
        </div>
        <div class="form-group3">
            <label>Drzava :</label>
            <input type="text" value="{{(isset($igrac))? $igrac->drzava : old('drzava')}}" name="drzava"
                   class="form-control"/>
        </div>

        <div class="form-group">
            <label>Slika:</label>
            @isset($igrac)
                <img src="{{ asset($igrac->slika) }}" width="190"/>
            @endisset
            <input type="file" name="slika"  class="form-control" />
                   {{--value="{{(isset($igrac))? $igrac->slika : old('slika')}}"/>--}}
        </div>
        <div class="form-group">
            <label>Alt:</label>
            <input type="text" name="alt"  value="{{(isset($igrac))? $igrac->alt : old('alt')}}"
                   class="form-control"/>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="{{(isset($igrac))? 'Izmena':'Dodaj'}}"
                   name="post"/>
        </div>

    </form>
    @empty(!session('neuspeh'))
        <div class="alert alert-danger">{{ session('neuspeh') }}</div>
    @endempty

    @empty(!session('uspeh'))
        <div class="alert alert-success">{{ session('uspeh') }} </div>
    @endempty
    <table class="table">
        <tr>Informacije o postovima</tr>
        <tr>
            <td>Ime:</td>
            <td>Prezime:</td>
            <td>Broj:</td>
            <td>Pozicija:</td>
            <td>Drzava:</td>
            <td>Slika:</td>
            <td>Alt:</td>

            <td>Izmena:</td>
            <td>Brisanje:</td>
        </tr>
        @isset($igraci )
            @foreach($igraci as $i)
                <tr>
                    <td>{{$i->ime}} </td>
                    <td>{{$i->prezime}} </td>
                    <td>{{  $i->broj }} </td>
                    <td>{{  $i->pozicija }} </td>
                    <td>{{  $i->drzava }} </td>
                    <td><img class="card-img-top"  width="200px" height="200px" src="{{asset
                                    ($i->slika)
                                    }}" alt="{{$i->alt}}"></td>
                    <td>{{  $i->alt }} </td>
                    <td> <a href="{{asset('/admin/igrac/view/'.$i->id_igraci)}}">Update post</a> </td>
                    <td> <a href="{{asset('/admin/igrac/delete/'.$i->id_igraci)}}">Obrisi post</a> </td>

                </tr>
            @endforeach
        @endisset

    </table>

</div>