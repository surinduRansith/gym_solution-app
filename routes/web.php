<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\memberScheduleListController;
use App\Http\Controllers\membersController;
use App\Http\Controllers\PaymentsController;
use Illuminate\Http\Request;
use App\Http\Controllers\SchedulesController;
use App\Models\Attendance;
use App\Models\Members;
use App\Models\Payments;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

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
Route::delete('/members/{id}', [MembersController::class,'deleteMemberDetails'])->name('membersdelete.delete');

Route::put('/members/{id}', [MembersController::class,'weightUpdate'])->name('weight.update');

Route::post('/members/{id}', [ExerciseController::class, 'addtype'])->name('scheduletype.add');

Route::post('/members/{id}', [SchedulesController::class, 'storeSchedule'])->name('updateshedule.insert');

Route::get('/members/{id}/edit', [MembersController::class,'EditMember'])->name('members.edit');

Route::put('/members/{id}/edit', [MembersController::class,'EditMemberDetails'])->name('update.data');

Route::get('/scheduletypes', [ExerciseController::class, 'index'])->name('scheduletype.insert');

Route::post('/scheduletypes', [ExerciseController::class, 'addtype'])->name('scheduletype.add');
Route::get('/scheduletypes', [ExerciseController::class, 'getScheculeType'])->name('scheduletype.insert');
Route::get('/members/{id}/editschedule/{scheduleid}', [MembersController::class, 'memberscheduleEditpage'])->name('memberscheduleedit.show');
Route::put('/members/{id}/editschedule/{scheduleid}', [SchedulesController::class, 'memberscheduleUpdate'])->name('memberScheduleedit.update');
Route::delete('/members/{id}/editschedule/{scheduleid}', [SchedulesController::class, 'memberscheduleDelete'])->name('memberscheduleeditpagedelete.delete');
Route::delete('/members/{id}/schedule/{scheduleid}', [SchedulesController::class, 'memberscheduleDelete'])->name('memberscheduledelete.delete');
Route::get('/members/{id}/schedule', [SchedulesController::class, 'memberAllscheduleDelete'])->name('memberallscheduledelete.delete');
Route::get('/members/{id}/generatepdf', [memberScheduleListController::class,'memberScheduleList'])->name('memberschedulelist.data');

Route::get('/members/{id}/payment', [PaymentsController::class,'ShowPaymentPage'])->name('paymentpage.data');
Route::post('/members/{id}/payment', [PaymentsController::class,'addPayment'])->name('paymentpage.insert');
Route::get('/members/{id}/payment/{month}', [PaymentsController::class,'deletePaymentPage'])->name('paymentpage.delete');
Route::delete('/members/{id}/payment/{payment}', [PaymentsController::class,'deletePaymentPageAnnual'])->name('paymentpageAnnual.delete');
Route::get('/members/{id}/attendance', [AttendanceController::class,'show'])->name('attendance.show');
Route::post('/members/{id}/attendance', [AttendanceController::class,'markAttendance'])->name('attendance.insert');

Route::get('/attendancereport', function (Request $request) {

    $members = Members::all();

    
    $userAttendance = Attendance::all()->where('member_id',$request->input('memberid'));

    return view('attendancereport',compact('members','userAttendance'));
})->name('attendancereport.show');



Route::post('/attendancereport', function (Request $request) {

    $members = Members::all();

    $request->validate([
        'startdate' => 'required|date',
        'enddate' => 'required|date|after_or_equal:startdate',
        'memberid' => [
            'required',
            Rule::in($members->pluck('id')->toArray())
        ],
    ]);

    $memberId = $request->input('memberid');
    $startDate = $request->input('startdate');
    $endDate = $request->input('enddate');

    $userAttendance = Attendance::join('members', 'attendances.member_id', '=', 'members.id')
        ->select('attendances.*', 'members.name as name')
        ->where('attendances.member_id', $memberId)
        ->whereBetween('attendances.attendancedate', [$startDate, $endDate]) // Use the correct date column name
        ->orderBy('attendances.attendancedate', 'asc')
        ->get();

        

    return view('attendancereport', compact('members', 'userAttendance'));
})->name('attendancereport1.show');


Route::get('/paymentreport', function (Request $request) {

    $members = Members::all();
    $payments =Payments::all()->where('member_id',$request->input('memberid'));
    $testvalue =1;
    return view('paymentreport',compact('members','payments','testvalue'));
})->name('paymentreport.show');


Route::post('/paymentreport', function (Request $request) {

    $members = Members::all();

    $request->validate([
        'memberid' => [
            'required',
            Rule::in($members->pluck('id')->toArray())
        ],
    ]);

    $memberId = $request->input('memberid');
    $testvalue = $request->input('testvalue');
    $payments =Payments::join('members', 'payments.member_id', '=', 'members.id')
        ->select('payments.*', 'members.name as name')
        ->where('payments.member_id', $memberId)
        ->get();


        

    return view('paymentreport',compact('members','payments','testvalue'));
})->name('userpaymentreport.show');

Route::get('/paymentreport/{id}/generatepdf', function (Request $request,$id) {

  
    $memberId = $id;

    $payments =Payments::join('members', 'payments.member_id', '=', 'members.id')
        ->select('payments.*', 'members.name as name')
        ->where('payments.member_id', $memberId)
        ->get();

        $data=[
           
            'payments'=> $payments

        ];

        $pdf = Pdf::loadView('Pdf.memberpaymentreportpdf',$data);
        return $pdf->stream('invoice.pdf');
})->name('userpaymentreportpdf.show');


