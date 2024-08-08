<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Livewire\NaturalPersonComponent;
use App\Livewire\PartnerComponent;
use App\Livewire\PermissionComponent;
use App\Livewire\SignatureComponent;
use Illuminate\Support\Facades\Auth;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('/roles', RoleController::class);
    Route::resource('/users', UserController::class);
    // Route::resource('blogs', BlogController::class);
    Route::get('permissions', PermissionComponent::class);
    Route::get('signatures', SignatureComponent::class)->name('signatures');
    Route::get('natural-persons', NaturalPersonComponent::class)->name('natural-persons');
    Route::get('partners', PartnerComponent::class)->name('partners');
});