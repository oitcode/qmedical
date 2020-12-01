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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* Dashboard */
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/foo', function () {
    return view('foo');
});

/* Patient */
Route::get('/patient', 'PatientController@index')->name('patient');

/* Agent */
Route::get('/agent', 'AgentController@index')->name('agent');
Route::get('/agent/{id}', 'AgentController@show')->name('agentShow');

/* Medical Test Type */
Route::get('/medicaltesttype', 'MedicalTestTypeController@index')->name('medicalTestType');

/* Medical Test */
Route::get('/medicaltest', 'MedicalTestController@index')->name('medicalTestIndex');
Route::get('/medicaltest/create', 'MedicalTestController@create')->name('medicalTestCreate');
Route::get('/medicaltest/{id}/edit', 'MedicalTestController@edit')->name('medicalTestEdit');

/* Expense */
Route::get('/expense', 'ExpenseController@index')->name('expense');

/* Analytics */
Route::get('/analytics/medical', 'Analytics\MedicalAnalyticsController@show')->name('medicalAnalytics');
Route::get('/analytics/financial', 'Analytics\FinancialAnalyticsController@show')->name('financialAnalytics');
