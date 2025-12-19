<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prescriptions des patients</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="admin/images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container-fluid {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .inline-h6 {
            margin-right: 20px;
        }
    </style>
</head>
<body>
    @include('template')
    
    <div class="content-body">
        <div class="container-fluid">
            <!-- VÉRIFIEZ D'ABORD SI $Consultation EXISTE ET N'EST PAS VIDE -->
            @if(isset($Consultation) && count($Consultation) > 0)
                <form action="/enregistrer-ordonnance" method="POST">
                    @csrf
                    <div class="form-group">
                        <!-- UTILISEZ L'OPÉRATEUR NULL COALESCENT (??) POUR ÉVITER LES ERREURS -->
                        <h6 class="inline-h6"><span style="color: #1977cc;">Nom:</span> {{ $Consultation[0]->Nom ?? 'Non spécifié' }}</h6>
                        <h6 class="inline-h6"><span style="color: #1977cc;">Prénom:</span> {{ $Consultation[0]->Prénom ?? 'Non spécifié' }}</h6>
                        <h6 class="inline-h6"><span style="color: #1977cc;">Date_de_naissance:</span> {{ $Consultation[0]->Date_de_naissance ?? 'Non spécifié' }}</h6>
                        <h6 class="inline-h6"><span style="color: #1977cc;">Numéro_de_téléphone:</span> {{ $Consultation[0]->Numéro_de_téléphone ?? 'Non spécifié' }}</h6>
                        <h6 class="inline-h6"><span style="color:#1977cc;">Date_et_Heure:</span> {{ $Consultation[0]->Date_et_Heure ?? 'Non spécifié' }}</h6>

                        <br/>
                        <label for="description" class="inline-h6">Ordonnance:</label>
                        <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                        
                        <!-- VÉRIFIEZ AVANT D'UTILISER LES IDS -->
                        @if(isset($Consultation[0]->id) && isset($Consultation[0]->IdC))
                            <input type="hidden" name="id_Patient" value="{{ $Consultation[0]->id }}">
                            <input type="hidden" name="id_Consultation" value="{{ $Consultation[0]->IdC }}">
                        @else
                            <div class="alert alert-danger mt-3">
                                Erreur: Données manquantes pour créer l'ordonnance.
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            @else
                <!-- MESSAGE D'ERREUR SI AUCUNE DONNÉE -->
                <div class="alert alert-danger">
                    <h4>⚠️ Aucune consultation sélectionnée</h4>
                    <p>Veuillez d'abord sélectionner une consultation valide.</p>
                    <a href="/Consultations" class="btn btn-secondary">Retour aux consultations</a>
                </div>
            @endif
        </div>
    </div>
    
    <div class="footer">
        <div class="copyright">
            <p>Copyright © Conçu &amp; Développé par <a href="http://meta-pixel.tn/" target="_blank">META PIXEL</a></p>
        </div>
    </div>
    
    <script src="{{asset('admin/vendor/global/global.min.js')}}"></script>
    <script src="{{asset('admin/js/quixnav-init.js')}}"></script>
    <script src="{{asset('admin/js/custom.min.js')}}"></script>
</body>
</html>