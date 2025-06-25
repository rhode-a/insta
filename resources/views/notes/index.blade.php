{{-- resources/views/notes/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Liste des Notes</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(Auth::user()->role === 'admin')
        <a href="{{ route('notes.create') }}" class="btn btn-primary mb-3">Ajouter une Note</a>
    @endif

    @if($notes->count() > 0)
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Étudiant</th>
                    <th>Matière</th>
                    <th>Note</th>
                    <th>Coefficient</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($notes as $note)
                <tr>
                    <td>{{ $note->etudiant->prenom ?? 'N/A' }}  {{ $note->etudiant->nom ?? 'N/A' }}</td>
                    <td>{{ $note->matiere->nom ?? 'N/A' }}</td>
                    <td>{{ $note->valeur }}</td>
                    <td>{{ $note->coefficient }}</td>
                    <td>
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('notes.edit', $note) }}" class="btn btn-sm btn-warning">Modifier</a>
                            <form action="{{ route('notes.destroy', $note) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette note ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Supprimer</button>
                            </form>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $notes->links() }}
    @else
        <p>Aucune note trouvée.</p>
    @endif
</div>
@endsection
