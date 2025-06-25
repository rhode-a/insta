@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Modifier l'Option</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('options.update', $option->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom de l'option</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ $option->nom }}" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('options.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
