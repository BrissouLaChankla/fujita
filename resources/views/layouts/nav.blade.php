<nav class="d-flex justify-content-center align-items-center">
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