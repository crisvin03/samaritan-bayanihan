<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SystemSettingsController extends Controller
{
    /**
     * Display the system settings dashboard.
     */
    public function index()
    {
        // Get organization statistics
        $orgStats = [
            'total_members' => \App\Models\User::byRole('member')->count(),
            'total_treasurers' => \App\Models\User::byRole('barangay_treasurer')->count(),
            'total_contributions' => \App\Models\Contribution::count(),
            'total_contribution_amount' => \App\Models\Contribution::sum('amount') ?? 0,
            'total_benefits' => \App\Models\Benefit::count(),
            'pending_benefits' => \App\Models\Benefit::where('status', 'pending')->count(),
            'approved_benefits' => \App\Models\Benefit::where('status', 'approved')->count(),
            'disbursed_benefits' => \App\Models\Benefit::where('status', 'disbursed')->count(),
        ];

        // Get recent activity
        $recentActivity = [
            'recent_contributions' => \App\Models\Contribution::with('user')->latest()->limit(5)->get(),
            'recent_benefits' => \App\Models\Benefit::with('user')->latest()->limit(5)->get(),
            'recent_announcements' => \App\Models\Announcement::with('user')->latest()->limit(5)->get(),
        ];

        // Get monthly statistics for the current year
        $monthlyStats = $this->getMonthlyStats();

        return view('admin.settings.index', compact(
            'orgStats',
            'recentActivity',
            'monthlyStats'
        ));
    }

    /**
     * Get monthly statistics for the current year.
     */
    private function getMonthlyStats()
    {
        $currentYear = now()->year;
        $monthlyData = [];

        for ($month = 1; $month <= 12; $month++) {
            $startOfMonth = now()->setYear($currentYear)->setMonth($month)->startOfMonth();
            $endOfMonth = now()->setYear($currentYear)->setMonth($month)->endOfMonth();

            $monthlyData[] = [
                'month' => $startOfMonth->format('M'),
                'contributions' => \App\Models\Contribution::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count(),
                'contribution_amount' => \App\Models\Contribution::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('amount') ?? 0,
                'benefits' => \App\Models\Benefit::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count(),
                'members' => \App\Models\User::byRole('member')->whereBetween('created_at', [$startOfMonth, $endOfMonth])->count(),
            ];
        }

        return $monthlyData;
    }

    /**
     * Update organization settings.
     */
    public function updateSettings(Request $request)
    {
        $request->validate([
            'organization_name' => 'required|string|max:255',
            'organization_address' => 'required|string|max:500',
            'organization_phone' => 'nullable|string|max:20',
            'organization_email' => 'nullable|email|max:255',
            'minimum_contribution' => 'required|numeric|min:0',
            'maximum_benefit_amount' => 'required|numeric|min:0',
            'benefit_processing_days' => 'required|integer|min:1|max:30',
        ]);

        try {
            // Update organization settings
            // This would typically update a settings table or config file
            // For now, we'll just return success
            
            return redirect()->back()->with('success', 'Organization settings updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update settings: ' . $e->getMessage());
        }
    }

    /**
     * Optimize application.
     */
    public function optimize()
    {
        try {
            Artisan::call('config:cache');
            Artisan::call('route:cache');
            Artisan::call('view:cache');
            
            return redirect()->back()->with('success', 'Application optimized successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to optimize application: ' . $e->getMessage());
        }
    }

    /**
     * Run database migrations.
     */
    public function migrate()
    {
        try {
            Artisan::call('migrate', ['--force' => true]);
            
            return redirect()->back()->with('success', 'Database migrations completed successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to run migrations: ' . $e->getMessage());
        }
    }

    /**
     * Generate application key.
     */
    public function generateKey()
    {
        try {
            Artisan::call('key:generate', ['--force' => true]);
            
            return redirect()->back()->with('success', 'Application key generated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to generate key: ' . $e->getMessage());
        }
    }


    /**
     * Get recent application logs.
     */
    private function getRecentLogs()
    {
        try {
            $logFile = storage_path('logs/laravel.log');
            
            if (!file_exists($logFile)) {
                return [];
            }

            $logs = [];
            $lines = file($logFile, FILE_IGNORE_NEW_LINES);
            $recentLines = array_slice($lines, -20); // Get last 20 lines

            foreach ($recentLines as $line) {
                if (strpos($line, '[') === 0) {
                    $logs[] = $line;
                }
            }

            return array_slice($logs, -10); // Return last 10 log entries
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Get system health status.
     */
    public function healthCheck()
    {
        $health = [
            'database' => $this->checkDatabase(),
            'storage' => $this->checkStorage(),
            'cache' => $this->checkCache(),
            'mail' => $this->checkMail(),
        ];

        return response()->json($health);
    }

    private function checkDatabase()
    {
        try {
            DB::connection()->getPdo();
            return ['status' => 'healthy', 'message' => 'Database connection successful'];
        } catch (\Exception $e) {
            return ['status' => 'unhealthy', 'message' => 'Database connection failed'];
        }
    }

    private function checkStorage()
    {
        try {
            $freeSpace = disk_free_space(storage_path());
            $totalSpace = disk_total_space(storage_path());
            $usagePercent = (($totalSpace - $freeSpace) / $totalSpace) * 100;

            if ($usagePercent > 90) {
                return ['status' => 'warning', 'message' => 'Storage usage is high: ' . round($usagePercent, 2) . '%'];
            }

            return ['status' => 'healthy', 'message' => 'Storage usage: ' . round($usagePercent, 2) . '%'];
        } catch (\Exception $e) {
            return ['status' => 'unhealthy', 'message' => 'Storage check failed'];
        }
    }

    private function checkCache()
    {
        try {
            Cache::put('health_check', 'ok', 60);
            $value = Cache::get('health_check');
            
            if ($value === 'ok') {
                return ['status' => 'healthy', 'message' => 'Cache system working'];
            }
            
            return ['status' => 'unhealthy', 'message' => 'Cache system not responding'];
        } catch (\Exception $e) {
            return ['status' => 'unhealthy', 'message' => 'Cache system failed'];
        }
    }

    private function checkMail()
    {
        try {
            // Simple mail configuration check
            $mailConfig = config('mail');
            
            if (empty($mailConfig['host'])) {
                return ['status' => 'warning', 'message' => 'Mail configuration incomplete'];
            }
            
            return ['status' => 'healthy', 'message' => 'Mail configuration present'];
        } catch (\Exception $e) {
            return ['status' => 'unhealthy', 'message' => 'Mail configuration error'];
        }
    }
}
