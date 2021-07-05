{!! Form::open(['method' => 'post', 'route' => 'post-comment', 'id' => 'post_commentary']) !!}
    <div class="form-group">
        {!! Form::label('commentary', 'Votre commentaire :', ['class' =>''])!!}
        {!! Form::textarea('commentary', ($current->teamgames->isNotEmpty()) ? $current->teamgames->commentary : null, ['class' => 'form-control bg-clearer text-white', 'placeholder' => 'Cette game était...'])!!}
        {!! Form::hidden('gameid', $gameid) !!}
        {!! Form::hidden('userid', $current->id) !!}
    </div>
    {!! Form::submit('Valider') !!}
{!! Form::close() !!}

<script>
    $("#post_commentary").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function()
            {
                alert("Commentaire envoyé avec succès")            ;
            }
        });
});
</script>