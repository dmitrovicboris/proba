<div class="col-md-8" style="margin-top: 80px;">
    <h3>Galerija </h3>

    @isset($errors)
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger"> {{ $error }} </div>
            @endforeach
        @endif
    @endisset

    <form action="{{ (isset($galerija))? asset('/admin/galerija/update/'.$galerija->id_galerija)  : asset('/admin/galerija/insert')}}"
          method="POST" enctype="multipart/form-data">
        @csrf
       <div class="form-group">
            <label>Slika:</label>
            @isset($galerija)
                <img src="{{ asset($galerija->slika) }}" width="190"/>
            @endisset
            <input type="file" name="slika"  class="form-control" />
        </div>
        <div class="form-group">
            <label>Alt:</label>
            <input type="text" name="alt"  value="{{(isset($galerija))? $galerija->alt : old('alt')}}"
                   class="form-control"/>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="{{(isset($galerija))? 'Izmena':'Dodaj'}}"
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
            <td>Slika :</td>
            <td>Alt :</td>

            <td>Izmena:</td>
            <td>Brisanje:</td>
        </tr>
        @isset($galerije )
            @foreach($galerije as $g)
                <tr>

                    <td><img class="card-img-top"  width="200px" height="200px" src="{{asset
                                    ($g->slika)
                                    }}" alt="{{$g->alt}}"></td>
                    <td>{{  $g->alt }} </td>
                    <td> <a href="{{asset('/admin/galerija/view/'.$g->id_galerija)}}">Update post</a> </td>
                    <td> <a href="{{asset('/admin/galerija/delete/'.$g->id_galerija)}}">Obrisi post</a> </td>

                </tr>
            @endforeach
        @endisset

    </table>

</div>