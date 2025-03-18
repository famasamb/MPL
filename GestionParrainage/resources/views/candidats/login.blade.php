<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Candidat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 2rem;
            font-weight: bold;
            color: #00853e;
            text-align: center;
            margin-bottom: 20px;
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
        .alert {
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Connexion Candidat</h1>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('candidats.login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email" class="form-label">Email :</label>
                <input type="email" class="form-control" name="email" required placeholder="Entrez votre email">
            </div>

            <div class="form-group">
                <label for="code_auth" class="form-label">Code d’authentification :</label>
                <input type="text" class="form-control" name="code_auth" required placeholder="Entrez votre code">
            </div>

            <button type="submit" class="btn btn-primary">Se Connecter</button>
        </form>
    </div>
</body>
</html>
