<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rendez_vous extends Model
{
    use HasFactory;

    protected $table = "rendez_vous";
    protected $primaryKey = "id";
    protected $fillable = [
        'id_Patient', 
        'Date', 
        'Heure', 
        'Statut', 
        'Remarques'
    ];

    // RELATION CORRECTE - vérifiez le nom de la clé étrangère
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'id_Patient');
    }
}