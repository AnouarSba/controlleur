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
Route::get('Infraction_list',[ ControlController::class, 'Infra_list'])->middleware('auth'); 
  
Route::post('Infraction_list',[ ControlController::class, 'Infra_list'])->name('Infra_list')->middleware('auth');
Route::post('Infraction_t',[ ControlController::class, 'infra_trait'])->name('Infra_trait')->middleware('auth');
Route::post('Infraction_s',[ ControlController::class, 'Infra_save'])->name('Infra_save')->middleware('auth');
Route::get('Infraction_r/{infra}',[ ControlController::class, 'Infra_rapport'])->name('Infra_rapport')->middleware('auth');

Route::get('Alert_list',[ ControlController::class, 'alert_list'])->middleware('auth'); 
  
Route::post('Alert_list',[ ControlController::class, 'alert_list'])->name('Alert_list')->middleware('auth'); 
Route::post('Alert_t',[ ControlController::class, 'alert_trait'])->name('Alert_trait')->middleware('auth');
Route::post('Alert_s',[ ControlController::class, 'alert_save'])->name('Alert_save')->middleware('auth');
Route::get('Alert_r/{alert}',[ ControlController::class, 'alert_rapport'])->name('Alert_rapport')->middleware('auth');
Route::get('Control',[ ControlController::class, 'control'])->name('control')->middleware('auth'); 
Route::get('Instructions',[ ControlController::class, 'inst'])->name('inst')->middleware('auth'); 
Route::get('Guide',[ ControlController::class, 'dalil'])->name('dalil')->middleware('auth'); 
Route::get('Reglement',[ ControlController::class, 'emp'])->name('emp')->middleware('auth'); 
Route::get('Nidam',[ ControlController::class, 'nidam'])->name('nidam')->middleware('auth'); 
Route::get('Stop_point',[ ControlController::class, 'stop'])->name('stop')->middleware('auth'); 

Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
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
	Route::get('/inf_show/{id}',[ ControlController::class, 'inf_show'])->name('inf_show'); 
	Route::get('/inf_type/{id}',[ ControlController::class, 'inf_type'])->name('inf_type'); 
	Route::get('/Alerts', [ControlController::class, 'Alerts'])->name('Alerts'); 
	Route::post('/add_alert', [ControlController::class, 'store_alert'])->name('store_alert'); 
	Route::get('/Accidents', [ControlController::class, 'Accidents'])->name('Accidents'); 
	Route::get('/Controle_Bus', [ControlController::class, 'Controle_Bus'])->name('Controle_Bus'); 
	Route::get('/Controle_Employer', [ControlController::class, 'Controle_Employer'])->name('Controle_Employer'); 
	Route::get('/Declaration_perte', [ControlController::class, 'Declaration_perte'])->name('Declaration_perte'); 

});