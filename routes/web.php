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

// frontend routes
Auth::routes();
Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
Route::post('/trial-url', [App\Http\Controllers\Frontend\HomeController::class, 'trialUrl'])->name('trial-url');

// web-admin routes
Route::group(['middleware' => 'auth' , 'prefix' => 'web-admin'] , function(){
    Route::resource('/', App\Http\Controllers\Backend\DashboardController::class);
    Route::get('dashboard/get-chart-data', [App\Http\Controllers\Backend\DashboardController::class, 'dashboardClick'])->name('get-dashboard-by-year');
    Route::resource('report', App\Http\Controllers\Backend\ReportController::class);
    Route::post('report/get-chart-data', [App\Http\Controllers\Backend\ReportController::class, 'getClickbyCurrentYear'])->name('get-report-by-year');
    Route::post('report/chart/get-report-by-date-range', [App\Http\Controllers\Backend\ReportController::class,'getReportByDateRange'])->name('get-report-by-date-range');
    Route::resource('manage-url', App\Http\Controllers\Backend\ShortUrlController::class);
    Route::post('manage-url/switch-status', [App\Http\Controllers\Backend\ShortUrlController::class, 'switchStatus'])->name('manage-url.switch-status');
});


// route for redirect
Route::get('/{code}', [App\Http\Controllers\Frontend\HomeController::class, 'redirect'])->name('redirect');
