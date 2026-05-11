<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SecretaryController;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Route::middleware(["guestchecker"])->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/logins', [HomeController::class, 'logins'])->name('logins');
    Route::get('/projectteam', [HomeController::class, 'projectteam'])->name('projectteam');
// });

// Route::middleware(["userchecker"])->group(function () {
    Route::get('/secretary_dashboard', [SecretaryController::class, 'secretary_dashboard'])->name('secretary_dashboard');
    Route::get('/certification_select', [SecretaryController::class, 'certification_select'])->name('certification_select');
    Route::get('/certificate_brgy', [SecretaryController::class, 'certificate_brgy'])->name('certificate_brgy');
    Route::get('/certificate_clearance', [SecretaryController::class, 'certificate_clearance'])->name('certificate_clearance');
    Route::get('/certificate_jobseeker', [SecretaryController::class, 'certificate_jobseeker'])->name('certificate_jobseeker');
    Route::get('/certificate_goodmoral', [SecretaryController::class, 'certificate_goodmoral'])->name('certificate_goodmoral');
    Route::get('/certificate_trees', [SecretaryController::class, 'certificate_trees'])->name('certificate_trees');
    Route::post('/storeCertification', [SecretaryController::class, 'storeCertification'])->name('storeCertification');
    Route::post('/certifications/data', [SecretaryController::class, 'get_certification'])->name('get_certification');
    Route::post('/deleteCertification', [SecretaryController::class, 'deleteCertification'])->name('deleteCertification');
    Route::get('/viewBrgyCertification', [SecretaryController::class, 'viewBrgyCertification'])->name('viewBrgyCertification');
    Route::get('/viewClearanceCertification', [SecretaryController::class, 'viewClearanceCertification'])->name('viewClearanceCertification');
    Route::get('/viewTreesCertification', [SecretaryController::class, 'viewTreesCertification'])->name('viewTreesCertification');
    Route::get('/viewJobSeekerCertification', [SecretaryController::class, 'viewJobSeekerCertification'])->name('viewJobSeekerCertification');
    Route::get('/viewGoodMoralCertification', [SecretaryController::class, 'viewGoodMoralCertification'])->name('viewGoodMoralCertification');
// });
