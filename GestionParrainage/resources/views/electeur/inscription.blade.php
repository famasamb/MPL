<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Électeur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #00853e;
            text-align: center;
            margin-bottom: 30px;
        }
        .form-label {
            font-weight: bold;
            color: #555;
        }
        .form-control {
            border-radius: 8px;
            padding: 10px;
            border: 1px solid #ddd;
            transition: border-color 0.3s ease;
        }
        .form-control:focus {
            border-color: #00853e;
            box-shadow: 0 0 5px rgba(0, 133, 62, 0.5);
        }
        .btn-primary {
            background-color: #00853e;
            border: none;
            padding: 12px 24px;
            font-size: 1.1rem;
            border-radius: 8px;
            transition: background-color 0.3s ease;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #006b32;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
        }
        .form-group input {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Inscription Électeur</h1>
        <form action="{{ route('electeur.inscription') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="numero_carte_identite" class="form-label">Numéro de carte d'identité :</label>
                <input type="text" name="numero_carte_identite" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="numero_electeur" class="form-label">Numéro d'électeur :</label>
                <input type="text" name="numero_electeur" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="prenom" class="form-label">Prénom :</label>
                <input type="text" name="prenom" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nom" class="form-label">Nom :</label>
                <input type="text" name="nom" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="date_naissance" class="form-label">Date de naissance :</label>
                <input type="date" name="date_naissance" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="lieu_naissance" class="form-label">Lieu de naissance :</label>
                <input type="text" name="lieu_naissance" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="sexe" class="form-label">Sexe :</label>
                <select name="sexe" class="form-control" required>
                    <option value="M">Masculin</option>
                    <option value="F">Féminin</option>
                </select>
            </div>
            <div class="form-group">
                <label for="bureau_vote" class="form-label">Bureau de vote :</label>
                <input type="text" name="bureau_vote" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="telephone" class="form-label">Téléphone :</label>
                <input type="text" name="telephone" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email :</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">S'inscrire</button>
        </form>
    </div>
</body>
</html>
