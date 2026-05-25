<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation de réservation</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f4f6f9; padding:20px;">

    <div style="max-width:600px; margin:auto; background:white; padding:30px; border-radius:12px;">
        <h2 style="color:#1e3a8a;">Réservation confirmée</h2>

        <p>Bonjour <strong>{{ $reservation->user->name }}</strong>,</p>

        <p>Votre réservation a été <strong>confirmée</strong> par l’administrateur.</p>

        <hr>

        <p><strong>Terrain :</strong> {{ $reservation->terrain->nom_terrain }}</p>
        <p><strong>Date réservation :</strong> {{ $reservation->date_reservation }}</p>
        <p><strong>Date horaire :</strong> {{ $reservation->horaire->date_horaire }}</p>
        <p><strong>Heure :</strong> {{ $reservation->horaire->heure_debut }} - {{ $reservation->horaire->heure_fin }}</p>
        <p><strong>Montant :</strong> {{ $reservation->montant_total }} DH</p>
        <p><strong>Statut :</strong> Réservée / Confirmée</p>

        <hr>

        <p style="color:#666;">Merci d'utiliser ReservationTonTerrain</p>
    </div>

</body>
</html>