<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme de Gestion des Parrainages - Sénégal</title>
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
        .dashboard {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            margin-top: 40px;
        }
        .dashboard h2 {
            font-size: 2.2rem;
            font-weight: bold;
            color: #00853e;
            margin-bottom: 30px;
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
        <h1>Plateforme de Gestion des Parrainages</h1>
        <p>Pour des élections transparentes et démocratiques au Sénégal</p>
    </div>

    <!-- Contenu principal -->
    <div class="container mt-5">
        <!-- Section des Fonctionnalités -->
        <div class="row">
            <div class="col-12">
                <h2 class="section-title"> Interface BackOFFICE destinée au personnel de la DGE</h2>
            </div>
            <!-- Carte pour l'importation des électeurs -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-users"></i> Importer les Électeurs</h5>
                        <p class="card-text">Importez la liste des électeurs pour commencer le processus de parrainage.</p>
                        <a href="{{ route('electeurs.import') }}" class="btn btn-primary">Commencer</a>
                    </div>
                </div>
            </div>

            <!-- Carte pour l'enregistrement des candidats -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-user-tie"></i> Enregistrer un Candidat</h5>
                        <p class="card-text">Enregistrez les candidats pour les élections présidentielles.</p>
                        <a href="{{ route('candidats.create') }}" class="btn btn-primary">Commencer</a>
                    </div>
                </div>
            </div>

            <!-- Carte pour la création de compte parrain -->
            <!-- <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-user-plus"></i> Créer un Compte Parrain</h5>
                        <p class="card-text">Permettez aux électeurs de créer un compte pour parrainer un candidat.</p>
                        <a href="{{ route('parrains.create') }}" class="btn btn-primary">Commencer</a>
                    </div>
                </div>
            </div> -->

            <!-- Carte pour l'enregistrement des parrainages -->
            <!-- <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-handshake"></i> Enregistrer un Parrainage</h5>
                        <p class="card-text">Enregistrez les parrainages des électeurs pour les candidats.</p>
                        <a href="{{ route('parrainages.create') }}" class="btn btn-primary">Commencer</a>
                    </div>
                </div>
            </div> -->

            <!-- Carte pour définir la période de parrainage -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-calendar-alt"></i> Définir la Période de Parrainage</h5>
                        <p class="card-text">Définissez les dates de début et de fin des parrainages.</p>
                        <a href="{{ route('periodes.create') }}" class="btn btn-primary">Commencer</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau de Bord -->
        <div class="dashboard">
            <h2><i class="fas fa-chart-line"></i> Tableau de Bord</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Statistiques des Parrainages</h5>
                            <p class="card-text">Visualisez les statistiques des parrainages en temps réel.</p>
                            <a href="{{ route('parrainages.statistiques') }}" class="btn btn-primary">Voir les Statistiques</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Évolution des Candidats</h5>
                            <p class="card-text">Suivez l'évolution des candidats et leurs parrainages.</p>
                            <a href="{{ route('candidats.evolution') }}" class="btn btn-primary">Voir l'Évolution</a>
                        </div>
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
