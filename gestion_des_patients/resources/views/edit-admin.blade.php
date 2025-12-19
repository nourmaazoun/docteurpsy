<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Administrateur</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Modifier Administrateur</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" name="name" class="form-control" value="{{ $admin->name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $admin->email }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Rôle</label>
                    <select name="role" class="form-control">
                        <option value="Doc" {{ $admin->role == 'Doc' ? 'selected' : '' }}>Docteur</option>
                        <option value="Sec" {{ $admin->role == 'Sec' ? 'selected' : '' }}>Secrétaire</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Statut</label>
                    <select name="statut" class="form-control">
                        <option value="Actif" {{ $admin->statut == 'Actif' ? 'selected' : '' }}>Actif</option>
                        <option value="Inactif" {{ $admin->statut == 'Inactif' ? 'selected' : '' }}>Inactif</option>
                    </select>
                </div>

               <div class="mb-3">
        <label class="form-label">Changer l'image</label>
        <input type="file" name="image" class="form-control">
        @if($admin->image)
            <img src="{{ asset('storage/' . $admin->image) }}" width="100" alt="Image actuelle">
        @endif
    </div>
                <button type="submit" class="btn btn-success">
                    Enregistrer
                </button>

                <a href="{{ route('admin.list') }}" class="btn btn-secondary">
                    Annuler
                </a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
