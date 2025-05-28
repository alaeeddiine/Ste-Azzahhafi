<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\PublicController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\CarburantController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\EtatJournalierController;

// --- Public Routes ---
Route::get('/', [PublicController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// --- Admin Login Page (GET) ---
Route::get('/admin', function () {
    return view('admin.login'); 
})->name('admin.login');

// --- Admin Login Submission (POST) ---
Route::post('/admin/dashboard', [AdminAuthController::class, 'login'])->name('admin.auth');

// --- Admin Dashboard ---
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

// --- Grouped Admin Routes (with session check) ---
Route::prefix('admin-azzahhafi')->group(function () {
    Route::get('/employes', function () {
        if (!session('admin_logged_in')) return redirect('/admin-login');
        return view('admin.employes');
    })->name('admin.employes');

    Route::resource('employes', EmployeController::class)->names([
        'index' => 'admin.employes',
    ])->except(['show']);
});

// --- Admin Logout ---
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/admin');
})->name('logout');

// --- Carburant Management ---
Route::get('admin/carburant', [CarburantController::class, 'index'])->name('admin.carburant');
Route::post('admin/carburant', [CarburantController::class, 'store'])->name('admin.carburant.store');

// --- Stock Management ---
Route::get('/admin/stock', [StockController::class, 'index'])->name('admin.stock');
Route::post('/admin/stock', [StockController::class, 'store'])->name('admin.stock.store');

// --- Daily Report Management ---
Route::get('admin/etat-journalier', [EtatJournalierController::class, 'index'])->name('admin.etat');
Route::post('admin/etat-journalier', [EtatJournalierController::class, 'store'])->name('admin.etat.store');
