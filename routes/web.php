<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassScheduleController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return redirect('/siakad');
});

Route::prefix('siakad')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

   
    Route::resource('faculties', FacultyController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('academic-years', AcademicYearController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('courses', CourseController::class);

   
    Route::resource('lecturers', LecturerController::class);
    Route::resource('students', StudentController::class);

    
    Route::resource('class-schedules', ClassScheduleController::class);

    
    Route::resource('krs', KrsController::class);
    Route::resource('grades', GradeController::class);

    
    Route::resource('invoices', InvoiceController::class);
    Route::resource('payments', PaymentController::class);
});
