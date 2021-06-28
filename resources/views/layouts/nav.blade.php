{{-- NAV DESKTOP --}}
<nav class="d-none d-md-flex justify-content-center align-items-center">
    <a class="text-white font-weight-bold text-decoration-none p-3" href="/">Accueil</a>
    <div class="dropdown">
        <a class="text-white font-weight-bold text-decoration-none p-3" href="{{route('show-team')}}">L'équipe</a>
        <div class="dropdown-content">
            @foreach ($players as $player)
                <a href="{{route('show-player', $player->slug)}}">{{$player->lol->pseudo}}</a>
            @endforeach
        </div>
      </div>
    <a class="text-white font-weight-bold text-decoration-none p-3" href="/"><img src="{{asset('logo.webp')}}"></a>
    <a class="text-white font-weight-bold text-decoration-none p-3" href="">Boutique</a>
    <a class="text-white font-weight-bold text-decoration-none p-3" href="">Contact</a>
  </nav>

{{-- NAV MOBILE --}}
  <nav class="d-flex d-md-none justify-content-between align-items-center">
      <a class="text-white font-weight-bold text-decoration-none p-3" href="/"><img src="{{asset('logo.webp')}}"></a>
      <button class="d-md-none text-white hamburger hamburger--elastic" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-label="{{ __('Toggle navigation') }}">
        <span class="hamburger-box">
          <span class="hamburger-inner"></span>
        </span>
      </button> 
  </nav>

  <div class="mobile-opened d-none d-md-none">
    <div class="d-flex d-md-none flex-column justify-content-between align-items-center nav">
      <a class="text-white font-weight-bold text-decoration-none pb-4 align-self-start" href="/"><img src="{{asset('logo.webp')}}"></a>
      <a class="text-white font-weight-bold text-decoration-none py-4" href="/">Accueil</a>
      <div class="dropdown">
          <a class="text-white font-weight-bold text-decoration-none py-4" href="{{route('show-team')}}">L'équipe</a>
          <ul>
              @foreach ($players as $player)
                <li class="text-decoration-none text-white"> 
                   <a class="text-light" href="{{route('show-player', $player->slug)}}">{{$player->lol->pseudo}}</a>
                </li>
              @endforeach
          </ul>
        </div>
      <a class="text-white font-weight-bold text-decoration-none py-4" href="">Boutique</a>
      <a class="text-white font-weight-bold text-decoration-none py-4" href="">Contact</a>
      </div>
  </div>



  <style>



.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

      .dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}


  </style>
  <script>
        $('.hamburger').on('click', function() {
          $(this).toggleClass('is-active');
          $('.mobile-opened').toggleClass('d-none');
      });

  </script>
  