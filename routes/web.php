<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\Admin\TreasurerController as AdminTreasurerController;
use App\Http\Controllers\Admin\ContributionController as AdminContributionController;
use App\Http\Controllers\Admin\BenefitController as AdminBenefitController;
use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\SystemSettingsController as AdminSystemSettingsController;
use App\Http\Controllers\Admin\DocumentVerificationController as AdminDocumentVerificationController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Member\ProfileController as MemberProfileController;
use App\Http\Controllers\Member\BenefitController as MemberBenefitController;
use App\Http\Controllers\Member\ContributionController as MemberContributionController;
use App\Http\Controllers\Member\NotificationController as MemberNotificationController;
use App\Http\Controllers\Member\AnnouncementController as MemberAnnouncementController;
use App\Http\Controllers\Member\PassbookController as MemberPassbookController;
use App\Http\Controllers\Treasurer\DashboardController as TreasurerDashboardController;
use App\Http\Controllers\Treasurer\MemberController as TreasurerMemberController;
use App\Http\Controllers\Treasurer\ContributionController as TreasurerContributionController;
use App\Http\Controllers\Treasurer\BenefitController as TreasurerBenefitController;
use App\Http\Controllers\Treasurer\ReportController as TreasurerReportController;
use App\Http\Controllers\Treasurer\AnnouncementController as TreasurerAnnouncementController;
use App\Models\Announcement;
use App\Models\User;
use App\Services\NotificationService;

Route::get('/', function () {
    return view('landing');
});

