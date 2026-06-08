<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KagawadController;
use App\Http\Controllers\SecretaryController;
use App\Http\Controllers\TreasurerController;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Route::middleware(["guestchecker"])->group(function () {
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/logins', [HomeController::class, 'logins'])->name('logins');
Route::get('/projectteam', [HomeController::class, 'projectteam'])->name('projectteam');
// });

Route::middleware(["userchecker"])->group(function () {
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
    Route::get('/report_brgy_clearance', [SecretaryController::class, 'report_brgy_clearance'])->name('report_brgy_clearance');
    Route::get('/report_trees', [SecretaryController::class, 'report_trees'])->name('report_trees');
    Route::get('/report_jobseeker', [SecretaryController::class, 'report_jobseeker'])->name('report_jobseeker');
    Route::get('/report_goodmoral', [SecretaryController::class, 'report_goodmoral'])->name('report_goodmoral');
    Route::get('/report_indigency', [SecretaryController::class, 'report_indigency'])->name('report_indigency');
    Route::get('/report_livestock', [SecretaryController::class, 'report_livestock'])->name('report_livestock');
    Route::get('/report_lot', [SecretaryController::class, 'report_lot'])->name('report_lot');
    Route::get('/report_motorcycle', [SecretaryController::class, 'report_motorcycle'])->name('report_motorcycle');
    Route::get('/report_piggery', [SecretaryController::class, 'report_piggery'])->name('report_piggery');
    Route::get('/report_quarry', [SecretaryController::class, 'report_quarry'])->name('report_quarry');
    Route::get('/report_brgy_id', [SecretaryController::class, 'report_brgy_id'])->name('report_brgy_id');
    Route::get('/overallreport', [TreasurerController::class, 'overallreport'])->name('overallreport');

    //quarry
    Route::get('/quarry', [SecretaryController::class, 'quarry'])->name('quarry');
    Route::post('/storeQuarry', [SecretaryController::class, 'storeQuarry'])->name('storeQuarry');
    Route::post('/get_quary', [SecretaryController::class, 'get_quary'])->name('get_quary');
    Route::post('/deleteQuarry', [SecretaryController::class, 'deleteQuarry'])->name('deleteQuarry');

    //dashboard
    Route::post('/get_dashboard_table', [SecretaryController::class, 'get_dashboard_table'])->name('get_dashboard_table');
    Route::get('/getChartStatistics', [SecretaryController::class, 'getChartStatistics'])->name('getChartStatistics');


    //treasurer
    Route::get('/treasurer_dashboard', [TreasurerController::class, 'treasurer_dashboard'])->name('treasurer_dashboard');
    Route::post('/get_collection', [TreasurerController::class, 'get_collection'])->name('get_collection');
    Route::get('/collectionfee_select', [TreasurerController::class, 'collectionfee_select'])->name('collectionfee_select');
    Route::get('/barangay_clearance', [TreasurerController::class, 'barangay_clearance'])->name('barangay_clearance');
    Route::get('/barangay_certification', [TreasurerController::class, 'barangay_certification'])->name('barangay_certification');
    Route::get('/summon', [TreasurerController::class, 'summon'])->name('summon');
    Route::get('/barangay_id', [TreasurerController::class, 'barangay_id'])->name('barangay_id');
    Route::get('/business_clearance', [TreasurerController::class, 'business_clearance'])->name('business_clearance');
    Route::post('/storeCollection', [TreasurerController::class, 'storeCollection'])->name('storeCollection');
    Route::post('/deleteCollection', [TreasurerController::class, 'deleteCollection'])->name('deleteCollection');
    Route::post('/get_dashboard_treasurer_table', [TreasurerController::class, 'get_dashboard_treasurer_table'])->name('get_dashboard_treasurer_table');
    //treasurer report
    Route::get('/collectionfeereport_select', [TreasurerController::class, 'collectionfeereport_select'])->name('collectionfeereport_select');
    Route::get('/collection_report', [TreasurerController::class, 'collection_report'])->name('collection_report');
    Route::get('/getChartStatisticsCollection', [TreasurerController::class, 'getChartStatisticsCollection'])->name('getChartStatisticsCollection');

    //kagawad
    Route::get('/kagawad_dashboard', [KagawadController::class, 'kagawad_dashboard'])->name('kagawad_dashboard');
    Route::get('/blotter', [KagawadController::class, 'blotter'])->name('blotter');
    Route::get('/kagawad_select', [KagawadController::class, 'kagawad_select'])->name('kagawad_select');
    Route::get('/blotter_report', [KagawadController::class, 'blotter_report'])->name('blotter_report');
    Route::get('/borrowed_report', [KagawadController::class, 'borrowed_report'])->name('borrowed_report');
    Route::get('/borrowedequipment', [KagawadController::class, 'borrowedequipment'])->name('borrowedequipment');
    Route::post('/storeKagawadRecord', [KagawadController::class, 'storeKagawadRecord'])->name('storeKagawadRecord');
    Route::post('/get_blotter', [KagawadController::class, 'get_blotter'])->name('get_blotter');
    Route::post('/deleteRecord', [KagawadController::class, 'deleteRecord'])->name('deleteRecord');

    //admin
    Route::get('/admin_dashboard', [AdminController::class, 'admin_dashboard'])->name('admin_dashboard');
    Route::get('/secretary_select', [AdminController::class, 'secretary_select'])->name('secretary_select');
    Route::get('/treasurer_select', [AdminController::class, 'treasurer_select'])->name('treasurer_select');
    Route::get('/kagawad_select', [AdminController::class, 'kagawad_select'])->name('kagawad_select');
    Route::get('/user', [AdminController::class, 'user'])->name('user');
    Route::get('/report_admin', [AdminController::class, 'report_admin'])->name('report_admin');
    Route::post('/get_users', [AdminController::class, 'get_users'])->name('get_users');
    Route::post('/storeUser', [AdminController::class, 'storeUser'])->name('storeUser');
    Route::post('/deleteUser', [AdminController::class, 'deleteUser'])->name('deleteUser');
    Route::get('/statistics/chart', [AdminController::class, 'getStatisticsChart'])
        ->name('statistics.chart');
});
