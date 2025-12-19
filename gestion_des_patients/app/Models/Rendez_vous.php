<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rendez_vous extends Model
{

        protected $table="rendez_vous";
        protected $primaryKey="id";
        protected $fillable=['id_Patient','Date','Heure','Statut','Remarques'];
        use HasFactory;
}
