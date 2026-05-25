<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bilan Dashboard</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #1e293b;
            font-size: 14px;
        }


        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 15px;
        }

        .header-table td {
            border: none;
            padding: 0;
            vertical-align: middle;
        }

        .pdf-logo {
            height: 100px; 
            width: auto;
        }

        .header-title h1 {
            color: #2563eb;
            margin: 0 0 5px 0;
            font-size: 24px;
        }

        .header-title p {
            margin: 0;
            color: #64748b;
            font-size: 14px;
        }

        .date {
            text-align: right;
            margin-bottom: 20px;
            color: #64748b;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table.data-table th {
            background: #2563eb;
            color: white;
            padding: 10px;
            text-align: left;
            border: 1px solid #2563eb;
        }

        table.data-table td {
            border: 1px solid #cbd5e1;
            padding: 10px;
        }

        .total {
            background: #dcfce7;
            font-weight: bold;
            color: #166534;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            color: #64748b;
            font-size: 12px;
        }
    </style>
</head>
<body>

<table class="header-table">
    <tr>
        <td style="width: 70px;">
            <img src="{{ public_path('image/logo2.png') }}" alt="Logo" class="pdf-logo">
        </td>
        <td class="header-title" style="padding-left: 15px;">
            <h1>Bilan Administrateur</h1>
            <p>Application de réservation de terrains sportifs</p>
        </td>
    </tr>
</table>

<div class="date">
    <p>Période du {{ \Carbon\Carbon::parse($dateDebut)->format('d/m/Y') }}
    au {{ \Carbon\Carbon::parse($dateFin)->format('d/m/Y') }}</p>
    Date : {{ now()->format('d/m/Y H:i') }}
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>Indicateur</th>
            <th>Valeur</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>Nombre de terrains</td>
            <td>{{ $terrains }}</td>
        </tr>

        <tr>
            <td>Nombre d'horaires</td>
            <td>{{ $horaires }}</td>
        </tr>

        <tr>
            <td>Nombre de réservations</td>
            <td>{{ $reservations }}</td>
        </tr>

        <tr>
            <td>Réservations confirmées</td>
            <td>{{ $confirmees }}</td>
        </tr>

        <tr>
            <td>Réservations en attente</td>
            <td>{{ $en_attente }}</td>
        </tr>

        <tr>
            <td>Réservations annulées</td>
            <td>{{ $annulees }}</td>
        </tr>

        <tr>
            <td>Nombre d'utilisateurs</td>
            <td>{{ $utilisateurs }}</td>
        </tr>

        <tr class="total">
            <td>Total revenus</td>
            <td>{{ number_format($totalRevenus, 2) }} DH</td>
        </tr>
    </tbody>
</table>

<div class="footer">
    Rapport généré automatiquement par le système.
</div>

</body>
</html>