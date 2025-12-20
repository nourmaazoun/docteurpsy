<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Table-datatable-basic</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="admin/images/favicon.png">
    <!-- Datatable -->
    <link href="admin/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- Custom Stylesheet -->
    <link href="admin/css/style.css" rel="stylesheet">

</head>

<body>
    @include('template')


        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Salut {{Auth::user()->name}} bienvenue!</h4>
                            <span class="ml-1">Table de données</span>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Tableau</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Table de données</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tableau de données de base</h4>
                            </div>
                            <div class="card-body">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                        Ajouter
                                  </button>
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Prénom</th>
                                                <th>Age</th>
                                                <th>Sexe</th>
                                                <th>Date_de_naissance</th>
                                                <th>Adresse</th>
                                                <th>Numéro_de_téléphone</th>
                                                <th>E_mail</th>
                                                <th>Statut</th>
                                                <th>Remarques</th>
                                                <th>Action</th>



                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ( $Patient as $p )
                                            <tr>
                                                <td>{{$p->Nom}}</td>
                                                <td>{{$p->Prénom}}</td>
                                                <td>{{$p->Age}}</td>
                                                <td>{{$p->Sexe}}</td>
                                                <td>{{$p->Date_de_naissance}}</td>
                                                <td>{{$p->Adresse}}</td>
                                                <td>{{$p->Numéro_de_téléphone}}</td>
                                                <td>{{$p->E_mail}}</td>
                                                <td>{{$p->Statut}}</td>
                                                <td>{{$p->Remarques}}</td>

<td>
    <!-- Bouton Éditer -->
<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editPatient{{$p->id}}">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
        <!-- ... icône édition ... -->
    </svg>
    Éditer
</button>
    <!-- Lien de Suppression (GET) -->
  <a href="/patient/delete/{{$p->id}}" 
   class="btn btn-danger btn-sm" 
   onclick="return confirm('Voulez-vous vraiment supprimer ce patient ?')">
    Supprimer
</a>
</td>
                                            </tr>
                                            @endforeach


                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Prénom</th>
                                                <th>Age</th>
                                                <th>Sexe</th>
                                                <th>Date_de_naissance</th>
                                                <th>Adresse</th>
                                                <th>Numéro_de_téléphone</th>
                                                <th>E_mail</th>
                                                <th>Statut</th>
                                                <th>Remarques</th>
                                                <th>Action</th>

                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Conçu &amp; Développé par <a href="http://meta-pixel.tn/" target="_blank">META PIXEL</a></p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


  <!-- Modal ajout-->
  <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Ajouter un patient</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/addpatient" method="post">
                @csrf
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" required>
                </div>
                <div class="mb-3">
                    <label for="age" class="form-label">Age</label>
                    <input type="text" class="form-control" id="age" name="age" required>
                </div>
                <div class="mb-3">
                    <label for="sexe" class="form-label">Sexe</label>
                    <select class="form-control" id="sexe" name="sexe" required>
                        <option value="M">Masculin</option>
                        <option value="F">Féminin</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="date_naissance" class="form-label">Date_de_naissance</label>
                    <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>
                </div>
                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="adresse" name="adresse" required>
                </div>
                <div class="mb-3">
                    <label for="telephone" class="form-label">Numéro_de_téléphone</label>
                    <input type="tel" class="form-control" id="telephone" name="telephone" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="statut" class="form-label">Statut</label>
                    <select class="form-control" id="statut" name="statut" required>
                        <option value="actif">Actif</option>
                        <option value="inactif">Inactif</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="remarques" class="form-label">Remarques</label>
                    <textarea class="form-control" id="remarques" name="remarques"></textarea>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
        </div>
      </div>
    </div>
  </div>



<!--modal modifier-->
@foreach ( $Patient as $p )
  <!-- Modal d'édition pour le patient -->
  <div class="modal fade" id="editPatient{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="editPatientTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editPatientTitle">Édition de {{$p->Nom}} {{$p->Prénom}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="/editpatient/{{$p->id}}" method="post">
            @csrf
            <!-- Champ pour le nom -->
            <div class="mb-3">
              <label for="nom" class="form-label">Nom</label>
              <input type="text" class="form-control" id="nom" name="nom" value="{{$p->Nom}}" required>
            </div>
            <!-- Autres champs (prénom, âge, etc.) -->
            <div class="mb-3">
              <label for="prenom" class="form-label">Prénom</label>
              <input type="text" class="form-control" id="prenom" name="prenom" value="{{$p->Prénom}}" required>
            </div>
           <!-- Champ pour l'âge -->
            <div class="mb-3">
            <label for="age" class="form-label">Âge</label>
            <input type="text" class="form-control" id="age" name="age" value="{{$p->Age}}" required>
            </div>

            <!-- Champ pour le sexe -->
            <div class="mb-3">
            <label for="sexe" class="form-label">Sexe</label>
            <select class="form-control" id="sexe" name="sexe" required>
            <option value="M" @if($p->Sexe == 'M') selected @endif>Masculin</option>
            <option value="F" @if($p->Sexe == 'F') selected @endif>Féminin</option>
             </select>
            </div>






             <!-- Champ pour la date de naissance -->
            <div class="mb-3">
             <label for="date_naissance" class="form-label">Date de naissance</label>
            <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="{{$p->Date_de_naissance}}" required>
            </div>

            <!-- Champ pour l'adresse -->
            <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
             <input type="text" class="form-control" id="adresse" name="adresse" value="{{$p->Adresse}}" required>
             </div>

            <!-- Champ pour le numéro de téléphone -->
            <div class="mb-3">
             <label for="telephone" class="form-label">Numéro de téléphone</label>
             <input type="tel" class="form-control" id="telephone" name="telephone" value="{{$p->Numéro_de_téléphone}}" required>
            </div>

            <!-- Champ pour l'e-mail -->
            <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
             <input type="email" class="form-control" id="email" name="email" value="{{$p->E_mail}}" required>
            </div>




             <!-- Champ pour le statut-->
            <div class="mb-3">
            <label for="statut" class="form-label">Statut</label>
            <select class="form-control" id="statut" name="statut" required>
                <option value="actif" @if($p->Statut == 'actif') selected @endif>Actif</option>
                <option value="inactif" @if($p->Statut == 'inactif') selected @endif>Inactif</option>

            </select>
            </div>



            <!-- Champ pour les remarques -->
            <div class="mb-3">
             <label for="remarques" class="form-label">Remarques</label>
            <textarea class="form-control" id="remarques" name="remarques">{{$p->Remarques}}</textarea>
            </div>

             <!-- ... (boutons de soumission et d'annulation) ... -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endforeach



    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="admin/vendor/global/global.min.js"></script>
    <script src="admin/js/quixnav-init.js"></script>
    <script src="admin/js/custom.min.js"></script>



    <!-- Datatable -->
    <script src="admin/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="admin/js/plugins-init/datatables.init.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
















</body>


</html>

