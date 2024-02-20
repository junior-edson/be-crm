<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientManagementController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\PermissionManagementController;
use App\Http\Controllers\AgendaEventController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {
        return view('pages.dashboards.index');
    })->name('dashboard');

    Route::resource('clients', ClientManagementController::class);

    Route::name('user-management.')->group(function () {
        Route::resource('/user-management/users', UserManagementController::class);
        Route::resource('/user-management/permissions', PermissionManagementController::class);
    });

    Route::name('client-management.')->group(function () {
        Route::resource('/client-management/clients', ClientManagementController::class);
    });

    Route::name('agenda.')->group(function() {
        Route::resource('/agenda/event', AgendaEventController::class);
    });
});
