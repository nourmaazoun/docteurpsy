<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $table = "consultations";
    protected $primaryKey = "id";
    protected $fillable = [
        'id_Patient',
        'Date_et_Heure',
        'Raison',
        'Diagnostic',
        'Prochain_Rendez_vous',
        'Statut',
        'Remarques'
    ];

    // Définir la relation avec le patient
    public function patient()
{
    return $this->belongsTo(Patient::class, 'id_Patient');
}
}
