<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reçu de réservation</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #222;
        }
        .container {
            padding: 20px;
        }
    
        .header-section {
            text-align: center;
            margin-bottom: 30px;
        }
        .pdf-logo {
            height: 150px; 
            width: auto;
            margin-bottom: 10px;
        }
        h1 {
            margin: 0;
            color: #0f172a;
            font-size: 24px;
        }
        .box {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
        }
        p {
            margin: 8px 0;
        }
        .label {
            font-weight: bold;
        }
        .footer-note {
            text-align: center;
            margin-top: 30px;
            font-style: italic;
            color: #64748b;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="header-section">
            <img src="{{ public_path('image/logo2.png') }}" alt="Logo" class="pdf-logo">
            <h1>Reçu de réservation</h1>
        </div>

        <div class="box">
            <p><span class="label">Référence :</span> {{ $reservation->id_reservation }}</p>
            <p><span class="label">Client :</span> {{ $reservation->user->name }}</p>
            <p><span class="label">Terrain :</span> {{ $reservation->terrain->nom_terrain }}</p>
            <p><span class="label">Date réservation :</span> {{ $reservation->date_reservation }}</p>
            <p><span class="label">Date horaire :</span> {{ $reservation->horaire->date_horaire }}</p>
            <p><span class="label">Heure :</span> {{ $reservation->horaire->heure_debut }} - {{ $reservation->horaire->heure_fin }}</p>
            <p><span class="label">Montant :</span> {{ $reservation->montant_total }} DH</p>
            <p><span class="label">Statut :</span> {{ $reservation->statut }}</p>
        </div>
        
        <p class="footer-note">Merci de nous avoir choisi. Bon match!</p>
    </div>
</body>
</html>