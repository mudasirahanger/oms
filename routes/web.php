<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages\ProjectsController;
use App\Http\Controllers\Admin\DepartmentsController;
use App\Http\Controllers\Admin\EmployeesController;

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

// dumy / sample route
Route::get('/welcome', function () {
    return view('welcome');
});
// admin dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
// Project routes
Route::get('/addproject', [ProjectsController::class, 'create'])->middleware(['auth'])->name('addproject');
Route::get('/viewproject/{id}', [ProjectsController::class, 'view'])->middleware(['auth'])->name('viewproject');
Route::get('/listproject', [ProjectsController::class, 'list'])->middleware(['auth'])->name('listproject');
Route::post('/saveproject', [ProjectsController::class, 'save'])->middleware(['auth'])->name('saveproject');
Route::post('/updateproject', [ProjectsController::class, 'update'])->middleware(['auth'])->name('updateproject');
// Department routes
Route::get('/adddepartment', [DepartmentsController::class, 'create'])->middleware(['auth'])->name('adddepartment');
Route::get('/listdepartment', [DepartmentsController::class, 'list'])->middleware(['auth'])->name('listdepartment');
Route::post('/savedepartment', [DepartmentsController::class, 'save'])->middleware(['auth'])->name('savedepartment');
Route::post('/deldepartment', [DepartmentsController::class, 'delete'])->middleware(['auth'])->name('deldepartment');

// Employees routes 
Route::get('/listemployees', [EmployeesController::class, 'list'])->middleware(['auth'])->name('listemployees');
// Client routes
Route::get('/listclients', [ProjectsController::class, 'clientList'])->middleware(['auth'])->name('listclients');
// auth routes
require __DIR__.'/auth.php';
