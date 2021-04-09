<div class="col-md-8" style="margin-top:80px;">

    <h3>Dodaj sliku u galeriju</h3>


    <form action="{{route('galerijaUnos')}}" method="POST" enctype="multipart/form-data" >
        @csrf

        <div class="form-group">
            <label>Slika : </label>
            <input type="file" name="slika" class="form-control"  />
        </div>
        <div class="form-group">
            <label>Alt : </label>
            <input type="text" name="alt" class="form-control" />
        </div>
        <div class="form-group">
            <input type="submit" name="addGalerija" value="Dodaj" class="btn btn-default" />
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
</div>