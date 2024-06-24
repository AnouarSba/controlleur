<?php

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

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;            
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ControlController;
use App\Http\Controllers\ExcelController;

Route::get('/import-excel', [ExcelImportController::class, 'showUploadForm'])->name('import.excel');
Route::post('/import-excel', [ExcelImportController::class, 'import'])->name('import.excel.submit');
Route::post('/upload', [ExcelController::class, 'upload'])->name('upload');
Route::get('/getExcelData', [ExcelController::class, 'getExcelData'])->name('getExcelData');
Route::post('Export',[ ExcelController::class, 'exportData'])->name('pointage')->middleware('auth'); 
Route::get('Pointage',[ ExcelController::class, 'do_pointage'])->name('do_pointage')->middleware('auth'); 
Route::post('Remplir_Pointage',[ ExcelController::class, 'do_pointage'])->name('fill_pointage')->middleware('auth'); 
Route::post('/upload/image', [ExcelController::class, 'upload'])->name('uploadImage');

// Route::get('Pointage',[ ControlController::class, 'pointage'])->name('pointage')->middleware('auth'); 
Route::get('Planing',[ ControlController::class, 'planing'])->name('planing')->middleware('auth'); 
Route::get('Show_Planing',[ ExcelController::class, 'show_planing'])->name('show_planing')->middleware('auth'); 
Route::get('Show_Avances',[ ExcelController::class, 'show_avances'])->name('show_avances')->middleware('auth'); 
Route::post('Demande_Avances',[ ExcelController::class, 'demande_avances'])->name('demande_avances')->middleware('auth'); 
Route::get('Avances',[ ExcelController::class, 'avances'])->name('avances')->middleware('auth'); 
Route::post('Export_Avance',[ ExcelController::class, 'exportDataAvance'])->name('exportDataAvance')->middleware('auth'); 


Route::post('Show_Attestations',[ ExcelController::class, 'show_attestations'])->name('show_attestations')->middleware('auth'); 

Route::post('Demande_Attestations',[ ExcelController::class, 'demande_attestations'])->name('demande_attestations')->middleware('auth'); 
Route::get('Demander_Attestations',[ ExcelController::class, 'attestations'])->name('attestations')->middleware('auth'); 
Route::post('attestation_reg',[ ExcelController::class, 'attestation_reg'])->name('attestation_reg')->middleware('auth'); 
Route::post('PAIE',[ ExcelController::class, 'import_paie'])->name('import_paie')->middleware('auth'); 


Route::post('Show_Events',[ ExcelController::class, 'show_events'])->name('show_events')->middleware('auth'); 
Route::get('Repos',[ ExcelController::class, 'repos'])->name('repos')->middleware('auth'); 
Route::post('/Repos',[ ExcelController::class, 'repo'])->name('repo')->middleware('auth'); 
Route::get('RJ',[ ExcelController::class, 'repos_j'])->name('repos_j')->middleware('auth'); 
Route::get('Detail_Repos/{id}',[ ExcelController::class, 'details'])->name('details')->middleware('auth'); 
Route::get('Detail_RJ/{id}',[ ExcelController::class, 'details_rj'])->name('details_rj')->middleware('auth'); 

Route::post('Demande_Events',[ ExcelController::class, 'demande_events'])->name('demande_events')->middleware('auth'); 
Route::get('Demander_Events',[ ExcelController::class, 'events'])->name('events')->middleware('auth'); 
Route::post('event_reg',[ ExcelController::class, 'event_reg'])->name('event_reg')->middleware('auth'); 


Route::get('Publicité',[ ControlController::class, 'pub'])->name('pub')->middleware('auth'); 

Route::get('Infraction_list',[ ControlController::class, 'Infra_list'])->middleware('auth'); 
Route::get('ls_pannes',[ ControlController::class, 'lspannes'])->name('lspannes')->middleware('auth');
Route::get('ticket',[ ControlController::class, 'c_helloworld'])->name('helloworld')->middleware('auth');

Route::get('locate',[ ControlController::class, 'locate'])->name('pos')->middleware('auth'); 
Route::post('Stop',[ ControlController::class, 'panne'])->name('panne')->middleware('auth'); 
Route::post('Move',[ ControlController::class, 'move'])->name('move')->middleware('auth'); 
Route::post('Clean',[ ControlController::class, 'clean'])->name('clean')->middleware('auth'); 
Route::post('/store_panne',[ ControlController::class, 'store_panne'])->name('store_panne')->middleware('auth'); 
Route::post('/store_move',[ ControlController::class, 'store_move'])->name('store_move')->middleware('auth'); 
Route::get('Moved',[ ControlController::class, 'move'])->name('Move')->middleware('auth'); 
Route::get('Stoped',[ ControlController::class, 'panne'])->name('Panne')->middleware('auth'); 
Route::get('/Stop_Bus',[ ControlController::class, 'Panne_bus'])->name('Panne_bus')->middleware('auth'); 
Route::get('/Move_Bus',[ ControlController::class, 'Move_bus'])->name('Move_bus')->middleware('auth'); 

