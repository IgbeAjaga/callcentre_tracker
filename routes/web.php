<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\OutgoingController;
use App\Http\Controllers\IncomingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified', 'checkApproval'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->role == 'admin') {
            return view('adminDashboard');
        } elseif ($user->role == 'superadmin') {
            return view('superAdminDashboard');
        } elseif ($user->role == 'customercare') {
            return view('customerCareDashboard');
        } else {
            return view('dashboard');
        }
    })->name('dashboard');
});

Route::group(['middleware' => ['auth', 'checkApproval']], function () {
    // Add any routes that need to be protected by the checkApproval middleware
});

// Routes for admin and superadmin
Route::middleware(['auth', 'verified', 'checkApproval', 'admin_or_superadmin'])->group(function () {
    Route::get('profile/index', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/alloutgoing', [OutgoingController::class, 'index'])->name('alloutgoing');
    Route::get('/allincoming', [IncomingController::class, 'index'])->name('allincoming');
    Route::get('/search', [OutgoingController::class, 'search'])->name('search');
    Route::get('/searchin', [IncomingController::class, 'search'])->name('searchin');
    Route::get('/export/incomingcalls', [IncomingController::class, 'export'])->name('incomingcalls.export');
Route::get('/export/outgoingcalls', [OutgoingController::class, 'export'])->name('outgoingcalls.export');
    Route::get('/incoming/all', [IncomingController::class, 'index'])->name('incoming.index');
    Route::get('/outgoing/all', [OutgoingController::class, 'index'])->name('outgoing.index');
});

// Strict superadmin middleware routes
Route::middleware(['auth', 'verified', 'checkApproval', 'superadmin'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperAdminDashboardController::class, 'index'])->name('superadmin.dashboard');
    Route::get('/approve-users', [ProfileController::class, 'approveUsersView'])->name('approve_users');
    Route::patch('/profile/approve/{id}', [ProfileController::class, 'approve'])->name('profile.approve');
    Route::patch('/profile/disapprove/{id}', [ProfileController::class, 'disapprove'])->name('profile.disapprove');
});

// Strict admin middleware routes
Route::middleware(['auth', 'verified', 'checkApproval', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

// Strict customercare middleware routes
Route::middleware(['auth', 'verified', 'checkApproval', 'customercare'])->group(function () {
    Route::get('/customercare/dashboard', [CustomerCareDashboardController::class, 'index'])->name('customercare.dashboard');
});

Route::middleware(['auth', 'verified', 'checkApproval'])->group(function () {
    Route::get('/outgoing/create', [OutgoingController::class, 'create'])->name('outgoing.create');
    Route::post('/outgoing/store', [OutgoingController::class, 'store'])->name('outgoing.store');
    Route::get('/incoming/add', [IncomingController::class, 'create'])->name('incoming.create');
    Route::post('/incoming/store', [IncomingController::class, 'store'])->name('incoming.store');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('incomingcalls', IncomingController::class);
    Route::resource('outgoingcalls', OutgoingController::class);
    Route::get('/addincoming', [IncomingController::class, 'create'])->name('addincoming');
    Route::get('/create', [OutgoingController::class, 'create'])->name('create');
});

require __DIR__.'/auth.php';
