<div class="col-md-8" >
    <h3>Kontakt</h3>
<form action="{{route('kontaktPosalji')}}" method="POST" >
    @csrf
    <div class="form-group">
        <label>Ime :</label>
        <input type="text" name="ime" class="form-control" />
    </div>
    <div class="form-group">
        <label>Email :</label>
        <input type="text" name="email" class="form-control" />
    </div>
    <div class="form-group">
        <label>Poruka :</label>
        <textarea name="poruka" class="form-control">

        </textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-info" name="posalji" value="Pošalji" />
    </div>
</form>
    @empty(!session('uspesanKontakt'))
        <div class="alert alert-success">{{ session('uspesanKontakt') }} </div>
    @endempty
    @empty(!session('NEuspesanKontakt'))
        <div class="alert alert-danger">{{ session('NEuspesanKontakt') }} </div>
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