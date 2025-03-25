<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DrugsController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Mail;

// Test email route
Route::get('/test-mail', function () {
    Mail::raw('Test email from Care Pharmacy', function ($message) {
        $message->to('test@example.com')
                ->subject('Mailtrap Test');
    });
    return 'Email sent!';
});

// Password reset routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Authentication routes
Route::get('/', [HomeController::class, 'showHome'])->name('home');
Route::get('/login', function () {
    return view('login');
})->name("showlogin");

Route::get('/login/{param}', function ($username) {
    return view('login', [
        'username' => $username,
        'Error' => "<span class='error'>Username or Password is incorrect</span>",
    ]);
})->name("slogin_param");

Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/home', [HomeController::class, 'showHome'])->name('home');

// Drug management routes
Route::prefix('drugs')->group(function () {
    Route::get('/add', [DrugsController::class, 'showAddDrug'])->name('showAddDrug');
    Route::post('/add', [DrugsController::class, 'handleAddDrug'])->name('handleAddDrug');
    Route::get('/all', [DrugsController::class, 'showAllDrugs'])->name('showAllDrugs');
    Route::get('/{id}', [DrugsController::class, 'showDrug'])->name('showDrug');
    Route::get('/update/{id}', [DrugsController::class, 'showUpdateDrug'])->name('showUpdateDrug');
    Route::post('/update/{id}', [DrugsController::class, 'handleUpdateDrug'])->name('handleUpdateDrug');
    Route::delete('delete/drug/{id}', [DrugsController::class, 'deleteDrug'])->name('deleteDrug');
    Route::get('/drugs/search', [DrugsController::class, 'DrugsSearch'])->name('DrugsSearch');
    Route::get('/export/csv', [DrugsController::class, 'exportCsv'])->name('exportDrugsCsv');
});

// Purchase management routes
Route::prefix('purchases')->group(function () {
    Route::get('/', [PurchaseController::class, 'showPurchase'])->name('showPurchase');
    Route::post('/', [PurchaseController::class, 'handlePurchase'])->name('handlePurchase');
    Route::get('/all', [PurchaseController::class, 'showallPurchases'])->name('showallPurchase');
    Route::post('/delete/{purchaseId}/{prodId}', [PurchaseController::class, 'deletePurchase'])->name('deletePurchase');
    Route::get('/search', [PurchaseController::class, 'PurchaseSearch'])->name('PurchaseSearch');
    Route::get('/export/csv', [PurchaseController::class, 'exportCsv'])->name('exportPurchasesCsv');
});

// Staff management routes
Route::prefix('staff')->group(function () {
    Route::get('/', [UserController::class, 'showAllStaff'])->name('showAllStaff');
    Route::post('/register', [UserController::class, 'handleRegister'])->name('handleRegister');
    Route::post('/search', [UserController::class, 'staffSearch'])->name('staffSearch');
    Route::post('/delete', [UserController::class, 'staffDelete'])->name('staffDelete');
});

// Profile settings routes
Route::prefix('profile')->group(function () {
    Route::get('/', [SettingsController::class, 'showProfile'])->name('showProfile');
    Route::post('/update', [SettingsController::class, 'handleProfileUpdate'])->name('updateProfile');
    Route::post('/update-title', [SettingsController::class, 'updateTitle'])->name('updateTitle');
    Route::post('/update-username', [SettingsController::class, 'handleUsernameUpdate'])->name('updateUsername');
    Route::post('/update-password', [SettingsController::class, 'handlePasswordUpdate'])->name('updatePassword');
    Route::post('/delete-image', [SettingsController::class, 'deleteImg'])->name('deleteImg');
});

// Logout route
Route::get('/logout', function () {
    $userId = session('userid');
    session()->invalidate();
    session()->regenerateToken();
    return redirect()->route('showlogin');
})->name('logout');

// Fallback route
Route::fallback(function () {
    return view('subviews.wentWrong');
});