


@isset($vesti)
@foreach($vesti as $vest)
    <!-- Blog Post -->
    <div class="card mb-4">
        <img class="card-img-top" src="{{asset('/'.$vest->slika )}}" alt="{{$vest->alt}}">
        <div class="card-body">
            <h2 class="card-title">{{$vest->naslov}}</h2>

            <a href="{{asset('/single/'.$vest->id_vesti)}}" class="btn btn-primary">Pročitaj više &rarr;</a>
        </div>
        <div class="card-footer text-muted">
            Posted on {{$vest->kreiran}}

        </div>
    </div>
    <!--// Blog Post -->
@endforeach
@endisset
<!-- Pagination -->
<div >
    <a class="" href="#" > {{$vesti->links()}}</a>

</div>
