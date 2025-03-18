@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Arial', sans-serif;
    }
    .dashboard-container {
        max-width: 800px;
        margin: 50px auto;
        padding: 30px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        position: relative;
    }
    .header-title {
        font-size: 1.8rem;
        font-weight: bold;
        color: #00853e;
        text-align: center;
        margin-bottom: 20px;
    }
    .info-box {
        background: #f1f1f1;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 15px;
        font-size: 1.1rem;
    }
    .info-box strong {
        color: #333;
    }
    .table {
        margin-top: 20px;
        font-size: 0.9rem;
    }
    .table th {
        background-color: #00853e;
        color: white;
        text-align: center;
    }
    .btn-logout {
        background-color: #d9534f;
        border: none;
        padding: 8px 16px;
        font-size: 0.9rem;
        border-radius: 8px;
        transition: background-color 0.3s ease;
        color: white;
        position: absolute;
        top: 10px;
        right: 10px;
    }
    .btn-logout:hover {
        background-color: #c9302c;
    }
</style>

<div class="container">
    <div class="dashboard-container">
        <form action="{{ route('candidats.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">Déconnexion</button>
        </form>

        <!-- Nouveau Titre -->
        <h1 class="header-title">Tableau de Bord - Candidat</h1>

        <div class="info-box">
            <p><strong>Email :</strong> {{ $candidat->email }}</p>
            <p><strong>Parti Politique :</strong> {{ $candidat->parti_politique ?? 'Non renseigné' }}</p>
            <p><strong>Slogan :</strong> {{ $candidat->slogan ?? 'Non renseigné' }}</p>
        </div>

        <h3>Évolution des Parrainages</h3>
        <div class="info-box">
            <p><strong>Total des parrainages :</strong> {{ $parrainages->count() }}</p>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom de l’Électeur</th>
                    <th>Date du Parrainage</th>
                </tr>
            </thead>
            <tbody>
                @foreach($parrainages as $parrainage)
                    <tr>
                        <td>{{ $parrainage->electeur->nom }} {{ $parrainage->electeur->prenom }}</td>
                        <td>{{ $parrainage->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
