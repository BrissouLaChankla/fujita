<div class="row">
    <div class="col-md-6">
        Adrien est :
        <ul>
            <li>1er au dégat</li>
            <li>1er au dégats des tourelles</li>
            <li>2em gars le moins mort</li>
        </ul>
    </div>
    <div class="col-md-6">
        <h3>Revivez les moments forts du match : </h3>
        @foreach ($game->videos as $video)
            <video class="video-js">
                <source src="{{asset("video/moments_forts/".$video->name)}}" type="video/mp4" />
            </video>
        @endforeach
    </div>
</div>