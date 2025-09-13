<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\Admin\ContributionController as AdminContributionController;
use App\Http\Controllers\Admin\BenefitController as AdminBenefitController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Member\ProfileController as MemberProfileController;
use App\Http\Controllers\Member\BenefitController as MemberBenefitController;
use App\Http\Controllers\Member\ContributionController as MemberContributionController;
use App\Http\Controllers\Member\NotificationController as MemberNotificationController;
use App\Http\Controllers\Treasurer\DashboardController as TreasurerDashboardController;
use App\Http\Controllers\Treasurer\MemberController as TreasurerMemberController;
use App\Http\Controllers\Treasurer\ContributionController as TreasurerContributionController;

Route::get('/', function () {
    return view('landing');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Role-based Dashboard Routes
Route::middleware(['auth'])->group(function () {
    // Redirect to appropriate dashboard based on role
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isBarangayTreasurer()) {
            return redirect()->route('treasurer.dashboard');
        } else {
            return redirect()->route('member.dashboard');
        }
    })->name('dashboard');

    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('members', AdminMemberController::class);
        Route::resource('contributions', AdminContributionController::class);
        Route::resource('benefits', AdminBenefitController::class);
        
        // Additional admin routes
        Route::post('members/{member}/activate', [AdminMemberController::class, 'activate'])->name('members.activate');
        Route::post('members/{member}/suspend', [AdminMemberController::class, 'suspend'])->name('members.suspend');
        Route::post('contributions/{contribution}/validate', [AdminContributionController::class, 'validate'])->name('contributions.validate');
        Route::post('benefits/{benefit}/approve', [AdminBenefitController::class, 'approve'])->name('benefits.approve');
        Route::post('benefits/{benefit}/reject', [AdminBenefitController::class, 'reject'])->name('benefits.reject');
        Route::post('benefits/{benefit}/disburse', [AdminBenefitController::class, 'disburse'])->name('benefits.disburse');
    });

    // Member Routes
    Route::middleware(['role:member'])->prefix('member')->name('member.')->group(function () {
        Route::get('/dashboard', [MemberDashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [MemberProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [MemberProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [MemberProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [MemberProfileController::class, 'updatePassword'])->name('profile.password');
        Route::get('/benefits/my-requests', [MemberBenefitController::class, 'myRequests'])->name('benefits.my-requests');
        Route::resource('benefits', MemberBenefitController::class);
        Route::resource('contributions', MemberContributionController::class);
        Route::get('/notifications', [MemberNotificationController::class, 'index'])->name('notifications.index');
        Route::post('/notifications/mark-as-read', [MemberNotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');
        Route::post('/notifications/clear-all', [MemberNotificationController::class, 'clearAll'])->name('notifications.clear-all');
    });

    // Barangay Treasurer Routes
    Route::middleware(['role:barangay_treasurer'])->prefix('treasurer')->name('treasurer.')->group(function () {
        Route::get('/dashboard', [TreasurerDashboardController::class, 'index'])->name('dashboard');
        Route::resource('members', TreasurerMemberController::class);
        Route::resource('contributions', TreasurerContributionController::class);
    });
});
