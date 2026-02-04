<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;

# ---------------- AUTH ROUTES ----------------
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

# ---------------- ROOT REDIRECT ----------------
Route::get('/', fn() => redirect()->route('contacts.index'));

# ---------------- CONTACT ROUTES ----------------

# ---------------- CONTACTS ROUTES ----------------

// List all contacts (index page)
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');

// Protected routes (requires login)
Route::middleware('auth')->group(function () {

    // Create & Store
    Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
    Route::post('/contacts/save', [ContactController::class, 'store'])->name('contacts.save');

    // Edit, Update & Delete
    Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
    Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    // Trashed contacts
    Route::get('/contacts/trashed/list', [ContactController::class, 'trashed'])->name('contacts.trashed');
    Route::post('/contacts/{id}/restore', [ContactController::class, 'restore'])->name('contacts.restore');
    Route::delete('/contacts/{id}/force-delete', [ContactController::class, 'forceDelete'])->name('contacts.forceDelete');

    // Toggle active/inactive via AJAX
    Route::post('/contacts/{contact}/toggle-active', [ContactController::class, 'toggleActive'])->name('contacts.toggleActive');
});

// Show single contact (must be last)
Route::get('/contacts/{contact}', [ContactController::class, 'show'])
    ->whereNumber('contact')
    ->name('contacts.show');

