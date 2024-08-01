<?php

use App\Http\Controllers\membersController;
use App\Http\Controllers\WeightController;
use App\Http\Controllers\Schedule_typesController;
use App\Http\Controllers\SchedulesController;
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
    return view('home',);
})->name('home');




Route::get('/form', function () {
    return view('form',);
})->name('membersregistration.data');

Route::post('/form', [MembersController::class, 'createMember'])->name('insert.data');

Route::get('/members', [MembersController::class,'ShowMembers'])->name('members.data');

Route::get('/members/{id}', [MembersController::class,'ShowMemberDetails'])->name('members.profile');

Route::put('/members/{id}', [MembersController::class,'weightUpdate'])->name('weight.update');

Route::post('/members/{id}', [Schedule_typesController::class, 'addtype'])->name('scheduletype.add');

Route::post('/members/{id}', [SchedulesController::class, 'storeSchedule'])->name('updateshedule.insert');

Route::get('/members/{id}/edit', [MembersController::class,'EditMember'])->name('members.edit');

Route::put('/members/{id}/edit', [MembersController::class,'EditMemberDetails'])->name('update.data');

Route::get('/scheduletypes', [Schedule_typesController::class, 'index'])->name('scheduletype.insert');

Route::post('/scheduletypes', [Schedule_typesController::class, 'addtype'])->name('scheduletype.add');
Route::get('/scheduletypes', [Schedule_typesController::class, 'getScheculeType'])->name('scheduletype.insert');
Route::get('/members/{id}/editschedule/{scheduleid}', [MembersController::class, 'memberscheduleEditpage'])->name('memberscheduleedit.show');
Route::put('/members/{id}/editschedule/{scheduleid}', [SchedulesController::class, 'memberscheduleUpdate'])->name('memberScheduleedit.update');
Route::delete('/members/{id}/editschedule/{scheduleid}', [SchedulesController::class, 'memberscheduleDelete'])->name('memberscheduleeditpagedelete.delete');
Route::delete('/members/{id}/schedule/{scheduleid}', [SchedulesController::class, 'memberscheduleDelete'])->name('memberscheduledelete.delete');
