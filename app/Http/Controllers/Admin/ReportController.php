<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contribution;
use App\Models\Benefit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        // Debug: Log that the method is being called
        \Log::info('ReportController index method called');
        
        // Basic statistics - simplified for testing
        $stats = [
            'total_members' => 0,
            'total_contributions' => 0,
            'total_contribution_amount' => 0,
            'total_benefits' => 0,
            'pending_benefits' => 0,
            'approved_benefits' => 0,
            'disbursed_benefits' => 0,
        ];

        try {
            // Get date range for current month
            $currentMonth = Carbon::now();
            $startOfMonth = $currentMonth->copy()->startOfMonth();
            $endOfMonth = $currentMonth->copy()->endOfMonth();

            // Basic statistics
            $stats = [
                'total_members' => User::byRole('member')->count(),
                'total_contributions' => Contribution::count(),
                'total_contribution_amount' => Contribution::sum('amount') ?? 0,
                'total_benefits' => Benefit::count(),
                'pending_benefits' => Benefit::where('status', 'pending')->count(),
                'approved_benefits' => Benefit::where('status', 'approved')->count(),
                'disbursed_benefits' => Benefit::where('status', 'disbursed')->count(),
            ];

        // Simplified data collection
        $contributionTrends = collect([]);
        $contributionByType = collect([]);
        $benefitsByStatus = collect([]);
        $benefitTrends = collect([]);
        $topContributors = collect([]);
        $recentContributions = collect([]);
        $recentBenefits = collect([]);

            return view('admin.reports.index', compact(
                'stats',
                'contributionTrends',
                'contributionByType',
                'benefitsByStatus',
                'benefitTrends',
                'topContributors',
                'recentContributions',
                'recentBenefits'
            ));
        } catch (\Exception $e) {
            // Log the error and return a simple view
            \Log::error('ReportController index error: ' . $e->getMessage());
            
            // Return basic stats with empty data
            $stats = [
                'total_members' => 0,
                'total_contributions' => 0,
                'total_contribution_amount' => 0,
                'total_benefits' => 0,
                'pending_benefits' => 0,
                'approved_benefits' => 0,
                'disbursed_benefits' => 0,
            ];
            
            $contributionTrends = collect([]);
            $contributionByType = collect([]);
            $benefitsByStatus = collect([]);
            $benefitTrends = collect([]);
            $topContributors = collect([]);
            $recentContributions = collect([]);
            $recentBenefits = collect([]);
            
            return view('admin.reports.index', compact(
                'stats',
                'contributionTrends',
                'contributionByType',
                'benefitsByStatus',
                'benefitTrends',
                'topContributors',
                'recentContributions',
                'recentBenefits'
            ));
        }
    }

    public function financial()
    {
        // Financial reports
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        // Monthly financial summary
        $monthlySummary = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthStart = Carbon::create($currentYear, $i, 1)->startOfMonth();
            $monthEnd = Carbon::create($currentYear, $i, 1)->endOfMonth();

            $contributions = Contribution::whereBetween('contribution_date', [$monthStart, $monthEnd])
                ->where('status', 'validated')
                ->sum('amount');

            $benefits = Benefit::whereBetween('created_at', [$monthStart, $monthEnd])
                ->where('status', 'disbursed')
                ->sum('approved_amount');

            $monthlySummary[] = [
                'month' => $monthStart->format('M Y'),
                'contributions' => $contributions,
                'benefits' => $benefits,
                'net' => $contributions - $benefits
            ];
        }

        // Contribution breakdown by type
        $contributionBreakdown = Contribution::select('type', DB::raw('SUM(amount) as total'))
            ->where('status', 'validated')
            ->groupBy('type')
            ->get();

        // Benefits breakdown by type
        $benefitBreakdown = Benefit::select('benefit_type', DB::raw('SUM(approved_amount) as total'))
            ->where('status', 'disbursed')
            ->groupBy('benefit_type')
            ->get();

        // Year-over-year comparison
        $previousYear = $currentYear - 1;
        $currentYearData = [
            'contributions' => Contribution::whereYear('contribution_date', $currentYear)
                ->where('status', 'validated')
                ->sum('amount'),
            'benefits' => Benefit::whereYear('created_at', $currentYear)
                ->where('status', 'disbursed')
                ->sum('approved_amount')
        ];

        $previousYearData = [
            'contributions' => Contribution::whereYear('contribution_date', $previousYear)
                ->where('status', 'validated')
                ->sum('amount'),
            'benefits' => Benefit::whereYear('created_at', $previousYear)
                ->where('status', 'disbursed')
                ->sum('approved_amount')
        ];

        return view('admin.reports.financial', compact(
            'monthlySummary',
            'contributionBreakdown',
            'benefitBreakdown',
            'currentYearData',
            'previousYearData',
            'currentYear',
            'previousYear'
        ));
    }

    public function members()
    {
        // Member analytics
        $totalMembers = User::byRole('member')->count();
        $activeMembers = User::byRole('member')->whereHas('contributions')->count();
        $inactiveMembers = $totalMembers - $activeMembers;

        // Members by barangay
        $membersByBarangay = User::byRole('member')
            ->select('barangay', DB::raw('COUNT(*) as count'))
            ->groupBy('barangay')
            ->orderBy('count', 'desc')
            ->get();

        // Member registration trends
        $registrationTrends = User::byRole('member')
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('COUNT(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Member contribution activity
        $contributionActivity = User::byRole('member')
            ->withCount('contributions')
            ->withSum('contributions', 'amount')
            ->having('contributions_count', '>', 0)
            ->orderBy('contributions_sum_amount', 'desc')
            ->limit(20)
            ->get();

        // New members this month
        $newMembersThisMonth = User::byRole('member')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Members with pending benefits
        $membersWithPendingBenefits = User::byRole('member')
            ->whereHas('benefits', function($query) {
                $query->where('status', 'pending');
            })
            ->count();

        return view('admin.reports.members', compact(
            'totalMembers',
            'activeMembers',
            'inactiveMembers',
            'membersByBarangay',
            'registrationTrends',
            'contributionActivity',
            'newMembersThisMonth',
            'membersWithPendingBenefits'
        ));
    }

    public function benefits()
    {
        // Benefit analytics
        $totalBenefits = Benefit::count();
        $pendingBenefits = Benefit::where('status', 'pending')->count();
        $approvedBenefits = Benefit::where('status', 'approved')->count();
        $disbursedBenefits = Benefit::where('status', 'disbursed')->count();
        $rejectedBenefits = Benefit::where('status', 'rejected')->count();

        // Benefits by type
        $benefitsByType = Benefit::select('benefit_type', DB::raw('COUNT(*) as count'), DB::raw('SUM(requested_amount) as total_requested'), DB::raw('SUM(approved_amount) as total_approved'))
            ->groupBy('benefit_type')
            ->get();

        // Benefits by status over time
        $benefitsByStatusOverTime = Benefit::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                'status',
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(12))
            ->groupBy('month', 'status')
            ->orderBy('month')
            ->get()
            ->groupBy('month');

        // Average processing time
        $avgProcessingTime = Benefit::whereNotNull('reviewed_at')
            ->whereNotNull('created_at')
            ->selectRaw('AVG(DATEDIFF(reviewed_at, created_at)) as avg_days')
            ->first();

        // Benefits by barangay
        $benefitsByBarangay = Benefit::join('users', 'benefits.user_id', '=', 'users.id')
            ->select('users.barangay', DB::raw('COUNT(*) as count'), DB::raw('SUM(benefits.approved_amount) as total_approved'))
            ->groupBy('users.barangay')
            ->orderBy('count', 'desc')
            ->get();

        // Top benefit recipients
        $topBenefitRecipients = User::byRole('member')
            ->withCount('benefits')
            ->withSum('benefits', 'approved_amount')
            ->having('benefits_count', '>', 0)
            ->orderBy('benefits_sum_approved_amount', 'desc')
            ->limit(10)
            ->get();

        return view('admin.reports.benefits', compact(
            'totalBenefits',
            'pendingBenefits',
            'approvedBenefits',
            'disbursedBenefits',
            'rejectedBenefits',
            'benefitsByType',
            'benefitsByStatusOverTime',
            'avgProcessingTime',
            'benefitsByBarangay',
            'topBenefitRecipients'
        ));
    }

    public function export(Request $request)
    {
        $type = $request->get('type', 'contributions');
        $format = $request->get('format', 'csv');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        // Implementation for data export
        // This would typically generate CSV/Excel files
        // For now, we'll return a success message
        return redirect()->back()->with('success', 'Export functionality will be implemented soon.');
    }
}
