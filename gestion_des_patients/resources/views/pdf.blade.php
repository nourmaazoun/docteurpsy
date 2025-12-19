<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ordonnance Médicale</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f6fd;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 15px;
        }
        .header h1 {
            color: #007bff;
            margin: 0;
        }
        .patient-info, .doctor-info, .ordonnance-description, .signature {
            margin-bottom: 25px;
        }
        .patient-info p, .doctor-info p {
            color: #333;
            margin: 8px 0;
            font-size: 14px;
        }
        .doctor-name {
            font-weight: bold;
            color: #007bff;
        }
        .ordonnance-description p {
            line-height: 1.6;
            color: #555;
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #007bff;
        }
        .signature p {
            text-align: right;
            margin-top: 60px;
            color: #333;
            font-size: 14px;
        }
        .date-info {
            margin-top: 20px;
            font-size: 13px;
            color: #666;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Ordonnance Médicale</h1>
        </div>

        <!-- CHANGEZ $data[0]->Nom EN $data->Nom -->
        <div class="patient-info">
            <p><strong>Nom du Patient:</strong> {{ $data->Nom ?? '' }}</p>
            <p><strong>Prénom du Patient:</strong> {{ $data->Prénom ?? '' }}</p>
            <p><strong>Date de consultation:</strong> {{ $data->Date_et_Heure ?? date('d/m/Y') }}</p>
        </div>

        <div class="doctor-info">
            
            <p><strong>Date de l'ordonnance:</strong> {{ date('d/m/Y') }}</p>
        </div>

        <div class="ordonnance-description">
            <p><strong>Description de l'Ordonnance:</strong><br>
            {{ $data->Description ?? 'Aucune description disponible' }}</p>
        </div>

        <div class="signature">
            <p>Signature du Docteur: __________________________</p>
            <p>Date: {{ date('d/m/Y') }}</p>
        </div>

        <div class="date-info">
            <p>Ordonnance générée le {{ date('d/m/Y à H:i') }}</p>
        </div>
    </div>
</body>
</html>