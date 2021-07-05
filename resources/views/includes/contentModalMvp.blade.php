<div class="row">
    <div class="col-md-6">
        Adrien est :
        <ul>
            <li>1er au dégat</li>
            <li>1er au dégats des tourelles</li>
            <li>2em gars le moins mort</li>
        </ul>

        <h3>Les commentaires :</h3>
        @foreach ($game->commentaires as $commentaire)
        <div class="row">

            {{dd($game->commentaire)}}
            <div class="col-4">
                <img src="{{ asset('mvp/'.strtolower($game->commentaire).'.jpg') }}" alt="">
            </div>

            {{$commentaire->commentary}}
        </div>
        @endforeach
    </div>
    <div class="col-md-6">
        <h3>Revivez les moments forts du match : </h3>
        <div id="lightgallery">
                @foreach ($game->videos as $video)
                        <a class="pointer @if(!$loop->first) d-none @endif" data-video='{"source": [{"src":"{{asset("video/moments_forts/".$video->name)}}", "type":"video/mp4"}], "attributes": {"preload": false, "controls": true}}'>
                            <img class="img-fluid" src="{{asset('video/moments_forts/thumbnail.png')}}" />
                        </a>
                @endforeach
            
              
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            {{-- <a href="{{asset('emblems/Emblem_Bronze.png')}}" data-lg-size="1600-2400">
                <video controls class="w-100">
                    <source src="{{asset("video/moments_forts/".$video->name)}}" type="video/mp4" />
                    </video>
                </a> --}}
            </div>
    </div>
</div>
<script>    
    lightGallery(document.getElementById('lightgallery'), {
        plugins: [lgVideo]
    });
</script>