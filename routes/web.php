<?php

use App\Http\Controllers\Admin\DepartementController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Student\RegistrationController as StudentRegistrationController;
use Illuminate\Support\Facades\Route;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\StudentT;

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

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'ShowLoginForm']);

Auth::routes(['register' => false]);

Route::prefix('admin')->group(function () {

    Route::group(['middleware' => 'auth'], function () {

        //dashboard
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard.index');
        //permissions
        Route::resource('/permission', App\Http\Controllers\Admin\PermissionController::class, ['except' => ['show', 'create', 'edit', 'update', 'delete'], 'as' => 'admin']);

        // role
        Route::resource('/role', App\Http\Controllers\Admin\RoleController::class, ['except' => ['show'], 'as' => 'admin']);

        // user
        Route::resource('/user', App\Http\Controllers\Admin\UserController::class, ['except' => ['show'], 'as' => 'admin']);
        // faculty
        Route::resource('/faculty', App\Http\Controllers\Admin\FacultyController::class, ['except' => ['show'], 'as' => 'admin']);
        // user
        Route::resource('/departement', App\Http\Controllers\Admin\DepartementController::class, ['except' => ['show'], 'as' => 'admin']);

        // registration
        Route::resource('/registration', App\Http\Controllers\Admin\RegistrationController::class, ['except' => ['show'], 'as' => 'admin']);

        Route::resource('/student/registration', StudentRegistrationController::class, ['except' => ['show'], 'as' => 'student']);
    });
});
Route::controller(UserController::class)->group(function () {
    Route::post('user-import', 'import')->name('users.import');
    Route::get('/user/departement/{id}', 'getDepartement')->name('get.departementUser');
});
Route::controller(DepartementController::class)->group(function () {
    Route::post('departement-import', 'import')->name('departements.import');
});
Route::controller(RegistrationController::class)->group(function () {
    Route::get('/registration/departement/{id}', 'getDepartement')->name('get.data');
    Route::get('/registration/show/{id}', 'getRegistrationByID')->name('admin.registration.show');
});
Route::get('/student/registration/pdf', [StudentRegistrationController::class, 'generateFormulir'])->name('student.registration.generateFormulir');
