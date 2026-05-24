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
//certification
Route::get('/secretary_dashboard', [SecretaryController::class, 'secretary_dashboard'])->name('secretary_dashboard');
Route::get('/certification_select', [SecretaryController::class, 'certification_select'])->name('certification_select');
Route::get('/certificate_brgy', [SecretaryController::class, 'certificate_brgy'])->name('certificate_brgy');
Route::get('/certificate_clearance', [SecretaryController::class, 'certificate_clearance'])->name('certificate_clearance');
Route::get('/certificate_jobseeker', [SecretaryController::class, 'certificate_jobseeker'])->name('certificate_jobseeker');
Route::get('/certificate_goodmoral', [SecretaryController::class, 'certificate_goodmoral'])->name('certificate_goodmoral');
Route::get('/certificate_indigency', [SecretaryController::class, 'certificate_indigency'])->name('certificate_indigency');
Route::get('/certificate_livestock', [SecretaryController::class, 'certificate_livestock'])->name('certificate_livestock');
Route::get('/certificate_motorcycle', [SecretaryController::class, 'certificate_motorcycle'])->name('certificate_motorcycle');
Route::get('/certificate_piggery', [SecretaryController::class, 'certificate_piggery'])->name('certificate_piggery');
Route::get('/certificate_trees', [SecretaryController::class, 'certificate_trees'])->name('certificate_trees');
Route::get('/certificate_quary', [SecretaryController::class, 'certificate_quary'])->name('certificate_quary');
Route::get('/certificate_lot', [SecretaryController::class, 'certificate_lot'])->name('certificate_lot');
Route::post('/storeCertification', [SecretaryController::class, 'storeCertification'])->name('storeCertification');
Route::post('/certifications/data', [SecretaryController::class, 'get_certification'])->name('get_certification');
Route::post('/deleteCertification', [SecretaryController::class, 'deleteCertification'])->name('deleteCertification');
Route::get('/viewBrgyCertification', [SecretaryController::class, 'viewBrgyCertification'])->name('viewBrgyCertification');
Route::get('/viewClearanceCertification', [SecretaryController::class, 'viewClearanceCertification'])->name('viewClearanceCertification');
Route::get('/viewTreesCertification', [SecretaryController::class, 'viewTreesCertification'])->name('viewTreesCertification');
Route::get('/viewJobSeekerCertification', [SecretaryController::class, 'viewJobSeekerCertification'])->name('viewJobSeekerCertification');
Route::get('/viewGoodMoralCertification', [SecretaryController::class, 'viewGoodMoralCertification'])->name('viewGoodMoralCertification');
Route::get('/viewIndigencyCertification', [SecretaryController::class, 'viewIndigencyCertification'])->name('viewIndigencyCertification');
Route::get('/viewLiveStockCertification', [SecretaryController::class, 'viewLiveStockCertification'])->name('viewLiveStockCertification');
Route::get('/viewMotorCycleCertification', [SecretaryController::class, 'viewMotorCycleCertification'])->name('viewMotorCycleCertification');
Route::get('/viewPiggeryCertification', [SecretaryController::class, 'viewPiggeryCertification'])->name('viewPiggeryCertification');
Route::get('/viewQuarryCertification', [SecretaryController::class, 'viewQuarryCertification'])->name('viewQuarryCertification');
Route::get('/viewLotCertification', [SecretaryController::class, 'viewLotCertification'])->name('viewLotCertification');

//brgy_id
Route::get('/brgy_id', [SecretaryController::class, 'brgy_id'])->name('brgy_id');
Route::post('/storeBrgyID', [SecretaryController::class, 'storeBrgyID'])->name('storeBrgyID');
Route::post('/get_brgy_id', [SecretaryController::class, 'get_brgy_id'])->name('get_brgy_id');
Route::post('/deleteBrgyId', [SecretaryController::class, 'deleteBrgyId'])->name('deleteBrgyId');

//RBI
Route::get('/rbi', [SecretaryController::class, 'rbi'])->name('rbi');
Route::post('/storeRBI', [SecretaryController::class, 'storeRBI'])->name('storeRBI');
Route::post('/getRBI1', [SecretaryController::class, 'getRBI1'])->name('getRBI1');
Route::post('/deleteRBI', [SecretaryController::class, 'deleteRBI'])->name('deleteRBI');
//reports
Route::get('/report_select', [SecretaryController::class, 'report_select'])->name('report_select');
Route::get('/report_brgy', [SecretaryController::class, 'report_brgy'])->name('report_brgy');
Route::get('/report_trees', [SecretaryController::class, 'report_trees'])->name('report_trees');
Route::get('/report_jobseeker', [SecretaryController::class, 'report_jobseeker'])->name('report_jobseeker');
Route::get('/report_goodmoral', [SecretaryController::class, 'report_goodmoral'])->name('report_goodmoral');
Route::get('/report_indigency', [SecretaryController::class, 'report_indigency'])->name('report_indigency');
Route::get('/report_livestock', [SecretaryController::class, 'report_livestock'])->name('report_livestock');
Route::get('/report_lot', [SecretaryController::class, 'report_lot'])->name('report_lot');
Route::get('/report_motorcycle', [SecretaryController::class, 'report_motorcycle'])->name('report_motorcycle');
Route::get('/report_piggery', [SecretaryController::class, 'report_piggery'])->name('report_piggery');
Route::get('/report_quarry', [SecretaryController::class, 'report_quarry'])->name('report_quarry');

//quarry
Route::get('/quarry', [SecretaryController::class, 'quarry'])->name('quarry');
Route::post('/storeQuarry', [SecretaryController::class, 'storeQuarry'])->name('storeQuarry');
Route::post('/get_quary', [SecretaryController::class, 'get_quary'])->name('get_quary');
Route::post('/deleteQuarry', [SecretaryController::class, 'deleteQuarry'])->name('deleteQuarry');

//dashboard
Route::post('/get_dashboard_table', [SecretaryController::class, 'get_dashboard_table'])->name('get_dashboard_table');
Route::get('/getChartStatistics', [SecretaryController::class, 'getChartStatistics'])->name('getChartStatistics');

// });