Route::post('Infraction_list',[ ControlController::class, 'Infra_list'])->name('Infra_list')->middleware('auth');
Route::post('Report_list',[ ControlController::class, 'repo_list'])->name('repo_list')->middleware('auth');
Route::post('Infraction_t',[ ControlController::class, 'infra_trait'])->name('Infra_trait')->middleware('auth');
Route::post('Coffre_t',[ ControlController::class, 'Coffre_trait'])->name('Coffre_trait')->middleware('auth');
Route::post('Infraction_s',[ ControlController::class, 'Infra_save'])->name('Infra_save')->middleware('auth');
Route::post('Coffre_s',[ ControlController::class, 'Coffre_save'])->name('Coffre_save')->middleware('auth');
Route::get('Infraction_r/{infra}',[ ControlController::class, 'Infra_rapport'])->name('Infra_rapport')->middleware('auth');
Route::get('Coffre/{c}',[ ControlController::class, 'Coffre_rapport'])->name('Coffre_rapport')->middleware('auth');

Route::get('Alert_list',[ ControlController::class, 'alert_list'])->middleware('auth'); 
Route::post('panne_edit',[ ControlController::class, 'panne_edit'])->name('panne_edit')->middleware('auth'); 

Route::post('Alert_list',[ ControlController::class, 'alert_list'])->name('Alert_list')->middleware('auth'); 
Route::post('Coffre_list',[ ControlController::class, 'coffre_list'])->name('Coffre_list')->middleware('auth'); 
Route::post('Alert_t',[ ControlController::class, 'alert_trait'])->name('Alert_trait')->middleware('auth');
Route::post('Alert_s',[ ControlController::class, 'alert_save'])->name('Alert_save')->middleware('auth');
Route::get('Alert_r/{alert}',[ ControlController::class, 'alert_rapport'])->name('Alert_rapport')->middleware('auth');
Route::get('Control',[ ControlController::class, 'control'])->name('control')->middleware('auth'); 
Route::post('Locations',[ ControlController::class, 'location'])->name('location')->middleware('auth'); 
Route::post('Locate',[ ControlController::class, 'location2'])->name('location2')->middleware('auth'); 
//Route::get('Stop',[ ControlController::class, 'panne'])->name('panne')->middleware('auth'); 
Route::get('Instructions',[ ControlController::class, 'inst'])->name('inst')->middleware('auth'); 
Route::get('Guide',[ ControlController::class, 'dalil'])->name('dalil')->middleware('auth'); 
Route::get('Reglement',[ ControlController::class, 'emp'])->name('emp')->middleware('auth'); 
Route::get('Nidam',[ ControlController::class, 'nidam'])->name('nidam')->middleware('auth'); 
Route::get('Reglement_int',[ ControlController::class, 'reg'])->name('int')->middleware('auth'); 
Route::get('Stop_point',[ ControlController::class, 'stop'])->name('stop')->middleware('auth'); 

Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');

		Route::get('List_pannes',[ ControlController::class, 'lpannes'])->name('lpannes')->middleware('auth'); 
	Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
	Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
	Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
	Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static'); 
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static'); 
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
	Route::resource('videos', MediaController::class); 
	Route::get('/Infractions',[ ControlController::class, 'Infractions'])->name('Infractions'); 
	Route::post('/add_infra',[ ControlController::class, 'store_infra'])->name('store_infra'); 
	
		Route::post('/add_panne',[ ControlController::class, 'store_lpanne'])->name('store_lpanne'); 
	
	
		Route::get('/inf_show/{id}',[ ControlController::class, 'inf_show'])->name('inf_show'); 
		Route::get('/panne_show/{id}',[ ControlController::class, 'panne_show'])->name('panne_show'); 
		Route::get('/inf_type/{id}',[ ControlController::class, 'inf_type'])->name('inf_type'); 
	Route::get('/Alerts', [ControlController::class, 'Alerts'])->name('Alerts'); 
	Route::get('/Coffre', [ControlController::class, 'Coffre'])->name('Coffre'); 
	Route::post('/add_alert', [ControlController::class, 'store_alert'])->name('store_alert'); 
	Route::post('/add_coffre', [ControlController::class, 'store_coffre'])->name('store_coffre'); 
	Route::get('/Accidents', [ControlController::class, 'Accidents'])->name('Accidents'); 
	Route::get('/Controle_Bus', [ControlController::class, 'Controle_Bus'])->name('Controle_Bus'); 
	Route::get('/Controle_Employer', [ControlController::class, 'Controle_Employer'])->name('Controle_Employer'); 
	Route::get('/Declaration_perte', [ControlController::class, 'Declaration_perte'])->name('Declaration_perte'); 

});