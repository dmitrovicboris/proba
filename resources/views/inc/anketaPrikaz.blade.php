<div class="col-md-8" style="margin-top: 80px;">

        <h5 class="card-header text-center"> Igrač meseca : </h5>

 <div id='anketa'>

                        @if(session()->has('korisnik'))

                            @if(isset($zabrana))
                                <div class="alert alert-warning">
                                    Vec ste glasali
                                </div>
                 <h2 class="card-title">Rezultati</h2>
                 <p class='card-text'>Igrač meseca :</p>
                 <table class="table">
                     <tr>
                         <td>Naziv</td>
                         <td>Rezultat</td>
                     </tr>

                     @foreach($rezultati as $r)

                    <tr>
                        <td>{{$r->naziv }} </td>
                        <td>{{$r->rezultat }}</td>
                    </tr>

                     @endforeach

                 </table>

                            @else
                                <h2 class="card-title">Anketa</h2>

                                <p class='card-text'>Igrač meseca : </p>
                                <form name='forma1' method='POST' action='{{ route('storeAjax')}}'>
                                    {{csrf_field()}}

                                    @foreach($rezultati as $r)

                                        <p class="card-text">
                                            <input type="hidden" value='{{ $r->rezultat }}' name='rez'/>
                                            <input type="radio" value='{{ $r->id_anketa }}' name="anketa" />{{
                                $r->naziv }}<br/></p>
                                    @endforeach

                                    <button type='submit' class="btn btn-success" value='{{route('go')}}'
                                            name='vote'>Glasaj</button>

                                </form>

         @endif

     @endif
 </div>


</div>
