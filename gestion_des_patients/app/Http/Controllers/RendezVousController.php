<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rendez_vous;
use App\Models\Patient;
use App\Models\Consultation;
use Carbon\Carbon;

class RendezVousController extends Controller
{
    /**
     * Afficher tous les rendez-vous et prochaines consultations
     */
 public function index()
    {
        // Créer automatiquement les rendez-vous à partir des prochaines consultations
        $this->createRendezVousFromConsultations();
        
        // Récupérer tous les rendez-vous existants
        $RendezTout = collect();
        $Rendez_vous = Rendez_vous::all();
        
        foreach ($Rendez_vous as $r) {
            $patient = Patient::find($r->id_Patient);
            if (!$patient) continue;

            $obj = new \stdClass();
            $obj->id = $r->id;
            $obj->id_Patient = $r->id_Patient;
            $obj->Nom = $patient->Nom;
            $obj->Prénom = $patient->Prénom;
            $obj->Date = $r->Date;
            $obj->Heure = $r->Heure;
            $obj->Statut = $r->Statut;
            $obj->Remarques = $r->Remarques;

            $RendezTout->push($obj);
        }

        return view('datatable-Rendez-vous', [
            'Rendez_vous' => $RendezTout,
            'Patient' => Patient::all(),
        ]);
    }

    /**
     * Créer automatiquement des rendez-vous à partir des prochaines consultations
     */
    private function createRendezVousFromConsultations()
    {
        // Récupérer les consultations avec prochain rendez-vous
        $consultations = Consultation::whereNotNull('Prochain_Rendez_vous')
                                     ->where('Prochain_Rendez_vous', '>=', Carbon::now())
                                     ->get();

        foreach ($consultations as $consultation) {
            // Vérifier si un rendez-vous existe déjà pour cette consultation
            $existingRendezVous = Rendez_vous::where('id_Patient', $consultation->id_Patient)
                                            ->where('Date', Carbon::parse($consultation->Prochain_Rendez_vous)->format('Y-m-d'))
                                            ->where('Heure', Carbon::parse($consultation->Prochain_Rendez_vous)->format('H:i'))
                                            ->first();

            // Si aucun rendez-vous n'existe, en créer un
            if (!$existingRendezVous) {
                $rendezVous = new Rendez_vous();
                $rendezVous->id_Patient = $consultation->id_Patient;
                $rendezVous->Date = Carbon::parse($consultation->Prochain_Rendez_vous)->format('Y-m-d');
                $rendezVous->Heure = Carbon::parse($consultation->Prochain_Rendez_vous)->format('H:i');
                $rendezVous->Statut = 'En cours'; // ou autre statut par défaut
                $rendezVous->Remarques; 
                                         Carbon::parse($consultation->created_at)->format('d/m/Y');
                $rendezVous->save();
            }
        }
    }

    public function add(Request $request)
    {
        $verif = Patient::where('E_mail', $request->email)->first();

        if ($verif) {
            $idP = $verif->id;
        } else {
            $patient = new Patient();
            $patient->Nom = $request->name;
            $patient->Prénom = $request->prenom;
            $patient->Age = $request->age;
            $patient->E_mail = $request->email;
            $patient->Numéro_de_téléphone = $request->phone;
            $patient->save();

            $idP = $patient->id;
        }

        $rendez = new Rendez_vous();
        $rendez->Date = $request->date;
        $rendez->Heure = $request->time ?? $request->heure;
        $rendez->Type_de_Rendez_vous = $request->type ?? 'En cours';
        $rendez->Statut = $request->statut ?? 'En cours';
        $rendez->Remarques = $request->remarques ?? $request->Remarques;
        $rendez->id_Patient = $idP;
        $rendez->save();

        return view('succès');
    }

    /**
     * Ajouter un rendez-vous direct (modal)
     */
  public function addRendez(Request $request)
    {
        $request->validate([
            'id_Patient' => 'required|exists:patients,id',
            'date' => 'required|date',
            'heure' => 'required',
            'statut' => 'required',
        ]);

        $rendez = new Rendez_vous();
        $rendez->id_Patient = $request->id_Patient;
        $rendez->Date = $request->date;
        $rendez->Heure = $request->heure;
        $rendez->Statut = $request->statut;
        $rendez->Remarques = $request->Remarques ?? '';
        $rendez->save();

        return redirect()->back()->with('success', 'Rendez-vous ajouté avec succès.');
    }

    /**
     * Mettre à jour un rendez-vous
     */
    public function updateRendez(Request $request, $id)
    {
        $rendez = Rendez_vous::find($id);

        if (!$rendez) {
            return redirect()->route('rendezvous.index')->with('error', 'Rendez-vous non trouvé.');
        }

        $rendez->Date = $request->input('date');
        $rendez->Heure = $request->input('Heure');
        $rendez->Type_de_Rendez_vous = $request->input('Type_de_Rendez_vous');
        $rendez->Statut = $request->input('Statut');
        $rendez->Remarques = $request->input('Remarques');
        $rendez->save();

        return redirect()->route('rendezvous.index')->with('success', 'Rendez-vous mis à jour avec succès.');
    }

    /**
     * Supprimer un rendez-vous
     */
    public function delete($id)
    {
        $rendez = Rendez_vous::find($id);

        if ($rendez) {
            $rendez->delete();
            return redirect()->back()->with('success', 'Rendez-vous supprimé avec succès.');
        }

        return redirect()->back()->with('error', 'Rendez-vous non trouvé.');
    }
   public function calendarEvents()
{
    try {
        $events = Rendez_vous::with('patient')->get()->map(function ($r) {
            return [
                'id' => $r->id,
                'title' => $r->patient 
                    ? $r->patient->Nom . ' ' . $r->patient->Prénom 
                    : 'Patient inconnu',
                'start' => $r->Date . 'T' . $r->Heure,
                'extendedProps' => [
                    'status' => $r->Statut,
                    'remarques' => $r->Remarques,
                ],
                'className' => $this->getStatusClass($r->Statut) // <-- ICI
            ];
        });

        return response()->json($events);
        
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


private function getStatusClass($status)
{
    $status = strtolower($status);
    $status = preg_replace('/[^a-z0-9]/', '', $status);
    
    switch ($status) {
        case 'encours': return 'en-cours';
        case 'confirme': return 'confirme';
        case 'annule': return 'annule';
        case 'termine': return 'termine';
        default: return 'en-cours';
    }
}
    
}
