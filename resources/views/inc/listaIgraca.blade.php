
<div id="postovi">
<h3>Za više informacija o igrču - pretražite igrača</h3>
@if(isset($igraci))
    @foreach($igraci as $igrac)
<!-- Blog Post -->
<div class="card mb-4" style=" width: 300px; height: 400px; float: left; padding: 5px;margin: 5px;">
    <img class="card-img-top" src="{{asset('/'.$igrac->slika)}}" alt="{{$igrac->alt}}" style="height: 200px; width: 200px;
margin-top: 50px;margin: 0px auto;">
    <div class="card-body">
        <p class="card-text" style="font-size: 25px;text-align: center"><b>Ime  : </b> {{$igrac->ime}}</p>
        <p class="card-text" style="font-size: 25px; text-align: center" ><b>Prezime : </b> {{$igrac->prezime}}</p>

    </div>
</div>
    @endforeach
    @endif

</div>

<div style="float: left; ">
    <a class="" href="#" > {{$igraci->links()}}</a>
</div>
