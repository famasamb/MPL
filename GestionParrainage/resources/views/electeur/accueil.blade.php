<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme de Parrainage - Électeurs</title>
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
            padding: 100px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .header h1 {
            font-size: 4rem;
            font-weight: bold;
            animation: fadeIn 2s ease-in-out;
        }
        .header p {
            font-size: 1.5rem;
            margin-top: 20px;
            animation: fadeIn 3s ease-in-out;
        }
        .flag {
            width: 150px;
            height: auto;
            margin-bottom: 30px;
            animation: bounce 2s infinite;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #00853e;
            margin-bottom: 40px;
            text-align: center;
            animation: slideIn 1s ease-in-out;
        }
        @keyframes slideIn {
            from { transform: translateX(-100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: white;
            margin-bottom: 30px;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
        }
        .card-body {
            text-align: center;
            padding: 30px;
        }
        .card-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #00853e;
            margin-bottom: 15px;
        }
        .card-text {
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #00853e;
            border: none;
            padding: 12px 24px;
            font-size: 1.1rem;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #006b32;
        }
        .footer {
            background-color: #00853e;
            color: white;
            text-align: center;
            padding: 30px 0;
            margin-top: 60px;
        }
        .footer p {
            margin: 0;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
    <!-- En-tête -->
    <div class="header">
        <img src="https://upload.wikimedia.org/wikipedia/commons/f/fd/Flag_of_Senegal.svg" alt="Drapeau du Sénégal" class="flag">
        <h1>Plateforme de Parrainage - Électeurs</h1>
        <p>Pour des élections transparentes et démocratiques au Sénégal</p>
    </div>

    <!-- Contenu principal -->
    <div class="container mt-5">
        <!-- Section d'inscription -->
        <div class="row">
            <div class="col-12">
                <h2 class="section-title">Inscription</h2>
            </div>
            <div class="col-md-6 offset-md-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-user-plus"></i> Créer un Compte</h5>
                        <p class="card-text">Inscrivez-vous pour pouvoir parrainer un candidat.</p>
                        <a href="{{ route('electeur.inscription') }}" class="btn btn-primary">S'inscrire</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section de connexion -->
        <div class="row">
            <div class="col-12">
                <h2 class="section-title">Connexion</h2>
            </div>
            <div class="col-md-6 offset-md-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-sign-in-alt"></i> Se Connecter</h5>
                        <p class="card-text">Connectez-vous pour accéder à la page de parrainage.</p>
                        <a href="{{ route('electeur.connexion') }}" class="btn btn-primary">Se Connecter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pied de page -->
    <div class="footer">
        <p>&copy; 2025 Plateforme de Gestion des Parrainages - Tous droits réservés</p>
    </div>
</body>
</html>
