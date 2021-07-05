<form  method="POST" enctype="multipart/form-data" action="{{route('videoUpload')}}"  id="video-upload" class='dropzone dz-clickable bg-clearer text-light'>
  @csrf
      <div class="dz-message needsclick">
          <button type="button" class="dz-button">Glissez ici votre vidéo du match!</button><br>
          <span class="note needsclick">(1 ou plusieurs en .mp4 ou .avi !)</span>
      </div>
      <input type="hidden" name="gameId" id="gameIdtosend" value="{{$gameid}}">
</form> 

<script>
                            //  Dropzone.forElement("#video-upload").removeAllFiles(true);
                            Dropzone.autoDiscover = false;
                            $("#video-upload").dropzone({ url: "/game/videoupload" });
</script>