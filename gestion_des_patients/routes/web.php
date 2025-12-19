<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\OrdonnanceController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/calendrier', function () {
    return view('calendrier');
});

Route::get('/profil', function () {
    return view('Profil');
});

Route::get('/Tableau_de_bord', function () {
    return view('Tableau_de_bord');
});

Route::get('/login', function () {
    return view('page-login');
});

Route::get('/register', function () {
    return view('page-register');
});

Route::get('/succ', function () {
    return view('succès');
});

// Consultations
Route::get('/Consultations', [ConsultationController::class, 'showConsultation'])->name('consultations.index');

// Patients
Route::get('/Patients', [patientcontroller::class, 'showPatient'])->name('patients.index');
Route::get('/patient/delete/{id}', [patientcontroller::class, 'deletePatient'])->name('patient.delete');



Route::get('/datatable-Ordonnances', [OrdonnanceController::class, 'showOrdonnance'])->name('ordonnances.index');

// Rendez-vous
Route::get('/Rendez-vous', [RendezVousController::class, 'index'])->name('rendezvous.index');
Route::post('/addRDV', [RendezVousController::class, 'add'])->name('rendezvous.add');
// Formulaires d’ajout
Route::post('/addpatient', [PatientController::class, 'AddPatient']);
Route::post('/addconsultation', [ConsultationController::class, 'AddConsultation']);
Route::post('/addrendez_vous', [RendezVousController::class, 'AddRendez']);

// Auth
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Modals de modification
Route::post('/editpatient/{id}', [PatientController::class, 'updatepatient']);
Route::post('/editconsultation/{id}', [ConsultationController::class, 'updateconsultation']);
Route::post('/editrendezvous/{id}', [RendezVousController::class, 'updaterendez']);
Route::post('/editordonnance/{id}', [OrdonnanceController::class, 'updateordonnance']);

// Ordonnances
Route::post('/enregistrer-ordonnance', [OrdonnanceController::class, 'enregistrerOrdonnance']);
Route::get('/consordo', [OrdonnanceController::class, 'join']);
Route::get('/ordonnance/{id}', [ConsultationController::class, 'showordonnance']);
Route::get('/ordonnance', [OrdonnanceController::class, 'join']);

// PDF
Route::get('/generate-pdf/{id}', [PDFController::class, 'generatePDF']);

// Admins
Route::get('/admins', [AdminController::class, 'showAdmin'])->name('admin.list');

Route::get('/admins/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');

Route::post('/admins/{id}/update', [AdminController::class, 'update'])->name('admin.update');
Route::get('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');

Route::get('/calendrier', function () {
    return view('calendrier');
});

Route::get('/calendar/events', [RendezVousController::class, 'calendarEvents']);