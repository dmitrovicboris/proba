<!-- Navigacija -->
{{--@if(session()->has('korisnik') && session()->get('korisnik')->naziv == "admin")--}}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" >



    <div class="container" >

        <a class="navbar-brand" href="{{asset('/')}}">FC Ajax</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              @if(isset($navigacija))
               @foreach($navigacija as $nav)

                <li class="nav-item {{($loop->first)? 'active':'' }}">
                    <a class="nav-link text-light" href="{{asset($nav->href) }}">{{ $nav->naziv }}
                        <span class="sr-only ">(current)</span>
                    </a>
                </li>
                @endforeach
                @endif

                  @if(session()->has('korisnik'))
                      <li class="nav-item">
                          <a class="nav-link text-light" href="{{route('go')}}">Anketa</a>
                      </li>
                      <li class="nav-item">
                      <a class="nav-link text-light" href="{{route('logout')}}">Logout</a>
                      </li>

                  @if(session()->get('korisnik')->naziv == 'admin')
                          <li class="nav-item">
                          <a class="nav-link text-light" href="{{route('admin')}}">Admin panel</a>
                          </li>
                      @endif
                      @else
                      <li class="nav-item">
                      <a class="nav-link text-light" href="{{route('registracija')}}">Registracija</a>
                      </li>

                      @endif

            </ul>
        </div>
    </div>
</nav>
<!--// Navigacija -->