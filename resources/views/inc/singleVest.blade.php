
    <!-- Blog Post -->
    <div class="card mb-4">
        <img class="card-img-top" src="{{asset('/'.$singleVest->slika)}}" alt="{{$singleVest->alt}}">
        <div class="card-body">
            <h2 class="card-title">{{$singleVest->naslov}}</h2>
            <p class="card-text">{{$singleVest->tekst}}</p>

        </div>
        <div class="card-footer text-muted">
            Posted on {{$singleVest->kreiran}}

        </div>
    </div>
    <!--// Blog Post -->

