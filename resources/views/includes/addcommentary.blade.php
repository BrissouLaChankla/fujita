{!! Form::open(['method' => 'post', 'route' => 'post-comment', 'id' => 'post_commentary']) !!}
    <div class="form-group">
        {!! Form::label('commentary', 'Votre commentaire :', ['class' =>''])!!}
        {!! Form::textarea('commentary', (null !== $current->commentaire($gameid)) ? $current->commentaire($gameid)->commentary : null, ['class' => 'form-control bg-clearer text-white', 'id' => 'commentary_input', 'placeholder' => 'Cette game était...'])!!}
        {!! Form::hidden('gameid', $gameid) !!}
        {!! Form::hidden('userid', $current->id) !!}
    </div>
{!! Form::close() !!}

<script>
    $("#commentary_input").on('change paste keydown', _.debounce(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this).closest('form');
        var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                console.log("changement");
            }
        });
}, 500));

</script>