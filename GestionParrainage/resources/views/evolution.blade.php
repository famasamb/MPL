<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Évolution des Candidats</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Évolution des Candidats</h1>
        <canvas id="evolutionChart" width="400" height="200"></canvas>
    </div>

    <script>
        // Données pour le graphique
        const labels = @json($labels);
        const data = @json($data);

        // Créer le graphique
        const ctx = document.getElementById('evolutionChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line', // Graphique en ligne
            data: {
                labels: labels,
                datasets: [{
                    label: 'Nombre de Parrainages',
                    data: data,
                    backgroundColor: 'rgba(0, 133, 62, 0.2)',
                    borderColor: 'rgba(0, 133, 62, 1)',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
