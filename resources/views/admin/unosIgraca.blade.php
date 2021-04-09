<div class="col-md-8" style="margin-top:80px; ">

    <h3>Dodaj igrača</h3>


    <form action="{{route('igraciUnos')}}" method="POST" enctype="multipart/form-data" >
        @csrf
        <div class="form-group">
            <label>Ime : </label>
            <input type="text" name="ime" class="form-control" />
        </div>
        <div class="form-group">
            <label>Prezime : </label>
            <input type="text" name="prezime" class="form-control" />
        </div>
        <div class="form-group">
            <label>Broj : </label>
            <input type="text" name="broj" class="form-control" />
        </div>
        <div class="form-group">
            <label>Pozicija : </label>
            <input type="text" name="pozicija" class="form-control" />
        </div>
        <div class="form-group">
            <label>Slika : </label>
            <input type="file" name="slika" class="form-control"  />
        </div>
        <div class="form-group">
            <label>Alt : </label>
            <input type="text" name="alt" class="form-control" />
        </div>
        <div class="form-group">
            <label>Država : </label>
            <input type="text" name="drzava" class="form-control" />
        </div>
        <div class="form-group">
            <input type="submit" name="addIgraca" value="Dodaj" class="btn btn-default" />
        </div>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @empty(!session('NEuspehKreiranja'))
        <div class="alert alert-danger">{{ session('NEuspehKreiranja') }}</div>
    @endempty

    @empty(!session('uspehKreiranja'))
        <div class="alert alert-success">{{ session('uspehKreiranja') }} </div>
    @endempty
    @empty(!session('greskaFajl'))
        <div class="alert alert-danger">{{ session('greskaFajl') }} </div>
    @endempty

</div>