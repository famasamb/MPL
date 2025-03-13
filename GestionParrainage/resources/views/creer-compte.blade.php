<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Créer un compte</h1>
        <form action="{{ route('parrains.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="numero_electeur" class="form-label">Numéro d'électeur :</label>
                <input type="text" class="form-control" name="numero_electeur" required>
            </div>
            <div class="mb-3">
                <label for="cin" class="form-label">Numéro de CIN :</label>
                <input type="text" class="form-control" name="cin" required>
            </div>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom :</label>
                <input type="text" class="form-control" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="bureau_vote" class="form-label">Bureau de vote :</label>
                <input type="text" class="form-control" name="bureau_vote" required>
            </div>
            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone :</label>
                <input type="text" class="form-control" name="telephone" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Créer un compte</button>
        </form>
    </div>
</body>
</html>
