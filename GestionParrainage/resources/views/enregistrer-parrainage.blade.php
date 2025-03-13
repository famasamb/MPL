<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement d'un Parrainage</title>
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
        <h1>Enregistrement d'un Parrainage</h1>
    </div>

    <!-- Contenu principal -->
    <div class="container">
        <form action="{{ route('parrainages.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="numero_electeur" class="form-label"><i class="fas fa-id-card"></i> Numéro d'électeur :</label>
                <input type="text" class="form-control" name="numero_electeur" required>
                <small class="form-text text-muted">Veuillez entrer votre numéro d'électeur.</small>
            </div>
            <div class="mb-4">
                <label for="cin" class="form-label"><i class="fas fa-address-card"></i> Numéro de CIN :</label>
                <input type="text" class="form-control" name="cin" required>
                <small class="form-text text-muted">Veuillez entrer votre numéro de carte d'identité nationale.</small>
            </div>
            <div class="mb-4">
                <label for="code_authentification" class="form-label"><i class="fas fa-shield-alt"></i> Code d'authentification :</label>
                <input type="text" class="form-control" name="code_authentification" required>
                <small class="form-text text-muted">Veuillez entrer le code d'authentification reçu par SMS ou email.</small>
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
