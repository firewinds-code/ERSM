<?php

use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\AgentTrackingController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ManageDataController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
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

Route::get('clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    Artisan::call('route:clear');
    return "Cleared!";
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    });


    ############################ Dashboard Routes ###############################
    Route::get('/dashboard', [UserController::class, 'show'])->name('dashboard');

    ############################ Manage User Routes ###############################
    Route::get('manageuser/list', [ManageUserController::class, 'list'])->name('manageuser.list')->middleware('admin');
    Route::get('manageuser/add', [ManageUserController::class, 'add'])->name('manageuser.add')->middleware('admin');
    Route::post('manageuser/postadd', [ManageUserController::class, 'postadd'])->name('manageuser.postadd')->middleware('admin');
    Route::get('manageuser/edit', [ManageUserController::class, 'editUser'])->name('manageuser.edit')->middleware('admin');
    Route::post('manageuser/update', [ManageUserController::class, 'update'])->name('manageuser.update')->middleware('admin');
    Route::get('manageuser/delete', [ManageUserController::class, 'delete'])->name('manageuser.delete')->middleware('admin');
    Route::get('changepassword', [ManageUserController::class, 'changepassword'])->name('changepassword');
    Route::post('updatepassword', [ManageUserController::class, 'updatepassword'])->name('updatepassword');

    ############################ Excel Routes ###############################
    Route::get('uploaddata/excel', [DataController::class, 'index'])->name('uploaddata.excel')->middleware('admin');
    Route::post('uploaddata/import', [DataController::class, 'import'])->name('uploaddata.import')->middleware('admin');
    Route::get('table-export', [DataController::class, 'export'])->name('table.export')->middleware('admin');

    ############################ Manage Data Routes ###############################
    Route::get('managedata/list', [ManageDataController::class, 'freshlist'])->name('managedata.list');
    Route::get('managedata/edit', [ManageDataController::class, 'freshedit'])->name('managedata.edit');
    Route::post('managedata/update', [ManageDataController::class, 'update'])->name('managedata.update');
    Route::get('gettabledata', [ManageDataController::class, 'gettabledata'])->name('gettabledata');
    Route::get('call', [ManageDataController::class, 'call'])->name('call');
    Route::post('/disposition', [ManageDataController::class, 'disposition'])->name('disposition');

    ############################ Agent Tracking Routes ###############################
    Route::get('agenttracking/list', [AgentTrackingController::class, 'list'])->name('agenttracking.list')->middleware('admin');

    ############################ Report Routes ###############################
    Route::get('report', [ReportController::class, 'report'])->name('report');
    Route::post('daterange', [ReportController::class, 'daterange'])->name('daterange');
    Route::get('calllog', [ReportController::class, 'calllog'])->name('calllog');

    ############################ lead transfer Routes ###############################
    Route::get('leadtransfer', [LeadController::class, 'leadtransfer'])->name('leadtransfer');
    Route::post('leadupdate', [LeadController::class, 'leadupdate'])->name('leadupdate');
    Route::post('/getNewAgents',[LeadController::class, 'getNewAgents'])->name('getNewAgents');
    Route::get('leadlog', [LeadController::class, 'leadlog'])->name('leadlog');
});