<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

Route::group(['prefix' => 'patient'], function () {
	Route::get('/','patientController@list')->name('patient.list');
	Route::get('/register','patientController@register')->name('patient.register');
	Route::get('/register/add','patientController@newPatient')->name('patient.add');
	Route::get('/{id}','patientController@showPatient')->name('patient.show');
	Route::get('/edit/{id}','patientController@editPatient')->name('patient.edit');
	Route::get('/update/{id}','patientController@updatePatient')->name('patient.update');
	Route::get('/care/{id}','patientController@showCare')->name('patient.care');
	Route::get('/visit/{id}','patientController@visit')->name('patient.visit');
});

Route::group(['prefix' => 'config/clinic'], function () {
	Route::get('/','clinicController@index')->name('clinic.index');
	Route::get('/add','clinicController@addClinic')->name('clinic.add');
	Route::get('/clinic_status', 'clinicController@clinicStatus');
});

Route::group(['prefix' => 'config/hospital'], function () {
	Route::get('/','hospitalController@index')->name('hospital.index');
	Route::get('/add','hospitalController@addHospital')->name('hospital.add');
	Route::get('/hstatus', 'hospitalController@hospitalStatus');
});

Route::group(['prefix' => 'diag'], function () {
	Route::get('/','diagController@index');
	Route::post('/all','diagController@all')->name('diag.all');
});
