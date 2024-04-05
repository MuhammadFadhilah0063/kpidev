<?php

use App\Http\Controllers\AdminKPIApproveController;
use App\Http\Controllers\AdminKPIController;
use App\Http\Controllers\AdminKPIGeneralApproveController;
use App\Http\Controllers\AdminKPIGeneralController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GLKPIApproveController;
use App\Http\Controllers\GLKPIController;
use App\Http\Controllers\GLKPIGeneralController;
use App\Http\Controllers\KamusKPIController;
use App\Http\Controllers\KamusKPIGeneralController;
use App\Http\Controllers\GLKPIGeneralApproveController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\RekapPencapaianSFGLKPIController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SectionKPIGeneralController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/clear-session-login', [DashboardController::class, 'clearSessionLogin'])->name('clear-session-login');

    // User
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::post('/user', [UserController::class, 'store'])->name('storeUser');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('editUser');
    Route::put('/user/{user}', [UserController::class, 'update'])->name('updateUser');
    Route::put('/user/{user}/update-ttd', [UserController::class, 'update_ttd'])->name('updateUserTtd');
    Route::put('/user/{user}/update-foto', [UserController::class, 'update_foto'])->name('updateUserFoto');
    Route::put('/user/{user}/update-password', [UserController::class, 'update_password'])->name('updateUserPassword');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('destroyUser');

    // Periode
    Route::get('/periode', [PeriodeController::class, 'index'])->name('periode');
    Route::post('/periode', [PeriodeController::class, 'store'])->name('storePeriode');
    Route::get('/periode/{id}/edit', [PeriodeController::class, 'edit'])->name('editPeriode');
    Route::put('/periode/{periode}', [PeriodeController::class, 'update'])->name('updatePeriode');
    Route::delete('/periode/{periode}', [PeriodeController::class, 'destroy'])->name('destroyPeriode');

    // Kamus
    Route::get('/kamus', [KamusKPIController::class, 'index'])->name('kamus');
    Route::post('/kamus', [KamusKPIController::class, 'store'])->name('storeKamus');
    Route::get('/kamus/{id}/edit', [KamusKPIController::class, 'edit'])->name('editKamus');
    Route::put('/kamus/{kamus}', [KamusKPIController::class, 'update'])->name('updateKamus');
    Route::delete('/kamus/{kamus}', [KamusKPIController::class, 'destroy'])->name('destroyKamus');
    Route::post('/kamus-import', [KamusKPIController::class, 'import'])->name('kamusImport');

    // Kamus General
    Route::get('/kamus-general', [KamusKPIGeneralController::class, 'index'])->name('kamusGeneral');
    Route::post('/kamus-general', [KamusKPIGeneralController::class, 'store'])->name('storeKamusGeneral');
    Route::get('/kamus-general/{id}/edit', [KamusKPIGeneralController::class, 'edit'])->name('editKamusGeneral');
    Route::put('/kamus-general/{id}', [KamusKPIGeneralController::class, 'update'])->name('updateKamusGeneral');
    Route::delete('/kamus-general/{id}', [KamusKPIGeneralController::class, 'destroy'])->name('destroyKamusGeneral');

    // Admin KPI
    Route::get('/check-admin-kpi/subdivisi/{subdivisi}', [AdminKPIController::class, 'checkKPI'])->name('checkAdminkpi');
    Route::delete('/check-admin-kpi/subdivisi/{subdivisi}/{id}', [AdminKPIController::class, 'destroyOnGL'])->name('adminDestroyKPIOnGL');
    Route::post('/check-admin-kpi/subdivisi/{subdivisi}/approve', [AdminKPIController::class, 'approve'])->name('approveKPIAdmin');
    Route::post('/check-admin-kpi/subdivisi/{subdivisi}/reject', [AdminKPIController::class, 'reject'])->name('rejectKPIAdmin');
    Route::get('/admin/subdivisi/{subdivisi}', [AdminKPIController::class, 'index'])->name('adminkpi');
    Route::post('/admin/subdivisi/{subdivisi}', [AdminKPIController::class, 'store'])->name('adminStoreKPI');
    Route::get('/admin/subdivisi/{subdivisi}/{id}/edit', [AdminKPIController::class, 'edit'])->name('adminEditKPI');
    Route::put('/admin/subdivisi/{subdivisi}/{id}', [AdminKPIController::class, 'update'])->name('adminUpdateKPI');
    Route::delete('/admin/subdivisi/{subdivisi}/{id}', [AdminKPIController::class, 'destroy'])->name('adminDestroyKPI');

    // GL KPI Individu
    Route::get('/gl/subdivisi/{subdivisi}', [GLKPIController::class, 'index'])->name('glkpi');
    Route::post('/gl/subdivisi/{subdivisi}', [GLKPIController::class, 'store'])->name('glStoreKPI');
    Route::get('/gl/subdivisi/{subdivisi}/{id}/edit', [GLKPIController::class, 'edit'])->name('glEditKPI');
    Route::put('/gl/subdivisi/{subdivisi}/{id}', [GLKPIController::class, 'update'])->name('glUpdateKPI');
    Route::delete('/gl/subdivisi/{subdivisi}/{id}', [GLKPIController::class, 'destroy'])->name('glDestroyKPI');

    // Rekap Pencapaian SF GL KPI Individu
    Route::get('/pencapaian-sf-kpi-individu-gl', [RekapPencapaianSFGLKPIController::class, 'index'])->name('rekapglkpi');
    Route::post('/pencapaian-sf-kpi-individu-gl', [RekapPencapaianSFGLKPIController::class, 'store'])->name('rekapGLStoreKPI');
    Route::get('/pencapaian-sf-kpi-individu-gl/{id}/edit', [RekapPencapaianSFGLKPIController::class, 'edit'])->name('rekapGLEditKPI');
    Route::put('/pencapaian-sf-kpi-individu-gl/{id}', [RekapPencapaianSFGLKPIController::class, 'update'])->name('rekapGLUpdateKPI');
    Route::delete('/pencapaian-sf-kpi-individu-gl/{id}', [RekapPencapaianSFGLKPIController::class, 'destroy'])->name('rekapGLDestroyKPI');

    // GL KPI General
    Route::get('/gl-general/{id}/pdf', [GLKPIGeneralController::class, 'makePdf'])->name('glkpiGeneralPdf');
    Route::get('/gl-general/pemeriksaan', [GLKPIGeneralController::class, 'check'])->name('glkpiGeneralCheck');
    Route::post('/gl-general/approve', [GLKPIGeneralController::class, 'approve'])->name('glkpiGeneralApprove');
    Route::post('/gl-general/reject', [GLKPIGeneralController::class, 'reject'])->name('glkpiGeneralReject');
    Route::get('/gl-general/subdivisi/{subdivisi}', [GLKPIGeneralController::class, 'index'])->name('glkpiGeneral');
    Route::post('/gl-general/subdivisi/{subdivisi}', [GLKPIGeneralController::class, 'store'])->name('glStoreKPIGeneral');
    Route::get('/gl-general/subdivisi/{subdivisi}/{id}/edit', [GLKPIGeneralController::class, 'edit'])->name('glEditKPIGeneral');
    Route::put('/gl-general/subdivisi/{subdivisi}/{id}', [GLKPIGeneralController::class, 'update'])->name('glUpdateKPIGeneral');
    Route::delete('/gl-general/subdivisi/{subdivisi}/{id}', [GLKPIGeneralController::class, 'destroy'])->name('glDestroyKPIGeneral');

    // GL KPI General Approve
    Route::get('/gl-kpi-general-approve', [GLKPIGeneralApproveController::class, 'index'])->name('glkpiGeneralApprove');

    // Admin KPI General
    Route::get('/admin-general/{id}/pdf', [AdminKPIGeneralController::class, 'makePdf'])->name('adminkpiGeneralPdf');
    Route::get('/admin-general/pemeriksaan', [AdminKPIGeneralController::class, 'check'])->name('adminkpiGeneralCheck');
    Route::post('/admin-general/approve', [AdminKPIGeneralController::class, 'approve'])->name('adminkpiGeneralApprove');
    Route::post('/admin-general/reject', [AdminKPIGeneralController::class, 'reject'])->name('adminkpiGeneralReject');
    Route::get('/admin-general/subdivisi/{subdivisi}', [AdminKPIGeneralController::class, 'index'])->name('adminkpiGeneral');
    Route::post('/admin-general/subdivisi/{subdivisi}', [AdminKPIGeneralController::class, 'store'])->name('adminStoreKPIGeneral');
    Route::get('/admin-general/subdivisi/{subdivisi}/{id}/edit', [AdminKPIGeneralController::class, 'edit'])->name('adminEditKPIGeneral');
    Route::put('/admin-general/subdivisi/{subdivisi}/{id}', [AdminKPIGeneralController::class, 'update'])->name('adminUpdateKPIGeneral');
    Route::delete('/admin-general/subdivisi/{subdivisi}/{id}', [AdminKPIGeneralController::class, 'destroy'])->name('adminDestroyKPIGeneral');

    // Admin KPI General Approve
    Route::get('/admin-kpi-general-approve', [AdminKPIGeneralApproveController::class, 'index'])->name('adminkpiGeneralApprove');

    // Section KPI General
    Route::get('/section-kpi-general/{id}/pdf', [SectionKPIGeneralController::class, 'makePdf'])
        ->name('sectionkpiGeneralPdf');
    Route::get('/section-kpi-general', [SectionKPIGeneralController::class, 'index'])
        ->name('sectionkpiGeneral');
    Route::post('/section-kpi-general', [SectionKPIGeneralController::class, 'store'])
        ->name('sectionStoreKPIGeneral');
    Route::get('/section-kpi-general/{id}', [SectionKPIGeneralController::class, 'show'])
        ->name('sectionShowKPIGeneral');
    Route::get('/section-kpi-general/{id}/edit', [SectionKPIGeneralController::class, 'edit'])
        ->name('sectionEditKPIGeneral');
    Route::put('/section-kpi-general/{id}', [SectionKPIGeneralController::class, 'update'])
        ->name('sectionUpdateKPIGeneral');
    Route::delete('/section-kpi-general/{id}', [SectionKPIGeneralController::class, 'destroy'])
        ->name('sectionDestroyKPIGeneral');

    // Section KPI
    Route::post('/section/{subdivisi}/kpi/approve', [SectionController::class, 'approve'])->name('approveSection');
    Route::post('/section/{subdivisi}/kpi/reject', [SectionController::class, 'reject'])->name('rejectSection');
    Route::get('/section/{subdivisi}', [SectionController::class, 'index'])->name('section');
    Route::post('/section/{subdivisi}', [SectionController::class, 'store'])->name('storeSection');
    Route::get('/section/{subdivisi}/{id}/edit', [SectionController::class, 'edit'])->name('editSection');
    Route::put('/section/{subdivisi}/{id}', [SectionController::class, 'update'])->name('updateSection');
    Route::delete('/section/{subdivisi}/{id}', [SectionController::class, 'destroy'])->name('destroySection');

    // GLKPIApprove
    Route::get('/gl-kpi-approve', [GLKPIApproveController::class, 'index'])->name('glkpiapprove');

    // AdminKPIApprove
    Route::get('/admin-kpi-approve', [AdminKPIApproveController::class, 'index'])->name('adminkpiapprove');

    // Profile
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');

    // Logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // AJAX
    Route::get('/get-kamus/{id_kamus}', [KamusKPIController::class, 'getKamus'])->name('getKamus');
    Route::get('/get-kamus-general/{id_kamus}', [KamusKPIGeneralController::class, 'getKamus'])->name('getKamusGeneral');
    Route::get('/get-kpi-individu-gl-periode', [RekapPencapaianSFGLKPIController::class, 'getKpiPeriodes'])->name('getRekapKpi');
});

// Login - Auth
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'auth'])->name('authMaster');
    Route::get('/login/master', [AuthController::class, 'loginMaster'])->name('loginMaster');
    Route::post('/login/master', [AuthController::class, 'authMaster'])->name('authMaster');
});
