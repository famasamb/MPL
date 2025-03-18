@if(isset($candidats) && count($candidats) > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Parti Politique</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($candidats as $candidat)
                <tr>
                    <td>{{ $candidat->nom }}</td>
                    <td>{{ $candidat->prenom }}</td>
                    <td>{{ $candidat->parti_politique }}</td>
                    <td>
                        <a href="{{ route('candidats.show', $candidat->id) }}" class="btn btn-info">Détails</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>Aucun candidat enregistré.</p>
@endif
