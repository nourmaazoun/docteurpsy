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
                    <h4>Salut {{ Auth::user()->name }}, bienvenue !</h4>
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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Tableau de données de base</h4>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop3">
                            Ajouter
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                              <thead>
    <tr>
        <th>Nom et Prénom</th>
        <th>Date</th>
        <th>Heure</th>
        
        <th>Statut</th>
        <th>Remarques</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    @foreach ($Rendez_vous as $r)
    <tr>
      <td>{{ $r->Nom }} {{ $r->Prénom }}</td>
        <td>{{ $r->Date }}</td>
        <td>{{ $r->Heure }}</td>
        <td>{{ $r->Statut }}</td>
        <td>{{ $r->Remarques }}</td>
        <td>
            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editRendezVous{{ $r->id }}">
                <i class="bi bi-pencil-square"></i> Modifier
            </button>
            <a href="{{ url('/produit/delete/' . $r->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cette ligne ?')">
                <i class="bi bi-trash3"></i> Supprimer
            </a>
        </td>
    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        <th>Nom et Prénom</th>
        <th>Date</th>
        <th>Heure</th>
       
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
          <!-- Modal -->
  <div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Ajouter un rendez-vous</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action='/addrendez_vous' method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Choisir un patient</label>
                    <select  name="id_Patient" id="dropdownSelect" class="js-example-basic-single" style="width: 100px;">
                      @foreach ( $Patient as $f )
                      <option value="{{$f->id}}">{{$f->Nom}} {{$f->Prénom}} {{$f->Date_de_naissance}}</option>
                      @endforeach
                    </select>


                    </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>


                <div class="mb-3">
                    <label for="heure" class="form-label">Heure</label>
                    <input type="time" class="form-control" id="heure" name="heure" required>
                </div>
               
                <div class="mb-3">
                    <label for="statut" class="form-label">Statut</label>
                    <select class="form-control" id="statut" name="statut" required>
                        <option value="En cours">En cours</option>
                        <option value="Confirmé">Confirmé</option>
                        <option value="Annulé">Annulé</option>
                        <option value="Terminé">Terminé</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="Remarques" class="form-label">Remarques</label>
                    <textarea class="form-control" id="Remarques" name="Remarques" rows="3"></textarea>
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




  @foreach ($Rendez_vous as $r)
  <!-- Modal d'édition pour le rendez-vous -->
  <div class="modal fade" id="editRendezVous{{$r->id}}" tabindex="-1" role="dialog" aria-labelledby="editRendezVousTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editRendezVousTitle">Édition du rendez-vous</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/editrendezvous/{{$r->id}}" method="post">
            @csrf
            <!-- Champ pour la date -->
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="{{$r->Date}}" required>
            </div>

            <!-- Champ pour l'heure -->
            <div class="mb-3">
              <label for="Heure" class="form-label">Heure</label>
              <input type="time" class="form-control" id="Heure" name="Heure" value="{{$r->Heure}}" required>
            </div>
            <!-- Champ pour le type de rendez-vous -->
            
            <!-- Champ pour le statut -->
            <div class="mb-3">
              <label for="Statut" class="form-label">Statut</label>
              <select class="form-control" id="Statut" name="Statut" required>
                <option value="En cours" @if($r->Statut == 'En cours') selected @endif>En cours</option>
                <option value="Confirmé" @if($r->Statut == 'Confirmé') selected @endif>Confirmé</option>
                <!-- Ajoutez d'autres options de statut ici -->
              </select>
            </div>
            <!-- Champ pour les remarques -->
            <div class="mb-3">
              <label for="Remarques" class="form-label">Remarques</label>
              <textarea class="form-control" id="Remarques" name="Remarques">{{$r->Remarques}}</textarea>
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












    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
    <title>Liste déroulante avec recherche</title>


   <script>
    $(document).ready(function() {
      $('.js-example-basic-single').select2();
    });
  </script>

</body>

</html>
