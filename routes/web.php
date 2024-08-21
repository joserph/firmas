<?php

use App\Livewire\ConsolidationComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImportController;
use App\Livewire\CompanyMemberComponent;
use App\Livewire\LegalRepresentativeComponent;
use App\Livewire\NaturalPersonComponent;
use App\Livewire\PartnerComponent;
use App\Livewire\PermissionComponent;
use App\Livewire\PriceComponent;
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
    Route::get('permissions', PermissionComponent::class);
    Route::get('signatures', SignatureComponent::class)->name('signatures');
    Route::get('natural-persons', NaturalPersonComponent::class)->name('natural-persons');
    Route::get('partners', PartnerComponent::class)->name('partners');
    Route::get('prices', PriceComponent::class)->name('prices');
    Route::get('legal-representatives', LegalRepresentativeComponent::class)->name('legal-representatives');
    Route::get('company-members', CompanyMemberComponent::class)->name('company-members');
    Route::post('import-signatures', [ImportController::class, 'importSignatures'])->name('import-signatures');
    Route::get('consolidations', ConsolidationComponent::class)->name('consolidations');
});