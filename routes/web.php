<?php

use App\Models\Material;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ReportDetailsController;

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
    $materials = Material::all();
    return view('welcome', compact('materials'));
})->name('welcome');
Route::get('/guest-materials/{id}', function ($id) {
    $material = Material::find($id);
    return view('guest-material', compact('material'));
})->name('guest-material');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => ['role:Super Admin|Admin|User']], function () {
    });
    Route::group(['middleware' => ['role:Super Admin|Admin|User']], function () {
        Route::get('/dashboard', [QuizController::class, 'index'])->name('dashboard');
        Route::get('/generate-quiz/{question}', [QuizController::class, 'initiate'])->name('generate-quiz');
        Route::get('/quiz', \App\Http\Livewire\Quizzes::class)->name('quizzes');
        Route::get('/history', \App\Http\Livewire\History::class)->name('history');
        Route::get('/user-materials', \App\Http\Livewire\UserMaterials::class)->name('user-materials');
        Route::get('/user-materials/{id}', [MaterialController::class, 'show'])->name('user-materials-show');
    });

    Route::group(['middleware' => ['role:Super Admin|Admin']], function () {
        Route::get('/roles', \App\Http\Livewire\Roles::class)->name('roles');
        Route::get('/users', \App\Http\Livewire\Users::class)->name('users');
        Route::get('/questions', \App\Http\Livewire\Questions::class)->name('questions');
        Route::get('/questions-form', \App\Http\Livewire\QuestionsForm::class)->name('questions-form');
        Route::get('/materials', \App\Http\Livewire\Materials::class)->name('materials');
        Route::get('/materials-form', \App\Http\Livewire\MaterialsForm::class)->name('materials-form');
        Route::get('/reports', \App\Http\Livewire\Reports::class)->name('reports');
        Route::get('/reports/{quiz_id}', [ReportDetailsController::class, 'show'])->name('report-details');
    });
});