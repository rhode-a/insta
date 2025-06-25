{{-- resources/views/preinscription/formulaire.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Formulaire de Préinscription</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('preinscription.envoyer') }}" method="POST" class="row g-3">
        @csrf

        <div class="col-md-6">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" required>
        </div>

        <div class="col-md-6">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" name="prenom" class="form-control" value="{{ old('prenom') }}" required>
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">Adresse Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="col-md-6">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" name="telephone" class="form-control" value="{{ old('telephone') }}" required>
        </div>

        <div class="col-md-6">
            <label for="niveau" class="form-label">Niveau</label>
            <select name="niveau" class="form-select" required>
                <option value="">-- Sélectionner --</option>
                <option value="1ère année" {{ old('niveau') == '1ère année' ? 'selected' : '' }}>1ère année</option>
                <option value="2ème année" {{ old('niveau') == '2ème année' ? 'selected' : '' }}>2ème année</option>
                <option value="3ème année" {{ old('niveau') == '3ème année' ? 'selected' : '' }}>3ème année</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="option" class="form-label">Option</label>
            <select name="option" class="form-select" required>
                <option value="">-- Sélectionner --</option>
                <option value="Génie logiciel" {{ old('option') == 'Génie logiciel' ? 'selected' : '' }}>Génie logiciel</option>
                <option value="Réseaux" {{ old('option') == 'Réseaux' ? 'selected' : '' }}>Réseaux</option>
                <option value="Finance" {{ old('option') == 'Finance' ? 'selected' : '' }}>Finance</option>
            </select>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary w-100">Envoyer la demande</button>
        </div>
    </form>
</div>
@endsection
