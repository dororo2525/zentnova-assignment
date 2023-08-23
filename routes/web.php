<?php

use App\Http\Controllers\Backend\ShortUrlController;
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

Auth::routes();
Route::group(['middleware' => 'auth' , 'prefix' => 'admin'] , function(){
    Route::group(['moddleware' => 'superadmin'] , function(){
        Route::resource('manage-package', 'App\Http\Controllers\Backend\PackageController');
    });
    Route::resource('dashboard', App\Http\Controllers\Backend\DashboardController::class);
    Route::post('report/get-chart-data', [App\Http\Controllers\Backend\DashboardController::class, 'getClickbyCurrentYear'])->name('get-report-by-year');
    Route::post('report/chart/get-report-by-date-range', [App\Http\Controllers\Backend\DashboardController::class,'getReportByDateRange'])->name('get-report-by-date-range');
    Route::post('post-chart-data', [App\Http\Controllers\Backend\DashboardController::class, 'getClickbyDate'])->name('dashboard.post-chart-data');
    Route::resource('manage-url', App\Http\Controllers\Backend\ShortUrlController::class);
    Route::post('manage-url/switch-status', [App\Http\Controllers\Backend\ShortUrlController::class, 'switchStatus'])->name('manage-url.switch-status');
});
