<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PreinscriptionController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\FormateurController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;




/*
|--------------------------------------------------------------------------
| Page d'accueil
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Authentification et redirection vers dashboard unique
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Dashboard unique
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Préinscription
    Route::get('/preinscription', [PreinscriptionController::class, 'formulaire'])->name('preinscription.formulaire');
    Route::post('/preinscription', [PreinscriptionController::class, 'envoyer'])->name('preinscription.envoyer');

    Route::resource('users', UserController::class)->except(['show']);

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('profile/show', [ProfileController::class, 'show'])->name('profile.show');


});

Route::middleware(['auth'])->group(function () {
    Route::resource('etudiants', EtudiantController::class);
    Route::resource('options', OptionController::class);
    Route::resource('formateurs', FormateurController::class);
    Route::resource('niveaux', NiveauController::class);
    Route::resource('notes', NoteController::class);
    Route::resource('matieres', MatiereController::class);
    Route::resource('cours', CoursController::class);
    Route::resource('articles', ArticleController::class);
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    Route::get('/etudiants/create/{preinscription}', [EtudiantController::class, 'create1'])->name('etudiants.create1');
    Route::get('/preinscriptions', [PreinscriptionController::class, 'index'])->name('preinscriptions.index');
    Route::delete('/preinscriptions/{id}', [PreinscriptionController::class, 'destroy'])->name('preinscription.destroy');
    Route::put('/preinscriptions/{preinscription}/valider', [PreinscriptionController::class, 'valider'])->name('preinscriptions.valider');
});


Route::middleware('auth')->group(function () {
    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/etudiant/dashboard', 'etudiants.dashboard')->name('etudiant.dashboard');
    Route::view('/formateur/dashboard', 'formateurs.dashboard')->name('formateur.dashboard');
    Route::view('/parent/dashboard', 'parent.dashboard')->name('parent.dashboard');
});

require __DIR__.'/auth.php';
