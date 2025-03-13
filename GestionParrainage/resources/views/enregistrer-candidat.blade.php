<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement des Candidats</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .header {
            background: linear-gradient(to right, #00853e, #ffd700);
            color: white;
            padding: 60px 0;
            text-align: center;
        }
        .header h1 {
            font-size: 3rem;
            font-weight: bold;
            animation: fadeIn 2s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            margin-top: -50px;
        }
        .form-label {
            font-weight: bold;
            color: #00853e;
        }
        .form-control {
            border-radius: 10px;
            border: 1px solid #ddd;
            padding: 10px;
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
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #006b32;
        }
        .footer {
            background-color: #00853e;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <!-- En-tête -->
    <div class="header">
        <h1>Enregistrement des Candidats</h1>
    </div>

    <!-- Contenu principal -->
    <div class="container">
        <form action="{{ route('candidats.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="numero_electeur" class="form-label"><i class="fas fa-id-card"></i> Numéro d'électeur :</label>
                <input type="text" class="form-control" name="numero_electeur" required>
                <small class="form-text text-muted">Veuillez entrer le numéro d'électeur du candidat.</small>
            </div>
            <div class="mb-4">
                <label for="nom" class="form-label"><i class="fas fa-user"></i> Nom :</label>
                <input type="text" class="form-control" name="nom" required>
                <small class="form-text text-muted">Veuillez entrer le nom du candidat.</small>
            </div>
            <div class="mb-4">
                <label for="prenom" class="form-label"><i class="fas fa-user"></i> Prénom :</label>
                <input type="text" class="form-control" name="prenom" required>
                <small class="form-text text-muted">Veuillez entrer le prénom du candidat.</small>
            </div>
            <div class="mb-4">
                <label for="date_naissance" class="form-label"><i class="fas fa-calendar-alt"></i> Date de naissance :</label>
                <input type="date" class="form-control" name="date_naissance" required>
                <small class="form-text text-muted">Veuillez entrer la date de naissance du candidat.</small>
            </div>
            <div class="mb-4">
                <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email :</label>
                <input type="email" class="form-control" name="email" required>
                <small class="form-text text-muted">Veuillez entrer l'adresse email du candidat.</small>
            </div>
            <div class="mb-4">
                <label for="telephone" class="form-label"><i class="fas fa-phone"></i> Téléphone :</label>
                <input type="text" class="form-control" name="telephone" required>
                <small class="form-text text-muted">Veuillez entrer le numéro de téléphone du candidat.</small>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button>
        </form>
    </div>

    <!-- Pied de page -->
    <div class="footer">
        <p>&copy; 2025 Plateforme de Gestion des Parrainages - Tous droits réservés</p>
    </div>
</body>
</html>
