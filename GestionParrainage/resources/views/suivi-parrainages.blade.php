<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi des parrainages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Parrainages pour {{ $candidat->nom }}</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de parrainage</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($parrainages as $parrainage)
                    <tr>
                        <td>{{ $parrainage->electeur->nom }}</td>
                        <td>{{ $parrainage->electeur->prenom }}</td>
                        <td>{{ $parrainage->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
