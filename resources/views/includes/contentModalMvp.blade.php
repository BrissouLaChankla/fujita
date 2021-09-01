<div class="row">
    <div class="col-md-6 d-flex flex-column">
        <ul>
            <li>1er au dégat</li>
            <li>1er au dégats des tourelles</li>
            <li>2em gars le moins mort</li>
        </ul>
        <div class="commentaires col rounded bg-clearer">
            <h3 class="mt-2">Les commentaires :</h3>
            <div class="d-flex flex-column">
                @foreach ($game->commentaires as $commentaire)
                    <div class="d-flex align-items-center mt-2">
                        <img style="width:40px; border-radius:5px"
                            src="{{ asset('mvp/' . strtolower($commentaire->user->name) . '.jpg') }}" alt="">
                        <h5 class="m-0 ml-2 text-primary text-nowrap">
                            <strong>
                                {{ $commentaire->user->name }} :
                            </strong>
                        </h5>
                        <h6 class="m-0 ml-2">
                            {!! $commentaire->commentary !!}
                        </h6>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <h3>Revivez les moments forts du match : </h3>
        <div id="lightgallery">
            @foreach ($game->videos as $video)
                <a class="pointer @if (!$loop->first) d-none @endif"
                    data-video='{"source": [{"src":"{{ asset('video/moments_forts/' . $video->name) }}",
                    "type":"video/mp4"}],
                    "attributes": {"preload": false, "controls": true}}'>
                    <img class="img-fluid" src="{{ asset('video/moments_forts/thumbnail.png') }}" />
                </a>
            @endforeach
        </div>
    </div>
</div>
</div>
<script>
    lightGallery(document.getElementById('lightgallery'), {
        plugins: [lgVideo]
    });
</script>
