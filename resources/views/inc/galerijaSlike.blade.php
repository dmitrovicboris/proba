<div class=" mb-4">
    @foreach($galerija as $gal)
        <div class=" mb-4" style="padding: 50px; ">
            <a href="{{$gal->slika}}" data-lightbox="mygallery" class="aImg" >
                <img src="{{ $gal->slika  }}" alt="{{ $gal->alt }}" style=" width: 100%; height: 100%;" /> </a>


        </div>

    @endforeach
    <div id="" >
        <a> {{ $galerija->links() }}</a>
    </div>
</div>