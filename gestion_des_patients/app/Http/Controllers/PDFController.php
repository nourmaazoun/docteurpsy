<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ordonnance;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generatePDF($id)
    {
        // Important: $id est l'ID de la consultation, pas l'ID de l'ordonnance
        // Cherchez l'ordonnance associée à cette consultation
        
        $data = DB::table('ordonnances')
            ->join('patients', 'ordonnances.id_Patient', '=', 'patients.id')
            ->join('consultations', 'ordonnances.id_Consultation', '=', 'consultations.id')
            ->select(
                'ordonnances.id', 
                'patients.Nom', 
                'patients.Prénom', 
                'ordonnances.Description', 
                'consultations.Date_et_Heure'
            )
            ->where('ordonnances.id_Consultation', $id) // CHANGEZ CE CI
            ->first(); // Utilisez first() au lieu de get()

        // Si aucune ordonnance n'existe pour cette consultation
        if (!$data) {
            return redirect()->back()
                ->with('error', 'Aucune ordonnance trouvée pour cette consultation. Veuillez d\'abord créer une ordonnance.');
        }

        // Générez le PDF
        $pdf = Pdf::loadView('pdf', ['data' => $data]);

        // Téléchargez le PDF
        $filename = 'ordonnance-' . $data->Nom . '-' . $data->Prénom . '.pdf';
        return $pdf->download($filename);
    }
}