// Test notification route (remove in production)
Route::get('/test-notification', function () {
    $user = User::first();
    if (!$user) {
        return 'No users found';
    }
    
    $announcement = Announcement::create([
        'title' => 'Test Announcement',
        'content' => 'This is a test announcement for notifications',
        'priority' => 'medium',
        'target_audience' => 'all',
        'is_published' => true,
        'created_by' => $user->id,
    ]);
    
    $notificationService = new NotificationService();
    $notificationService->createAnnouncementNotification($announcement);
    
    return 'Test notification created successfully!';
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginSelect'])->name('login.select');
Route::get('/login/member', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login/member', [AuthController::class, 'login']);
Route::get('/login/admin', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/login/admin', [AuthController::class, 'adminLogin']);
Route::get('/login/treasurer', [AuthController::class, 'showTreasurerLogin'])->name('treasurer.login');
Route::post('/login/treasurer', [AuthController::class, 'treasurerLogin']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Email Verification Routes
Route::get('/verify-email', [App\Http\Controllers\VerificationController::class, 'showEmailVerification'])->name('verify-email');
Route::get('/verify-email/verify', [App\Http\Controllers\VerificationController::class, 'verifyEmail'])->name('verify-email.verify');
Route::post('/resend-verification', [App\Http\Controllers\VerificationController::class, 'resendVerification'])->name('resend-verification');

// Phone Verification Routes
Route::get('/verify-phone', [App\Http\Controllers\VerificationController::class, 'showPhoneVerification'])->name('verify-phone');
Route::post('/send-phone-verification', [App\Http\Controllers\VerificationController::class, 'sendPhoneVerification'])->name('send-phone-verification');
Route::post('/verify-phone', [App\Http\Controllers\VerificationController::class, 'verifyPhone'])->name('verify-phone.verify');
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
        Route::resource('treasurers', AdminTreasurerController::class);
        Route::resource('contributions', AdminContributionController::class);
        Route::resource('benefits', AdminBenefitController::class);
        Route::resource('announcements', AdminAnnouncementController::class);
        
        // Reports and Analytics
        Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/financial', [AdminReportController::class, 'financial'])->name('reports.financial');
        Route::get('/reports/members', [AdminReportController::class, 'members'])->name('reports.members');
        Route::get('/reports/benefits', [AdminReportController::class, 'benefits'])->name('reports.benefits');
        Route::get('/reports/export', [AdminReportController::class, 'export'])->name('reports.export');
        
        // Test route for debugging
        Route::get('/test-reports', function() {
            return 'Reports test route is working!';
        })->name('test.reports');
        
        // Test view route
        Route::get('/test-reports-view', function() {
            return view('admin.reports.test');
        })->name('test.reports.view');
        
        // Additional admin routes
        Route::post('members/{member}/activate', [AdminMemberController::class, 'activate'])->name('members.activate');
        Route::post('members/{member}/suspend', [AdminMemberController::class, 'suspend'])->name('members.suspend');
        Route::post('treasurers/{treasurer}/activate', [AdminTreasurerController::class, 'activate'])->name('treasurers.activate');
        Route::post('treasurers/{treasurer}/suspend', [AdminTreasurerController::class, 'suspend'])->name('treasurers.suspend');
        Route::post('contributions/{contribution}/validate', [AdminContributionController::class, 'validate'])->name('contributions.validate');
        
        // Document Verification Routes
        Route::get('document-verification', [AdminDocumentVerificationController::class, 'index'])->name('document-verification.index');
        Route::get('document-verification/{id}', [AdminDocumentVerificationController::class, 'show'])->name('document-verification.show');
        Route::post('document-verification/{id}/approve', [AdminDocumentVerificationController::class, 'approve'])->name('document-verification.approve');
        Route::post('document-verification/{id}/reject', [AdminDocumentVerificationController::class, 'reject'])->name('document-verification.reject');
        Route::post('benefits/{benefit}/approve', [AdminBenefitController::class, 'approve'])->name('benefits.approve');
        Route::post('benefits/{benefit}/reject', [AdminBenefitController::class, 'reject'])->name('benefits.reject');
        Route::post('benefits/{benefit}/disburse', [AdminBenefitController::class, 'disburse'])->name('benefits.disburse');
        Route::post('announcements/{announcement}/publish', [AdminAnnouncementController::class, 'publish'])->name('announcements.publish');
        Route::post('announcements/{announcement}/unpublish', [AdminAnnouncementController::class, 'unpublish'])->name('announcements.unpublish');

        // System Settings
        Route::get('/settings', [AdminSystemSettingsController::class, 'index'])->name('settings.index');
        Route::post('/settings/clear-cache', [AdminSystemSettingsController::class, 'clearCache'])->name('settings.clear-cache');
        Route::post('/settings/optimize', [AdminSystemSettingsController::class, 'optimize'])->name('settings.optimize');
        Route::post('/settings/migrate', [AdminSystemSettingsController::class, 'migrate'])->name('settings.migrate');
        Route::post('/settings/generate-key', [AdminSystemSettingsController::class, 'generateKey'])->name('settings.generate-key');
        Route::put('/settings', [AdminSystemSettingsController::class, 'updateSettings'])->name('settings.update');
        Route::get('/settings/health-check', [AdminSystemSettingsController::class, 'healthCheck'])->name('settings.health-check');
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
        Route::get('/announcements', [MemberAnnouncementController::class, 'index'])->name('announcements.index');
        Route::get('/announcements/{announcement}', [MemberAnnouncementController::class, 'show'])->name('announcements.show');
        Route::get('/passbook', [MemberPassbookController::class, 'index'])->name('passbook');
        Route::post('/profile/upload-documents', [App\Http\Controllers\Member\ProfileController::class, 'uploadDocuments'])->name('profile.upload-documents');
    });

    // Barangay Treasurer Routes
    Route::middleware(['role:barangay_treasurer'])->prefix('treasurer')->name('treasurer.')->group(function () {
        Route::get('/dashboard', [TreasurerDashboardController::class, 'index'])->name('dashboard');
        Route::resource('members', TreasurerMemberController::class);
        Route::resource('contributions', TreasurerContributionController::class);
        Route::resource('benefits', TreasurerBenefitController::class)->only(['index', 'show']);
        Route::post('benefits/{benefit}/forward', [TreasurerBenefitController::class, 'forward'])->name('benefits.forward');
        Route::post('benefits/{benefit}/reject', [TreasurerBenefitController::class, 'reject'])->name('benefits.reject');
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/', [TreasurerReportController::class, 'index'])->name('index');
            Route::get('/financial', [TreasurerReportController::class, 'financial'])->name('financial');
            Route::get('/members', [TreasurerReportController::class, 'members'])->name('members');
            Route::get('/benefits', [TreasurerReportController::class, 'benefits'])->name('benefits');
        });
        Route::resource('announcements', TreasurerAnnouncementController::class);
    });
});
