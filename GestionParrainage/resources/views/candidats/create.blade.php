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
            padding: 40px 0;
            text-align: center;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            margin-top: -30px;
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
        <p>Formulaire réservé à la Direction Générale des Élections (DGE)</p>
    </div>

    <!-- Contenu principal -->
    <div class="container">
        <form action="{{ route('candidats.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="numero_electeur" class="form-label"><i class="fas fa-id-card"></i> Numéro d'électeur :</label>
                <input type="text" class="form-control" name="numero_electeur" required>
            </div>

            <div class="mb-4">
                <label for="nom" class="form-label"><i class="fas fa-user"></i> Nom :</label>
                <input type="text" class="form-control" name="nom" required>
            </div>

            <div class="mb-4">
                <label for="prenom" class="form-label"><i class="fas fa-user"></i> Prénom :</label>
                <input type="text" class="form-control" name="prenom" required>
            </div>

            <div class="mb-4">
                <label for="date_naissance" class="form-label"><i class="fas fa-calendar-alt"></i> Date de naissance :</label>
                <input type="date" class="form-control" name="date_naissance" required>
            </div>

            <div class="mb-4">
                <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email :</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="mb-4">
                <label for="telephone" class="form-label"><i class="fas fa-phone"></i> Téléphone :</label>
                <input type="text" class="form-control" name="telephone" required>
            </div>

            <div class="mb-4">
                <label for="parti_politique" class="form-label"><i class="fas fa-flag"></i> Parti Politique :</label>
                <input type="text" class="form-control" name="parti_politique">
            </div>

            <div class="mb-4">
                <label for="slogan" class="form-label"><i class="fas fa-quote-left"></i> Slogan :</label>
                <input type="text" class="form-control" name="slogan">
            </div>

            <div class="mb-4">
                <label for="photo" class="form-label"><i class="fas fa-camera"></i> Photo du candidat :</label>
                <input type="file" class="form-control" name="photo" accept="image/*">
            </div>

            <div class="mb-4">
                <label for="couleurs_parti" class="form-label"><i class="fas fa-palette"></i> Couleurs du Parti :</label>
                <input type="text" class="form-control" name="couleurs_parti">
            </div>

            <div class="mb-4">
                <label for="url_page" class="form-label"><i class="fas fa-link"></i> URL de la Page Officielle :</label>
                <input type="url" class="form-control" name="url_page">
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
