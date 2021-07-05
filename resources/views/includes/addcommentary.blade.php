{!! Form::open(['method' => 'post', 'route' => 'post-comment', 'id' => 'post_commentary']) !!}
    <div class="row">
        text
        {{-- <div class="col-md-6">
            <h5 class="text-primary">Prénom</h5>
            {!! Form::text('commentary', $member->surname, ['class' => ' form-control', 'required' => 'required']) !!}
        </div>
        <div class="col-md-6">
            <h5 class="text-primary">Nom</h5>
            {!! Form::text('name', $member->name, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="col-md-6">
            <h5 class="text-primary mt-3">Titre</h5>
            {!! Form::text('titre', $member->titre, ['class' => 'form-control']) !!}
        </div>
        <div class="col-md-6">
            <h5 class="text-primary mt-3">E-mail</h5>
            {!! Form::email('mail', $member->mail, ['class' => ' form-control']) !!}
        </div>
        <div class="col-12">
            <h5 class="text-primary mt-3">Description</h5>
            {!! Form::textarea('description', $member->description, ['class' => ' form-control withEditor']) !!}
        </div>
        <div class="col-12">
            <h5 class="text-primary mt-3">Role</h5>
            {!! Form::text('role', $member->role, ['class' => 'form-control']) !!}
            
        </div> --}}
    </div>
    


{!! Form::close() !!}