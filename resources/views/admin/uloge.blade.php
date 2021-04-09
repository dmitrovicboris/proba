<div class="col-md-8" style="margin-top: 80px;" >
    <h3>Uloge</h3>
    @isset($errors)
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger"> {{ $error }} </div>
            @endforeach
        @endif
    @endisset
<form method="POST" action="{{(isset($uloga)) ? asset('/admin/uloge/update/'.$uloga->id_uloga) : asset('/admin/uloge/insert')}}"
      enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label> Naziv :</label>
        <input type="text" name="naziv" value="{{(isset($uloga)? $uloga->naziv : old('naziv'))}}"  class="form-control"/>
    </div>
<div class="form-group">
    <input type="submit" name="post"  value="{{isset($uloga)? 'Izmeni' : 'Dodaj'}}" class="btn btn-primary"/>
</div>

</form>
    @empty(!session('neuspeh'))
        <div class="alert alert-danger">{{ session('neuspeh') }}</div>
    @endempty

    @empty(!session('uspeh'))
        <div class="alert alert-success">{{ session('uspeh') }} </div>
    @endempty
    <table class="table">
        <tr>
            <td>Naziv</td>
            <td>Izmeni</td>
            <td>Obrisi</td>
        </tr>
        @isset($uloge)
      @foreach($uloge as $u)
    <tr>
        <td> {{$u->naziv}}</td>
        <td><a href="{{asset('/admin/uloge/view/'.$u->id_uloga)}}">Update post</a> </td>
        <td><a href="{{asset('/admin/uloge/delete/'.$u->id_uloga)}}">Obrisi post</a> </td>
    </tr>
   @endforeach
 @endisset
    </table>
</div>