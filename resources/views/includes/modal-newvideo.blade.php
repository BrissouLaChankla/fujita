<div class="modal fade" id="addVideoModal" tabindex="-1" role="dialog" aria-labelledby="addVideoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content bg-clear rounded">
        <div class="modal-header">
          <h5 class="modal-title text-light" id="addVideoModalLabel">Ajouter les moments forts du match</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="text-white" aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form  method="POST" enctype="multipart/form-data" action="{{route('videoUpload')}}"  id="video-upload" class='dropzone dz-clickable bg-clearer text-light'>
                @csrf
                    <div class="dz-message needsclick">
                        <button type="button" class="dz-button">Glissez ici votre vidéo du match!</button><br>
                        <span class="note needsclick">(1 ou plusieurs en .mp4 ou .avi !)</span>
                    </div>
              </form> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Lets go !</button>
        </div>
      </div>
    </div>
  </div>