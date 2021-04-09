
<div class="col-md-8" style="margin-top: 80px;">
    <h3>Vesti</h3>

    @isset($errors)
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger"> {{ $error }} </div>
            @endforeach
        @endif
    @endisset

    <form action="{{ (isset($adminPanelPostDelete))? asset('/admin/updatePost/'.$adminPanelPostDelete->id_vesti)  : asset('/vestiUnos') }}"
          method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group3">
            <label>Naslov:</label>
            <input type="text" value="{{(isset($adminPanelPostDelete))? $adminPanelPostDelete->naslov : old('naslov')}}" name="naslov"
                   class="form-control"/>
        </div>

        <div class="form-group">
            <label>Sadrzaj:</label>
            <textarea  name="tekst" class="form-control" rows="7">{{(isset($adminPanelPostDelete))? $adminPanelPostDelete->tekst :
                     old('tekst')}}</textarea>
        </div>
        <div class="form-group">
            <label>Slika:</label>
            @isset($adminPanelPostDelete)
                <img src="{{ asset($adminPanelPostDelete->slika) }}" width="190"/>
            @endisset
            <input type="file" name="slika"  class="form-control"
            value="{{(isset($adminPanelPostDelete))? $adminPanelPostDelete->slika : old('slika')}}"/>
        </div>
        <div class="form-group">
            <label>Alt:</label>
            <input type="text" name="alt"  value="{{(isset($adminPanelPostDelete))? $adminPanelPostDelete->alt : old('alt')}}"
                   class="form-control"/>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="{{(isset($adminPanelPostDelete))? 'Izmena':'Dodaj'}}"
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
            <td>Naslov:</td>
            <td>Tekst:</td>
            <td>Kreiran:</td>
            <td>Izmenjen:</td>
            <td>Slika:</td>

            <td>Brisanje:</td>
            <td>Izmena:</td>
        </tr>
        @isset($adminPanelPostsDelete)
            @foreach($adminPanelPostsDelete as $a)
                <tr>
                    <td>{{$a->naslov}} </td>
                    <td>{{$a->tekst}} </td>
                    <td>{{  $a->kreiran }} </td>
                    <td>{{  $a->izmenjen }} </td>

                    <td><img class="card-img-top"  width="200px" height="200px" src="{{asset
                                    ($a->slika)
                                    }}" alt="{{$a->alt}}"></td>

                    <td> <a href="{{asset('/admin/deletePostView/'.$a->id_vesti)}}">Update post</a> </td>
                    <td> <a href="{{asset('/admin/deletePost/'.$a->id_vesti)}}">Obrisi post</a> </td>
                </tr>
            @endforeach
        @endisset

    </table>

</div>