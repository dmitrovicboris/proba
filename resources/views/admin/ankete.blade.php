
<div class="col-md-8" style="margin-top:80px; ">
    @isset($errors)
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger"> {{ $error }} </div>
            @endforeach
        @endif
    @endisset
   <form method="POST" action="{{(isset($anketa)) ? asset('/admin/anketa/update/'.$anketa->id_anketa )
   : route('anketeAdminInsert')}}" >
       @csrf
    <div class="form-group">
        <label>Naziv :</label>
        <input class="form-control" value="{{(isset($anketa))? $anketa->naziv : old('naziv')}}" name="naziv" />
    </div>
       <div class="form-group">
           <label>Rezultat :</label>
           <input class="form-control" value="{{(isset($anketa))? $anketa->rezultat : old('rez')}}" name="rez" />
       </div>

       <div class="form-group">
           <input type="submit" class="btn btn-default" value="{{(isset($anketa))? 'Izmeni': 'Dodaj'}}"  />
       </div>
   </form>
    @empty(!session('uspeh'))
    <div class="alert alert-success">
        {{session('uspeh')}}
    </div>
        @endempty
    @empty(!session('neuspeh'))
        <div class="alert alert-danger">
            {{session('neuspeh')}}
        </div>
    @endempty
<table class="table">
    <tr>
        <td>Naziv</td>
        <td>Rezultat</td>
        <td>Izmeni</td>
        <td>Obriši</td>
    </tr>
    @isset($ankete)
        @foreach($ankete as $a)
        <tr>
            <td>{{$a->naziv}}</td>
            <td>{{$a->rezultat}}</td>
            <td><a href="{{ asset('/admin/anketa/view/'.$a->id_anketa) }}">Update post</a> </td>
            <td><a href="{{ asset('/admin/anketa/delete/'.$a->id_anketa) }}">Delete post</a></td>
        </tr>
          @endforeach
        @endisset
</table>

</div>